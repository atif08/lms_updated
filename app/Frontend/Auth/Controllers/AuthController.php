<?php

namespace App\Frontend\Auth\Controllers;

use App\Http\Controllers\BaseController;
use Domain\Attendance\Actions\CheckInAction;
use Domain\Users\Enums\UserTypeEnum;
use Domain\Users\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Support\Enums\DomainListEnum;

class AuthController extends BaseController
{
    public function getLogin(Request $request): View
    {
        if ($request->getHost() == DomainListEnum::BRITISH()) {
            return view('frontend/auth/buc_login');
        } else {
            return view('frontend/auth/asti_login');
        }
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
        ]);

        $credentials = $request->only('email', 'password');

        // First, try to retrieve the user by email
        $user = User::where('email', $credentials['email'])->first();

        // Check if the user exists and is active
        if ($user && $user->is_active) {
            if (Auth::attempt($credentials)) {
                (new CheckInAction)->handle($user);

                switch ($user->user_type) {
                    case UserTypeEnum::ADMIN()->value:
                        return redirect()->intended('/admin/users')->withSuccess('Signed in');
                    case UserTypeEnum::STANDARD_STUDENT()->value:
                    case UserTypeEnum::ACCELERATED_STUDENT()->value:
                        return redirect()->intended('/students/dashboard')->withSuccess('Signed in');

                    case UserTypeEnum::FACULTY_MEMBER()->value:
                        return redirect()->intended('/admin/courses')->withSuccess('Signed in');

                    default:
                        Auth::logout();

                        return redirect('login')->withErrors('Unauthorized access for this user type.');
                }

            } else {
                return redirect('login')->withErrors('These credentials do not match our records.');
            }
        } else {
            return redirect('login')->withErrors($user ? 'Your account is inactive.' : 'These credentials do not match our records.');
        }
    }

    public function getRegister(Request $request): View
    {

        return view('frontend/auth/register');

    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|max:30',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]
        );

        User::query()->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'user_type' => UserTypeEnum::STANDARD_STUDENT(),
            'is_active' => true,
            'password' => Hash::make($request->get('password')),

        ]);

        return redirect('login')->withSuccess('You have signed-in');
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('/');
        }

        return redirect('login')->withSuccess('You are not allowed to access');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
