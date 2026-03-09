<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends BaseController {

    public function getIndex(Request $request) {
        return $this->renderView('dashboard.index');
    }

}
