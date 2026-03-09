<?php

namespace App\Enums;

use Illuminate\Support\Str;
use \Spatie\Enum\Enum;

/**
 * Class UserTypeEnum
 * @package App\Enums
 * @method static self ADMIN()
 * @method static self BUYER()
 * @method static self WAREHOUSE()
 * @method static self DEVELOPER()
 * @method static self SELLER()
 * @method static self TEACHER()
 * @method static self ACCELERATED_STUDENT()
 * @method static self FACULTY_MEMBER()
 * @method static self STANDARD_STUDENT()
 */
final class UserTypeEnum extends Enum {

    protected static function values(): array {
        return [
            'ADMIN'     => 'ADMIN',
            'BUYER'     => 'BUYER',
            'WAREHOUSE' => 'WAREHOUSE',
            'DEVELOPER' => 'DEVELOPER',
            'SELLER'    => 'SELLER',
            'FACULTY_MEMBER' => 'FACULTY_MEMBER',
            'ACCELERATED_STUDENT' => 'ACCELERATED_STUDENT',
            'STANDARD_STUDENT' => 'STANDARD_STUDENT',
            'TEACHER' => 'TEACHER',
        ];
    }

    public static function getUsersDropdown(): array
    {
        $array = [];
        if (auth()->user()?->user_type == self::FACULTY_MEMBER()) {
            collect([self::ACCELERATED_STUDENT(), self::STANDARD_STUDENT()])->each(function ($case) use (&$array) {
                $array[$case->value] = Str::title(str_replace('_', ' ', Str::lower($case->label)));
            });

            return $array;
        }

        collect([self::ADMIN(),self::TEACHER(), self::FACULTY_MEMBER(), self::ACCELERATED_STUDENT(), self::STANDARD_STUDENT()])->each(function ($case) use (&$array) {
            $array[$case->value] = Str::title(str_replace('_', ' ', Str::lower($case->label)));
        });

        return $array;
    }

}
