<?php

namespace App\Admin\Forms\Quizzes;

use App\Admin\Forms\BaseForm;
use App\Models\Batch;
use Domain\Quizzes\Models\Quiz;
use Domain\Users\Models\User;
use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Field;

class QuizForm extends BaseForm
{
    /** @var Quiz */
    protected $quiz;

    /** @var User */
    protected $user;

    public function buildForm()
    {
        /** @var Quiz $quiz */
        $quiz = $this->getData('item');
        $isEditMode = isset($quiz);

        // Basic fields always shown
        $this
            ->add('name', Field::TEXT, [
                'label' => required_label('Name'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required', 'string', 'max:255'],
                'value' => $quiz?->name ?? '',
            ])
            ->add('description', 'ck_editor', [
                'description' => $quiz?->description ?? '',
            ])
            ->add('is_active', Field::CHECKBOX, [
                'label' => __('Active'),
                'label_attr' => ['class' => 'form-check-label'],
                'wrapper' => ['class' => 'form-group form-check form-switch form-switch-lg m-2 ms-3', 'dir' => 'ltr'],
                'attr' => ['class' => 'form-check-input'],
                'rules' => ['sometimes', Rule::in(['1'])],
                'checked' => $quiz ? $quiz->is_active : true,
            ])->add('batch_id', Field::SELECT, [
                'label' => 'Batch',
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2 mt-2'],
                'attr' => ['class' => 'form-select'],
                'choices' => Batch::query()->get()->pluck('name', 'id')->toArray(),
                'selected' => $quiz->batch_id ?? '',
            ]);

        if ($isEditMode) {
            // Additional fields shown only in edit mode
            $this
//                ->add('unregistered_users_can_solve', Field::CHECKBOX, [
//                    'label' => 'Unregistered Users Can Solve',
//                    'label_attr' => ['class' => 'form-check-label'],
//                    'wrapper' => ['class' => 'form-group form-check form-switch form-switch-lg m-2 ms-3', 'dir' => 'ltr'],
//                    'attr' => ['class' => 'form-check-input'],
//                    'checked' => $quiz->unregistered_users_can_solve,
//                ])
//                ->add('hide_answers_in_reports', Field::CHECKBOX, [
//                    'label' => 'Hide Answers in Reports',
//                    'label_attr' => ['class' => 'form-check-label'],
//                    'wrapper' => ['class' => 'form-group form-check form-switch form-switch-lg m-2 ms-3', 'dir' => 'ltr'],
//                    'attr' => ['class' => 'form-check-input'],
//                    'checked' => $quiz->hide_answers_in_reports,
//                ])
//                ->add('no_review_needed', Field::CHECKBOX, [
//                    'label' => 'No Review Needed',
//                    'label_attr' => ['class' => 'form-check-label'],
//                    'wrapper' => ['class' => 'form-group form-check form-switch form-switch-lg m-2 ms-3', 'dir' => 'ltr'],
//                    'attr' => ['class' => 'form-check-input'],
//                    'checked' => $quiz->no_review_needed,
//                ])
//                ->add('student_can_download_results', Field::CHECKBOX, [
//                    'label' => 'Student Can Download Results',
//                    'label_attr' => ['class' => 'form-check-label'],
//                    'wrapper' => ['class' => 'form-group form-check form-switch form-switch-lg m-2 ms-3', 'dir' => 'ltr'],
//                    'attr' => ['class' => 'form-check-input'],
//                    'checked' => $quiz->student_can_download_results,
//                ])
                ->add('time_to_complete', Field::TEXT, [
                    'label' => 'Time to Complete',
                    'wrapper' => ['class' => 'form-group col-lg-6 mb-2'],
                    'attr' => ['class' => 'form-control'],
                    'value' => $quiz->time_to_complete ?? '',
                ])
                ->add('questions_per_page', Field::SELECT, [
                    'label' => 'Questions Per Page',
                    'wrapper' => ['class' => 'form-group col-lg-6 mb-2'],
                    'choices' => [
                        'single' => 'Single',
                        'section' => 'Section',
                        'all' => 'All',
                    ],
                    'selected' => $quiz->questions_per_page ?? 'all',
                ]);
        }

        $this->add('submit', Field::BUTTON_SUBMIT, [
            'label' => '<span class="fa fa-save"></span> '.__($quiz ? 'Save' : 'Save'),
            'wrapper' => ['class' => 'form-group mt-2 mb-2'],
            'attr' => ['class' => 'btn btn-success btn-supplier-save', 'id' => 'courseSave'],
        ]);
    }
}
