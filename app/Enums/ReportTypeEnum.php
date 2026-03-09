<?php

namespace App\Enums;

use \Spatie\Enum\Enum;

/**
 * Class ReportTypeEnum
 * @package App\Enums
 * @method static self UPCS()
 * @method static self SUPPLIER_SHEET()
 */
final class ReportTypeEnum extends Enum {

    protected static function values(): array {
        return [
            'UPCS'           => 'UPCS',
            'SUPPLIER_SHEET' => 'SUPPLIER_SHEET'
        ];
    }

}
