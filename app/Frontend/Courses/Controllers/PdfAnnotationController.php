<?php

namespace App\Frontend\Courses\Controllers;

use App\Http\Controllers\BaseController;
use Domain\Courses\Models\PdfAnnotation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PdfAnnotationController extends BaseController
{
    public function show(int $mediaId): JsonResponse
    {
        $annotation = PdfAnnotation::where('user_id', $this->user->id)
            ->where('media_id', $mediaId)
            ->first();

        return response()->json($annotation?->annotations ?? []);
    }

    public function upsert(Request $request, int $mediaId): JsonResponse
    {
        $request->validate([
            'annotations' => 'required|array',
        ]);

        PdfAnnotation::updateOrCreate(
            ['user_id' => $this->user->id, 'media_id' => $mediaId],
            ['annotations' => $request->annotations]
        );

        return response()->json(['ok' => true]);
    }
}
