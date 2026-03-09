<?php

namespace App\DataTables\Settings;

use App\DataTables\BaseDataTable;
use App\Enums\UserTypeEnum;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class ConnectionsDataTable extends BaseDataTable {

    public function getBaseQuery(): ?Builder {
        $this->columns = [
            'u.id',
            'u.seller_id',
            'm.marketplace_id',
            'm.code',
            'u.is_active',
            'u.created_at',
        ];

        return DB::table('users AS u')
            ->join('marketplaces AS m', 'm.id', 'u.marketplace_id')
            ->join('sp_tokens AS st', 'st.user_id', 'u.id')
            ->where('u.parent_id', $this->user->id)
            ->where('u.user_type', UserTypeEnum::SELLER())
            ->select($this->columns);
    }

    public function getColumnDef(): array {
        return [
            'seller_id'      => [
                'title'       => __('Seller ID'),
                'data'        => 'seller_id',
                'name'        => 'u.seller_id',
                'width'       => '60%',
                'column_type' => 'text',
                'raw'         => true,
                'content'     => function ($row) {
                    $mp_code = strtolower($row->code === 'UK' ? 'gb' : $row->code);
                    return $row->seller_id . '<br/>' .
                        '<span class="font-size-13 me-2 fi fi-' . $mp_code . '"></span> ' . $row->marketplace_id;
                }
            ],
            'marketplace_id' => [
                'title'       => __('Marketplace ID'),
                'data'        => 'marketplace_id',
                'name'        => 'm.marketplace_id',
                'column_type' => 'text',
                'raw'         => true,
                'visible'     => false,
            ],
            'is_active'      => [
                'title'       => __('Active'),
                'data'        => 'is_active',
                'name'        => 'u.is_active',
                'width'       => '20%',
                'column_type' => 'boolean',
                'raw'         => true,
                'orderable'   => false,
                'content'     => function ($row) {
                    $checked = $row->is_active ? 'checked' : '';
                    return '<input class="btn-status" data-url="' . route('connections.post.status') . '?account_id=' . $row->id . '" ' .
                        'type="checkbox" id="switch-' . $row->id . '" switch="primary" ' . $checked . ' /> ' .
                        '<label for="switch-' . $row->id . '" data-on-label="True" data-off-label="False"></label>';
                }
            ],
            'created_at'     => [
                'title'       => __('Onboarded On'),
                'data'        => 'created_at',
                'name'        => 'u.created_at',
                'width'       => '20%',
                'column_type' => 'date'
            ]
        ];
    }
}
