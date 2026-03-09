<?php

namespace Domain\Assignment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssignmentExtendRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function assignment(): BelongsTo
    {

        return $this->belongsTo(Assignment::class);
    }
}
