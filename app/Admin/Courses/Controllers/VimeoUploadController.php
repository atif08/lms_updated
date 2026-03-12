<?php

namespace App\Admin\Courses\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Domain\Courses\Models\Course;
use Domain\Courses\Models\Lesson;
use Domain\Courses\Models\Topic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Vimeo\Laravel\Facades\Vimeo;

class VimeoUploadController extends BaseController
{
    public function initTus(Course $course, Topic $topic, Lesson $lesson, Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'size' => ['required', 'integer', 'min:1'],
        ]);

        $payload = [
            'upload' => [
                'approach' => 'tus',
                'size' => (int) $data['size'],
            ],
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
        ];

        $res = Vimeo::request('/me/videos', $payload, 'POST');

        if (($res['status'] ?? 500) >= 300) {
            Log::error('Failed to init Vimeo TUS upload', [
                'status' => $res['status'] ?? null,
                'body' => $res['body'] ?? null,
            ]);

            return response()->json(['message' => 'Failed to initialize upload with Vimeo'], 422);
        }

        $uri = $res['body']['uri'] ?? null; // e.g. "/videos/123456789"
        $uploadLink = $res['body']['upload']['upload_link'] ?? null;
        $videoId = $uri ? (int) str_replace('/videos/', '', $uri) : null;

        return response()->json([
            'uri' => $uri,
            'video_id' => $videoId,
            'upload_link' => $uploadLink,
        ]);
    }

    public function completeTus(Course $course, Topic $topic, Lesson $lesson, Request $request): JsonResponse
    {
        $data = $request->validate([
            'uri' => ['required', 'string'],
            'name' => ['nullable', 'string'],
        ]);

        $uri = $data['uri'];
        $videoName = $data['name'] ?? $lesson->name.' - Video';

        // Try to set privacy and embed settings after upload (best-effort)
        try {
            Vimeo::request($uri, [
                'privacy' => [
                    'view' => 'public',
                ],
                'embed' => [
                    'buttons' => [
                        'like' => false,
                        'share' => false,
                        'watchlater' => false,
                        'embed' => false,
                    ],
                    'logos' => [
                        'vimeo' => false,
                        'custom' => [
                            'active' => false,
                        ],
                    ],
                    'title' => [
                        'name' => 'hide',
                        'owner' => 'hide',
                        'portrait' => 'hide',
                    ],
                ],
            ], 'PATCH');
        } catch (\Throwable $e) {
            Log::warning('Vimeo privacy/embed update failed after TUS', [
                'uri' => $uri,
                'error' => $e->getMessage(),
            ]);
        }

        $meta = Vimeo::request($uri, [], 'GET');
        $id = (int) str_replace('/videos/', '', $uri);

        $baseEmbedUrl = $meta['body']['player_embed_url'] ?? ('https://player.vimeo.com/video/'.$id);
        $embed = $baseEmbedUrl;
        $ready = ($meta['body']['transcode']['status'] ?? null) === 'complete';

        // Create media entry with Vimeo metadata in custom properties
        // We create the media entry manually because Vimeo URLs are not downloadable
        try {
            $media = new \Spatie\MediaLibrary\MediaCollections\Models\Media([
                'model_type' => get_class($lesson),
                'model_id' => $lesson->id,
                'uuid' => \Illuminate\Support\Str::uuid(),
                'collection_name' => 'videos',
                'name' => $videoName,
                'file_name' => 'vimeo_'.$id.'.mp4',
                'mime_type' => 'video/mp4',
                'disk' => 'public',
                'conversions_disk' => 'public',
                'size' => 0, // External URL, no file size
                'manipulations' => [],
                'custom_properties' => [
                    'vimeo_id' => $id,
                    'vimeo_uri' => $uri,
                    'vimeo_embed_url' => $embed,
                    'vimeo_ready' => $ready,
                    'is_external' => true,
                    'video_provider' => 'vimeo',
                ],
                'generated_conversions' => [],
                'responsive_images' => [],
                'order_column' => $lesson->media()->count() + 1,
            ]);

            $media->save();

            Log::info('Vimeo video added to media library', [
                'lesson_id' => $lesson->id,
                'media_id' => $media->id,
                'vimeo_id' => $id,
            ]);

            return response()->json([
                'vimeo_id' => $id,
                'vimeo_embed_url' => $embed,
                'vimeo_ready' => $ready,
                'media_id' => $media->id,
                'name' => $videoName,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create media entry for Vimeo video', [
                'lesson_id' => $lesson->id,
                'vimeo_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Failed to save video to media library',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateSettings(Course $course, Topic $topic, Lesson $lesson, Request $request): JsonResponse
    {
        $data = $request->validate([
            'media_id' => ['required', 'integer', 'exists:media,id'],
        ]);

        try {
            $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::findOrFail($data['media_id']);

            if ($media->model_id !== $lesson->id || $media->model_type !== get_class($lesson)) {
                return response()->json(['message' => 'Media does not belong to this lesson'], 403);
            }

            $vimeoUri = $media->getCustomProperty('vimeo_uri');
            if (! $vimeoUri) {
                return response()->json(['message' => 'No Vimeo URI found for this video'], 404);
            }

            // Force update privacy and embed settings
            Vimeo::request($vimeoUri, [
                'privacy' => [
                    'view' => 'public',
                ],
                'embed' => [
                    'buttons' => [
                        'like' => false,
                        'share' => false,
                        'watchlater' => false,
                        'embed' => false,
                    ],
                    'logos' => [
                        'vimeo' => false,
                        'custom' => ['active' => false],
                    ],
                    'title' => [
                        'name' => 'hide',
                        'owner' => 'hide',
                        'portrait' => 'hide',
                    ],
                ],
            ], 'PATCH');

            Log::info('Vimeo video settings updated via sync', [
                'lesson_id' => $lesson->id,
                'media_id' => $media->id,
                'vimeo_uri' => $vimeoUri,
            ]);

            return response()->json(['message' => 'Video settings synced successfully']);

        } catch (\Exception $e) {
            Log::error('Failed to sync Vimeo settings', [
                'lesson_id' => $lesson->id,
                'media_id' => $data['media_id'] ?? null,
                'error' => $e->getMessage(),
            ]);

            return response()->json(['message' => 'Failed to sync settings', 'error' => $e->getMessage()], 500);
        }
    }

    public function updateTitle(Course $course, Topic $topic, Lesson $lesson, Request $request): JsonResponse
    {
        $data = $request->validate([
            'media_id' => ['required', 'integer', 'exists:media,id'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        try {
            $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::findOrFail($data['media_id']);

            if ($media->model_id !== $lesson->id || $media->model_type !== get_class($lesson)) {
                return response()->json(['message' => 'Media does not belong to this lesson'], 403);
            }

            $vimeoUri = $media->getCustomProperty('vimeo_uri');

            // Update local media name
            $media->name = $data['name'];
            $media->save();

            // Update title on Vimeo (if URI is present)
            if ($vimeoUri) {
                Vimeo::request($vimeoUri, [
                    'name' => $data['name'],
                ], 'PATCH');
            }

            Log::info('Video name updated', [
                'lesson_id' => $lesson->id,
                'media_id' => $media->id,
                'new_name' => $data['name'],
            ]);

            return response()->json(['message' => 'Video name updated successfully', 'name' => $data['name']]);

        } catch (\Exception $e) {
            Log::error('Failed to update video name', [
                'lesson_id' => $lesson->id,
                'media_id' => $data['media_id'] ?? null,
                'error' => $e->getMessage(),
            ]);

            return response()->json(['message' => 'Failed to update video name', 'error' => $e->getMessage()], 500);
        }
    }

    public function replaceComplete(Course $course, Topic $topic, Lesson $lesson, Request $request): JsonResponse
    {
        $data = $request->validate([
            'media_id' => ['required', 'integer', 'exists:media,id'],
            'uri' => ['required', 'string'],
            'name' => ['nullable', 'string', 'max:255'],
        ]);

        try {
            $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::findOrFail($data['media_id']);

            if ($media->model_id !== $lesson->id || $media->model_type !== get_class($lesson)) {
                return response()->json(['message' => 'Media does not belong to this lesson'], 403);
            }

            $oldVimeoUri = $media->getCustomProperty('vimeo_uri');
            $oldVimeoId = $media->getCustomProperty('vimeo_id');

            $newUri = $data['uri'];
            $newId = (int) str_replace('/videos/', '', $newUri);
            $videoName = $data['name'] ?? $media->name;

            // Set privacy and embed settings on the new video (best-effort)
            try {
                Vimeo::request($newUri, [
                    'privacy' => ['view' => 'public'],
                    'embed' => [
                        'buttons' => [
                            'like' => false,
                            'share' => false,
                            'watchlater' => false,
                            'embed' => false,
                        ],
                        'logos' => [
                            'vimeo' => false,
                            'custom' => ['active' => false],
                        ],
                        'title' => [
                            'name' => 'hide',
                            'owner' => 'hide',
                            'portrait' => 'hide',
                        ],
                    ],
                ], 'PATCH');
            } catch (\Throwable $e) {
                Log::warning('Vimeo privacy/embed update failed during replace', [
                    'uri' => $newUri,
                    'error' => $e->getMessage(),
                ]);
            }

            // Get new video metadata
            $meta = Vimeo::request($newUri, [], 'GET');
            $baseEmbedUrl = $meta['body']['player_embed_url'] ?? ('https://player.vimeo.com/video/'.$newId);
            $ready = ($meta['body']['transcode']['status'] ?? null) === 'complete';

            // Delete old video from Vimeo (best-effort)
            if ($oldVimeoUri) {
                try {
                    Vimeo::request($oldVimeoUri, [], 'DELETE');
                    Log::info('Old Vimeo video deleted during replace', [
                        'old_vimeo_uri' => $oldVimeoUri,
                        'old_vimeo_id' => $oldVimeoId,
                    ]);
                } catch (\Throwable $e) {
                    Log::warning('Failed to delete old Vimeo video during replace', [
                        'old_vimeo_uri' => $oldVimeoUri,
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            // Update the existing media record with new Vimeo data
            $media->name = $videoName;
            $media->file_name = 'vimeo_'.$newId.'.mp4';
            $media->setCustomProperty('vimeo_id', $newId);
            $media->setCustomProperty('vimeo_uri', $newUri);
            $media->setCustomProperty('vimeo_embed_url', $baseEmbedUrl);
            $media->setCustomProperty('vimeo_ready', $ready);
            $media->save();

            Log::info('Vimeo video replaced', [
                'lesson_id' => $lesson->id,
                'media_id' => $media->id,
                'old_vimeo_id' => $oldVimeoId,
                'new_vimeo_id' => $newId,
            ]);

            return response()->json([
                'message' => 'Video replaced successfully',
                'vimeo_id' => $newId,
                'vimeo_embed_url' => $baseEmbedUrl,
                'vimeo_ready' => $ready,
                'media_id' => $media->id,
                'name' => $videoName,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to replace Vimeo video', [
                'lesson_id' => $lesson->id,
                'media_id' => $data['media_id'] ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Failed to replace video',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function reorder(Course $course, Topic $topic, Lesson $lesson, Request $request): JsonResponse
    {
        $data = $request->validate([
            'order' => ['required', 'array'],
            'order.*' => ['integer'],
        ]);

        $lessonMediaIds = $lesson->getMedia('videos')->pluck('id')->toArray();

        foreach ($data['order'] as $index => $mediaId) {
            if (! in_array((int) $mediaId, $lessonMediaIds)) {
                return response()->json(['message' => 'Media does not belong to this lesson'], 403);
            }

            \Spatie\MediaLibrary\MediaCollections\Models\Media::where('id', $mediaId)
                ->update(['order_column' => $index + 1]);
        }

        return response()->json(['status' => 'success']);
    }

    public function destroy(Course $course, Topic $topic, Lesson $lesson, Request $request): JsonResponse
    {
        $data = $request->validate([
            'media_id' => ['required', 'integer', 'exists:media,id'],
        ]);

        try {
            // Find the media entry
            $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::findOrFail($data['media_id']);

            // Verify it belongs to this lesson
            if ($media->model_id !== $lesson->id || $media->model_type !== get_class($lesson)) {
                return response()->json([
                    'message' => 'Media does not belong to this lesson',
                ], 403);
            }

            // Get Vimeo URI from custom properties
            $vimeoUri = $media->getCustomProperty('vimeo_uri');
            $vimeoId = $media->getCustomProperty('vimeo_id');

            // Try to delete from Vimeo (best-effort)
            if ($vimeoUri) {
                try {
                    $deleteResponse = Vimeo::request($vimeoUri, [], 'DELETE');

                    if (($deleteResponse['status'] ?? 500) < 300) {
                        Log::info('Vimeo video deleted successfully', [
                            'vimeo_uri' => $vimeoUri,
                            'vimeo_id' => $vimeoId,
                        ]);
                    } else {
                        Log::warning('Vimeo video deletion returned non-success status', [
                            'vimeo_uri' => $vimeoUri,
                            'status' => $deleteResponse['status'] ?? null,
                        ]);
                    }
                } catch (\Throwable $e) {
                    // Log but don't fail - video might already be deleted on Vimeo
                    Log::warning('Failed to delete video from Vimeo (continuing with local deletion)', [
                        'vimeo_uri' => $vimeoUri,
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            // Delete the media entry from database
            $mediaId = $media->id;
            $media->delete();

            Log::info('Vimeo media entry deleted', [
                'lesson_id' => $lesson->id,
                'media_id' => $mediaId,
                'vimeo_id' => $vimeoId,
            ]);

            return response()->json([
                'message' => 'Video deleted successfully',
                'deleted_media_id' => $mediaId,
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Media not found',
            ], 404);
        } catch (\Exception $e) {
            Log::error('Failed to delete Vimeo video', [
                'lesson_id' => $lesson->id,
                'media_id' => $data['media_id'] ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Failed to delete video',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
