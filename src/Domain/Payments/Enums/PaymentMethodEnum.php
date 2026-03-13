<?php

namespace Domain\Payments\Enums;

use Spatie\Enum\Enum;

/**
 * Class PaymentMethodEnum
 *
 * @method static self CARD()
 * @method static self BANK_TRANSFER()
 * @method static self EMI()
 * @method static self OFFLINE()
 */
final class PaymentMethodEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'CARD' => 'card',
            'BANK_TRANSFER' => 'bank_transfer',
            'EMI' => 'emi',
            'OFFLINE' => 'offline',
        ];
    }

    public static function getDropdown(): array
    {
        $array = [];
        foreach (self::values() as $key => $value) {
            $array[$value] = ucfirst(str_replace('_', ' ', $value));
        }

        return $array;
    }
}
