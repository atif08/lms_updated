<?php

namespace App\Admin\Forms\Courses;

use App\Admin\Forms\BaseForm;
use Domain\Categories\Models\Category;
use Domain\Courses\Enums\CourseStatusEnum;
use Domain\Courses\Enums\DifficultyTypeEnum;
use Domain\Courses\Models\Course;
use Domain\Users\Models\User;
use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Field;

class CourseForm extends BaseForm
{
    /** @var Course */
    protected $course;

    /** @var User */
    protected $user;

    public function buildForm()
    {
        /** @var Course $course */
        $course = $this->getData('item');
        /** @var User $usersList */
        $usersList = User::query()->teacher()->get();

        $categories = Category::query()->get();

        $this
            ->add('name', FIELD::TEXT, [
                'label' => required_label('Name'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required', 'string', 'max:255', Rule::unique('courses', 'name')->ignore($course?->id)],
                'value' => $course?->name ?? '',
            ])
            ->add('slug', FIELD::TEXT, [
                'label' => required_label('Slug'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required', 'string', 'max:255', Rule::unique('courses', 'slug')->ignore($course?->id)],
                'value' => $course?->slug ?? '',
            ])
            ->add('announcement', FIELD::TEXTAREA, [
                'label' => required_label('Announcement'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['sometimes', 'max:255'],
                'value' => $course?->announcement ?? '',
            ])

            /* ->add('course_duration_hr', FIELD::NUMBER, [
                'label' => required_label('Course Duration Hr'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required', 'string', 'max:255'],
                'value' => $course?->course_duration_hr ?? ''
            ])->add('course_duration_min', FIELD::NUMBER, [
                'label' => required_label('Course Duration Min'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required', 'string', 'max:255'],
                'value' => $course?->course_duration_min ?? ''
            ])*/
            ->add('description', 'ck_editor', ['description' => $course->description ?? ''])
//            ->add('difficulty_level', FIELD::SELECT, [
//                'label'    => __('Difficulty Level'),
//                'wrapper'  => ['class' => 'form-group col-lg-12 mb-2 mt-2'],
//                'attr'     => ['class' => 'form-select'],
//                'selected' => $course->status ?? '',
//                'choices'  => DifficultyTypeEnum::getDropdownLesson(),
//                'rules'    => ['required']
//            ])
            ->add('category_id', FIELD::SELECT, [
                'label' => __('Category'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2 mt-2'],
                'attr' => ['class' => 'form-select'],
                'selected' => $course->category_id ?? '',
                'choices' => $categories->pluck('name', 'id')->toArray(),
                'rules' => ['required'],
            ])
            ->add('course_status', FIELD::SELECT, [
                'label' => __('Course Status'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2 mt-2'],
                'attr' => ['class' => 'form-select'],
                'selected' => $course->course_status ?? '',
                'choices' => CourseStatusEnum::getDropdown(),
                'rules' => ['required'],
            ])
            ->add('teachers', 'multi_select_dropdown', [
                'name' => 'teachers',
                'items' => $usersList ?? [],
                'ids' => $course?->teachers()->pluck('users.id')->toArray() ?? [],
            ])
            ->add('media', 'single_media', ['item' => $course ?? new Course])
            ->add('is_question', FIELD::CHECKBOX, [
                'label' => __('Question and answer'),
                'label_attr' => ['class' => 'form-check-label'],
                'wrapper' => ['class' => 'form-group form-check form-switch form-switch-lg m-2 ms-3', 'dir' => 'ltr'],
                'attr' => ['class' => 'form-check-input'],
                'rules' => ['sometimes', Rule::in(['1'])],
                'checked' => ($course ? $course->is_question : false),
            ])
//            ->add('is_announcement', FIELD::CHECKBOX, [
//                'label' => __('Announcements'),
//                'label_attr' => ['class' => 'form-check-label'],
//                'wrapper' => ['class' => 'form-group form-check form-switch form-switch-lg m-2 ms-3', 'dir' => 'ltr'],
//                'attr' => ['class' => 'form-check-input'],
//                'rules' => ['sometimes', Rule::in(['1'])],
//                'checked' => ($course ? $course->is_announcement : false),
//            ])
            ->add('is_active', FIELD::CHECKBOX, [
                'label' => __('Active'),
                'label_attr' => ['class' => 'form-check-label'],
                'wrapper' => ['class' => 'form-group form-check form-switch form-switch-lg m-2 ms-3', 'dir' => 'ltr'],
                'attr' => ['class' => 'form-check-input'],
                'rules' => ['sometimes', Rule::in(['1'])],
                'checked' => ($course ? $course->is_active : true),
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
                'label' => '<span class="fa fa-save"></span> '.__($course ? 'Save' : 'Save'),
                'wrapper' => ['class' => 'form-group mt-2 mb-2'],
                'attr' => ['class' => 'btn btn-success btn-supplier-save', 'id' => 'courseSave'],
            ]);
    }
}
