<?php

namespace App\Admin\Forms;

use Domain\Assignment\Models\Assignment;
use Domain\Attendance\Enums\AttendanceStatusEnum;
use Domain\Users\Models\User;
use Kris\LaravelFormBuilder\Field;

class AttendanceForm extends BaseForm
{
    public function buildForm()
    {
        /** @var Assignment $item */
        $item = $this->getData('item');
        /** @var User $usersList */
        $usersList = User::query()->student()->active()->get();

        $this
//            ->add('batch_id', Field::SELECT, [
//                'label' => __('Batch'),
//                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
//                'attr'     => ['class' => 'form-select'],
//                'rules' => ['max:255'],
//                'choices' => Batch::query()->get()->pluck('name','id')->toArray(),
//                'value' => $item?->batch_id ?? ''
//            ])
            ->add('students', 'multi_select_dropdown', [
                'name' => 'students',
                'items' => $usersList ?? [],
                'ids' => $item?->users?->pluck('id')->toArray() ?? [],
            ])
            ->add('check_in', Field::TIME, [
                'label' => required_label('Check In'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required'],
                'value' => $item?->check_in ?? '',
            ])
            ->add('check_out', Field::TIME, [
                'label' => required_label('Check Out'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required'],
                'value' => $item?->check_out ?? '',
            ])
            ->add('date', Field::DATE, [
                'label' => required_label('Date'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required'],
                'value' => $item?->date ?? '',
            ])
            ->add('status', FIELD::SELECT, [
                'label' => __('Status'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2 mt-2'],
                'attr' => ['class' => 'form-select', 'id' => 'status_id'],
                'selected' => $item?->status ?? '',
                'choices' => AttendanceStatusEnum::getDropdown(),
                'rules' => ['required'],
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
                'label' => '<span class="fa fa-save"></span> '.__($item ? 'Update' : 'Save'),
                'wrapper' => ['class' => 'form-group mt-2 mb-2'],
                'attr' => ['class' => 'btn btn-success btn-supplier-save'],
            ]);
    }
}
