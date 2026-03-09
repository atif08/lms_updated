<?php

namespace App\Admin\Users\Controllers;

use App\Admin\DataTables\Settings\UsersDataTable;
use App\Admin\Forms\ChangePasswordForm;
use App\Admin\Forms\UserForm;
use App\Http\Controllers\BaseController;
use App\Models\Batch;
use App\Notifications\RegistgerUserNotificaiton;
use App\Services\FlashMessage;
use Domain\Courses\Models\Course;
use Domain\Users\Enums\PermissionsEnum;
use Domain\Users\Enums\UserTypeEnum;
use Domain\Users\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;

class UsersController extends BaseController
{
    protected $settings_page = true;



    public function getIndex(Request $request): JsonResponse|View
    {

        if (! auth()->user()->can(PermissionsEnum::USERS()->value)) {
            abort(403, 'Unauthorized action.');
        }
        $data_table = new UsersDataTable($this->user, $this->current_account, $request);

        $user_assignments = $request->user()->assignments()->get();
        $extend_requests = $request->user()->extend_requests()->get();

        if ($request->ajax()) {
            return $data_table->getData();
        }
//
//        $data_table->setFilterData([
//            'batches' => Batch::all(),
//            'courses' => Course::query()->active()->get(),
//        ]);

        return $this->renderView('admin.users.index', compact('data_table', 'user_assignments', 'extend_requests'));
    }

    public function getUserProfile(User $user): JsonResponse|View
    {
        $user_assignments = $user->assignments()->get();
        $extend_requests = $user->extend_requests()->get();

        return $this->renderView('admin.users.partial_profile', compact('user_assignments', 'extend_requests', 'user'));
    }

    public function handleRedirect(Request $request)
    {
        if (Auth::check()) {
            return redirect('/admin/courses');
        }

        return redirect('/admin/login');
    }

    public function getLogin(Request $request)
    {
        $request->validate(['uid' => 'required']);

        Auth::login($this->selected_user);

        if($this->selected_user->user_type == UserTypeEnum::STANDARD_STUDENT() || $this->selected_user->user_type == UserTypeEnum::ACCELERATED_STUDENT())
        {

            return redirect('/courses/enrolled');
        }

        return redirect('/admin/courses');

    }

    public function getDetails(FormBuilder $form_builder): View
    {
        $basic_info_form = $this->_getBasicInfoForm($form_builder);
        $password_form = ! $this->selected_user ? null : $this->_getChangePasswordForm($form_builder);
        $user = new User;

        return $this->renderView('admin.users.details', compact('user', 'basic_info_form', 'password_form'));
    }

    public function postDetails(Request $request, FormBuilder $form_builder): RedirectResponse
    {
        $form = $this->_getBasicInfoForm($form_builder);
        $form->redirectIfNotValid();

        if (! $request->has('uid')) {

            $random_password = Str::random(10);

            $this->selected_user = User::query()->create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'mobile' => $request->get('mobile'),
                'batch_id' => $request->get('batch_id'),
                'password' => Hash::make($random_password),
                'is_active' => $request->get('is_active') ?: false,
                'user_type' => $request->get('user_type'),
                'parent_id' => $this->user->id,
            ]);
            if ($request->has('media')) {

                $this->selected_user->syncFromMediaLibraryRequest($request->media)->toMediaCollection('default');
            }

            $this->selected_user->notify(new RegistgerUserNotificaiton($random_password, $this->selected_user));

            FlashMessage::success('User created successfully.');

        } else {

            $this->selected_user->name = $request->get('name');
            $this->selected_user->email = $request->get('email');
            $this->selected_user->batch_id = $request->get('batch_id') ?? null;
            $this->selected_user->user_type = $request->get('user_type');
            $this->selected_user->is_active = $request->get('is_active') ?: false;
            $this->selected_user->save();

            $this->selected_user->syncFromMediaLibraryRequest($request->get('media'))->toMediaCollection('default');

            FlashMessage::success('User updated successfully');
        }
        // enrolled user for selected course

        $this->selected_user->enrolled_courses()->sync(Course::find($request->get('course_id') ?? []));

        $this->selected_user->syncRoles($request->role);

        return redirect('admin/users/details?uid='.$this->selected_user->id);
    }

    public function postPassword(Request $request, FormBuilder $form_builder)
    {
        $request->validate(['uid' => ['required']]);

        $form = $this->_getChangePasswordForm($form_builder);
        $form->redirectIfNotValid();

        $password = $request->get('password');
        $this->selected_user->password = Hash::make($password);
        $this->selected_user->save();

        FlashMessage::success(__('Successfully changed password'));

        return redirect('admin/users/details?uid='.$this->selected_user->id);
    }

    public function postStatus(Request $request)
    {
        $request->validate(['uid' => ['required']]);

        $this->selected_user->is_active = ! $this->selected_user->is_active;
        $this->selected_user->save();

        return $this->resJson('Successfully changed status');
    }

    private function _getBasicInfoForm(FormBuilder $form_builder): Form
    {
        return $form_builder->create(UserForm::class, [
            'method' => 'POST',
            'url' => route('users.post.details').($this->selected_user ? '?uid='.$this->selected_user->id : ''),
            'role' => 'form',
            'class' => 'row',
        ], [
            'user' => $this->selected_user,
            'class' => get_class($this),
        ]);
    }

    private function _getChangePasswordForm(FormBuilder $form_builder): Form
    {
        return $form_builder->create(ChangePasswordForm::class, [
            'method' => 'POST',
            'url' => route('users.post.password').('?uid='.$this->selected_user->id),
            'role' => 'form',
            'class' => 'row',
        ], [
            'class' => get_class($this),
        ]);
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json(['message' => 'item deleted successfully', 'item' => $user]);
    }
}
