<?php

namespace App\Admin\Payments\Controllers;

use App\Admin\DataTables\PaymentsDataTable;
use App\Http\Controllers\Controller;
use App\Notifications\PaymentConfirmedNotification;
use App\Services\FlashMessage;
use Domain\Courses\Models\Course;
use Domain\Payments\Enums\PaymentMethodEnum;
use Domain\Payments\Enums\PaymentStatusEnum;
use Domain\Payments\Models\Payment;
use Domain\Users\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminPaymentsController extends Controller
{
    public function index(Request $request): JsonResponse|View
    {
        $data_table = new PaymentsDataTable($this->user, $this->current_account, $request);

        if ($request->ajax()) {
            return $data_table->getData();
        }

        return $this->renderView('admin.payments.index', compact('data_table'));
    }

    public function show(Payment $payment): View
    {
        return $this->renderView('admin.payments.show', compact('payment'));
    }

    public function confirm(Payment $payment): RedirectResponse
    {
        if ($payment->status === PaymentStatusEnum::COMPLETED()->value) {
            FlashMessage::info('Payment is already completed.');

            return back();
        }

        $payment->update([
            'status' => PaymentStatusEnum::COMPLETED()->value,
        ]);

        $this->unlockCourse($payment);

        // Notify student
        $payment->user->notify(new PaymentConfirmedNotification($payment));

        FlashMessage::success('Payment confirmed and student notified.');

        return back();
    }

    public function create(): View
    {
        $students = User::query()->where('user_type', 'standard_student')->orderBy('name')->get();
        $courses = Course::query()->active()->orderBy('name')->get();

        return $this->renderView('admin.payments.create', compact('students', 'courses'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'amount' => 'required|numeric|min:0',
            'transaction_id' => 'nullable|string|max:255',
        ]);

        $payment = Payment::create([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'amount' => $request->amount,
            'payment_method' => PaymentMethodEnum::OFFLINE()->value,
            'status' => PaymentStatusEnum::COMPLETED()->value,
            'transaction_id' => $request->transaction_id,
        ]);

        $this->unlockCourse($payment);

        // Notify student
        $payment->user->notify(new PaymentConfirmedNotification($payment));

        FlashMessage::success('Offline payment recorded and course unlocked for student.');

        return redirect()->route('payments.index');
    }

    private function unlockCourse(Payment $payment): void
    {
        $student = $payment->user;
        $course = $payment->course;

        // Ensure user is enrolled
        if (! $student->enrolled_courses()->where('course_id', $course->id)->exists()) {
            $student->enrolled_courses()->attach($course->id, ['status' => PaymentStatusEnum::COMPLETED()->value]);
        }

        $student->enrolled_courses()->updateExistingPivot($course->id, [
            'status' => PaymentStatusEnum::COMPLETED()->value,
            'installment_progress' => 3,
        ]);

        if ($payment->payment_method === PaymentMethodEnum::EMI()->value) {
            $student->enrolled_courses()->updateExistingPivot($course->id, [
                'installment_progress' => $payment->installment_no,
            ]);
        }
    }
}
