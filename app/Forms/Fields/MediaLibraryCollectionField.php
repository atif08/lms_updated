<?php

namespace App\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class MediaLibraryCollectionField extends FormField
{
    protected function getTemplate()
    {
        return 'fields.media_collection_library';
    }

    public function render(array $options = [], $showLabel = true, $showField = true, $showError = true)
    {

        return parent::render($options, $showLabel, $showField, $showError);
    }
}
