<?php

namespace Domain\Quizzes\Models;

use Domain\Courses\Models\Topic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Quiz extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia,SoftDeletes;

    protected $fillable = [
        'user_id',
        'batch_id',
        'name',
        'slug',
        'description',
        'total_marks',
        'pass_marks',
        'max_attempts',
        'is_published',
        'media_url',
        'media_type',
        'duration',
        'time_between_attempts',
        'valid_from',
        'valid_upto',
        'negative_marking_settings',
        'unregistered_users_can_solve',
        'hide_answers_in_reports',
        'no_review_needed',
        'student_can_download_results',
        'time_to_complete',
        'questions_per_page',
        'order',
        'is_active',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($quiz) {
            $quiz->slug = Str::slug($quiz->name);
        });
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    public function topics(): MorphToMany
    {
        return $this->morphToMany(Topic::class, 'topicable');
    }

    public function quiz_sections(): HasMany
    {
        return $this->hasMany(QuizSection::class);
    }

    public function quiz_questions(): HasManyThrough
    {
        return $this->hasManyThrough(Question::class, QuizSection::class);
    }

    public function authors(): HasMany
    {
        return $this->hasMany(QuizAuthor::class);
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(QuizAttempt::class);
    }

    public function totalPoints(): int
    {
        return $this->quiz_questions()->pluck('points')->sum();
    }
}
