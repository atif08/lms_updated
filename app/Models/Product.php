<?php

namespace App\Models;

use Carbon\Carbon;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Class Product
 * @package App\Models
 * @property integer id
 * @property integer user_id
 * @property integer marketplace_id
 * @property integer tracked_product_id
 * @property string sku
 * @property string fnsku
 * @property string asin
 * @property string parent_asin
 * @property string title
 * @property string description
 * @property string condition
 * @property string brand
 * @property string category
 * @property integer sales_rank
 * @property integer pack_size
 * @property double landed_price
 * @property double listing_price
 * @property double shipping_price
 * @property double buy_box
 * @property string link
 * @property string image_url
 * @property string fulfillment_channel
 * @property integer total_quantity
 * @property string product_size
 * @property double pack_length
 * @property double pack_width
 * @property double pack_height
 * @property double pack_weight
 * @property Carbon open_date
 * @property string status
 * @property boolean active
 * @property boolean hidden
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property User user
 * @property Marketplace marketplace
 * @property TrackedProduct tracked_product
 * @property UniversalCode[] universal_codes
 * @property EstimatedFee estimated_fees
 * @property MyiInventory myi_inventory
 */
class Product extends Model {

    protected $fillable = [
        'user_id',
        'marketplace_id',
        'tracked_product_id',
        'sku',
        'fnsku',
        'asin',
        'parent_asin',
        'title',
        'description',
        'condition',
        'brand',
        'category',
        'sales_rank',
        'pack_size',
        'landed_price',
        'listing_price',
        'shipping_price',
        'buy_box',
        'link',
        'image_url',
        'fulfillment_channel',
        'total_quantity',
        'product_size',
        'pack_length',
        'pack_width',
        'pack_height',
        'pack_weight',
        'open_date',
        'status',
        'active',
        'hidden',
    ];

    protected $casts = [
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function marketplace(): BelongsTo {
        return $this->belongsTo(Marketplace::class);
    }

    /**
     * @return BelongsTo
     */
    public function tracked_product(): BelongsTo {
        return $this->belongsTo(TrackedProduct::class);
    }

    /**
     * @return MorphToMany
     */
    public function universal_codes(): MorphToMany {
        return $this->morphToMany(UniversalCode::class, 'product', 'product_universal_code');
    }

    /**
     * @return MorphOne
     */
    public function estimated_fees(): MorphOne {
        return $this->morphOne(EstimatedFee::class, 'product');
    }

    /**
     * @return MorphOne
     */
    public function myi_inventory(): MorphOne {
        return $this->morphOne(MyiInventory::class, 'product');
    }

    public function getSyncAttributes() {
        $attributes = $this->replicate(['user_id'])->attributesToArray();
        return with(new TrackedProduct($attributes))->attributes;
    }

    /**
     * @return TrackedProduct|null
     */
    public function getTrackedProduct(): ?TrackedProduct {
        if (empty($this->asin)) {
            return null;
        }

        if ($this->tracked_product_id) {
            return $this->tracked_product;
        }

        /** @var TrackedProduct $tracked_product */
        $tracked_product = TrackedProduct::query()->firstOrCreate([
            'user_id'        => $this->user->getParentId(),
            'marketplace_id' => $this->marketplace_id,
            'asin'           => $this->asin,
        ], $this->getSyncAttributes());

        $this->tracked_product_id = $tracked_product->id;
        $this->save();

        return $tracked_product;
    }

    /**
     * @return void
     */
    public function syncUPCsBySKU(): void {
        $keywords = preg_split("/[-\\/]+/", $this->sku);

        $valid_upcs = [];
        foreach ($keywords as $keyword) {
            if (is_valid_upc($keyword)) {
                $valid_upcs[] = $keyword;
            }
        }

        if (!empty($valid_upcs)) {
            console_log('Valid UPCs: ' . implode(', ', $valid_upcs));
            $this->syncUPCs($valid_upcs);
        }
    }

    /**
     * @param array $upcs
     * @return void
     */
    public function syncUPCs(array $upcs): void {
        $upc_ids = [];
        foreach ($upcs as $upc) {
            /** @var UniversalCode $upc */
            $upc = UniversalCode::query()->firstOrCreate(compact('upc'));
            $upc_ids[] = $upc->id;
        }

        $this->universal_codes()->syncWithoutDetaching($upc_ids);

        if ($tracked_product = $this->getTrackedProduct()) {
            $tracked_product->universal_codes()->syncWithoutDetaching($upc_ids);
        }
    }

    /**
     * @param $condition_code
     * @return string
     */
    public static function getCondition($condition_code): string {
        return match ($condition_code) {
            1       => 'UsedLikeNew',
            2       => 'UsedVeryGood',
            3       => 'UsedGood',
            4       => 'UsedAcceptable',
            5       => 'CollectibleLikeNew',
            6       => 'CollectibleVeryGood',
            7       => 'CollectibleGood',
            8       => 'CollectibleAcceptable',
            9       => 'UsedRefurbished',
            10      => 'Refurbished',
            11      => 'New',
            ''      => 'None',
            default => '',
        };
    }

}
