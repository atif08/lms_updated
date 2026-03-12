<?php

namespace App\Admin\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class VimeoUploaderField extends FormField
{
    protected function getTemplate()
    {
        return 'fields.vimeo_uploader';
    }
}
