<?php

namespace App\Admin\Forms\Calender;

use App\Admin\Forms\BaseForm;
use App\Models\Batch;
use Domain\Calendar\Enums\CalendarTopicEnum;
use Domain\Calendar\Models\CalendarEvent;
use Domain\Courses\Models\Course;
use Domain\Users\Models\User;
use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Field;

class CalendarEventForm extends BaseForm
{
    public function buildForm()
    {
        /** @var CalendarEvent $event */
        $event = $this->getData('item');
        /** @var User $usersList */
        $usersList = User::query()->active()->student()->get();

        $this
            ->add('topic', Field::SELECT, [
                'label' => required_label('Topic'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-select'],
                'choices' => CalendarTopicEnum::getDropdown(),
                'selected' => $event->topic_id ?? '',
                'rules' => ['required'],
            ])
            ->add('course_id', Field::SELECT, [
                'label' => required_label('Course'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-select'],
                'choices' => Course::active()->pluck('name', 'id')->toArray(),
                'selected' => $event->course_id ?? '',
                'rules' => ['required'],
            ])
            /*->add('batch_id', Field::SELECT, [
                'label'    => __('Batch'),
                'wrapper'  => ['class' => 'form-group col-lg-12 mb-2'],
                'attr'     => ['class' => 'form-select'],
                'choices'  => \App\Models\Batch::pluck('name', 'id')->toArray(),
                'selected' => $event->batch_id ?? '',
                'rules'    => ['nullable'],
            ])*/
            ->add('batch_id', Field::SELECT, [
                'label' => __('Batch'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-select get-batch-students'],
                'rules' => ['max:255'],
                'choices' => ['' => 'Select'] + Batch::query()->get()->pluck('name', 'id')->toArray(),
                'value' => $event?->batch_id ?? '',
            ])
            ->add('students', 'multi_select_dropdown', [
                'name' => 'students',
                'items' => [],
                'ids' => [],
            ])
            ->add('title', Field::TEXT, [
                'label' => required_label('Title'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required', 'string', 'max:255'],
                'value' => $event?->title ?? '',
            ])
            ->add('description', Field::TEXTAREA, [
                'label' => required_label('Description'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required', 'string', 'max:255'],
                'value' => $event?->description ?? '',
            ])
            ->add('start_datetime', Field::DATETIME_LOCAL, [
                'label' => required_label('Start Date & Time'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required'],
                'value' => $event?->start_datetime ?? '',
            ])
            ->add('end_datetime', Field::DATETIME_LOCAL, [
                'label' => required_label('End Date & Time'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required'],
                'value' => $event?->end_datetime ?? '',
            ])
            ->add('url', Field::URL, [
                'label' => __('URL'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['nullable', 'url'],
                'value' => $event?->url ?? '',
            ])
            ->add('is_active', Field::CHECKBOX, [
                'label' => __('Show'),
                'label_attr' => ['class' => 'form-check-label'],
                'wrapper' => ['class' => 'form-group form-check form-switch form-switch-lg m-2 ms-3', 'dir' => 'ltr'],
                'attr' => ['class' => 'form-check-input'],
                'rules' => ['sometimes', Rule::in(['1'])],
                'checked' => ($event ? $event->is_active : false),
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
                'label' => '<span class="fa fa-save"></span> '.__($event ? 'Save' : 'Save'),
                'wrapper' => ['class' => 'form-group mt-2 mb-2'],
                'attr' => ['class' => 'btn btn-success btn-supplier-save'],
            ]);
    }
}
