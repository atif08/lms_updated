<?php

namespace App\Jobs\Traits;

use App\Enums\JobStatusEnum;
use App\Models\Tools\JobChunk;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait JobChunkHandler {

    /** @var JobChunk */
    protected $job_chunk;

    protected function getJobChunk($isForce): JobChunk {
        $conditions = [
            'user_id'   => $this->getUser()->id,
            'job_class' => get_class_name($this),
            'exe_date'  => Carbon::now()->toDateString()
        ];
        $data = [
            'status'     => JobStatusEnum::PENDING(),
            'started_at' => Carbon::now()
        ];

        if (!$this->job_chunk) {
            if ($isForce) {

                $this->job_chunk = JobChunk::query()->create(array_merge($conditions, $data));
                Log::info(json_encode($this->job_chunk));

            } else {

                $this->job_chunk = JobChunk::query()->firstOrCreate($conditions, $data);

            }
        }

        return $this->job_chunk;
    }

    protected function isDoneForToday(bool $isForced = false): bool {
        return $this->getJobChunk($isForced)->status == JobStatusEnum::DONE();
    }

    protected function updateJobChunk($last_index): void {
        $this->job_chunk->status = JobStatusEnum::WORKING();
        $this->job_chunk->last_index = $last_index;
        $this->job_chunk->save();
    }

    protected function completeJobChunk(): void {
        $this->job_chunk->status = JobStatusEnum::DONE();
        $this->job_chunk->completed_at = Carbon::now();
        $this->job_chunk->save();
    }

    protected function getLastIndex(): int {
        return $this->job_chunk->last_index ?? 0;
    }

}
