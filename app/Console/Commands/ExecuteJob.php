<?php

namespace App\Console\Commands;

use App\Jobs\BaseJob;
use Domain\Users\Models\User;
use Illuminate\Console\Command;

class ExecuteJob extends Command
{
    protected $signature = 'app:job {job_class} {--user=}';

    protected $description = 'Manually execute a job class';

    public function handle(): void
    {
        $userIds = $this->option('user') ? explode(',', $this->option('user')) : [];

        $users = $userIds
            ? User::query()->whereIn('id', $userIds)->get()
            : User::all();

        foreach ($users as $user) {
            $jobClass = 'App\\Jobs\\'.$this->argument('job_class');

            /** @var BaseJob $job */
            $job = new $jobClass($user);
            $job->handle();

            console_log('Process finished for user '.$user->id);
        }
    }
}
