<?php

namespace Domain\Assignment\Models;

use Domain\Courses\Models\Course;
use Domain\Courses\Models\Topic;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Assignment extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia,SoftDeletes;

    protected $fillable = ['course_id', 'name', 'description', 'due_date', 'topic_id'];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'assignment_users')->withPivot(['due_date']);
    }

    //    public function submitted_assignments(): MorphMany {
    //        return $this->morphMany(SubmittedAssignment::class, 'submissionable')->where('user_id',Auth::id())->latest();
    //    }
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function submitted_assignments(): MorphMany
    {
        return $this->morphMany(SubmittedAssignment::class, 'submissionable');
    }
}
