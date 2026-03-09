<?php

namespace App\Admin\Forms\Settings;

use App\Admin\Forms\BaseForm;
use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Field;

class PermissionsForm extends BaseForm
{
    public function buildForm(): void
    {
        $permission = $this->getData('permission');

        $this->add('name', FIELD::TEXT, [
            'label' => __('Name'),
            'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
            'attr' => ['class' => 'form-control'],
            'rules' => $permission ? ['required', 'max:255', Rule::unique('permissions')->ignore($permission->id)] : ['required', 'max:255', 'unique:permissions'],
            'value' => $permission?->name,
        ]);

        $this->add('submit', Field::BUTTON_SUBMIT, [
            'label' => '<span class="fa fa-save"></span> '.__($permission ? 'Save' : 'Save'),
            'wrapper' => ['class' => 'form-group mt-2 mb-2'],
            'attr' => ['class' => 'btn btn-success btn-supplier-save'],
        ])->addSeparator('dotted');
    }
}
