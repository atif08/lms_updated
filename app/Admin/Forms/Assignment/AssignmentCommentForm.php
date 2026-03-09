<?php

namespace App\Admin\Forms\Assignment;

use App\Admin\Forms\BaseForm;
use Domain\Assignment\Enums\AssignmentStatusEnum;
use Domain\Courses\Models\Topic;
use Kris\LaravelFormBuilder\Field;

class AssignmentCommentForm extends BaseForm
{
    /** @var Topic */
    protected $topic;

    public function buildForm()
    {
        $item = $this->getData('item');
        $this
            ->add('comments', FIELD::TEXTAREA, [
                'label' => required_label('Notes'),
                'wrapper' => ['class' => 'input-block'],
                'attr' => ['class' => 'form-control'],
                //                'rules'   => ['string'],
                'value' => $item->comments,
            ])
            ->add('score', FIELD::NUMBER, [
                'label' => required_label('Score/100'),
                'wrapper' => ['class' => 'input-block'],
                'attr' => ['class' => 'form-control'],
                //                'rules'   => ['string'],
                'value' => $item->score,
            ])
            ->add('status', FIELD::SELECT, [
                'label' => __('Status'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2 mt-2'],
                'attr' => ['class' => 'form-select', 'id' => 'assignment-status'],
                'selected' => $item->status ?? '',
                'choices' => AssignmentStatusEnum::getDropdown(),
                //                'rules'    => ['required'],
            ])

            ->add('submit', Field::BUTTON_SUBMIT, [
                'label' => __('Submit'),
                'wrapper' => ['class' => 'd-grid'],
                'attr' => ['class' => 'btn btn-primary btn-start'],
            ]);
    }
}
