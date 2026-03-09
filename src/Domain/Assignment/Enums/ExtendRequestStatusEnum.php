<?php

namespace Domain\Assignment\Enums;

use Spatie\Enum\Enum;

/**
 * Class AttendanceStatusEnum
 *
 * @method static self PENDING()
 * @method static self APPROVED()
 * @method static self REJECTED()
 */
final class ExtendRequestStatusEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'PENDING' => 'PENDING',
            'APPROVED' => 'APPROVED',
            'REJECTED' => 'REJECTED',
        ];
    }

    public static function getDropdown(): array
    {
        $array = [];
        foreach (self::values() as $key => $value) {
            $array[$key] = ucfirst(strtolower($value));
        }

        return $array;
    }
}
