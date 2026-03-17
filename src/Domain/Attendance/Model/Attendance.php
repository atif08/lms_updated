<?php

namespace Domain\Attendance\Model;

use App\Models\Batch;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['user_id', 'batch_id', 'date', 'status', 'remarks', 'check_in', 'check_out', 'hours', 'auto_checked_out'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class);
    }
}
