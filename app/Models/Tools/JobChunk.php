<?php

namespace App\Models\Tools;

use App\Enums\JobStatusEnum;
use Carbon\Carbon;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class JobChunk
 * @package App\Models\Tools
 * @property integer id
 * @property integer user_id
 * @property string job_class
 * @property Carbon exe_date
 * @property string last_index
 * @property string status
 * @property Carbon started_at
 * @property Carbon completed_at
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property User user
 */
class JobChunk extends Model {

    protected $fillable = [
        'user_id',
        'job_class',
        'exe_date',
        'last_index',
        'status',
        'started_at',
        'completed_at',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'exe_date'     => 'datetime',
        'status'       => JobStatusEnum::class,
        'started_at'   => 'datetime',
        'completed_at' => 'datetime',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

}
