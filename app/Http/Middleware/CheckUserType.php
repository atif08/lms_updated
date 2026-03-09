<?php

namespace App\Http\Middleware;

use Closure;
use Domain\Users\Enums\UserTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->user_type == UserTypeEnum::STANDARD_STUDENT() || Auth::user()->user_type == UserTypeEnum::ACCELERATED_STUDENT()) {
            abort(403);
        }

        return $next($request);

    }
}
