<?php

namespace App\Admin\DataTables\Settings;

use App\DataTables\BaseDataTable;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class InstructorGradingDeadlineDataTable extends BaseDataTable
{
    protected $order_by = [[2, 'asc']]; // Order by deadline

    public function getSelectStatement(): array
    {
        return [
            DB::raw('\'\' as DT_RowIndex'),
            'u.id as instructor_id',
            'u.name as instructor_name',
            DB::raw('igd.deadline'),
            DB::raw('igd.id as deadline_id'),
            DB::raw('igd.created_at as assigned_at'),
        ];
    }

    public function getBaseQuery(): Builder
    {
        $query = DB::table('users as u')
            ->select($this->getSelectStatement())
//            ->where('u.user_type', 'instructor')
            ->leftJoin('instructor_grading_deadlines as igd', 'igd.user_id', '=', 'u.id');

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
            'instructor_name' => [
                'title' => __('Instructor'),
                'data' => 'instructor_name',
                'name' => 'u.name',
                'column_type' => 'text',
            ],
            'deadline' => [
                'title' => __('Grading Deadline'),
                'data' => 'deadline',
                'name' => 'igd.deadline',
                'column_type' => 'date',
                'raw' => true,
                'content' => function ($row) {
                    return $row->deadline ? date('Y-m-d', strtotime($row->deadline)) : '<span class="text-muted">Not Assigned</span>';
                },
            ],
            'assigned_at' => [
                'title' => __('Assigned At'),
                'data' => 'assigned_at',
                'name' => 'igd.created_at',
                'column_type' => 'date',
                'searchable' => false,
            ],
            'action' => [
                'title' => __('Action'),
                'data' => 'action',
                'name' => 'action',
                'searchable' => false,
                'orderable' => false,
                'raw' => true,
                'content' => function ($row) {
                    $editUrl = route('admin.instructor-deadlines.edit', $row->instructor_id);

                    return '<a class="btn btn-primary btn-sm" href="'.$editUrl.'"><i class="fas fa-edit"></i> Assign / Update</a>';
                },
            ],
        ];
    }
}
