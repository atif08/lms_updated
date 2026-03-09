<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Inspire extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inspire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'for testing';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        return 0;
    }

}
