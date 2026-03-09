<?php

namespace Domain\Quizzes\Enums;

use Spatie\Enum\Enum;

/**
 * Class LessonTypeEnum
 *
 * @method static self ONE_CORRECT()
 * @method static self MULTIPLE_CORRECT()
 * @method static self FREE_TEXT()
 * @method static self FILL_BLANK()
 * @method static self MATCHING()
 */
final class QuestionTypeEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'ONE_CORRECT' => 'ONE_CORRECT',
            'MULTIPLE_CORRECT' => 'MULTIPLE_CORRECT',
            'FREE_TEXT' => 'FREE_TEXT',
            'FILL_BLANK' => 'FILL_BLANK',
            'MATCHING' => 'MATCHING',
        ];
    }

    public static function getDropdown(): array
    {
        $array = [];
        collect([self::FREE_TEXT(), self::ONE_CORRECT(), self::MULTIPLE_CORRECT(), self::FILL_BLANK(), self::MATCHING()])->each(function ($case) use (&$array) {
            $array[$case->value] = $case->label;
        });

        return $array;
    }
}
