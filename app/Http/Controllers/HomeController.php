<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends BaseController {

    public function getIndex(Request $request) {
        return match (true) {
            $this->user->isAdmin() => redirect('admin/users'),
            default => redirect('students/dashboard'),
        };
    }

}
