<?php

namespace App\Admin\Attendance\Controllers;

use App\Admin\DataTables\AttendanceDataTable;
use App\Admin\Forms\AttendanceForm;
use App\Http\Controllers\BaseController;
use App\Models\Batch;
use App\Services\FlashMessage;
use Carbon\Carbon;
use Domain\Attendance\Model\Attendance;
use Domain\Users\Enums\UserTypeEnum;
use Domain\Users\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;

class AttendanceController extends BaseController
{
    public function index(Request $request)
    {
        $data_table = new AttendanceDataTable(user: $this->user, request: $request);

        if ($request->ajax()) {
            return $data_table->getData();
        }

//        $data_table->setFilterData([
//            'batches' => Batch::query()->get(),
//            'users' => User::query()->whereIn('user_type', [UserTypeEnum::STANDARD_STUDENT(), UserTypeEnum::ACCELERATED_STUDENT()])->get(),
//        ]);

        return $this->renderView('admin/attendance/index', compact('data_table'));
    }

    public function create(FormBuilder $formBuilder): View
    {
        $form = $this->_getForm($formBuilder);

        return $this->renderView('admin.attendance.form', compact('form'));
    }

    public function store(FormBuilder $formBuilder, Request $request): RedirectResponse
    {
        $form = $this->_getForm($formBuilder);
        $form->redirectIfNotValid();
        $request = $form->getFieldValues();

        // Custom validation
        $validator = Validator::make($request, [
            'check_in' => 'required|date_format:H:i',
            'check_out' => 'required|date_format:H:i|after:check_in',
            'date' => 'required|date',
            'students' => 'required|array',
            'status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Combine the date with check_in and check_out times
        $checkIn = Carbon::createFromFormat('Y-m-d H:i', $request['date'].$request['check_in']);
        $checkOut = Carbon::createFromFormat('Y-m-d H:i', $request['date'].$request['check_out']);

        $hoursDifference = $checkIn->diff($checkOut);

        foreach ($request['students'] as $student) {
            Attendance::query()->create([
                'batch_id' => User::query()->find($student)->batch_id,
                'date' => $request['date'],
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'user_id' => $student,
                'status' => $request['status'],
                'hours' => sprintf('%02d:%02d:%02d', $hoursDifference->h, $hoursDifference->i, $hoursDifference->s),
            ],
            );
        }
        FlashMessage::success('Attendance created successfully !');

        return to_route('attendances.index');
    }

    private function _getForm(FormBuilder $form_builder, $attendance = null): Form
    {
        return $form_builder->create(AttendanceForm::class, [
            'method' => $attendance ? 'PUT' : 'POST',
            'url' => $attendance ? route('attendances.update', $attendance->id) : route('attendances.store'),
            'role' => 'form',
            'class' => 'row',
        ], [
            'item' => $attendance,
            'class' => get_class($this),
        ]);
    }
}
