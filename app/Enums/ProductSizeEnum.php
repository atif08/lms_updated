<?php

namespace App\Enums;

use \Spatie\Enum\Enum;

/**
 * Class WarehouseTypeEnum
 * @package App\Enums
 * @method static self SMALL_STANDARD()
 * @method static self LARGE_STANDARD()
 * @method static self LARGE_BULKY()
 * @method static self EXTRA_LARGE_50()
 * @method static self EXTRA_LARGE_70()
 * @method static self EXTRA_LARGE_150()
 * @method static self EXTRA_LARGE_OVER_150()
 */
final class ProductSizeEnum extends Enum {

    protected static function values(): array {
        return [
            'SMALL_STANDARD'       => 'SMALL_STANDARD',
            'LARGE_STANDARD'       => 'LARGE_STANDARD',
            'LARGE_BULKY'          => 'LARGE_BULKY',
            'EXTRA_LARGE_50'       => 'EXTRA_LARGE_50',
            'EXTRA_LARGE_70'       => 'EXTRA_LARGE_70',
            'EXTRA_LARGE_150'      => 'EXTRA_LARGE_150',
            'EXTRA_LARGE_OVER_150' => 'EXTRA_LARGE_OVER_150',
        ];
    }

}
