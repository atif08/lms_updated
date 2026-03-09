<?php

namespace App\Admin\Forms;

use App\Admin\Settings\Controllers\ProfileController;
use App\Models\Batch;
use Domain\Courses\Models\Course;
use Domain\Users\Enums\UserTypeEnum;
use Domain\Users\Models\User;
use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Field;
use Spatie\Permission\Models\Role;

class UserForm extends BaseForm
{
    /** @var User */
    protected $user;

    /** @var string */
    protected $class;

    public function buildForm()
    {
        /** @var User $user */
        $this->user = $this->getData('user');
        $this->class = $this->getData('class');
        $roles = Role::query()->get();
        $batches = Batch::query()->get();
        $courses = Course::query()->active()->get();

        $this
            ->add('name', FIELD::TEXT, [
                'label' => required_label('Name'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required', 'string', 'max:255'],
                'value' => $this->user?->name ?? '',
            ])
            ->add('email', FIELD::TEXT, [
                'label' => required_label('Email Address'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users', 'email')->ignore($this->user?->id),
                ],
                'value' => $this->user?->email ?? '',
            ])->add('mobile', FIELD::TEXT, [
                'label' => required_label('Mobile Number'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => $this->user ? [] : ['max:255'],
                'value' => $this->user?->mobile ?? '',
            ])
            ->addIf('user_type', FIELD::SELECT, [
                'label' => __('User Type'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2 mt-2'],
                'attr' => ['class' => 'form-select'],
                'selected' => $this->user?->user_type ?? UserTypeEnum::STANDARD_STUDENT(),
                'choices' => UserTypeEnum::getUsersDropdown(),
                'rules' => ['required'],
            ], $this->class !== ProfileController::class)

            ->addIf('role', FIELD::SELECT, [
                'label' => __('Role'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2 mt-2'],
                'attr' => ['class' => 'form-select'],
                'selected' => $this->user?->getRoleNames()[0] ?? '',
                'choices' => $roles->pluck('name', 'name')->toArray(),
                'rules' => ['required'],
            ], $this->class !== ProfileController::class && auth()->user()->user_type !== UserTypeEnum::FACULTY_MEMBER())
            ->add('batch_id', FIELD::SELECT, [
                'label' => __('Batch'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2 mt-2'],
                'attr' => array_merge(
                    ['class' => 'form-select'],
                    $this->class === ProfileController::class ? ['disabled' => 'disabled'] : []
                ),
                'selected' => $this->user?->batch_id ?? '',
                'choices' => ['' => 'Select'] + $batches->pluck('name', 'id')->toArray(),
                'rules' => [
                    Rule::requiredIf(function () {
                        $userType = request()->get('user_type') ?? $this->model?->user_type;

                        return $userType == UserTypeEnum::STANDARD_STUDENT() || $userType == UserTypeEnum::ACCELERATED_STUDENT();
                    }),
                ],
            ])
            ->add('course_id', FIELD::SELECT, [
                'label' => __('Course'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2 mt-2'],
                'attr' => array_merge(
                    ['class' => 'form-select'],
                    $this->class === ProfileController::class ? ['disabled' => 'disabled'] : []
                ),
                'selected' => $this->user->enrolled_courses[0]->id ?? '',
                'choices' => ['' => 'Select'] + $courses->pluck('name', 'id')->toArray(),
                'rules' => [
                    Rule::requiredIf(function () {
                        $userType = request()->get('user_type') ?? $this->model?->user_type;

                        return $userType == UserTypeEnum::STANDARD_STUDENT() || $userType == UserTypeEnum::ACCELERATED_STUDENT();
                    }),
                ],
            ])

            ->addIf('is_active', FIELD::CHECKBOX, [
                'label' => __('Active'),
                'label_attr' => ['class' => 'form-check-label'],
                'wrapper' => ['class' => 'form-group form-check form-switch form-switch-lg m-2 ms-3', 'dir' => 'ltr'],
                'attr' => ['class' => 'form-check-input'],
                'rules' => ['sometimes', Rule::in(['1'])],
                'checked' => ($this->user ? $this->user->is_active : false),
            ], $this->class !== ProfileController::class)
            ->add('media', 'single_media', ['item' => $this->user ?? new User])
            ->addSubmitButton();
    }

    protected function addSubmitButton()
    {
        if ($this->class == ProfileController::class) {
            $button_title = __('Update Profile');
        } elseif ($this->user) {
            $button_title = __('Save');
        } else {
            $button_title = __('Save');
        }

        $this->add('submit', Field::BUTTON_SUBMIT, [
            'wrapper' => ['class' => 'form-group col-md-12 col-sm-12 mt-2'],
            'label' => '<span class="fa fa-save"></span> '.$button_title,
            'attr' => ['class' => 'btn btn-success'],
        ]);
    }
}
