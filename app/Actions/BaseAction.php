<?php

namespace App\Actions;

use Domain\Users\Models\User;

class BaseAction {

    /** @var User */
    protected $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

}
