<?php

namespace App\Admin\Forms\Assignment;

use App\Admin\Forms\BaseForm;
use Domain\Assignment\Models\Assignment;
use Domain\Courses\Models\Course;
use Domain\Users\Models\User;
use Kris\LaravelFormBuilder\Field;

class AssignmentForm extends BaseForm
{
    public function buildForm()
    {
        /** @var Assignment $item */
        $item = $this->getData('item');
        /** @var User $usersList */
        $usersList = User::query()->student()->active()->get();

        $this
            ->add('course_id', Field::SELECT, [
                'label' => required_label('Course'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-select'],
                'choices' => Course::active()->pluck('name', 'id')->toArray(),
                'selected' => $item->course_id ?? '',
                'rules' => ['required'],
            ])
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
            ->add('name', Field::TEXT, [
                'label' => required_label('Title'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required', 'string', 'max:255'],
                'value' => $item?->name ?? '',
            ])
            ->add('description', Field::TEXTAREA, [
                'label' => required_label('Description'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'value' => $item?->description ?? '',
            ])
            ->add('media', 'single_media', ['label' => 'Select Assignment', 'item' => $item ?? new Assignment])

            ->add('due_date', Field::DATE, [
                'label' => required_label('Due Date'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required'],
                'value' => $item?->due_date ?? '',
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
                'label' => '<span class="fa fa-save"></span> '.__($item ? 'Update' : 'Save'),
                'wrapper' => ['class' => 'form-group mt-2 mb-2'],
                'attr' => ['class' => 'btn btn-success btn-supplier-save'],
            ]);
    }
}
