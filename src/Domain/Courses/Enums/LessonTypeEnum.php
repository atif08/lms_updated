<?php

namespace Domain\Courses\Enums;

use Spatie\Enum\Enum;

/**
 * Class LessonTypeEnum
 *
 * @method static self ExternalLink()
 * @method static self Media()
 * @method static self Iframe()
 */
final class LessonTypeEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'ExternalLink' => 'EXTERNAL_LINK',
            'Media' => 'MEDIA',
            'Iframe' => 'IFRAME',
        ];
    }

    public static function getDropdownLesson(): array
    {
        $array = [];
        collect([self::ExternalLink(), self::Media(), self::Iframe()])->each(function ($case) use (&$array) {
            $array[$case->value] = $case->label;
        });

        return $array;
    }
}
