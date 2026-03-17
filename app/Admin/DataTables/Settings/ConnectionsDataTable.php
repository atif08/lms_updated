<?php

namespace App\Admin\DataTables\Settings;

use App\Admin\DataTables\BaseDataTable;
use Domain\Users\Enums\UserTypeEnum;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class ConnectionsDataTable extends BaseDataTable
{
    protected $order_by = [[0, 'asc']];

    public function getBaseQuery(): ?Builder
    {
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

    public function getColumnDef(): array
    {
        return [
            'id' => [
                'title' => __('UID'),
                'data' => 'id',
                'name' => 'u.id',
                'column_type' => 'integer',
            ],
            'seller_id' => [
                'title' => __('Seller ID'),
                'data' => 'seller_id',
                'name' => 'u.seller_id',
                'column_type' => 'text',
                'raw' => 'true',
                'content' => function ($row) {
                    $mp_code = strtolower($row->code === 'UK' ? 'gb' : $row->code);

                    return $row->seller_id.'<br/>'.
                        '<span class="font-size-13 me-2 fi fi-'.$mp_code.'"></span> '.$row->marketplace_id;
                },
            ],
            'is_active' => [
                'title' => __('Active'),
                'data' => 'is_active',
                'name' => 'u.is_active',
                'column_type' => 'boolean',
                'raw' => 'true',
                'content' => function ($row) {
                    $checked = $row->is_active ? 'checked' : '';

                    return '<input class="btn-status" data-url="'.route('connections.post.status').'?account_id='.$row->id.'" '.
                        'type="checkbox" id="switch-'.$row->id.'" switch="primary" '.$checked.' /> '.
                        '<label for="switch-'.$row->id.'" data-on-label="True" data-off-label="False"></label>';
                },
            ],
            'created_at' => [
                'title' => __('Onboarded On'),
                'data' => 'created_at',
                'name' => 'u.created_at',
                'column_type' => 'date',
            ],
        ];
    }
}
