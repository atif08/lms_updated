<?php

namespace App\Frontend\Students\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentsIndexController extends BaseController
{
    public function index(Request $request): View
    {

        return view('frontend/students/courses');
    }
}
