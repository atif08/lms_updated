<?php

namespace App\Admin\Forms\Settings;

use App\Admin\Forms\BaseForm;
use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Field;
use Spatie\Permission\Models\Permission;

class RolesForm extends BaseForm
{
    public function buildForm(): void
    {
        $role = $this->getData('role');
        $permissions = Permission::all();

        $this->add('name', FIELD::TEXT, [
            'label' => __('Name'),
            'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
            'attr' => ['class' => 'form-control'],
            'rules' => $role ? ['required', 'max:255', Rule::unique('roles')->ignore($role->id)] : ['required', 'max:255', 'unique:roles'],
            'value' => $role?->name,
        ]);

        foreach ($permissions as $permission) {
            $this->add('permissions['.$permission->id.']', Field::CHECKBOX, [
                'label' => __(ucfirst($permission->name)),
                'label_attr' => ['class' => 'form-check-label'],
                'wrapper' => ['class' => 'form-group form-check form-switch form-switch-lg m-2 ms-3', 'dir' => 'ltr'],
                'attr' => ['class' => 'form-check-input'],
                'checked' => $role ? $role->hasPermissionTo($permission->name) : false,
                'value' => $permission->name,
            ]);
        }

        $this->add('submit', Field::BUTTON_SUBMIT, [
            'label' => '<span class="fa fa-save"></span> '.__($role ? 'Save' : 'Save'),
            'wrapper' => ['class' => 'form-group mt-2 mb-2'],
            'attr' => ['class' => 'btn btn-success btn-supplier-save'],
        ])->addSeparator('dotted');
    }
}
