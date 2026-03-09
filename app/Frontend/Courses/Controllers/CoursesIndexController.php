<?php

namespace App\Frontend\Courses\Controllers;

use App\Frontend\Courses\Queries\CoursesIndexQuery;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CoursesIndexController extends BaseController
{
    public function __invoke(Request $request): View
    {
        $query = new CoursesIndexQuery;

        return view('frontend/courses/index', ['courses' => $query->get()]);
    }
}
