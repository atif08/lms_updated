<?php

namespace App\Frontend\Home\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends BaseController
{
    public function index(Request $request)
    {
        if (Auth::user()) {
            return redirect('/students/profile');
        }

        return redirect('/login');
        //        return view('frontend/home/index');

    }
}
