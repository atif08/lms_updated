<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use Domain\Attendance\Actions\CheckInAction;
use Domain\Users\Enums\UserTypeEnum;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends BaseController
{
    use AuthenticatesUsers;

    protected $redirectTo = '/students/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(): Response
    {
        return Inertia::render('Auth/Login');
    }

    protected function authenticated(Request $request, $user)
    {
        (new CheckInAction)->handle($user);

        return match ($user->user_type) {
            UserTypeEnum::ADMIN()->value => Inertia::location(url('/admin/users')),
            UserTypeEnum::FACULTY_MEMBER()->value => Inertia::location(url('/admin/courses')),
            UserTypeEnum::TEACHER()->value => Inertia::location(url('/admin/courses')),
            UserTypeEnum::STANDARD_STUDENT()->value,
            UserTypeEnum::ACCELERATED_STUDENT()->value => redirect()->intended('/students/dashboard'),
            default => tap(null, fn () => $this->guard()->logout()) ?: redirect('/login')->withErrors('Unauthorized access for this user type.'),
        };
    }
}
