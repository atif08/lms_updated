<?php

namespace Domain\FileLibrary\Enums;

use Spatie\Enum\Enum;

/**
 * Class FileTypeEnum
 *
 * @method static self IMAGES()
 * @method static self MEDIA_LIBRARY()
 * @method static self FILE()
 * @method static self AVATAR()
 * @method static self ASSIGNMENT()
 */
final class MediaCollectionEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'IMAGES' => 'IMAGES',
            'MEDIA_LIBRARY' => 'MEDIA_LIBRARY',
            'FILE' => 'FILE',
            'AVATAR' => 'AVATAR',
            'ASSIGNMENT' => 'ASSIGNMENT',
        ];
    }

    public static function getDropdown(): array
    {
        $array = [];
        //        collect([self::IMAGE(),self::FILE(),self::VIDEO(),self::LINK()])->each(function ($case) use (&$array) {
        //            $array[$case->value] = $case->label;
        //        });

        return $array;
    }
}
