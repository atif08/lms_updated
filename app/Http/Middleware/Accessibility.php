<?php

namespace App\Http\Middleware;

use App\Models\Tools\PageVisit;
use App\Services\FlashMessage;
use Closure;
use Domain\Users\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Accessibility {
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {
        $start_time = microtime(true);

        /** @var User $user */
        $user = Auth::user();

        if (!$user->is_active) {
            auth()->logout();
            FlashMessage::error(__('Deactivated Account: Your account is deactivated, contact your admin'));
            return redirect('/login');
        }

        /** @var PageVisit $page_visit */
        $page_visit = PageVisit::query()->create([
            'user_id'   => $user->id,
            'method'    => $request->getMethod(),
            'url'       => $request->url(),
            'params'    => $request->all(),
            'ajax'      => $request->ajax(),
            'client_ip' => $request->getClientIp()
        ]);

        $response = $next($request);

        $end_time = microtime(true);
        $time_in_secs = round($end_time - $start_time, 2); // in seconds

        $page_visit->response_time = $time_in_secs;
        $page_visit->save();

        return $response;
    }
}
