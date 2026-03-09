<?php

namespace Domain\Courses\Enums;

use Spatie\Enum\Enum;

/**
 * Class LessonTypeEnum
 *
 * @method static self BEGINNER()
 * @method static self INTERMEDIATE()
 * @method static self EXPERTS()
 */
final class DifficultyTypeEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'EXPERTS' => 'EXPERTS',
            'INTERMEDIATE' => 'INTERMEDIATE',
            'BEGINNER' => 'BEGINNER',
        ];
    }

    public static function getDropdownLesson(): array
    {
        $array = [];
        collect([self::BEGINNER(), self::EXPERTS(), self::INTERMEDIATE()])->each(function ($case) use (&$array) {
            $array[$case->value] = $case->label;
        });

        return $array;
    }
}
