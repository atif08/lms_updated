<?php

namespace App\Admin\Forms\Courses;

use App\Admin\Forms\BaseForm;
use App\Models\SupportTicket;
use Domain\Courses\Models\Topic;
use Kris\LaravelFormBuilder\Field;

class SupportTicketForm extends BaseForm
{
    /** @var Topic */
    protected $item;

    public function buildForm()
    {
        $item = $this->getData('item');
        $this
            ->add('category', FIELD::SELECT, [
                'label' => required_label('Category'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2 mt-2'],
                'attr' => ['class' => 'form-select', 'id' => 'status_id'],
                'rules' => ['required'],
                'choices' => ['TECHNICAL' => 'Technical', 'NON_TECHNICAL' => 'Non-Technical'],
                'selected' => $item?->category ?? 'TECHNICAL',
            ])
            ->add('topic', FIELD::TEXT, [
                'label' => required_label('Topic'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required', 'string', 'max:255'],
                'value' => $item?->topic ?? '',
            ])
            ->add('description', 'ck_editor', ['description' => $item->description ?? ''])
            ->add('media', 'collection_media', ['label' => 'Select Attachment', 'item' => $item ?? new SupportTicket])
            ->add('status', FIELD::SELECT, [
                'label' => required_label('Status'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2 mt-2'],
                'attr' => ['class' => 'form-select', 'id' => 'status_id'],
                'rules' => ['required'],
                'choices' => ['HIGH' => 'High', 'LOW' => 'Low', 'MEDIUM' => 'Medium', 'CLOSED' => 'Closed'],
                'selected' => $item?->status ?? 'HIGH',
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
                'label' => '<span class="fa fa-save"></span> '.__($item ? 'Update' : 'Create'),
                'wrapper' => ['class' => 'form-group mt-2 mb-2'],
                'attr' => ['class' => 'btn btn-success btn-supplier-save'],
            ]);
    }
}
