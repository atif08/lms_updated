<?php

namespace App\Forms\Import;

use App\Enums\ReportTypeEnum;
use App\Forms\BaseForm;
use App\Models\ImportRequest;
use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Field;

class ImportMappingsForm extends BaseForm {

    public function buildComponents() {
        /** @var ImportRequest $import_request */
        $import_request = $this->getData('import_request');
        $import_id = $import_request ? $import_request->id : $this->getData('import_id');
        $report_type = $this->getData('report_type');

        $this
            ->add('import_id', FIELD::HIDDEN, [
                'value' => $import_id
            ])
            ->add('report_type', FIELD::HIDDEN, [
                'value' => $report_type,
                'rule'  => Rule::in(ReportTypeEnum::cases())
            ]);

        foreach ($import_request->getDefaultHeaders() as $index => $field) {
            $required = $field['required'] ?? false;

            $choices = array_combine($import_request->headers, $import_request->headers);
            if (!$required) {
                $choices = ['' => 'N/A'] + $choices;
            }

            $rules = ['sometimes', Rule::in(array_keys($choices))];
            if ($required) {
                $rules[0] = 'required';
            }

            $this
                ->add($index, FIELD::SELECT, [
                    'label'    => $required ? required_label($field['label']) : __($field['label']),
                    'wrapper'  => ['class' => 'form-group col-lg-4 mb-3 mt-3'],
                    'attr'     => ['class' => 'form-select ' . $index],
                    'choices'  => $choices,
                    'selected' => in_array($field['sheet_title'], $choices) ? $field['sheet_title'] : '',
                    'rules'    => $rules,
                ]);
        }
    }
}
