<?php

namespace Domain\Courses\Models;

use Domain\Assignment\Models\Assignment;
use Domain\FileLibrary\Enums\MediaCollectionEnum;
use Domain\Quizzes\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Topic extends Model implements HasMedia
{
    use HasFactory ,InteractsWithMedia,SoftDeletes;

    protected $fillable = ['course_id', 'name', 'description', 'is_active', 'order', 'assignment_submit_date'];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
        $this
            ->addMediaCollection(MediaCollectionEnum::ASSIGNMENT())
            ->singleFile();
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);

    }

    public function assignment(): HasOne
    {
        return $this->hasOne(Assignment::class);
    }

    public function topicables(): HasMany
    {
        return $this->hasMany(Topicable::class)->with('topicable')->orderBy('order');
    }

    public function quizzes(): MorphToMany
    {
        return $this->morphedByMany(Quiz::class, 'topicable');

    }

    public function lessons(): MorphToMany
    {
        return $this->morphedByMany(Lesson::class, 'topicable');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
