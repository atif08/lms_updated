<?php

namespace App\Admin\Forms\Quizzes;

use App\Admin\Forms\BaseForm;
use Domain\Quizzes\Models\QuizSection;
use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Field;

class QuizSectionForm extends BaseForm
{
    /** @var QuizSection */
    protected $quizSection;

    public function buildForm()
    {
        /** @var QuizSection $quizSection */
        $quizSection = $this->getData('item');
        $quiz_id = $this->getData('quiz_id');
        // Basic fields always shown
        $this
            ->add('title', Field::TEXT, [
                'label' => required_label('Title'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required', 'string', 'max:255'],
                'value' => $quizSection?->title ?? '',
            ])
            ->add('quiz_id', Field::HIDDEN, [
                'label' => required_label('Title'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required', 'string', 'max:255'],
                'value' => $quiz_id ?? '',
            ])
            ->add('description', 'ck_editor', [
                'description' => $quizSection?->description ?? '',
            ]);
        //            ->add('mandatory', Field::CHECKBOX, [
        //                'label' => __('Mandatory'),
        //                'label_attr' => ['class' => 'form-check-label'],
        //                'wrapper' => ['class' => 'form-group form-check form-switch form-switch-lg m-2 ms-3', 'dir' => 'ltr'],
        //                'attr' => ['class' => 'form-check-input'],
        //                'rules' => ['sometimes', Rule::in(['1'])],
        //                'checked' => $quizSection ? $quizSection->mandatory : false,
        //            ])
        //            ->add('shuffle_questions', Field::CHECKBOX, [
        //                'label' => __('Shuffle Questions'),
        //                'label_attr' => ['class' => 'form-check-label'],
        //                'wrapper' => ['class' => 'form-group form-check form-switch form-switch-lg m-2 ms-3', 'dir' => 'ltr'],
        //                'attr' => ['class' => 'form-check-input'],
        //                'rules' => ['sometimes', Rule::in(['1'])],
        //                'checked' => $quizSection ? $quizSection->shuffle_questions : false,
        //            ])
        //            ->add('shuffle_answers', Field::CHECKBOX, [
        //                'label' => __('Shuffle Answers'),
        //                'label_attr' => ['class' => 'form-check-label'],
        //                'wrapper' => ['class' => 'form-group form-check form-switch form-switch-lg m-2 ms-3', 'dir' => 'ltr'],
        //                'attr' => ['class' => 'form-check-input'],
        //                'rules' => ['sometimes', Rule::in(['1'])],
        //                'checked' => $quizSection ? $quizSection->shuffle_answers : false,
        //            ])
        //            ->add('use_random_questions', Field::CHECKBOX, [
        //                'label' => __('Use Random Questions'),
        //                'label_attr' => ['class' => 'form-check-label'],
        //                'wrapper' => ['class' => 'form-group form-check form-switch form-switch-lg m-2 ms-3', 'dir' => 'ltr'],
        //                'attr' => ['class' => 'form-check-input'],
        //                'rules' => ['sometimes', Rule::in(['1'])],
        //                'checked' => $quizSection ? $quizSection->use_random_questions : false,
        //            ])
        //            ->add('random_questions_count', Field::NUMBER, [
        //                'label' => __('Random Questions Count'),
        //                'wrapper' => ['class' => 'form-group col-lg-6 mb-2'],
        //                'attr' => ['class' => 'form-control'],
        //                'rules' => ['nullable', 'integer'],
        //                'value' => $quizSection?->random_questions_count ?? ''
        //            ])
        //            ->add('hide_title_and_description', Field::CHECKBOX, [
        //                'label' => __('Hide Title and Description'),
        //                'label_attr' => ['class' => 'form-check-label'],
        //                'wrapper' => ['class' => 'form-group form-check form-switch form-switch-lg m-2 ms-3', 'dir' => 'ltr'],
        //                'attr' => ['class' => 'form-check-input'],
        //                'rules' => ['sometimes', Rule::in(['1'])],
        //                'checked' => $quizSection ? $quizSection->hide_title_and_description : false,
        //            ]);

        $this->add('submit', Field::BUTTON_SUBMIT, [
            'label' => '<span class="fa fa-save"></span> '.__($quizSection ? 'Save' : 'Save'),
            'wrapper' => ['class' => 'form-group mt-2 mb-2'],
            'attr' => ['class' => 'btn btn-success btn-supplier-save', 'id' => 'sectionSave'],
        ]);
    }
}
