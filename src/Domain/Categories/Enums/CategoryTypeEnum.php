<?php

namespace Domain\Categories\Enums;

use Spatie\Enum\Enum;

/**
 * Class LessonTypeEnum
 *
 * @method static self BUC()
 * @method static self ASTI()
 */
final class CategoryTypeEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'DWC' => 'DWC',
            'BUC' => 'BUC',
        ];
    }

    public static function getDropdown(): array
    {
        $array = [];
        collect(self::values())->each(function ($case) use (&$array) {
            $array[$case->value] = $case->label;
        });

        return $array;
    }
}
