<?php

namespace App\Jobs;

use App\Enums\JobStatusEnum;
use App\Importers\ImporterParent;
use App\Models\ImportRequest;
use App\Models\Tools\BugReport;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportRequestsJob extends BaseJob implements ShouldQueue {

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var ImportRequest */
    protected $import_request;

    /**
     * @throws Exception
     */
    public function processJob() {
        /** @var ImportRequest $import_request */
        $import_request = ImportRequest::query()
            ->where('user_id', $this->getUser()->id)
            ->where(function ($query) {
                $query->where('status', JobStatusEnum::QUEUED())
                    ->orWhereRaw(DB::raw(
                        'status = \'' . JobStatusEnum::WORKING() . '\'' .
                        ' AND updated_at < \'' . Carbon::parse('20 minutes ago') . '\''
                    ));
            })
            ->orderBy('id')
            ->first();

        if (!$import_request) {
            console_log('There\'s no pending ImportRequest to process');
            return;
        }

        $this->processImport($import_request);
    }

    /**
     * @throws Exception
     */
    public function processImport(ImportRequest $import_request) {
        $this->import_request = $import_request;
        $this->import_request->status = JobStatusEnum::WORKING();
        $this->import_request->error = '';
        $this->import_request->save();

        console_log('Starting import ID:' . $this->import_request->id . ' ' . $this->import_request->report_type);

        try {
            /** @var ImporterParent $report_class */
            $class = $this->import_request->getImporter();
            $report_class = new $class($this->import_request->fresh());

            $report_class->process();

        } catch (Exception $ex) {
            console_log($ex->getMessage());
            console_log($ex->getTraceAsString());
            console_log('Failed import ID:' . $this->import_request->id . ' ' . $this->import_request->report_type);
            BugReport::logException($ex, $this->getUser());

            $this->import_request->status = JobStatusEnum::FAILED();
            $this->import_request->error = $ex->getMessage();
            $this->import_request->save();
        }
    }
}
