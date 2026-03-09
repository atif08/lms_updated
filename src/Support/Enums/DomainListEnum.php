<?php

namespace Support\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * Class UserTypeEnum
 *
 * @method static self BRITISH()
 * @method static self ASTI_ACADEMY()
 */
final class DomainListEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'BRITISH' => 'portal.btcedu.ae',
            'ASTI_ACADEMY' => 'portal.astiacademy.ac.ae',
        ];
    }

    public static function getUsersDropdown(): array
    {
        $array = [];

        collect([self::BRITISH(), self::ASTI_ACADEMY()])->each(function ($case) use (&$array) {
            $array[$case->value] = $case->label;
        });

        return $array;
    }
}
