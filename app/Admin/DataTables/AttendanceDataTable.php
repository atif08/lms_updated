<?php

namespace App\Admin\DataTables;

use Carbon\Carbon;
use Domain\Attendance\Enums\AttendanceStatusEnum;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class AttendanceDataTable extends BaseDataTable
{
    protected $order_by = [[5, 'desc']];

    public function getBaseQuery(): Builder
    {

        return DB::table('attendances as a')->select($this->getSelectStatement())
            ->join('users as u', 'a.user_id', '=', 'u.id')
            ->join('enrollments as e', 'e.user_id', '=', 'u.id')
            ->join('courses as c', 'e.course_id', '=', 'c.id')
            ->join('batches as b', 'u.batch_id', '=', 'b.id')
            ->whereNull('u.deleted_at');
    }

    public function getSelectStatement(): array
    {
        return [
            DB::raw('\'\' as DT_RowIndex'),
            'u.name',
            'u.user_type',
            'c.name as c_name',
            'b.name as b_name',
            'date',
            'a.status',
            'check_in',
            'check_out',
            'hours',
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
            'batch' => [
                'title' => __('Batch'),
                'data' => 'b_name',
                'name' => 'b_name',
                'column_type' => 'text',
            ],
            'course' => [
                'title' => __('Course'),
                'data' => 'c_name',
                'name' => 'c_name',
                'column_type' => 'text',
            ],
            'name' => [
                'title' => __('Student'),
                'data' => 'name',
                'name' => 'u.name',
                'column_type' => 'text',
            ],
            'user_type' => [
                'title' => __('Student Type'),
                'data' => 'user_type',
                'name' => 'u.user_type',
                'column_type' => 'text',
            ],
            'date' => [
                'title' => __('Date'),
                'data' => 'date',
                'name' => 'date',
                'column_type' => 'date',
                'raw' => true,
                'content' => function ($row) {
                    return Carbon::parse($row->date)->format(config('constants.date_format'));
                },
            ],
            'status' => [
                'title' => __('Status'),
                'data' => 'status',
                'name' => 'a.status',
                'column_type' => 'text',
                'raw' => true,
                'searchable' => false,
                'orderable' => false,
                'content' => function ($row) {
                    $class = match ($row->status) {
                        AttendanceStatusEnum::ABSENT()->value => 'bg-soft-danger',
                        AttendanceStatusEnum::PRESENT()->value => 'bg-soft-success',
                        AttendanceStatusEnum::LATE()->value => 'bg-soft-info',
                        default => 'bg-soft-warning',
                    };

                    return '<span class="badge badge-pill '.$class.' font-size-12">'.$row->status.'</span>';
                },
            ],
            'check_in' => [
                'title' => __('Active Session'),
                'data' => 'check_in',
                'name' => 'check_in',
                'column_type' => 'text',
                'raw' => true,
                'content' => function ($row) {
                    return Carbon::parse($row->check_in)->format('H:i');
                },
            ],
            'check_out' => [
                'title' => __('Ended Session'),
                'data' => 'check_out',
                'name' => 'check_out',
                'column_type' => 'text',
                'raw' => true,
                'content' => function ($row) {
                    return Carbon::parse($row->check_out)->format('H:i');
                },
            ],
            'hours' => [
                'title' => __('Logged Hours'),
                'data' => 'hours',
                'name' => 'hours',
                'column_type' => 'text',
            ],
        ];
    }
}
