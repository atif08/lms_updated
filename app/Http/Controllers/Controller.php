<?php

namespace App\Http\Controllers;

use App\Helpers\CarbonHelper;
use App\Models\Batch;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var User */
    protected $user; // logged-in user

    /** @var User */
    protected $selected_user; // user selected by admin

    /** @var User */
    protected $current_account; // SELLER selected

    /** @var Collection */
    protected $accounts; // all children SELLERS

    /** @var array */
    protected $account_ids; // all children SELLERS user_id

    /** @var Request */
    protected $request;

    /** @var bool */
    protected $settings_page = false;

    /** @var array */
    protected $filters = [];

    /** @var CarbonHelper */
    protected $date_object;

    /** @var array */
    protected $date_range = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //        $this->middleware(['auth']);

        $this->middleware(function (Request $request, $next) {
            $this->request = $request;
            $this->setUserProperties($request);

            return $next($request);
        });
    }

    protected function hasControllerAccess(Request $request): bool
    {
        return true;
    }

    protected function setFilters(Request $request)
    {
        $this->filters = $request->all();
    }

    protected function setUserProperties($request)
    {
        $this->user = Auth::user();

        if (! $this->user) {
            return;
        }

        abort_if(! $this->hasControllerAccess($request), 403);

        if ($request->has('uid')) {
            $this->selected_user = User::query()->findOrFail($request->get('uid'));
        }

        if (! $this->settings_page) {
            $this->setCurrentAccount($request);
        }

        $this->setFilters($request);
        $this->date_object = $this->getCarbonObject();
        $this->date_range = $this->date_object->getRangeYmd();
    }

    protected function setCurrentAccount(Request $request)
    {
        $this->accounts = $this->user->getActiveMarketplaces()->keyBy('id');
        $this->account_ids = $this->accounts->pluck('id')->toArray();

        if ($request->has('account_id')) {
            $account_id = $request->get('account_id');
            abort_if(! in_array($account_id, $this->account_ids), 403);

            $this->current_account = User::query()->find($account_id);
            $this->user->setUserAttribute('current_account', $this->current_account->id);

            return;
        }

        $account_id = $this->user->getUserAttribute('current_account');

        if ($account_id && in_array($account_id, $this->account_ids)) {
            $this->current_account = User::query()->find($account_id);

            return;
        }

        if ($this->account_ids) {
            $this->current_account = $this->accounts->first();
            $this->user->setUserAttribute('current_account', $this->current_account->id);
        }
    }

    protected function renderView($view, $data = [])
    {
        $data = array_merge([
            'user' => $this->user,
            'selected_user' => $this->selected_user,
            'current_account' => $this->current_account,
            'batches' => Batch::all(),
            'users' => User::query()->student()->get(),
            'settings_page' => $this->settings_page,
            'date_object' => $this->date_object,
        ], $data);

        return view($view, $data);
    }

    protected function resJson($data, $status_code = 200, $success = true): JsonResponse
    {
        if (is_array($data)) {
            $data = $status_code == 403 ? ['errors' => $data] : $data;

            return response()->json($data, $status_code);
        }

        $message = $data;

        return response()->json(compact('success', 'message'), $status_code);
    }

    protected function getCarbonObject($default_days = 30): CarbonHelper
    {
        return new CarbonHelper($this->user, $this->request, $default_days);
    }
}
