<?php

namespace App\Services;

use Vimeo\Laravel\Facades\Vimeo;
use Illuminate\Support\Facades\Log;

class VimeoService
{
    public function upload(string $absoluteFilePath, ?string $name = null, ?string $description = null): array
    {
        // Preflight checks
        if (!file_exists($absoluteFilePath)) {
            Log::error('Vimeo upload failed: file does not exist', ['path' => $absoluteFilePath]);
            throw new \RuntimeException('Video file not found on server.');
        }

        if (!is_readable($absoluteFilePath)) {
            Log::error('Vimeo upload failed: file not readable', ['path' => $absoluteFilePath]);
            throw new \RuntimeException('Video file is not readable by the server.');
        }

        $size = @filesize($absoluteFilePath) ?: null;
        Log::info('Starting Vimeo upload', [
            'path' => $absoluteFilePath,
            'size' => $size,
            'name' => $name,
        ]);

        // Attempt minimal upload first (plan limitations may reject advanced privacy settings on creation)
        $uri = Vimeo::upload($absoluteFilePath, [
            'name' => $name ?? basename($absoluteFilePath),
            'description' => $description,
        ]);

        $videoId = trim(str_replace('/videos/', '', $uri));

        // Try to set privacy after successful upload; ignore failures but log them
        try {
            Vimeo::request($uri, [
                'privacy' => [
                    'view' => 'unlisted',
                    // Some plans don’t support embed whitelist via API
                    'embed' => 'whitelist',
                ],
            ], 'PATCH');
        } catch (\Throwable $e) {
            Log::warning('Vimeo privacy update failed (continuing)', [
                'uri' => $uri,
                'error' => $e->getMessage(),
            ]);
        }

        $res = Vimeo::request($uri, [], 'GET');

        return [
            'uri' => $uri,
            'id' => $videoId,
            'link' => $res['body']['link'] ?? null,
            'player_embed_url' => $res['body']['player_embed_url'] ?? null,
        ];
    }
}
