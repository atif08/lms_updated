<?php

namespace App\Http\Middleware;

use Domain\Users\Enums\UserTypeEnum;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = $request->user();

        return [
            ...parent::share($request),

            'auth' => [
                'user' => $user ? [
                    'id' => $user->id,
                    'name' => $user->name,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'mobile' => $user->mobile,
                    'country_code' => $user->country_code,
                    'qualification_name' => $user->qualification_name,
                    'institution' => $user->institution,
                    'graduation_year' => $user->graduation_year,
                    'major' => $user->major,
                    'national_id' => $user->national_id,
                    'gender' => $user->gender,
                    'user_type' => $user->user_type,
                    'avatar' => get_image($user->media),
                    'is_student' => in_array($user->user_type, [
                        UserTypeEnum::STANDARD_STUDENT(),
                        UserTypeEnum::ACCELERATED_STUDENT(),
                    ]),
                    'is_admin_or_faculty' => in_array($user->user_type, [
                        UserTypeEnum::ADMIN(),
                        UserTypeEnum::FACULTY_MEMBER(),
                    ]),
                    'check_in' => $user->today_attendance?->check_in,
                ] : null,
            ],

            'flash' => [
                'success' => fn () => $request->session()->get('type') === 'success'
                    ? $request->session()->get('message')
                    : null,
                'error' => fn () => $request->session()->get('type') === 'danger'
                    ? $request->session()->get('message')
                    : null,
            ],

            'domain' => [
                'is_asti' => str_contains($request->getHost(), 'astiacademy.ac.ae'),
            ],
        ];
    }
}
