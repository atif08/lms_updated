<?php

namespace App\Enums;

use \Spatie\Enum\Enum;

/**
 * Class ShipmentTypeEnumTypeEnum
 * @package App\Enums
 * @method static self AMAZON_INBOUND_SHIPMENT()
 */
final class ShipmentTypeEnum extends Enum {

    protected static function values(): array {
        return [
            'AMAZON_INBOUND_SHIPMENT' => 'AMAZON_INBOUND_SHIPMENT',
        ];
    }

    public static function forDropdown(): array {
        $array = [];

        collect(self::cases())->each(function ($case) use (&$array) {
            $array[$case->value] = $case->label;
        });

        return $array;
    }

}
