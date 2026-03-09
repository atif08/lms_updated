<?php

namespace App\Admin\DataTables;

use App\DataTables\BaseDataTable;
use Domain\Assignment\Models\SubmittedAssignment;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubmittedAssignmentsDetailDataTable extends BaseDataTable
{
    protected $order_by = [[10, 'desc']];

    public function getSelectStatement(): array
    {
        return [
            DB::raw('\'\' as DT_RowIndex'),
            'sa.id',
            't.assignment_submit_date',
            'a.due_date',
            DB::raw('c.name AS course_name'),
            DB::raw('t.name AS topic_name'),
            DB::raw('a.name AS assignment_name'),
            DB::raw('u.name AS user_name'),
            DB::raw('b.name AS batch_name'),
            DB::raw('u.batch_id AS user_batch_id'),
            'sa.status',
            'sa.user_id',
            'u.name',
            'm.file_name',
            'm.disk',
            DB::raw('m.id AS media_id'),
            'sa.description',
            'sa.comments',
            'sa.score',
            'sa.created_at',
            'sa.updated_at',
        ];
    }

    public function getBaseQuery(): Builder
    {

        $query = DB::table('submitted_assignments as sa')
            ->select($this->getSelectStatement())
            ->leftJoin('users as u', 'sa.user_id', '=', 'u.id')
            ->leftJoin('assignment_users as au', 'au.user_id', '=', 'u.id')
            ->leftJoin('assignments as a', 'au.assignment_id', '=', 'a.id')
            ->leftJoin('batches as b', 'u.batch_id', '=', 'b.id')
            ->leftJoin('topics as t', function ($join) {
                $join->on('sa.submissionable_id', '=', 't.id')
                    ->where('sa.submissionable_type', '=', 'Domain\\Courses\\Models\\Topic');
            })
            ->leftJoin('courses as c', function ($join) {
                $join->on('c.id', '=', 't.course_id')
                    ->whereNotNull('t.id'); // Join courses only if topic exists
            })
            ->leftJoin('assignments as a2', function ($join) {
                // Alias for second 'assignments' table, ensuring no conflict
                $join->on('sa.submissionable_id', '=', 'a2.id')
                    ->where('sa.submissionable_type', '=', 'Domain\\Assignment\\Models\\Assignment');
            })
            ->leftJoin('media as m', function ($join) {
                $join->on('m.model_id', '=', 'sa.id')
                    ->where('m.model_type', '=', SubmittedAssignment::class);
            })
            ->where(function ($query) {
                $query->where('t.id', $this->request->topic_id) // Ensure topic-specific records
                    ->where('u.id', $this->request->user_id); // Or assignment-specific records
            })
            ->whereNull('u.deleted_at')
            ->groupBy('sa.id')->orderByDesc('sa.created_at');

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
            'batch_name' => [
                'title' => __('Batch'),
                'data' => 'batch_name',
                'name' => 'b.name',
                'column_type' => 'text',
            ],
            'user_name' => [
                'title' => __('Submitted By'),
                'data' => 'user_name',
                'name' => 'u.name',
                'column_type' => 'text',
            ],
            'course_name' => [
                'title' => __('Course'),
                'data' => 'course_name',
                'name' => 'c.name',
                'column_type' => 'text',
            ],
            'topic_name' => [
                'title' => __('Assignment Topic'),
                'data' => 'topic_name',
                'name' => 't.name',
                'column_type' => 'text',
                'content' => function ($row) {
                    return $row->topic_name ?? $row->assignment_name;
                },
            ],
            'description' => [
                'title' => __('Student Notes'),
                'data' => 'description',
                'name' => 'sa.description',
                'column_type' => 'text',
                'raw' => true,
                'content' => function ($row) {
                    return Str::limit($row->description, 150) ?? 'N/A';
                },
            ],
            'comments' => [
                'title' => __('Faculty Feedback/Notes'),
                'data' => 'comments',
                'name' => 'sa.comments',
                'column_type' => 'text',
                'content' => function ($row) {
                    return Str::limit($row->comments, 150) ?? 'N/A';
                },
            ],
            'score' => [
                'title' => __('Score'),
                'data' => 'score',
                'name' => 'sa.score',
                'column_type' => 'text',
            ],
            'status' => [
                'title' => __('Status'),
                'data' => 'status',
                'name' => 'sa.status',
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
            'assignment_submit_date' => [
                'title' => __('Due Date'),
                'data' => 'assignment_submit_date',
                'name' => 't.assignment_submit_date',
                'searchable' => false,
                'column_type' => 'date',
                'content' => function ($row) {
                    return $row->assignment_submit_date ?? $row->due_date;
                },
            ],
            'created_at' => [
                'title' => __('Submitted At'),
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
                'raw' => true,
                'content' => function ($row) {
                    $actions = [
                        '<a class="btn btn-primary btn-sm edit-assignment-btn" data-bs-toggle="modal" data-bs-target="#editAssignmentModal" data-url="'.route('submitted-assignments.edit', $row->id).'"><i class="fas fa-edit"></i> </a>',
                    ];

                    return implode(' ', $actions);
                },
            ],

        ];
    }
}
