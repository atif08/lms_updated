<?php

namespace App\Admin\Reports\Controllers;

use App\Admin\Blocks\BlockBase;
use App\Admin\DataTables\Reports\ExportRequestsDatatable;
use App\Http\Controllers\BaseController;
use App\Models\ExportRequest;
use Domain\Courses\Models\Course;
use Domain\Users\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExportRequestController extends BaseController
{
    protected $settings_page = true;

    public function getIndex(Request $request): View|JsonResponse
    {

        $data_table = new ExportRequestsDatatable($this->user, $this->user, $request);

        if ($request->ajax()) {
            return $data_table->getData();
        }

        return $this->renderView('admin.exports.index', compact('data_table'));
    }

    public function getDownload(Request $request)
    {
        $request->validate(['export_id' => ['required']]);

        /** @var ExportRequest $export_request */
        $export_request = ExportRequest::query()->findOrFail($request->get('export_id'));

        abort_if($export_request->user_id !== $this->user->id ||
            $export_request->status != ExportRequest::STATUS_DONE, 422);

        $file_name = $export_request->export_type.'-'.$export_request->created_at->format('Ymd-His').'.xlsx';

        return storage()->download($export_request->full_path, $file_name);
    }

    public function postDelete(Request $request): bool
    {
        $request->validate(['export_id' => ['required']]);

        /** @var ExportRequest $export_request */
        $export_request = ExportRequest::query()->findOrFail($request->get('export_id'));

        //        abort_if($export_request->user_id !== $this->user->id, 422);

        $export_request->delete();

        return true;
    }

    public function getExportRequest(Request $request): bool
    {
        $custom_filters = $request->get('custom_filters');
        $file_name = '';
        $batch_name = '';
        $user_name = '';
        $course_name = '';
        $block_name = getBlockName($request);
        /** @var BlockBase $block */
        $block = new $block_name($this->user, $request);
        if ($custom_filters !== null && isset($custom_filters['b.name']['from'])) {
            $batch_name = $custom_filters['b.name']['from'].'-';
        }
        if ($custom_filters !== null && isset($custom_filters['u.name']['from'])) {
            $user_name = $custom_filters['u.name']['from'].'-';
        }
        if ($custom_filters !== null && isset($custom_filters['c.name']['from'])) {
            $course_name = $custom_filters['c.name']['from'];
        }
        if ($request->get('user_id')) {
            $user_name = User::query()->find($request->get('user_id'))?->name.'-';
        }
        if ($request->get('course_id')) {
            $course_name = Course::query()->find($request->get('course_id'))?->name;
        }
        $file_name = $batch_name.$user_name.$course_name;

        ExportRequest::createRequest($this->user, [
            'account_id' => $this->user->id,
            'export_type' => get_class_name($block),
            'payload' => [
                'full_url' => $request->fullUrl(),
                'block' => get_class($block),
                'file_name' => $file_name,
            ],
            'status' => ExportRequest::STATUS_PENDING,
        ]);

        return true;
    }
}
