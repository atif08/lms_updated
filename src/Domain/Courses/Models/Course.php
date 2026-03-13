<?php

namespace Domain\Courses\Models;

use App\Casts\SpatieEnumCast;
use App\Models\Progress;
use Domain\Calendar\Models\CalendarEvent;
use Domain\Categories\Models\Category;
use Domain\Courses\Enums\CourseStatusEnum;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Support\Traits\StatusChangeable;

class Course extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes,StatusChangeable;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'is_announcement',
        'is_question',
        'is_active',
        'created_by',
        'course_duration_hr',
        'course_duration_min',
        'difficulty_level',
        'course_status',
        'category_id',
        'announcement',
        'price',
    ];

    protected $casts = [
        'course_status' => SpatieEnumCast::class.':'.CourseStatusEnum::class,
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($property) {
            $property->created_by = Auth::id();
        });
    }

    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class)->orderBy('order');
    }

    public function category(): BelongsTo
    {

        return $this->belongsTo(Category::class);
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'enrollments');
    }

    public function lessons(): HasManyThrough
    {
        return $this->hasManyThrough(Lesson::class, Topic::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(CourseQuestion::class);
    }

    public function user_course_progress(): HasMany
    {
        return $this->hasMany(Progress::class)->where('user_id', auth()->user()->id);
    }

    public function calendarEvents(): HasMany
    {
        return $this->hasMany(CalendarEvent::class, 'course_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1)->where('course_status', CourseStatusEnum::PUBLISH());
    }
}
