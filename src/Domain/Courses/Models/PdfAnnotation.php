<?php

namespace Domain\Courses\Models;

use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PdfAnnotation extends Model
{
    protected $fillable = ['user_id', 'media_id', 'annotations'];

    protected function casts(): array
    {
        return [
            'annotations' => 'array',
            'media_id' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
