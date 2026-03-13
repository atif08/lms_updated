<?php

namespace App\Frontend\Home\Controllers;

use App\Http\Controllers\BaseController;
use Domain\Courses\Models\Course;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PagesController extends BaseController
{
    public function getHome(Request $request): View
    {

        return view('marketplace/pages/index');
    }

    public function getAbout(Request $request): View
    {

        return view('marketplace/pages/about');
    }

    public function getContact(Request $request): View
    {

        return view('marketplace/pages/contact');
    }

    public function getCourses(): View
    {

        return view('marketplace/pages/courses');
    }

    public function getCourse(string $slug)
    {
        if ($slug == $this->user?->enrolled_courses?->firstWhere('slug', $slug)?->slug) {
            return to_route('courses.get.details', ['course' => $slug]);
        }

        return view('marketplace/pages/'.$slug, [
            'course' => Course::query()->where('slug', $slug)->first(),
        ]);
    }

    public function getLandingPage(string $slug)
    {
        // Look for views in /marketplace/pages/{slug}.blade.php
        $viewPath = 'marketplace.pages.'.$slug;

        if (view()->exists($viewPath)) {
            return view($viewPath);
        }

        // If view not found, throw 404
        abort(404, 'Landing Page not found');
    }
}
