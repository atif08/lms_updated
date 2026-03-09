<?php

namespace Domain\Courses\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['course_question_id', 'answer'];

    public function question(): BelongsTo
    {
        return $this->belongsTo(CourseQuestion::class);
    }
}
