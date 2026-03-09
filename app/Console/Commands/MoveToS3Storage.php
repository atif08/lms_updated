<?php

namespace App\Console\Commands;

use App\Models\ImportRequest;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class MoveToS3Storage extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:move_s3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is going to move files from production to s3';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 * @throws Exception
	 */
    public function handle() {
		$import_requests = ImportRequest::query()->get();

		/** @var ImportRequest $import_request */
		foreach ($import_requests as $import_request) {
			$this->moveImportRequest($import_request);
		}

    }

	protected function moveImportRequest(ImportRequest $import_request) {
		console_log('Moving: ' . $import_request->id . ' | ' . $import_request->file_path);

		$storage_path = storage_path('app/'. $import_request->file_path);

		if (file_exists($storage_path)) {

			$file_path = 'app/imports/' . $import_request->user_id . '/';

			$file_name = pathinfo($import_request->file_path,PATHINFO_FILENAME);
			$file_name .= '-' . $import_request->created_at->timestamp * rand(1, 9);
			$file_name .= '.' . pathinfo($import_request->file_path,PATHINFO_EXTENSION);

			Storage::disk('s3')->put($file_path . $file_name,
				Storage::disk('local')->get($import_request->file_path));

			$import_request->file_path = $file_path . $file_name;
			$import_request->save();

			console_log('Moved to: ' . $import_request->file_path);

		} else {
			console_log('DOES NOT EXIST!');
		}
	}

}
