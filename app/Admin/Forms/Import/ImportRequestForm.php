<?php

namespace App\Admin\Forms\Import;

use App\Admin\Forms\BaseForm;
use App\Enums\ReportTypeEnum;
use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Field;

class ImportRequestForm extends BaseForm
{
    public function buildForm()
    {
        $report_type = $this->getData('report_type');

        $this
            ->add('report_type', FIELD::HIDDEN, [
                'value' => $report_type,
                'rule' => Rule::in([ReportTypeEnum::UPCS()->value]),
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
