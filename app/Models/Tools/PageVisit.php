<?php

namespace App\Models\Tools;

use Carbon\Carbon;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class PageVisit
 * @package App\Models\Tools
 * @property integer id
 * @property integer user_id
 * @property string method
 * @property string url
 * @property array params
 * @property boolean ajax
 * @property string client_ip
 * @property double response_time
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property User user
 */
class PageVisit extends Model {

    protected $fillable = [
        'user_id',
        'method',
        'url',
        'params',
        'ajax',
        'client_ip',
        'response_time'
    ];

    protected $casts = [
        'params'     => 'array',
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
