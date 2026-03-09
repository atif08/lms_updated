<?php

namespace App\Observers;

use App\Enums\ReportTypeEnum;
use App\Models\ImportRequest;
use App\Models\SupplierSheets\SupplierSheet;

class ImportRequestObserver {

    /**
     * Handle the ImportRequest "created" event.
     *
     * @param ImportRequest $import_request
     * @return void
     */
    public function created(ImportRequest $import_request) {
        if ($import_request->report_type == ReportTypeEnum::SUPPLIER_SHEET()->value) {
            SupplierSheet::query()->create([
                'user_id'           => $import_request->user_id,
                'import_request_id' => $import_request->id,
                'supplier_id'       => $import_request->importable_id,
                'name'              => $import_request->report_name,
                'status'            => $import_request->status,
            ]);
        }
    }

    /**
     * Handle the ImportRequest "updated" event.
     *
     * @param ImportRequest $import_request
     * @return void
     */
    public function updated(ImportRequest $import_request) {
        if ($import_request->report_type == ReportTypeEnum::SUPPLIER_SHEET()->value) {
            $supplier_sheet = $import_request->supplier_sheet;
            $supplier_sheet->status = $import_request->status;
            $supplier_sheet->total_count = max(0, $import_request->total_rows - 1);
            $supplier_sheet->save();
        }
    }

    /**
     * Handle the ImportRequest "deleted" event.
     *
     * @param ImportRequest $import_request
     * @return void
     */
    public function deleted(ImportRequest $import_request) {
        if ($import_request->file_path && storage()->exists($import_request->file_path)) {
            storage()->delete($import_request->file_path);
        }
    }

    /**
     * Handle the ImportRequest "restored" event.
     *
     * @param ImportRequest $import_request
     * @return void
     */
    public function restored(ImportRequest $import_request) {
        //
    }

    /**
     * Handle the ImportRequest "force deleted" event.
     *
     * @param ImportRequest $import_request
     * @return void
     */
    public function forceDeleted(ImportRequest $import_request) {
        //
    }
}
