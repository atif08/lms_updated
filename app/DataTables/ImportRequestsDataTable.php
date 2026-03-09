<?php

namespace App\DataTables;

use App\Enums\JobStatusEnum;
use App\Enums\ReportTypeEnum;
use Illuminate\Support\Facades\DB;

class ImportRequestsDataTable extends BaseDataTable {

    public function getBaseQuery() {
        $this->columns = [
            'im.id',
            'im.report_name',
            'im.report_type',
            'im.status',
            'im.total_rows',
            'im.error',
            'im.created_at',
        ];

        return DB::table('import_requests AS im')
            ->where('im.user_id', $this->user->id)
            ->whereNotIn('im.report_type', [ReportTypeEnum::SUPPLIER_SHEET()])
            ->select($this->columns);
    }

    public function getColumnDef(): array {
        return [
            'report_name' => [
                'title'       => __('File Name'),
                'data'        => 'report_name',
                'name'        => 'im.report_name',
                'column_type' => 'text'
            ],
            'report_type' => [
                'title'       => __('File Type'),
                'data'        => 'report_type',
                'name'        => 'im.report_type',
                'column_type' => 'select',
                'options'     => ReportTypeEnum::toArray()
            ],
            'total_rows'  => [
                'title'       => __('Total Rows'),
                'data'        => 'total_rows',
                'name'        => 'im.total_rows',
                'column_type' => 'integer',
                'raw'         => true
            ],
            'exception'   => [
                'title'       => __('Error'),
                'data'        => 'error',
                'name'        => 'im.error',
                'column_type' => 'text'
            ],
            'status'      => [
                'title'       => __('Import Status'),
                'data'        => 'status',
                'name'        => 'im.status',
                'column_type' => 'select',
                'options'     => JobStatusEnum::toArray(),
                'raw'         => true,
                'content'     => function ($row) {
                    if ($row->status == JobStatusEnum::VERIFIED()) {
                        return '<button type="button" class="btn btn-sm btn-warning waves-effect waves-light btn-import-mappings" ' .
                            'data-bs-toggle="modal" data-bs-target="#importModal" ' .
                            'data-import-id="' . $row->id . '" data-report-type="' . $row->report_type . '">' .
                            __('Map Columns') . ' <i class="fa fa-exclamation-triangle"></i></button>';
                    }

                    $class = match ($row->status) {
                        JobStatusEnum::FAILED()->value  => 'bg-soft-danger',
                        JobStatusEnum::DONE()->value    => 'bg-soft-success',
                        JobStatusEnum::QUEUED()->value  => 'bg-soft-info',
                        JobStatusEnum::WORKING()->value => 'bg-soft-info',
                        default                         => 'bg-soft-warning',
                    };

                    return '<span class="badge badge-pill ' . $class . ' font-size-12">' . $row->status . '</span>';
                }
            ],
            'created_at'  => [
                'title'       => __('Created At'),
                'data'        => 'created_at',
                'name'        => 'im.created_at',
                'column_type' => 'date'
            ],
            'action'      => [
                'title'      => __('Action'),
                'data'       => 'action',
                'name'       => 'action',
                'raw'        => true,
                'searchable' => false,
                'orderable'  => false,
                'content'    => function ($row) {
                    $actions = [
                        '<a class="btn btn-primary btn-sm" href="' . route('imports.get.download') . '?import_id=' . $row->id . '"><i class="fa fa-download"></i> | ' . __('Download') . '</a>'
                    ];

                    return implode(' ', $actions);
                }
            ],
        ];
    }
}
