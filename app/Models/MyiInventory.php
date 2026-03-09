<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class MyiInventory
 * @package App\Models
 * @property integer id
 * @property string product_type
 * @property integer product_id
 * @property boolean mfn_listing_exists
 * @property integer mfn_fulfillable_quantity
 * @property boolean afn_listing_exists
 * @property integer afn_warehouse_quantity
 * @property integer afn_fulfillable_quantity
 * @property integer afn_unsellable_quantity
 * @property integer afn_reserved_quantity
 * @property integer afn_total_quantity
 * @property integer per_unit_volume
 * @property integer afn_inbound_working_quantity
 * @property integer afn_inbound_shipped_quantity
 * @property integer afn_inbound_receiving_quantity
 * @property integer afn_researching_quantity
 * @property integer afn_reserved_future_supply
 * @property integer afn_future_supply_buyable
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Product|TrackedProduct product
 */
class MyiInventory extends Model {

    protected $fillable = [
        'product_type',
        'product_id',
        'mfn_listing_exists',
        'mfn_fulfillable_quantity',
        'afn_listing_exists',
        'afn_warehouse_quantity',
        'afn_fulfillable_quantity',
        'afn_unsellable_quantity',
        'afn_reserved_quantity',
        'afn_total_quantity',
        'per_unit_volume',
        'afn_inbound_working_quantity',
        'afn_inbound_shipped_quantity',
        'afn_inbound_receiving_quantity',
        'afn_researching_quantity',
        'afn_reserved_future_supply',
        'afn_future_supply_buyable',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return MorphTo
     */
    public function product(): MorphTo {
        return $this->morphTo();
    }
}
