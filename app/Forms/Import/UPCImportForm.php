<?php

namespace App\Forms\Import;

use App\Enums\ReportTypeEnum;
use App\Forms\BaseForm;
use App\Models\ImportRequest;
use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Field;

class UPCImportForm extends BaseForm {

    public function buildComponents() {
        /** @var ImportRequest|null $import_request */
        $import_request = $this->getData('import_request');
        $import_id = $import_request ? $import_request->id : $this->getData('import_id');

        $this->add('report_type', FIELD::HIDDEN, [
            'value' => $this->getData('report_type'),
            'rule'  => Rule::in(ReportTypeEnum::cases())
        ]);

        if ($import_id) {
            $this->add('import_id', FIELD::HIDDEN, [
                'value' => $import_id
            ]);
        } else {
            $this->add('file', FIELD::FILE, [
                'label'   => required_label('Import File'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-3 mt-3'],
                'attr'    => ['class' => 'form-control', 'accept' => '.xlsx,.csv'],
                'rules'   => ['required']
            ]);
        }

    }
}
