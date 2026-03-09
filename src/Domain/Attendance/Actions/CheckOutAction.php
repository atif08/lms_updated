<?php

namespace Domain\Attendance\Actions;

use Carbon\Carbon;
use Domain\Users\Enums\UserTypeEnum;
use Domain\Users\Models\User;

class CheckOutAction
{
    public function handle(User $user, ?string $hours)
    {
        // Check if the user is a student
        if ($user->user_type == UserTypeEnum::STANDARD_STUDENT() || $user->user_type == UserTypeEnum::ACCELERATED_STUDENT()) {

            $checkOutTime = Carbon::now('Asia/Dubai');
            // Update the check-out time and hours worked
            if ($user->today_attendance) {
                $user->today_attendance->update([
                    'check_out' => $checkOutTime,
                    'hours' => $hours,
                ]);
            }

        }
    }
}
