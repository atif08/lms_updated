<?php

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

use Illuminate\Support\Facades\Artisan;

Artisan::command('app:validate_upc {upc}', function () {
    $upc = $this->argument('upc');
    if (is_valid_upc($upc)) {
        console_log($upc.' is VALID');
    } else {
        console_log($upc.' is INVALID');
    }
});
