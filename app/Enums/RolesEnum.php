<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * Class JobStatusEnum
 *
 * @method static self ADMIN()
 * @method static self TEACHER()
 */
final class RolesEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'ADMIN' => 'ADMIN',
            'TEACHER' => 'TEACHER',
        ];
    }

    public static function getList(): array
    {
        $array = [];

        collect(self::values())->each(function ($case) use (&$array) {
            $array[$case->value] = $case->label;
        });

        return $array;
    }
}
