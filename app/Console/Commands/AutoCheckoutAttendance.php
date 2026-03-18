<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Domain\Attendance\Model\Attendance;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AutoCheckoutAttendance extends Command
{
    protected $signature = 'attendance:auto-checkout';

    protected $description = 'Auto-checkout attendance records that have a check-in but no check-out (students who forgot to logout).';

    public function handle(): void
    {
        Log::info("Auto-checked out start");

        $openRecords = Attendance::query()
            ->whereNotNull('check_in')
            ->whereNull('check_out')
            ->get();

        if ($openRecords->isEmpty()) {
            $this->info('No open attendance records found.');

            return;
        }

        foreach ($openRecords as $attendance) {
            $checkIn = Carbon::parse($attendance->check_in, 'Asia/Dubai');

            // Cap session at 10 hours or end of the attendance date, whichever is sooner.
            $endOfDay = Carbon::parse($attendance->date, 'Asia/Dubai')->endOfDay();
            $cappedCheckOut = $checkIn->copy()->addHours(10);
            $checkOut = $cappedCheckOut->lessThan($endOfDay) ? $cappedCheckOut : $endOfDay;

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
                'auto_checked_out' => true,
            ]);
        }

        $this->info("Auto-checked out {$openRecords->count()} attendance record(s).");
        Log::info("Auto-checked out {$openRecords->count()} attendance record(s).");
    }
}
