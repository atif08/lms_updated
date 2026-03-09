<?php

namespace Domain\Assignment\Actions;

use Domain\Assignment\Models\Assignment;
use Domain\Courses\Models\Lesson;
use Domain\FileLibrary\Enums\MediaCollectionEnum;
use Illuminate\Support\Facades\Log;

class ConvertLessonMediaToPdfAction
{
    public function execute(Lesson|Assignment $lesson, ?string $collection = null): void
    {
        // Always refresh first to get updated media relations
        $lesson->refresh();

        // Decide which media collection to use
        $collection = $collection ?? MediaCollectionEnum::IMAGES();

        // Fetch media from the selected collection
        $mediaItems = $lesson->getMedia($collection);

        // Allowed file types

        $mediaItems
            ->filter(function ($media) {
                $allowedExtensions = ['doc', 'docx', 'ppt', 'pptx'];
                $ext = strtolower(pathinfo($media->getPath(), PATHINFO_EXTENSION));

                return in_array($ext, $allowedExtensions);
            })
            ->each(function ($media) use ($lesson, $collection) {

                $pdfPath = convertFileToPdf($media->getPath());

                if ($pdfPath && file_exists($pdfPath)) {
                    $lesson
                        ->addMedia($pdfPath)
                        ->usingName(pathinfo($pdfPath, PATHINFO_FILENAME))
                        ->toMediaCollection($collection);

                    $media->forceDelete();
                } else {
                    Log::error("PDF conversion failed for media ID {$media->id}");
                }
            });
    }
}
