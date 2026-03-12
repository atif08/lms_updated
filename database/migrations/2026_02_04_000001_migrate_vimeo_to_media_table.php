<?php

use Domain\Courses\Models\Lesson;
use Domain\FileLibrary\Enums\MediaCollectionEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Migrate existing Vimeo data from lessons table to media table
        $lessonsWithVimeo = Lesson::whereNotNull('vimeo_embed_url')
            ->whereNotNull('vimeo_id')
            ->get();

        foreach ($lessonsWithVimeo as $lesson) {
            try {
                // Create a media entry manually for the Vimeo video
                // We don't use addMediaFromUrl because Vimeo embed URLs are not downloadable
                $media = new \Spatie\MediaLibrary\MediaCollections\Models\Media([
                    'model_type' => get_class($lesson),
                    'model_id' => $lesson->id,
                    'uuid' => \Illuminate\Support\Str::uuid(),
                    'collection_name' => 'videos',
                    'name' => $lesson->name . ' - Video',
                    'file_name' => 'vimeo_' . $lesson->vimeo_id . '.mp4',
                    'mime_type' => 'video/mp4',
                    'disk' => 'public',
                    'conversions_disk' => 'public',
                    'size' => 0, // External URL, no file size
                    'manipulations' => [],
                    'custom_properties' => [
                        'vimeo_id' => $lesson->vimeo_id,
                        'vimeo_uri' => $lesson->vimeo_uri,
                        'vimeo_embed_url' => $lesson->vimeo_embed_url,
                        'vimeo_ready' => $lesson->vimeo_ready ?? false,
                        'is_external' => true,
                        'video_provider' => 'vimeo',
                    ],
                    'generated_conversions' => [],
                    'responsive_images' => [],
                    'order_column' => $lesson->media()->count() + 1,
                ]);

                $media->save();

                Log::info("Migrated Vimeo video for lesson {$lesson->id}", [
                    'lesson_id' => $lesson->id,
                    'media_id' => $media->id,
                    'vimeo_id' => $lesson->vimeo_id,
                ]);
            } catch (\Exception $e) {
                Log::error("Failed to migrate Vimeo video for lesson {$lesson->id}", [
                    'lesson_id' => $lesson->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove media entries that were created for Vimeo videos
        $lessonsWithVimeo = Lesson::whereNotNull('vimeo_embed_url')
            ->whereNotNull('vimeo_id')
            ->get();

        foreach ($lessonsWithVimeo as $lesson) {
            $lesson->getMedia('videos')
                ->filter(function ($media) {
                    return $media->getCustomProperty('video_provider') === 'vimeo';
                })
                ->each(function ($media) {
                    $media->delete();
                });
        }
    }
};
