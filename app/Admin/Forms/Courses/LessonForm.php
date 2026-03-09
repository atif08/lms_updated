<?php

namespace App\Admin\Forms\Courses;

use App\Admin\Forms\BaseForm;
use Domain\Courses\Enums\LessonTypeEnum;
use Domain\Courses\Models\Lesson;
use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Field;

class LessonForm extends BaseForm
{
    public function buildForm()
    {
        /** @var Lesson $lesson */
        $lesson = $this->getData('item');

        $this
            ->add('name', FIELD::TEXT, [
                'label' => required_label('Name'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required', 'string', 'max:255'],
                'value' => $lesson?->name ?? '',
            ])
            ->add('description', 'ck_editor', ['description' => $lesson->description ?? ''])
            ->add('type', FIELD::SELECT, [
                'label' => required_label('Type'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2 mt-2 '],
                'attr' => ['class' => 'form-select lessonTypeChange'],
                'selected' => $lesson->type ?? '',
                'choices' => LessonTypeEnum::getDropdownLesson(),
                'rules' => ['required'],
            ])
            ->addIf('external_link', FIELD::TEXT, [
                'label' => __('External Link'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2 external_link'],
                'attr' => ['class' => 'form-control'],
                'value' => $lesson?->external_link ?? '',
            ])->addIf('iframe', FIELD::TEXTAREA, [
                'label' => __('Iframe'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2 iframe'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['nullable', 'string'],
                'value' => $lesson?->external_link ?? '',
            ])
            ->add('user_ids', 'multi_select_dropdown', [
                'name' => 'user_ids',
                'attr' => [
                    'placeholder' => 'Select users',
                ],
                'items' => $lesson->topic->course->students ?? [],
                'ids' => $lesson?->users->pluck('id')->toArray() ?? [],
            ])
            ->add('media', 'collection_media', ['item' => $lesson ?? new Lesson, 'id' => 'mediaId'])

            ->add('is_active', FIELD::CHECKBOX, [
                'label' => __('Show'),
                'label_attr' => ['class' => 'form-check-label'],
                'wrapper' => ['class' => 'form-group form-check form-switch form-switch-lg m-2 ms-3', 'dir' => 'ltr'],
                'attr' => ['class' => 'form-check-input'],
                'rules' => ['sometimes', Rule::in(['1'])],
                'checked' => ($lesson ? $lesson->is_active : true),
            ])->add('is_fast_track', FIELD::CHECKBOX, [
                'label' => __('Fast Track'),
                'label_attr' => ['class' => 'form-check-label'],
                'wrapper' => ['class' => 'form-group form-check form-switch form-switch-lg m-2 ms-3', 'dir' => 'ltr'],
                'attr' => ['class' => 'form-check-input'],
                'rules' => ['sometimes', Rule::in(['1'])],
                'checked' => ($lesson ? $lesson->is_fast_track : true),
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
                'label' => '<span class="fa fa-save"></span> '.__($lesson ? 'Save' : 'Save'),
                'wrapper' => ['class' => 'form-group mt-2 mb-2'],
                'attr' => ['class' => 'btn btn-success btn-supplier-save'],
            ]);
    }
}
