<?php

namespace Domain\Assignment\Models;

use App\Casts\SpatieEnumCast;
use Domain\Assignment\Enums\AssignmentStatusEnum;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SubmittedAssignment extends Model implements HasMedia
{
    use HasFactory ,InteractsWithMedia,SoftDeletes;

    protected $fillable = [
        'user_id',
        'submissionable_type',
        'submissionable_id',
        'status',
        'score',
        'description',
        'comments',
        'attempt_number',
    ];

    protected $casts = ['status' => SpatieEnumCast::class.':'.AssignmentStatusEnum::class];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function submissionable(): MorphTo
    {

        return $this->morphTo();
    }

    public function scopeLatestAttempt($query)
    {
        return $query->orderByDesc('attempt_number')->limit(1);
    }
}
