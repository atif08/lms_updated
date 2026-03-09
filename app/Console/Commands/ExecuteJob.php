<?php

namespace App\Console\Commands;

use App\Enums\UserTypeEnum;
use App\Jobs\BaseJob;
use Domain\Users\Models\User;
use Illuminate\Console\Command;

class ExecuteJob extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:job {job_class} {--user=5} {--job_type=products} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command helps executing jobs manually';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle() {
        $user = $this->option('user');
        if (!$user || $user == 'all') {
            $users = $this->getCallableUsers();
            foreach ($users as $user) {
                $this->executeJob($user);
            }
        } else {
            $user_ids = explode(',', $this->option('user'));
            foreach ($user_ids as $user_id) {
                /** @var User $user */
                $user = User::query()->find($user_id);
                $this->executeJob($user);
            }
        }
    }

    protected function executeJob($user) {
        $jobClass = $this->getDirectory() . $this->argument('job_class');

        /** @var BaseJob $job */
        $job = new $jobClass($user);
        if ($this->option('force')) {
            $job->setJobDone();
        }

        $job->handle();

        console_log('Process (for USER ' . $user->id . ') finished');
    }

    protected function getDirectory(): string {
        $directory = 'App\\Jobs\\';

        return match ($this->option('job_type')) {
            'products' => $directory . 'AmazonProducts\\',
            'reports' => $directory . 'AmazonReports\\',
            'shipments' => $directory . 'AmazonShipments\\',
            'keepa' => $directory . 'KeepaAPIs\\',
            default => $directory,
        };

    }

    protected function getCallableUsers() {
        return match ($this->option('job_type')) {
            'products', 'reports', 'shipments' => User::getActiveCallables(),
            'keepa' => User::getActiveCallables([UserTypeEnum::ADMIN()]),
            default => User::all(),
        };

    }
}
