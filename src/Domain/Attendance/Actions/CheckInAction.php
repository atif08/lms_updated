<?php

namespace Domain\Attendance\Actions;

use Carbon\Carbon;
use Domain\Attendance\Enums\AttendanceStatusEnum;
use Domain\Attendance\Model\Attendance;
use Domain\Users\Enums\UserTypeEnum;
use Domain\Users\Models\User;

class CheckInAction
{
    public function handle(User $user): void
    {
        // Check if the user is a student
        if ($user->user_type == UserTypeEnum::STANDARD_STUDENT() || $user->user_type == UserTypeEnum::ACCELERATED_STUDENT()) {
            // Check if there's already an attendance record for today
            $attendance = Attendance::query()->firstOrCreate(
                [
                    'user_id' => $user->id,
                    'date' => Carbon::now()->toDateString(),
                ],
                [
                    'batch_id' => $user->batch_id,
                    'check_in' => Carbon::now('Asia/Dubai'),
                    'status' => AttendanceStatusEnum::PRESENT(),
                ]
            );

            if (! $attendance->wasRecentlyCreated) {
                // Update the check-in time if the record already exists and check_in is null
                if (! $attendance->check_in) {
                    $attendance->check_in = Carbon::now();
                    $attendance->save();
                }
            }
        }
    }
}
