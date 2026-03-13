<?php

namespace Domain\Payments\Enums;

use Spatie\Enum\Enum;

/**
 * Class PaymentStatusEnum
 *
 * @method static self PENDING()
 * @method static self COMPLETED()
 * @method static self REJECTED()
 */
final class PaymentStatusEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'PENDING' => 'pending',
            'COMPLETED' => 'completed',
            'REJECTED' => 'rejected',
        ];
    }

    public static function getDropdown(): array
    {
        $array = [];
        foreach (self::values() as $key => $value) {
            $array[$value] = ucfirst(strtolower($value));
        }

        return $array;
    }
}
