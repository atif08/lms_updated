<?php

namespace App\Admin\Settings\Controllers;

use App\Admin\DataTables\Settings\ConnectionsDataTable;
use App\Admin\Forms\BatchForm;
use App\Http\Controllers\BaseController;
use App\Models\Connections\Connection;
use Database\Seeders\UserTableSeeder;
use Domain\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;

class ConnectionsController extends BaseController
{
    protected $settings_page = true;

    protected function hasControllerAccess(Request $request): bool
    {
        return $this->user->isAdmin();
    }

    public function getIndex(Request $request): JsonResponse|\Illuminate\Contracts\View\View
    {
        $data_table = new ConnectionsDataTable($this->user, $this->current_account, $request);

        if ($request->ajax()) {
            return $data_table->getData();
        }

        return $this->renderView('connections.index', compact('data_table'));
    }

    public function getDetails(FormBuilder $formBuilder): View
    {
        $form = $this->_getConnectionsForm($formBuilder);

        return $this->renderView('connections.details', compact('form'));
    }

    public function postDetails(Request $request, FormBuilder $form_builder)
    {
        $form = $this->_getConnectionsForm($form_builder);

        $form->redirectIfNotValid();

        /** @var Connection $connection */
        $connection = Connection::query()->updateOrCreate([
            'user_id' => $this->user->id,
        ], $form->getFieldValues());

        (new UserTableSeeder)
            ->registerProfiles($this->user, $connection);

        return $this->resJson('Successfully updated credentials');
    }

    public function postStatus(Request $request)
    {
        $request->validate(['account_id' => ['required']]);

        /** @var User $current_account */
        $current_account = User::query()->findOrFail($request->get('account_id'));
        $current_account->is_active = ! $current_account->is_active;
        $current_account->save();

        return $this->resJson('Successfully changed status');
    }

    private function _getConnectionsForm(FormBuilder $form_builder): Form
    {
        return $form_builder->create(BatchForm::class, [
            'method' => 'POST',
            'url' => route('connections.post.details'),
            'role' => 'form',
            'class' => 'row',
        ], [
            'user' => $this->user,
        ]);
    }
}
