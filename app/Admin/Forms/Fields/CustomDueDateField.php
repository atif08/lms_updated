<?php

namespace App\Admin\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class CustomDueDateField extends FormField
{
    protected function getTemplate()
    {
        return 'fields.custom_due_date';
    }

    public function render(array $options = [], $showLabel = true, $showField = true, $showError = true)
    {

        return parent::render($options, $showLabel, $showField, $showError);
    }
}
