<?php

namespace App\Admin\DataTables\Settings;

use App\Admin\DataTables\BaseDataTable;
use Domain\Users\Enums\UserTypeEnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersDataTable extends BaseDataTable
{
    protected $order_by = [[5, 'desc']];

    public function getBaseQuery()
    {
        $inner = DB::table('users as u')
            ->leftJoin('batches as b', 'u.batch_id', '=', 'b.id')
            ->leftJoin('enrollments as e', 'e.user_id', '=', 'u.id')
            ->leftJoin('courses as c', 'e.course_id', '=', 'c.id')
            ->leftJoin('course_user as cu', 'cu.course_id', '=', 'c.id')
            ->leftJoin('users as f', 'cu.user_id', '=', 'f.id')
            ->whereIn('u.user_type', array_keys(UserTypeEnum::getUsersDropdown()))
            ->whereNull('u.deleted_at')
            ->select($this->getSelectStatement())
            ->groupBy('u.id');

        if (auth()?->user()?->id) {
            $inner->where('u.id', '!=', auth()?->user()?->id);
        }

        return DB::table(DB::raw("({$inner->toSql()}) as users_sub"))
            ->mergeBindings($inner)
            ->select('*');
    }

    public function getSelectStatement(): array
    {
        return [
            DB::raw('\'\' as DT_RowIndex'),
            'u.id',
            DB::raw('u.name as user_name'),
            DB::raw('b.name as batch_name'),
            DB::raw('c.name as course_name'),
            DB::raw('c.id as course_id'),
            DB::raw('f.name as course_faculty'),
            'u.email',
            'u.mobile',
            'u.is_active',
            'u.user_type',
            'u.created_at',
        ];
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
            'user_name' => [
                'title' => __('Name'),
                'data' => 'user_name',
                'name' => 'user_name',
                'column_type' => 'text',
                'raw' => true,
                'content' => function ($row) {
                    return "<a href='".url('admin/users/details').'?uid='.$row->id."'>$row->user_name</a>";
                },
            ],
            'email' => [
                'title' => __('Email'),
                'data' => 'email',
                'name' => 'email',
                'column_type' => 'text',
            ],
            'mobile' => [
                'title' => __('Phone'),
                'data' => 'mobile',
                'name' => 'mobile',
                'column_type' => 'text',
            ],
            'user_type' => [
                'title' => __('User Type'),
                'data' => 'user_type',
                'name' => 'user_type',
                'column_type' => 'text',
                'raw' => true,
                'content' => function ($row) {
                    return Str::title(str_replace('_', ' ', Str::lower($row->user_type)));

                },
            ],
            'batch_name' => [
                'title' => __('Batch'),
                'data' => 'batch_name',
                'name' => 'batch_name',
                'column_type' => 'text',
            ],
            'course_name' => [
                'title' => __('Course'),
                'data' => 'course_name',
                'name' => 'course_name',
                'column_type' => 'text',
                //                'raw'         => true,
                //                'content'     => function ($row) {
                //                    return "<a href='" . route('courses.edit',$row->course_id)."'>$row->course_name</a>";
                //                }
            ],
            //            'faculty'       => [
            //                'title'       => __('Faculty Name'),
            //                'data'        => 'course_faculty',
            //                'name'        => 'f.name',
            //                'column_type' => 'text'
            //            ],
            'is_active' => [
                'title' => __('Active'),
                'data' => 'is_active',
                'name' => 'is_active',
                'column_type' => 'boolean',
                'raw' => 'true',
                'content' => function ($row) {
                    $checked = $row->is_active ? 'checked' : '';

                    return '<input class="btn-status" data-url="'.route('users.post.status').'?uid='.$row->id.'" '.
                        'type="checkbox" id="switch-'.$row->id.'" switch="primary" '.$checked.' /> '.
                        '<label for="switch-'.$row->id.'" data-on-label="True" data-off-label="False"></label>';
                },
            ],
            'created_at' => [
                'title' => __('Created At'),
                'data' => 'created_at',
                'name' => 'created_at',
                'column_type' => 'date',
                'searchable' => false,
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
                        '<a class="btn btn-secondary btn-sm" href="'.route('users.get.login').'?uid='.$row->id.'"><i class="fas fa-unlock"></i> '.__('').'</a>',
                        '<a class="btn btn-primary btn-sm" href="'.route('users.get.details').'?uid='.$row->id.'"><i class="fas fa-edit"></i> '.__('').'</a>',
                        //                        ($row->user_type == UserTypeEnum::ACCELERATED_STUDENT() || $row->user_type == UserTypeEnum::STANDARD_STUDENT()) ? '<a class="btn btn-warning btn-sm" href="' . route('users.get.full-report', $row->id) . '"><i class="fas fa-download"></i></a>' : '',
                        (auth()->user()->user_type == UserTypeEnum::ADMIN()) ? '<a class="btn btn-danger btn-sm delete-item" data-url="'.route('users.post.delete', $row->id).'"><i class="fas fa-trash-alt"></i> '.__('').'</a>' : '',
                        ($row->user_type == UserTypeEnum::FACULTY_MEMBER()) ? '<a class="btn btn-success btn-sm" href="'.route('users.get.assignment-report', $row->id).'"><i class="fas fa-align-left"></i> '.__('').'</a>' :
                            '<a class="btn btn-success btn-sm  get-user-profile" data-bs-toggle="modal" data-bs-target="#userProfileModal" data-url="'.route('users.get.partial-profile', $row->id).'"><i class="fas fa-user-alt"></i> '.__('').'</a>',

                    ];

                    return implode(' ', $actions);
                },
            ],
        ];
    }
}
