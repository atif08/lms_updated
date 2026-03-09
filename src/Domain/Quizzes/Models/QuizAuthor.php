<?php

namespace Domain\Quizzes\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class QuizAuthor extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $fillable = ['quiz_id', 'author_id', 'author_type', 'author_role', 'is_active'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }
}
