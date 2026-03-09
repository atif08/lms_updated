<?php

namespace Domain\Courses\Enums;

use Spatie\Enum\Enum;

/**
 * Class LessonTypeEnum
 *
 * @method static self PENDING()
 * @method static self PUBLISH()
 * @method static self DRAFT()
 */
final class CourseStatusEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'DRAFT' => 'DRAFT',
            'PUBLISH' => 'PUBLISH',
            'PENDING' => 'PENDING',
        ];
    }

    public static function getDropdown(): array
    {
        $array = [];
        collect([self::DRAFT(), self::PENDING(), self::PUBLISH()])->each(function ($case) use (&$array) {
            $array[$case->value] = $case->label;
        });

        return $array;
    }
}
