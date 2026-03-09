<?php

namespace App\Enums;

use \Spatie\Enum\Enum;

/**
 * Class WarehouseTypeEnum
 * @package App\Enums
 * @method static self SELLER_WAREHOUSE()
 * @method static self AMAZON_WAREHOUSE()
 */
final class WarehouseTypeEnum extends Enum {

    protected static function values(): array {
        return [
            'SELLER_WAREHOUSE' => 'SELLER_WAREHOUSE',
            'AMAZON_WAREHOUSE' => 'AMAZON_WAREHOUSE',
        ];
    }

}
