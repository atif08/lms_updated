<?php

namespace App\Console\Commands\Deletions;

use App\Models\Tools\PageVisit;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;

class DeleteFromPageVisit extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:del_page_visits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is going to delete historic page_visits';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 * @throws Exception
	 */
    public function handle() {
		$last_id = 0;

		do {
			console_log('Getting page_visits gt ' . $last_id);
			$page_visits = PageVisit::query()->where('id', '>', $last_id)->take(1000)->cursor();
			$delete_ids = [];

			/** @var PageVisit $page_visit */
			foreach ($page_visits as $page_visit) {
				if (!$page_visit->created_at->lt(Carbon::parse('30 days ago')->startOfDay())) {
					break;
				}

				$delete_ids[] = $page_visit->id;
				$last_id = $page_visit->id;
			}

			if (!empty($delete_ids)) {
				console_log('Deleting ' . count($delete_ids) . ' page_visits');
				PageVisit::query()->whereIn('id', $delete_ids)->delete();
			}

		} while (!empty($delete_ids));

    }

}
