<?php

namespace Domain\Quizzes\Models;

use App\Casts\SpatieEnumCast;
use Domain\Quizzes\Enums\QuestionTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Question extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia,SoftDeletes;

    protected $fillable = ['name', 'quiz_section_id', 'type', 'is_active', 'points'];

    protected $casts = ['type' => SpatieEnumCast::class.':'.QuestionTypeEnum::class];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(QuizSection::class, 'section_questions');
    }

    public function options(): HasMany
    {
        return $this->hasMany(QuestionOption::class);
    }

    public function isCorrect(array $user_options): bool
    {
        if ($this->type == QuestionTypeEnum::FILL_BLANK()) {
            $correct = $this->options()
                ->pluck('name')
                ->toArray();
        } elseif ($this->type == QuestionTypeEnum::MATCHING()) {
            $correct = $this->options()
                ->pluck('answer')
                ->toArray();
        } else {
            $correct = $this->options()
                ->where('is_correct', true)
                ->pluck('id')
                ->toArray();
        }

        return $user_options == $correct;
    }
}
