<?php

namespace App\Admin\DataTables;

use Domain\Assignment\Models\Assignment;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class AssignmentsDataTable extends BaseDataTable
{
    protected $order_by = [[5, 'desc']];

    public function getSelectStatement(): array
    {
        return [
            DB::raw('\'\' as DT_RowIndex'),
            'a.id',
            'a.due_date',
            DB::raw('c.name AS course_name'),
            //            DB::raw('t.name AS topic_name'),
            //            DB::raw('u.name AS user_name'),
            //            'u.name',
            'm.file_name',
            'm.disk',
            DB::raw('m.id AS media_id'),
            'a.description',
            'a.created_at',
            'a.updated_at',
        ];
    }

    public function getBaseQuery(): Builder
    {

        $query = DB::table('assignments as a')
            ->select($this->getSelectStatement())
//            ->join('users as u', 'a.user_id', '=', 'u.id')
//            ->leftJoin('batches as b', 'u.batch_id', '=', 'b.id')
//            ->join('topics as t', 'a.topic_id', '=', 't.id')
            ->join('courses as c', 'a.course_id', '=', 'c.id')
            ->join('assignment_users as au', 'au.assignment_id', '=', 'a.id')
            ->join('users as u', 'au.user_id', '=', 'u.id')
            ->join('batches as b', 'u.batch_id', '=', 'b.id')
            ->leftJoin('media as m', function ($join) {
                $join->on('m.model_id', '=', 'a.id')
                    ->where('m.model_type', '=', Assignment::class);
            })->groupBy('a.id');

        //        if ($this->user->user_type == UserTypeEnum::FACULTY_MEMBER()) {
        //            $query->join('course_teacher as ct', 'c.id', '=', 'ct.course_id')
        //                ->join('users as ut', 'ct.user_id', '=', 'ut.id')
        //                ->where('ut.id', $this->user->id);
        //        }

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
            'course_name' => [
                'title' => __('Course'),
                'data' => 'course_name',
                'name' => 'c.name',
                'column_type' => 'text',
            ],
            //            'user_name'      => [
            //                'title'       => __('Submitted By'),
            //                'data'        => 'user_name',
            //                'name'        => 'u.name',
            //                'column_type' => 'text',
            //            ],
            'description' => [
                'title' => __('Student Notes'),
                'data' => 'description',
                'name' => 'a.description',
                'column_type' => 'text',
            ],
            'file' => [
                'title' => __('Assignment'),
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
            'due_date' => [
                'title' => __('Due Date'),
                'data' => 'due_date',
                'name' => 'a.due_date',
                'searchable' => false,
                'column_type' => 'date',
            ],
            'created_at' => [
                'title' => __('Created At'),
                'data' => 'created_at',
                'name' => 'a.created_at',
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
                        '<a class="btn btn-primary btn-sm" href="'.route('assignments.edit', $row->id).'" ><i class="fas fa-edit"></i> </a>',
                    ];

                    return implode(' ', $actions);
                },
            ],

        ];
    }
}
