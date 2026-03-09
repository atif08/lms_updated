<?php

namespace App\Admin\DataTables;

use App\DataTables\BaseDataTable;
use Illuminate\Support\Facades\DB;

class ImportRequestsDataTable extends BaseDataTable
{
    protected $order_by = [[0, 'asc']];

    public function getBaseQuery()
    {
        $this->columns = [
            'im.id',
            'im.report_type',
            'im.status',
            'im.error',
            'im.created_at',
        ];

        return DB::table('import_requests AS im')
            ->leftJoin('users AS u', 'u.id', 'im.account_id')
            ->where('im.user_id', $this->user->id)
            ->select($this->columns);
    }

    public function getColumnDef(): array
    {
        return [
            'report_type' => [
                'title' => __('Report Type'),
                'data' => 'report_type',
                'name' => 'im.report_type',
                'column_type' => 'text',
            ],
            'status' => [
                'title' => __('Status'),
                'data' => 'status',
                'name' => 'im.status',
                'column_type' => 'text',
            ],
            'created_at' => [
                'title' => __('Requested At'),
                'data' => 'created_at',
                'name' => 'im.created_at',
                'column_type' => 'date',
            ],
            'exception' => [
                'title' => __('Error'),
                'data' => 'error',
                'name' => 'im.error',
                'column_type' => 'text',
            ],
            'action' => [
                'title' => __('Action'),
                'data' => 'action',
                'name' => 'action',
                'raw' => true,
                'searchable' => false,
                'orderable' => false,
                'content' => function ($row) {
                    $actions = [
                        '<a class="btn btn-primary btn-sm" href="'.route('imports.get.download').'?import_id='.$row->id.'"><i class="fa fa-download"></i> | '.__('Download').'</a>',
                    ];

                    return implode(' ', $actions);
                },
            ],
        ];
    }
}
