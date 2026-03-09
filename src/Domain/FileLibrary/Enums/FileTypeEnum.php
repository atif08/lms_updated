<?php

namespace Domain\FileLibrary\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * Class FileTypeEnum
 *
 * @method static self IMAGE()
 * @method static self FILE()
 * @method static self VIDEO()
 * @method static self LINK()
 */
final class FileTypeEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'IMAGE' => 'IMAGE',
            'FILE' => 'FILE',
            'VIDEO' => 'VIDEO',
            'LINK' => 'LINK',
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
