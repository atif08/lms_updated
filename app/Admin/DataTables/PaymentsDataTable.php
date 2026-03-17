<?php

namespace App\Admin\DataTables;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class PaymentsDataTable extends BaseDataTable
{
    protected $order_by = [[6, 'desc']];

    public function getSelectStatement(): array
    {
        return [
            DB::raw('\'\' as DT_RowIndex'),
            'p.id',
            'u.name as student_name',
            'c.name as course_name',
            'p.amount',
            'p.installment_no',
            'p.payment_method',
            'p.status',
            'p.created_at',
        ];
    }

    public function getBaseQuery(): Builder
    {
        return DB::table('payments as p')
            ->select($this->getSelectStatement())
            ->join('users as u', 'p.user_id', '=', 'u.id')
            ->join('courses as c', 'p.course_id', '=', 'c.id');
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
            'student_name' => [
                'title' => __('Student'),
                'data' => 'student_name',
                'name' => 'u.name',
                'column_type' => 'text',
            ],
            'course_name' => [
                'title' => __('Course'),
                'data' => 'course_name',
                'name' => 'c.name',
                'column_type' => 'text',
            ],
            'amount' => [
                'title' => __('Amount'),
                'data' => 'amount',
                'name' => 'p.amount',
                'column_type' => 'text',
            ],
            'installment_no' => [
                'title' => __('Installment'),
                'data' => 'installment_no',
                'name' => 'p.installment_no',
                'column_type' => 'text',
                'content' => function ($row) {
                    return $row->installment_no ? 'Installment '.$row->installment_no : 'N/A';
                },
            ],
            'payment_method' => [
                'title' => __('Method'),
                'data' => 'payment_method',
                'name' => 'p.payment_method',
                'column_type' => 'text',
                'content' => function ($row) {
                    return ucfirst(str_replace('_', ' ', $row->payment_method));
                },
            ],
            'status' => [
                'title' => __('Status'),
                'data' => 'status',
                'name' => 'p.status',
                'column_type' => 'text',
                'raw' => true,
                'content' => function ($row) {
                    $class = 'badge bg-soft-info';
                    if ($row->status === 'completed') {
                        $class = 'badge bg-soft-success';
                    }
                    if ($row->status === 'rejected') {
                        $class = 'badge bg-soft-danger';
                    }

                    return '<span class="'.$class.'">'.ucfirst($row->status).'</span>';
                },
            ],
            'created_at' => [
                'title' => __('Date'),
                'data' => 'created_at',
                'name' => 'p.created_at',
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
                    return '<a class="btn btn-primary btn-sm" href="'.route('payments.show', $row->id).'" ><i class="fas fa-eye"></i> View</a>';
                },
            ],
        ];
    }
}
