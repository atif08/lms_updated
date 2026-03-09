<?php

namespace Domain\Calendar\Enums;

use Spatie\Enum\Enum;

/**
 * Class LessonTypeEnum
 *
 * @method static self EVENTS()
 * @method static self CLASSES()
 * @method static self ANNOUNCEMENTS()
 * @method static self NOTICES()
 * @method static self COURSES()
 * @method static self BATCHES()
 * @method static self ASSIGNMENTS()
 * @method static self ACTIVITIES()
 * @method static self OTHERS()
 */
final class CalendarTopicEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'EVENTS' => 'EVENTS',
            'CLASSES' => 'CLASSES',
            'ANNOUNCEMENTS' => 'ANNOUNCEMENTS',
            'NOTICES' => 'NOTICES',
            'COURSES' => 'COURSES',
            'BATCHES' => 'BATCHES',
            'ASSIGNMENTS' => 'ASSIGNMENTS',
            'ACTIVITIES' => 'ACTIVITIES',
            'OTHERS' => 'OTHERS',
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
