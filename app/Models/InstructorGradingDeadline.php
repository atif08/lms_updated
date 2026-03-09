<?php

namespace App\Models;

use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InstructorGradingDeadline extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
