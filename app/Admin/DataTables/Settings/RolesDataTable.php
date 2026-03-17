<?php

namespace App\Admin\DataTables\Settings;

use App\Admin\DataTables\BaseDataTable;
use Spatie\Permission\Models\Role;

class RolesDataTable extends BaseDataTable
{
    protected $order_by = [[2, 'asc']];

    public function getBaseQuery()
    {
        $this->columns = [
            'id',
            'name',
            'created_at',
        ];

        return Role::select($this->columns);
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
            'name' => [
                'title' => __('Name'),
                'data' => 'name',
                'name' => 'name',
                'column_type' => 'text',
                'raw' => true,
                'content' => function ($row) {
                    return "<a href='".route('roles.edit', $row->id)."'>$row->name</a>";

                },
            ],
            'created_at' => [
                'title' => __('Created At'),
                'data' => 'created_at',
                'name' => 'created_at',
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
                        '<a class="btn btn-primary btn-sm" href="'.route('roles.edit', $row->id).'"><i class="fas fa-edit"></i> | '.__('Edit').'</a>',
                        '<a class="btn btn-danger delete-item btn-sm" data-url="'.route('roles.destroy', $row->id).'"><i class="fas fa-trash-alt"></i> </a>',

                    ];

                    return implode(' ', $actions);
                },
            ],
        ];
    }
}
