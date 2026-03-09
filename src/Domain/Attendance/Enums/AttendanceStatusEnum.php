<?php

namespace Domain\Attendance\Enums;

use Spatie\Enum\Enum;

/**
 * Class AttendanceStatusEnum
 *
 * @method static self PRESENT()
 * @method static self ABSENT()
 * @method static self LATE()
 */
final class AttendanceStatusEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'PRESENT' => 'PRESENT',
            'ABSENT' => 'ABSENT',
            'LATE' => 'LATE',
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
