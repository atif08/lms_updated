<?php

namespace App\Admin\DataTables\Reports;

use App\Admin\DataTables\BaseDataTable;
use App\Models\ExportRequest;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class ExportRequestsDatatable extends BaseDataTable
{
    protected $order_by = [[0, 'desc']];

    public function getBaseQuery(): ?Builder
    {

        $this->columns = [
            'er.id',
            'er.user_id',
            'er.export_type',
            'er.status',
            'er.full_path',
            'er.created_at',
            'er.payload',
            'acc.name AS account_title',
        ];

        return DB::table('export_requests AS er')
            ->leftJoin('users AS acc', 'acc.id', 'er.account_id')
            ->select($this->columns);
    }

    public function getColumnDef(): array
    {
        return [
            'id' => [
                'title' => __('No'),
                'data' => 'id',
                'name' => 'er.id',
            ],
            'account_title' => [
                'title' => __('Export By'),
                'data' => 'account_title',
                'name' => 'account_title',
                'column_type' => 'text',
            ],
            'student' => [
                'title' => __('Student'),
                'data' => 'payload',
                'name' => 'er.payload',
                'column_type' => 'text',
                'raw' => true,
                'content' => function ($row) {
                    if (isset(json_decode($row->payload)?->file_name)) {
                        return json_decode($row->payload)?->file_name;

                    }
                },
            ],
            'export_type' => [
                'title' => __('Export Type'),
                'data' => 'export_type',
                'name' => 'er.export_type',
                'column_type' => 'text',
                'raw' => true,
                'content' => function ($row) {
                    $stringWithSpaces = preg_replace('/(?<!^)(?=[A-Z])/', ' ', $row->export_type);

                    return ucwords(strtolower($stringWithSpaces));
                },
            ],
            'status' => [
                'title' => __('Status'),
                'data' => 'status',
                'name' => 'er.status',
                'column_type' => 'text',
            ],
            'created_at' => [
                'title' => __('Created At'),
                'data' => 'created_at',
                'name' => 'er.created_at',
                'column_type' => 'text',
            ],
            'action' => [
                'title' => __('Action'),
                'data' => 'action',
                'name' => 'action',
                'searchable' => false,
                'orderable' => false,
                'raw' => 'true',
                'content' => function ($row) {
                    $actions = [];
                    if ($row->status == ExportRequest::STATUS_DONE) {
                        $actions[] = "<a class='btn btn-primary btn-sm m-1' href='".
                            url('admin/exports/download').'?export_id='.$row->id."'><i class='fa fa-download'></i> ".__('Download').'</a>';
                    }
                    $actions[] = "<a class='btn btn-secondary btn-sm m-1 btn-delete' href='javascript:;' data-url='".
                        url('admin/exports/delete').'?export_id='.$row->id."'><i class='fa fa-trash'></i> ".__('Delete').'</a>';

                    return implode(' ', $actions);
                },
            ],
        ];
    }
}
