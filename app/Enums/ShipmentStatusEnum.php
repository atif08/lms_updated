<?php

namespace App\Enums;

use \Spatie\Enum\Enum;

/**
 * Class UserTypeEnum
 * @package App\Enums
 * @method static self WORKING()
 * @method static self SHIPPED()
 * @method static self RECEIVING()
 * @method static self CANCELLED()
 * @method static self DELETED()
 * @method static self CLOSED()
 * @method static self ERROR()
 * @method static self IN_TRANSIT()
 * @method static self DELIVERED()
 * @method static self CHECKED_IN()
 */
final class ShipmentStatusEnum extends Enum {

    protected static function values(): array {
        return [
            'WORKING'    => 'working',
            'SHIPPED'    => 'shipped',
            'RECEIVING'  => 'receiving',
            'CANCELLED'  => 'cancelled',
            'DELETED'    => 'deleted',
            'CLOSED'     => 'closed',
            'ERROR'      => 'error',
            'IN_TRANSIT' => 'in_transit',
            'DELIVERED'  => 'delivered',
            'CHECKED_IN' => 'checked_in',
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
