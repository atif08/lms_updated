<?php

namespace App\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class CkEditorField extends FormField
{
    protected function getTemplate()
    {
        return 'fields.ck_editor_field';
    }

    public function render(array $options = [], $showLabel = true, $showField = true, $showError = true)
    {

        return parent::render($options, $showLabel, $showField, $showError);
    }
}
