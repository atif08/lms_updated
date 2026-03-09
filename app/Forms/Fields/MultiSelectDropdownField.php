<?php

namespace App\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class MultiSelectDropdownField extends FormField
{
    protected function getTemplate()
    {
        return 'fields.select_multi_dropdown';
    }

    public function render(array $options = [], $showLabel = true, $showField = true, $showError = true)
    {

        return parent::render($options, $showLabel, $showField, $showError);
    }
}
