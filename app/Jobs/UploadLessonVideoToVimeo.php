<?php

namespace App\Jobs;

use App\Services\VimeoService;
use Domain\Courses\Models\Lesson;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Log;

class UploadLessonVideoToVimeo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Allow long-running uploads (30 minutes). Adjust as needed for larger files.
     */
    public int $timeout = 1800;

    /**
     * We don't want automatic retries for long uploads unless explicitly desired.
     */
    public int $tries = 1;

    public function __construct(public int $lessonId, public int $mediaId)
    {
    }

    public function handle(VimeoService $vimeo): void
    {
        // Ensure PHP won't interrupt long transfers
        if (function_exists('set_time_limit')) {
            @set_time_limit(0);
        }

        $lesson = Lesson::query()->find($this->lessonId);
        $media = Media::query()->find($this->mediaId);

        if (!$lesson || !$media) {
            return;
        }

        $path = $media->getPath();

        Log::info('UploadLessonVideoToVimeo started', [
            'lesson_id' => $lesson->id,
            'media_id' => $media->id,
            'path' => $path,
        ]);

        $data = $vimeo->upload(
            absoluteFilePath: $path,
            name: $lesson->name,
            description: strip_tags((string) $lesson->description)
        );

        $lesson->forceFill([
            'vimeo_id' => $data['id'] ?? null,
            'vimeo_uri' => $data['uri'] ?? null,
            'vimeo_embed_url' => $data['player_embed_url'] ?? ($data['id'] ? ('https://player.vimeo.com/video/' . $data['id']) : null),
            'vimeo_ready' => true,
        ])->save();

        // Remove local media file to avoid storing video in both places
        try {
            $media->delete();
            Log::info('Local video media deleted after Vimeo upload', [
                'lesson_id' => $lesson->id,
                'media_id' => $this->mediaId,
            ]);
        } catch (\Throwable $e) {
            Log::warning('Failed to delete local media after Vimeo upload', [
                'lesson_id' => $lesson->id,
                'media_id' => $this->mediaId,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
