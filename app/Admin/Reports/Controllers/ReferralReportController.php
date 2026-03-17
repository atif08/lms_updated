<?php

namespace App\Admin\Reports\Controllers;

use App\Admin\DataTables\ReferralEnrollmentsDataTable;
use App\Http\Controllers\BaseController;
use Domain\Courses\Models\Course;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReferralReportController extends BaseController
{
    public function index(Request $request): View|JsonResponse
    {
        $data_table = new ReferralEnrollmentsDataTable($this->user, $this->current_account, $request);

        if ($request->ajax()) {
            return $data_table->getData();
        }


        return $this->renderView('admin.reports.referrals', compact('data_table'));
    }
}
