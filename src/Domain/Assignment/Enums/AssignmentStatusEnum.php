<?php

namespace Domain\Assignment\Enums;

use Spatie\Enum\Enum;

/**
 * Class LessonTypeEnum
 *
 * @method static self PENDING()
 * @method static self REJECTED()
 * @method static self APPROVED()
 */
final class AssignmentStatusEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'PENDING' => 'PENDING',
            'REJECTED' => 'REJECTED',
            'APPROVED' => 'APPROVED',
        ];
    }

    public static function getDropdown(): array
    {
        $array = [];
        collect([self::PENDING(), self::REJECTED(), self::APPROVED()])->each(function ($case) use (&$array) {
            $array[$case->value] = $case->label;
        });

        return $array;
    }
}
