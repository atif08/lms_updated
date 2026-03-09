<?php

namespace App\Http\Controllers\Settings;

use App\Forms\ChangePasswordForm;
use App\Forms\UserForm;
use App\Http\Controllers\BaseController;
use App\Services\FlashMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;

class ProfileController extends BaseController
{
    protected $settings_page = true;

    public function getIndex(Request $request, FormBuilder $form_builder)
    {
        $basic_info_form = $this->_getBasicInfoForm($form_builder);
        $password_form = $this->_getChangePasswordForm($form_builder);

        return $this->renderView('profile.index', compact('basic_info_form', 'password_form'));
    }

    public function postIndex(Request $request, FormBuilder $form_builder)
    {
        $form = $this->_getBasicInfoForm($form_builder);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $this->user->name = $request->get('name');
        $this->user->save();

        $this->user
            ->syncFromMediaLibraryRequest($request->media)
            ->toMediaCollection('avatar');

        FlashMessage::success(__('Successfully updated profile'));

        return redirect('profile');
    }

    public function postPassword(Request $request, FormBuilder $form_builder)
    {
        $form = $this->_getChangePasswordForm($form_builder);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $password = $request->get('password');
        $this->user->password = Hash::make($password);
        $this->user->save();

        FlashMessage::success(__('Successfully changed password'));

        return redirect('profile');
    }

    private function _getBasicInfoForm(FormBuilder $form_builder): Form
    {
        return $this->createForm($form_builder, UserForm::class, [
            'method' => 'POST',
            'url' => route('profile.post.index'),
            'role' => 'form',
            'class' => 'row',
        ]);
    }

    private function _getChangePasswordForm(FormBuilder $form_builder): Form
    {
        return $this->createForm($form_builder, ChangePasswordForm::class, [
            'method' => 'POST',
            'url' => route('profile.post.password'),
            'role' => 'form',
            'class' => 'row',
        ]);
    }
}
