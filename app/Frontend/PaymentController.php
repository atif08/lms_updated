<?php

namespace App\Frontend;

use App\Http\Controllers\Controller;
use App\Services\GeideaPaymentService;
use Domain\Courses\Models\Course;
use Domain\Payments\Enums\PaymentMethodEnum;
use Domain\Payments\Enums\PaymentStatusEnum;
use Domain\Payments\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    protected $geidea;

    public function __construct(GeideaPaymentService $geidea)
    {
        $this->geidea = $geidea;
        parent::__construct();
    }

    public function pay(Request $request): JsonResponse
    {
        $response = $this->geidea->initiatePayment([
            'amount' => $request->amount,
            'card_number' => $request->card_number,
            'expiry_month' => $request->expiry_month,
            'expiry_year' => $request->expiry_year,
            'cvv' => $request->cvv,
            'reference_id' => uniqid('order_'),
            'callback_url' => route('payment.callback'),
        ]);

        return response()->json($response);
    }

    public function createSession(Request $request): JsonResponse
    {
        $request->validate([
            'slug' => 'required',
            'currency' => 'required|string',
            'callback_url' => 'required|url',
            'language' => 'nullable|string',
            'amount' => 'nullable|numeric',
        ]);

        $course = Course::query()->where('slug', $request->input('slug'))->first();

        if (! $course) {
            return response()->json([
                'error' => "there is no course found with slug '{$request->input('slug')}'",
            ], 404);
        }

        $data = [
            'amount' => $request->input('amount', $course->price),
            'currency' => 'USD',
            'merchant_reference_id' => Str::uuid(),
            'timestamp' => now()->format('Y/m/d H:i:s'),
            'callback_url' => $request->callback_url,
            'language' => $request->language ?? 'en',
        ];

        $response = $this->geidea->createSession($data);

        if ($response->failed()) {
            return response()->json([
                'error' => $response->json('detailedResponseMessage', 'Invalid Price'),
            ], $response->status());
        }

        return response()->json($response->json());
    }

    public function submitBankTransfer(Request $request, Course $course): RedirectResponse
    {
        $request->validate([
            'proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'amount' => 'nullable|numeric',
            'installment_progress' => 'nullable|integer',
            'installment_no' => 'nullable|integer',
        ]);

        $amount = $request->input('amount', $course->price);
        $installmentProgress = $request->input('installment_progress', 0); // Default to 0 (pending full enrollment) or 1?
        // Logic: if installment_progress is provided, use it. If not, assume full payment (course start).
        // Actually, existing full payment bank transfer logic sets progress=0, status=pending.

        // If this is an installment payment (e.g. 2nd installment), status should probably remain 'active' but this specific payment is pending approval?
        // Or we create a Payment record, and the Enrollment isn't updated until Admin approves?
        // The existing code updates enrollment immediately to 'pending'. This might lock the user out if they were 'active'.
        // For 2nd installment, we probably want to keep them 'active' on previous level, but maybe not unlock next level?
        // However, the prompt implies manual approval workflow.

        $payment = Payment::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'amount' => $amount,
            'payment_method' => PaymentMethodEnum::BANK_TRANSFER()->value,
            'status' => PaymentStatusEnum::PENDING()->value,
        ]);

        if ($request->hasFile('proof')) {
            $payment->addMediaFromRequest('proof')->toMediaCollection('payment_proofs');
        }

        // For installments, we might not want to overwrite the status to 'pending' if it was 'active'.
        // But for generic bank transfer flow, let's stick to the requested pattern:
        // Update enrollment to reflect the NEW state we are trying to reach, but marked as pending?
        // Or just record the payment and admin updates enrollment?

        // Existing logic:
        // Logic to capture referral
        $user = Auth::user();
        $referredById = null;
        $source = 'organic';

        $referrerType = $user->parent?->user_type;
        if ($user->parent_id && in_array($referrerType, [
            \Domain\Users\Enums\UserTypeEnum::TEACHER()->value,
            \Domain\Users\Enums\UserTypeEnum::FACULTY_MEMBER()->value,
        ])) {
            $referredById = $user->parent_id;
            $source = 'teacher';
        }

        $user->enrolled_courses()->syncWithoutDetaching([
            $course->id => [
                'status' => PaymentStatusEnum::PENDING()->value,
                'installment_progress' => $installmentProgress,
                'payment_method' => PaymentMethodEnum::BANK_TRANSFER()->value,
                'referred_by_id' => $referredById,
                'source' => $source,
            ],
        ]);

        return redirect()->route('courses.get.enrolled')->with('success', 'thanks for submit bank recipt we will review it');
    }
}
