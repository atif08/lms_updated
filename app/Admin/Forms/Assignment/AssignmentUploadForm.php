<?php

namespace App\Admin\Forms\Assignment;

use App\Admin\Forms\BaseForm;
use Domain\Assignment\Models\Assignment;
use Domain\Courses\Models\Topic;
use Kris\LaravelFormBuilder\Field;

class AssignmentUploadForm extends BaseForm
{
    /** @var Topic */
    protected $topic;

    public function buildForm()
    {
        $topic = $this->getData('topic');
        $this
            ->add('submissionable_id', FIELD::HIDDEN, [
                'label' => required_label('topic'),
                'value' => $this->request->get('id'),
            ])->add('submissionable_type', FIELD::HIDDEN, [
                'label' => required_label('topic'),
                'value' => $this->request->get('type') == 'topic' ? Topic::class : Assignment::class,
            ])->add('description', FIELD::TEXTAREA, [
                'label' => required_label('Additional Notes'),
                'wrapper' => ['class' => 'input-block'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['string', 'max:255'],
            ])
            ->add('media', FIELD::FILE, [
                'label' => required_label('Upload Assignment'),
                'wrapper' => ['class' => 'input-block'],
                'attr' => ['class' => 'form-control', 'accept' => '.pdf, .doc, .docx,'],
                'rules' => ['required', 'file', 'mimes:docx,doc', 'max:255'],
            ])
            ->add('form_message', Field::STATIC, [
                'tag' => 'div',
                'label' => false,
                'attr' => [
                    'id' => 'form-error',
                    'class' => 'text-danger mb-2',
                ],
                'value' => '', // empty initially
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
                'label' => __('Submit'),
                'wrapper' => ['class' => 'd-grid', 'id' => 'assignment-button'],
                'attr' => ['class' => 'btn btn-primary btn-start assignment-submit-button'],
            ]);
    }
}
