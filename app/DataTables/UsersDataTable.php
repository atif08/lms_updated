<?php

namespace App\DataTables;

use App\Enums\UserTypeEnum;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class UsersDataTable extends BaseDataTable {

    public function getBaseQuery(): ?Builder {
        $this->columns = [
            'u.id',
            'u.name',
            'u.email',
            'u.is_active',
            'u.user_type',
            'u.last_activity_at',
            'u.created_at',
        ];

        return DB::table('users AS u')
            ->where('u.parent_id', $this->user->id)
            ->select($this->columns);
    }

    public function getColumnDef(): array {
        return [
            'id'         => [
                'title'       => __('UID'),
                'data'        => 'id',
                'name'        => 'u.id',
                'column_type' => 'text',
                'raw'         => true,
            ],
            'name'       => [
                'title'       => __('Name'),
                'data'        => 'name',
                'name'        => 'u.name',
                'column_type' => 'text'
            ],
            'email'      => [
                'title'       => __('Email'),
                'data'        => 'email',
                'name'        => 'u.email',
                'column_type' => 'text'
            ],
            'user_type'  => [
                'title'       => __('User Type'),
                'data'        => 'user_type',
                'name'        => 'u.user_type',
                'column_type' => 'text',
                'searchable'  => false,
            ],
            'is_active'  => [
                'title'       => __('Active'),
                'data'        => 'is_active',
                'name'        => 'u.is_active',
                'column_type' => 'boolean',
                'raw'         => true,
                'searchable'  => false,
                'orderable'   => false,
                'content'     => function ($row) {
                    $checked = $row->is_active ? 'checked' : '';
                    return '<input class="btn-status" data-url="' . route('users.post.status') . '?uid=' . $row->id . '" ' .
                        'type="checkbox" id="switch-' . $row->id . '" switch="primary" ' . $checked . ' /> ' .
                        '<label for="switch-' . $row->id . '" data-on-label="True" data-off-label="False"></label>';
                }
            ],
            'created_at' => [
                'title'       => __('Created At'),
                'data'        => 'created_at',
                'name'        => 'created_at',
                'column_type' => 'date',
                'searchable'  => false,
            ],
            'action'     => [
                'title'      => __('Action'),
                'data'       => 'action',
                'name'       => 'action',
                'searchable' => false,
                'orderable'  => false,
                'raw'        => true,
                'content'    => function ($row) {
                    $actions = [
                        '<a class="btn btn-primary btn-sm" href="' . route('users.get.details') . '?uid=' . $row->id . '"><i class="fas fa-edit"></i> | ' . __('Edit') . '</a>',
                        '<a class="btn btn-secondary btn-sm" href="' . route('users.get.login') . '?uid=' . $row->id . '"><i class="fas fa-unlock"></i> | ' . __('Login') . '</a>',
                    ];

                    return implode(' ', $actions);
                },
            ],
        ];
    }
}
