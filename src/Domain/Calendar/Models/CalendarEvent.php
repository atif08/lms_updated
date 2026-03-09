<?php

namespace Domain\Calendar\Models;

use App\Casts\SpatieEnumCast;
use App\Models\Batch;
use Domain\Calendar\Enums\CalendarTopicEnum;
use Domain\Courses\Models\Course;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CalendarEvent extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia,SoftDeletes;

    protected $table = 'calender_events';

    protected $casts = ['topic' => SpatieEnumCast::class.':'.CalendarTopicEnum::class];

    protected $fillable = [
        'user_id',
        'user_type',
        'topic',
        'course_id',
        'batch_id',
        'title',
        'description',
        'start_datetime',
        'end_datetime',
        'url',
    ];

    /**
     * Get the user that owns the event.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the course that owns the event.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function batch(): BelongsTo
    {

        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }
}
