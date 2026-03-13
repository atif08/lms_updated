<?php

namespace App\Frontend\Students\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\FlashMessage;
use Domain\Courses\Models\Course;
use Domain\Payments\Enums\PaymentMethodEnum;
use Domain\Payments\Enums\PaymentStatusEnum;
use Domain\Payments\Models\Payment;
use Domain\Users\Models\User;
use Illuminate\Http\Request;

class EnrollmentController extends BaseController
{
    public function __invoke(Request $request, Course $course, User $user)
    {
        $installmentProgress = (int) $request->input('installment_progress', 0);
        $installmentNo = $request->input('installment_no');
        $paymentMethod = $request->input('payment_method', PaymentMethodEnum::CARD()->value);
        $amount = $request->input('amount');
        $orderId = $request->input('orderId');

        if ($amount) {
            Payment::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'amount' => $amount,
                'payment_method' => $paymentMethod,
                'status' => PaymentStatusEnum::COMPLETED()->value,
                'transaction_id' => $orderId,
                'installment_no' => $installmentNo,
            ]);
        }

        $user->enrolled_courses()->syncWithoutDetaching([
            $course->id => [
                'status' => PaymentStatusEnum::COMPLETED()->value,
                'installment_progress' => $installmentProgress,
                'payment_method' => $paymentMethod,
            ],
        ]);

        FlashMessage::success('You are enrolled successfully');

        return redirect()->back();
    }

    public function unenroll(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        $user = User::find($request->user_id);
        $course = Course::find($request->course_id);

        $user->courses()->detach($course);

        return response()->json(['message' => 'Student unenrolled from course successfully']);
    }
}
