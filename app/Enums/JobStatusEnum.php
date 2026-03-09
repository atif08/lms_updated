<?php

namespace App\Enums;

use \Spatie\Enum\Enum;

/**
 * Class JobStatusEnum
 * @package App\Enums
 * @method static self PENDING()
 * @method static self VERIFIED()
 * @method static self QUEUED()
 * @method static self WORKING()
 * @method static self DONE()
 * @method static self FAILED()
 */
final class JobStatusEnum extends Enum {

    protected static function values(): array {
        return [
            'PENDING'  => 'PENDING',
            'VERIFIED' => 'VERIFIED',
            'QUEUED'   => 'QUEUED',
            'WORKING'  => 'WORKING',
            'DONE'     => 'DONE',
            'FAILED'   => 'FAILED',
        ];
    }

}
