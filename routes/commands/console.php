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

use App\Jobs\ImportRequestsJob;
use App\Models\ImportRequest;
use Illuminate\Support\Facades\Artisan;

Artisan::command('app:validate_upc {upc}', function () {
    $upc = $this->argument('upc');
    if (is_valid_upc($upc)) {
        console_log($upc . ' is VALID');
    } else {
        console_log($upc . ' is INVALID');
    }
});

Artisan::command('app:import {import_id}', function () {
    /** @var ImportRequest $import */
    $import = ImportRequest::query()->findOrFail($this->argument('import_id'));

    (new ImportRequestsJob($import->user))
        ->processImport($import);
});
