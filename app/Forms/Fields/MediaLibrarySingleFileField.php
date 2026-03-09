<?php

namespace App\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class MediaLibrarySingleFileField extends FormField
{
    protected function getTemplate()
    {
        return 'fields.media_library';
    }

    public function render(array $options = [], $showLabel = true, $showField = true, $showError = true)
    {

        return parent::render($options, $showLabel, $showField, $showError);
    }
}
