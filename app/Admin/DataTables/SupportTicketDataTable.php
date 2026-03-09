<?php

namespace App\Admin\DataTables;

use App\DataTables\BaseDataTable;
use App\Models\SupportTicket;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class SupportTicketDataTable extends BaseDataTable
{
    protected $order_by = [[5, 'desc']];

    public function getSelectStatement(): array
    {
        return [
            DB::raw('\'\' as DT_RowIndex'),
            't.id',
            'm.file_name',
            'u.name',
            'm.disk',
            DB::raw('m.id AS media_id'),
            't.description',
            't.topic',
            't.status',
            't.created_at',
            't.updated_at',
        ];
    }

    public function getBaseQuery(): Builder
    {

        $query = DB::table('support_tickets as t')
            ->select($this->getSelectStatement())
            ->join('users as u', 'u.id', '=', 't.created_by')
            ->leftJoin('media as m', function ($join) {
                $join->on('m.model_id', '=', 't.id')
                    ->where('m.model_type', '=', SupportTicket::class);
            })->where('t.deleted_at', null)
            ->groupBy('t.id');

        return $query;
    }

    public function getColumnDef(): array
    {
        return [
            'DT_RowIndex' => [
                'title' => __('No'),
                'data' => 'DT_RowIndex',
                'name' => 'DT_RowIndex',
                'column_type' => 'integer',
                'orderable' => false,
                'searchable' => false,
            ],
            'topic' => [
                'title' => __('Topic'),
                'data' => 'topic',
                'name' => 't.topic',
                'column_type' => 'text',
            ],
            'created_by' => [
                'title' => __('Created By'),
                'data' => 'name',
                'name' => 'u.name',
                'column_type' => 'text',
            ],
            'file' => [
                'title' => __('File'),
                'data' => 'file_name',
                'name' => 'file_name',
                'column_type' => 'text',
                'raw' => true,
                'content' => function ($row) {
                    if (! empty($row->file_name)) {
                        $url = asset('storage/media/'.$row->media_id.'/'.$row->file_name);
                        $actions = [
                            '<a target="_blank" href="'.$url.'">View</a>',
                        ];

                        return implode(' ', $actions);
                    }

                    return 'N/A';
                },
            ],
            'status' => [
                'title' => __('Status'),
                'data' => 'status',
                'name' => 't.status',
                'column_type' => 'text',
            ],
            'created_at' => [
                'title' => __('Created At'),
                'data' => 'created_at',
                'name' => 't.created_at',
                'searchable' => false,
                'column_type' => 'date',
            ],
            'action' => [
                'title' => __('Action'),
                'data' => 'action',
                'name' => 'action',
                'searchable' => false,
                'orderable' => false,
                'raw' => 'true',
                'content' => function ($row) {
                    $actions = [
                        $row->status != 'CLOSED' ? '<a class="btn btn-primary btn-sm" href="'.route('support-tickets.edit', $row->id).'" ><i class="fas fa-edit"></i> </a>' : '',
                        '<a class="btn btn-danger btn-sm delete-item" data-url="'.route('support-tickets.destroy', $row->id).'"><i class="fas fa-trash-alt"></i> '.__('').'</a>'];

                    return implode(' ', $actions);
                },
            ],

        ];
    }
}
