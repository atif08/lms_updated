<?php

namespace Domain\Attendance\Actions;

use Carbon\Carbon;
use Domain\Users\Enums\UserTypeEnum;
use Domain\Users\Models\User;

class CheckOutAction
{
    public function handle(User $user, bool $autoCheckout = false): void
    {
        if (
            $user->user_type != UserTypeEnum::STANDARD_STUDENT()->value &&
            $user->user_type != UserTypeEnum::ACCELERATED_STUDENT()->value
        ) {
            return;
        }

        $attendance = $user->today_attendance;

        if (! $attendance || ! $attendance->check_in || $attendance->check_out) {
            return;
        }

        $checkOut = Carbon::now('Asia/Dubai');
        $checkIn = Carbon::parse($attendance->check_in, 'Asia/Dubai');
        $totalSeconds = max(0, $checkOut->diffInSeconds($checkIn));

        $hours = sprintf(
            '%02d:%02d:%02d',
            floor($totalSeconds / 3600),
            floor(($totalSeconds % 3600) / 60),
            $totalSeconds % 60
        );

        $attendance->update([
            'check_out' => $checkOut,
            'hours' => $hours,
            'auto_checked_out' => $autoCheckout,
        ]);
    }
}
