<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class GeneralController extends BaseController {

    public function getMenus(Request $request) {
        $this->settings_page = true;
        $menus = config('menu') ?? [];
        return view('general.menus', compact('menus'));
    }

    public function getMarketplaces(Request $request) {
        abort_if($this->user->isSeller(), 403);
        $accounts = $this->user->getActiveMarketplaces()->keyBy('id');
        return $this->renderView('general.marketplaces', compact('accounts'));
    }

    public function postMarketplaces(Request $request) {
        abort_if($this->user->isSeller(), 403);
        $request->validate(['account_id' => ['required']]);
        $this->user->setUserAttribute('current_account', $this->current_account->id);
        return response()->json(['success' => true]);
    }
}
