<?php

namespace App\Frontend;

use App\Http\Controllers\Controller;
use Domain\Courses\Models\Course;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request, Course $course)
    {
        $page = 'Checkout - '.$course->name;

        $enrollment = $request->user()
            ->enrolled_courses()
            ->where('course_id', $course->id)
            ->first();

        $installmentProgress = $enrollment?->pivot?->installment_progress ?? 0;

        return view('marketplace.pages.checkout', compact('course', 'page', 'installmentProgress'));
    }
}
