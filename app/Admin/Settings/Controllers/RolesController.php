<?php

namespace App\Admin\Settings\Controllers;

use App\Admin\DataTables\Settings\RolesDataTable;
use App\Admin\Forms\Settings\RolesForm;
use App\Http\Controllers\BaseController;
use App\Services\FlashMessage;
use Domain\Users\Enums\PermissionsEnum;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends BaseController
{
    protected function hasControllerAccess(Request $request): bool
    {
        return $this->user->isAdmin();
    }

    public function index(Request $request): View|JsonResponse
    {
        if (! auth()->user()->can(PermissionsEnum::ROLES()->value)) {
            abort(403, 'Unauthorized action.');
        }
        $data_table = new RolesDataTable(user: $this->user, request: $request);

        if ($request->ajax()) {
            return $data_table->getData();
        }

        return $this->renderView('admin.roles.index', compact('data_table'));
    }

    public function create(FormBuilder $formBuilder): View
    {
        $form = $this->_getRoleForm($formBuilder);

        return $this->renderView('admin.roles.details', compact('form'));
    }

    public function store(FormBuilder $formBuilder): RedirectResponse
    {
        $form = $formBuilder->create(RolesForm::class);

        $form->redirectIfNotValid();

        /** @var Role $role */
        $role = Role::query()->create($form->getFieldValues());

        $this->_syncPermissions($form, $role);

        FlashMessage::success('Role created successfully !');

        return to_route('roles.index');
    }

    public function edit(Role $role, FormBuilder $formBuilder): View
    {
        $form = $this->_getRoleForm($formBuilder, $role);

        return $this->renderView('admin.roles.details', compact('form'));
    }

    public function update(Role $role, FormBuilder $formBuilder): RedirectResponse
    {
        $form = $this->_getRoleForm($formBuilder, $role);

        $form->redirectIfNotValid();

        $role->update($form->getFieldValues());

        $this->_syncPermissions($form, $role);

        FlashMessage::success('Role updated successfully !');

        return to_route('roles.index');
    }

    private function _getRoleForm(FormBuilder $form_builder, $role = null): Form
    {
        return $form_builder->create(RolesForm::class, [
            'method' => $role ? 'PUT' : 'POST',
            'url' => $role ? route('roles.update', $role) : route('roles.store'),
            'role' => 'form',
            'class' => 'row',
        ], [
            'role' => $role,
            'class' => get_class($this),
        ]);
    }

    public function _syncPermissions(Form $form, Role $role): void
    {
        $permissions = collect($form->getFieldValues()['permissions'] ?? []);
        $filtered = $permissions->filter(function ($value) {
            return ! is_null($value);
        });
        $role->syncPermissions($filtered->all());
    }

    public function destroy(Role $role): JsonResponse
    {
        $role->delete();

        return response()->json(['message' => 'Role deleted successfully', 'item' => $role]);
    }

    public function assignPermissions(Role $role): View
    {
        $permissions = Permission::all();

        return $this->renderView('admin.roles.assign-permissions', compact('role', 'permissions'));
    }

    public function updatePermissions(Request $request, Role $role): RedirectResponse
    {
        $permissions = $request->input('permissions', []);
        $role->syncPermissions($permissions);

        FlashMessage::success('Permissions updated successfully !');

        return to_route('roles.index');
    }
}
