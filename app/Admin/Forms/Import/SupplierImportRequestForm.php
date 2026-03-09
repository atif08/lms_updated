<?php

namespace App\Admin\Forms\Import;

use App\Admin\Forms\BaseForm;
use App\Enums\ReportTypeEnum;
use Kris\LaravelFormBuilder\Field;

class SupplierImportRequestForm extends BaseForm
{
    public function buildForm()
    {

        $suppliers = $this->getData('suppliers');

        $this
            ->add('report_type', FIELD::HIDDEN, [
                'value' => ReportTypeEnum::SUPPLIER_SHEET()->value])
            ->add('supplier_id', FIELD::SELECT, [
                'label' => __('Suppliers'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2 mt-2'],
                'attr' => ['class' => 'form-select supplier'],
                'choices' => $suppliers->toArray(),
                'rules' => ['required'],
            ])
            ->add('file', FIELD::FILE, [
                'label' => required_label('Import File'),
                'wrapper' => ['class' => 'form-group mb-2'],
                'attr' => ['class' => 'form-control', 'accept' => '.xlsx'],
                'rules' => ['required'],
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
                'label' => '<span class="fa fa-save"></span> '.__('Import'),
                'wrapper' => ['class' => 'form-group mt-2 mb-2'],
                'attr' => ['class' => 'btn btn-success btn-save'],
            ]);
    }
}
