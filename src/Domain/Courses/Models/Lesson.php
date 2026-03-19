<?php

namespace Domain\Courses\Models;

use App\Casts\SpatieEnumCast;
use Domain\Courses\Enums\LessonTypeEnum;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Lesson extends Model implements HasMedia
{
    use InteractsWithMedia,SoftDeletes;

    protected $fillable = ['topic_id', 'name', 'type', 'description', 'external_link', 'order', 'is_active', 'is_fast_track'];

    protected $casts = [
        'type' => SpatieEnumCast::class.':'.LessonTypeEnum::class,
        'is_fast_track' => 'boolean',
    ];

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
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
}
