<?php

namespace Domain\Users\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class UserAttribute
 * @package App\Models
 * @property integer id
 * @property integer user_id
 * @property array payload
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property User user
 */
class UserAttribute extends Model {

    protected $fillable = [
        'user_id',
        'payload'
    ];

    protected $casts = [
        'payload'    => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

}
