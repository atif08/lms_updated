<?php

namespace App\Admin\DataTables;

use Carbon\Carbon;
use Domain\Users\Enums\UserTypeEnum;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class ReferralEnrollmentsDataTable extends BaseDataTable
{
    protected $order_by = [[5, 'desc']];

    public function getBaseQuery(): Builder
    {
        $query = DB::table('enrollments as e')
            ->select($this->getSelectStatement())
            ->join('users as u', 'e.user_id', '=', 'u.id')
            ->join('courses as c', 'e.course_id', '=', 'c.id')
            ->leftJoin('users as r', 'e.referred_by_id', '=', 'r.id')
            ->whereNull('u.deleted_at');

        if (in_array($this->user->user_type, [UserTypeEnum::FACULTY_MEMBER()->value, UserTypeEnum::TEACHER()->value])) {
            $query->where('e.referred_by_id', $this->user->id);
        }

        return $query;
    }

    public function getSelectStatement(): array
    {
        return [
            DB::raw('\'\' as DT_RowIndex'),
            'c.name as course_name',
            'u.name as student_name',
            'u.email as student_email',
            DB::raw("COALESCE(r.name, 'Admin') as referrer_name"),
            'e.created_at as enrollment_date',
            DB::raw("COALESCE(e.source, 'organic') as source"),
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
            'course_name' => [
                'title' => __('Course'),
                'data' => 'course_name',
                'name' => 'course_name',
                'column_type' => 'text',
            ],
            'student_name' => [
                'title' => __('Student'),
                'data' => 'student_name',
                'name' => 'student_name',
                'column_type' => 'text',
            ],
            'student_email' => [
                'title' => __('Email'),
                'data' => 'student_email',
                'name' => 'student_email',
                'column_type' => 'text',
            ],
            'referrer_name' => [
                'title' => __('Referred By'),
                'data' => 'referrer_name',
                'name' => 'referrer_name',
                'column_type' => 'text',
                'raw' => true,
                'content' => function ($row) {
                    $class = $row->referrer_name === 'Admin' ? 'bg-soft-info' : 'bg-soft-success';

                    return '<span class="badge badge-pill '.$class.' font-size-12">'.$row->referrer_name.'</span>';
                },
            ],
            'enrollment_date' => [
                'title' => __('Enrollment Date'),
                'data' => 'enrollment_date',
                'name' => 'enrollment_date',
                'column_type' => 'date',
                'raw' => true,
                'content' => function ($row) {
                    return $row->enrollment_date ? Carbon::parse($row->enrollment_date)->format('M d, Y') : '';
                },
            ],
            'source' => [
                'title' => __('Source'),
                'data' => 'source',
                'name' => 'source',
                'column_type' => 'text',
                'raw' => true,
                'content' => function ($row) {
                    return '<span class="badge badge-pill bg-soft-warning font-size-12">'.ucfirst($row->source).'</span>';
                },
            ],
        ];
    }
}
