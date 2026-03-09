<?php

namespace App\Admin\Forms\Settings;

use App\Admin\Forms\BaseForm;
use Domain\Categories\Enums\CategoryTypeEnum;
use Kris\LaravelFormBuilder\Field;

class CategoryForm extends BaseForm
{
    public function buildForm(): void
    {
        $item = $this->getData('item');
        $this
            ->add('name', FIELD::TEXT, [
                'label' => required_label('Title'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control', 'rows' => '4'],
                'rules' => ['required', 'max:255'],
                'value' => $item->name ?? '',
            ])
//            ->add('type', FIELD::SELECT, [
//                'label'    => __('Type'),
//                'wrapper'  => ['class' => 'form-group col-lg-12 mb-2 mt-2'],
//                'attr'     => ['class' => 'form-select'],
//                'selected' => $item->type ?? '',
//                'choices'  => CategoryTypeEnum::getDropdown(),
//                'rules'    => ['required'],
//            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
                'wrapper' => ['class' => 'form-group col-md-12 col-sm-12 mt-2'],
                'label' => '<span class="fa fa-save"></span> '.__('Save'),
                'attr' => ['class' => 'btn btn-success btn-save'],
            ]);
    }
}
