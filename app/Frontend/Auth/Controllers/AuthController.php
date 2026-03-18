<?php

namespace App\Frontend\Auth\Controllers;

use Domain\Attendance\Actions\CheckInAction;
use Domain\Users\Enums\UserTypeEnum;
use Domain\Users\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Support\Enums\DomainListEnum;

class AuthController extends Controller
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

    public function getRegister(Request $request): mixed
    {
        if (Auth::check()) {
            return Inertia::location($request->query('redirect', '/students/dashboard'));
        }

        return Inertia::render('Auth/Register', [
            'redirectTo' => $request->query('redirect', '/students/dashboard'),
        ]);
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'country_code' => 'required|string|max:10',
            'mobile' => 'required|string|max:20',
            'password' => 'required|min:8|confirmed',
        ]);

        $teacher = $request->input('ref')
            ? User::where('referral_code', $request->input('ref'))->first()
            : null;

        $user = User::query()->create([
            'name' => $request->input('first_name').' '.$request->input('last_name'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'country_code' => $request->input('country_code'),
            'mobile' => $request->input('mobile'),
            'user_type' => UserTypeEnum::STANDARD_STUDENT(),
            'is_active' => true,
            'password' => Hash::make($request->input('password')),
            'parent_id' => $teacher?->id,
        ]);

        Auth::login($user);

        return Inertia::location($request->input('redirect_to', '/students/dashboard'));
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
