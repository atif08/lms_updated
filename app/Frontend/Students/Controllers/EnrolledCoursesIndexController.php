<?php

namespace App\Frontend\Students\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EnrolledCoursesIndexController extends BaseController
{
    public function __invoke(Request $request): View
    {
        $courses = $request->user()->enrolled_courses()->active()->paginate();

        return view('frontend/courses/enrolled-courses', compact('courses'));
    }
}
