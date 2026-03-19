<?php

namespace Domain\Users\Enums;


use Spatie\Enum\Enum;

/**
 * Class PermissionsEnum
 *
 * @method static self USERS()
 * @method static self ROLES()
 * @method static self QUIZ_REPOSITORY()
 * @method static self COURSES()
 * @method static self CATEGORIES()
 * @method static self CALENDARS()
 * @method static self ASSIGNMENTS()
 * @method static self QUIZ_ATTEMPTS()
 * @method static self SUBMITTED_ASSIGNMENTS()
 * @method static self COURSE_PROGRESS()
 * @method static self BATCHES()
 * @method static self ATTENDANCES()
 * @method static self EXPORT_REQUESTS()
 * @method static self PAYMENTS()
 */
final class PermissionsEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'USERS' => 'USERS',
            'ROLES' => 'ROLES',
            'COURSES' => 'COURSES',
            'QUIZ_REPOSITORY' => 'QUIZ_REPOSITORY',
            'CALENDARS' => 'CALENDARS',
            'CATEGORIES' => 'CATEGORIES',
            'ASSIGNMENTS' => 'ASSIGNMENTS',
            'QUIZ_ATTEMPTS' => 'QUIZ_ATTEMPTS',
            'SUBMITTED_ASSIGNMENTS' => 'SUBMITTED_ASSIGNMENTS',
            'COURSE_PROGRESS' => 'COURSE_PROGRESS',
            'BATCHES' => 'BATCHES',
            'ATTENDANCES' => 'ATTENDANCES',
            'EXPORT_REQUESTS' => 'EXPORT_REQUESTS',
            'PAYMENTS' => 'PAYMENTS',
        ];
    }

    public static function getPermission(): array
    {
        $array = [];

        collect(self::values())->each(function ($case) use (&$array) {
            $array[$case->value] = $case->label;
        });

        return $array;
    }
}
