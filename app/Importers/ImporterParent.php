<?php

namespace App\Importers;

use App\Enums\JobStatusEnum;
use App\Models\ImportRequest;
use Domain\Users\Models\User;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ImporterParent {

    /** @var User */
    protected $user;
    /** @var User */
    protected $current_account;
    /** @var ImportRequest */
    protected $import_report;
    /** @var string */
    protected $file_path;
    /** @var array */
    protected $report_data = [];
    /** @var array */
    protected $required_columns = [];
    /** @var string */
    protected $scope;
    /** @var Spreadsheet */
    protected $excel;

    /**
     * @throws FileNotFoundException
     */
    public function __construct(ImportRequest $import_report) {
        $this->import_report = $import_report;
        $this->user = $import_report->user;
        $this->current_account = $import_report->account;
        $this->file_path = $this->import_report->getStoragePath();
        $this->required_columns = $this->import_report->getRequiredColumns();
    }

    /**
     * @throws Exception
     */
    public function process() {
        $excel_reader = IOFactory::createReaderForFile($this->file_path);
        $this->excel = $excel_reader->load($this->file_path);
        $this->readFromExcel();
        $this->readCompleted();
        $this->setDone();
    }

    /**
     * @throws Exception
     */
    protected function readFromExcel() {
        $sheet = $this->excel->getActiveSheet();
        $this->readFromSheet($sheet);
    }

    /**
     * @throws Exception
     */
    protected function readFromSheet($sheet) {
        console_log('Total Rows: ', $this->import_report->total_rows);

        $data_set = $sheet->toArray();
        if (empty($data_set)) {
            throw new Exception('The report seems to be empty');
        }

        $headers = $this->import_report->headers;

        if ($this->import_report->mappings) {
            $payload = $this->import_report->mappings;
            $headers = get_trans_headers($headers, $payload);
        }

        if ($missing_col = array_diff($this->required_columns, $headers)) {
            throw new Exception('Required column(s) [' . implode(', ', $missing_col) . '] are missing.');
        }

        array_shift($data_set);
        $this->report_data = $data_set;

        console_log('Starting per row processing..');

        foreach ($this->report_data as $index => $row) {
            if (!$this->handleRow(array_combine($headers, $row))) {
                break;
            }
        }
    }

    protected function handleRow($row): bool {
        return true;
    }

    protected function readCompleted() {
        if (config('filesystems.storage') == 's3') {
            unlink($this->file_path);
        }
    }

    protected function setDone() {
        $this->import_report->status = JobStatusEnum::DONE();
        $this->import_report->save();
    }
}
