<?php

namespace App\Admin\Forms\Courses;

use App\Admin\Forms\BaseForm;
use Domain\Courses\Models\Topic;
use Domain\Users\Models\User;
use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Field;

class TopicForm extends BaseForm
{
    /** @var Topic */
    protected $topic;

    public function buildForm()
    {
        $topic = $this->getData('item');
        $course = $this->getData('course');
        $existing_due_dates = $this->getData('existing_due_dates');
        $this
            ->add('name', FIELD::TEXT, [
                'label' => required_label('Name'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required', 'string', 'max:255'],
                'value' => $topic?->name ?? '',
            ])
            ->add('description', 'ck_editor', ['description' => $topic->description ?? ''])

            ->add('student_due_dates', 'custom_due_date', ['users' => User::student()->get(), 'existing_due_dates' => $existing_due_dates])

            ->addIf('is_active', FIELD::CHECKBOX, [
                'label' => __('Show'),
                'label_attr' => ['class' => 'form-check-label'],
                'wrapper' => ['class' => 'form-group form-check form-switch form-switch-lg m-2 ms-3', 'dir' => 'ltr'],
                'attr' => ['class' => 'form-check-input'],
                'rules' => ['sometimes', Rule::in(['1'])],
                'checked' => ($topic ? $topic->is_active : true),
            ])
            ->add('assignment_title', FIELD::TEXT, [
                'label' => 'Assignment Title',
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['nullable', 'string', 'max:255'],
                'value' => $topic->assignment->name ?? '',
            ])

            ->add('default_due_date', FIELD::DATE, [
                'label' => 'Default Assignment Due Date',
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['nullable', 'date'],
                'value' => $topic->assignment->due_date ?? '',
            ])
            ->add('media', 'single_media', ['label' => 'Select Assignment', 'item' => $topic->assignment ?? new Topic])

            ->add('submit', Field::BUTTON_SUBMIT, [
                'label' => '<span class="fa fa-save"></span> '.__('Save'),
                'wrapper' => ['class' => 'form-group mt-2 mb-2'],
                'attr' => ['class' => 'btn btn-success btn-supplier-save'],
            ]);
    }
}
