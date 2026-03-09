<?php

namespace App\Console\Commands\Deletions;

use App\Models\AmazonReports\AmazonReport;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;

class DeleteFromAmazonReport extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:del_amazon_reports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is going to delete historic amazon_reports';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 * @throws Exception
	 */
    public function handle() {
		$last_id = 0;

		do {
			console_log('Getting amz_reports gt ' . $last_id);
			$amz_reports = AmazonReport::query()->where('id', '>', $last_id)->take(1000)->cursor();
			$delete_ids = [];

			/** @var AmazonReport $amz_report */
			foreach ($amz_reports as $amz_report) {
				if (!$amz_report->created_at->lt(Carbon::parse('90 days ago')->startOfDay())) {
					break;
				}

				$delete_ids[] = $amz_report->id;
				$last_id = $amz_report->id;
			}

			if (!empty($delete_ids)) {
				console_log('Deleting ' . count($delete_ids) . ' amz_reports');
				AmazonReport::query()->whereIn('id', $delete_ids)->delete();
			}

		} while (!empty($delete_ids));

    }

}
