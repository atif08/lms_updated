<?php

namespace App\Admin\Settings\Controllers;

use App\Admin\DataTables\Settings\PermissionsDataTable;
use App\Admin\Forms\Settings\PermissionsForm;
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

class PermissionsController extends BaseController
{
    public function index(Request $request): View|JsonResponse
    {
        if (! auth()->user()->can(PermissionsEnum::ROLES()->value)) {
            abort(403, 'Unauthorized action.');
        }
        $data_table = new PermissionsDataTable(user: $this->user, request: $request);

        if ($request->ajax()) {
            return $data_table->getData();
        }

        return $this->renderView('admin.permissions.index', compact('data_table'));
    }

    public function create(FormBuilder $formBuilder): View
    {
        $form = $this->_getPermissionForm($formBuilder);

        return $this->renderView('admin.permissions.details', compact('form'));
    }

    public function store(FormBuilder $formBuilder): RedirectResponse
    {
        $form = $formBuilder->create(PermissionsForm::class);

        $form->redirectIfNotValid();

        /** @var Permission $permission */
        $permission = Permission::query()->create($form->getFieldValues());

        FlashMessage::success('Permission created successfully !');

        return to_route('permissions.index');
    }

    public function edit(Permission $permission, FormBuilder $formBuilder): View
    {
        $form = $this->_getPermissionForm($formBuilder, $permission);

        return $this->renderView('admin.permissions.details', compact('form'));
    }

    public function update(Permission $permission, FormBuilder $formBuilder): RedirectResponse
    {
        $form = $this->_getPermissionForm($formBuilder, $permission);

        $form->redirectIfNotValid();

        $permission->update($form->getFieldValues());

        FlashMessage::success('Permission updated successfully !');

        return to_route('permissions.index');
    }

    private function _getPermissionForm(FormBuilder $form_builder, $permission = null): Form
    {
        return $form_builder->create(PermissionsForm::class, [
            'method' => $permission ? 'PUT' : 'POST',
            'url' => $permission ? route('permissions.update', $permission) : route('permissions.store'),
            'role' => 'form',
            'class' => 'row',
        ], [
            'permission' => $permission,
            'class' => get_class($this),
        ]);
    }

    public function destroy(Permission $permission): JsonResponse
    {
        $permission->delete();

        return response()->json(['message' => 'Permission deleted successfully', 'item' => $permission]);
    }
}
