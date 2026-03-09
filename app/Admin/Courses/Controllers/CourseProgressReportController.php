<?php

namespace App\Admin\Courses\Controllers;

use App\Admin\DataTables\Courses\CoursesProgressReportDataTable;
use App\Admin\DataTables\Courses\CoursesProgressReportDetailDataTable;
use App\Http\Controllers\BaseController;
use App\Models\Batch;
use Domain\Courses\Models\Course;
use Domain\Users\Enums\UserTypeEnum;
use Domain\Users\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseProgressReportController extends BaseController
{
    public function index(Request $request): View|JsonResponse
    {
        $data_table = new CoursesProgressReportDataTable(user: $this->user, request: $request);

        if ($request->ajax()) {
            return $data_table->getData();
        }

        return $this->renderView('admin.courses.progress.index', compact('data_table'));
    }

    public function detail(Request $request): View|JsonResponse
    {
        $courses = Course::query()->get();
        $data_table = new CoursesProgressReportDetailDataTable(user: $this->user, request: $request);
        if ($request->ajax()) {
            return $data_table->getData();
        }

        return $this->renderView('admin.courses.progress.progress_report', compact('data_table', 'courses'));
    }
}
