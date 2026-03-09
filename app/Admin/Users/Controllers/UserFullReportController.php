<?php

namespace App\Admin\Users\Controllers;

use App\Exports\FullReport\UserFullReportExport;
use App\Http\Controllers\BaseController;
use App\Services\FlashMessage;
use Domain\Users\Models\User;
use Illuminate\Http\Request;

class UserFullReportController extends BaseController
{
    public function __invoke(User $user, Request $request)
    {

        if ($user->enrolled_courses()->count() > 0) {
            return (new UserFullReportExport($user, $request))->download($user->name.'-full-report.xlsx');
        }
        FlashMessage::error('N0 Course attach to this user');

        return redirect()->back();

    }
}
