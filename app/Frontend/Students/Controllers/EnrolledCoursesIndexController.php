<?php

namespace App\Frontend\Students\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EnrolledCoursesIndexController extends BaseController
{
    public function __invoke(Request $request): Response
    {
        $courses = $request->user()
            ->enrolled_courses()
            ->active()
            ->paginate(12)
            ->through(fn ($course) => [
                'id' => $course->id,
                'name' => $course->name,
                'slug' => $course->slug,
                'image' => get_image($course->media),
            ]);

        return Inertia::render('Courses/Enrolled', compact('courses'));
    }
}
