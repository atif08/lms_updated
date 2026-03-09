<?php

namespace App\Admin\DataTables\Courses;

use App\DataTables\BaseDataTable;
use Domain\Courses\Models\Course;
use Domain\Courses\Models\Lesson;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CoursesProgressReportDataTable extends BaseDataTable
{
    protected $order_by = [[0, 'desc']];

    public function getSelectStatement(): array
    {
        return [
            DB::raw('\'\' as DT_RowIndex'),
            DB::raw('c.name AS course_name'),
            DB::raw('c.id AS course_id'),
            DB::raw('u.name AS user_name'),
            DB::raw('u.id AS user_id'),
            DB::raw('b.name AS batch_name'),
        ];
    }

    public function getBaseQuery(): Builder
    {

        $subquery = DB::table('progress as p')
            ->select([
                'p.user_id',
                'p.course_id',
                DB::raw('COUNT(DISTINCT p.id) AS total_progress'), // Count distinct progress entries for each user in the course
                DB::raw('SUM(CASE WHEN p.completed = 1 THEN 1 ELSE 0 END) AS completed_progress'), // Count only completed progress entries
            ])
            ->groupBy('p.user_id', 'p.course_id');

        $query = DB::table('users as u')
            ->select([
                DB::raw('\'\' as DT_RowIndex'),
                DB::raw('c.name AS course_name'),
                DB::raw('c.id AS course_id'),
                DB::raw('u.name AS user_name'),
                DB::raw('b.name AS batch_name'),
                DB::raw('u.id AS user_id'),
                DB::raw('COUNT(DISTINCT t.id) AS total_topics'),  // Count distinct topics for the course
                DB::raw('COUNT(DISTINCT l.id) AS total_lessons'), // Count distinct lessons for each topic

                // Join the subquery to get total progress
                DB::raw('IFNULL(sp.total_progress, 0) AS total_progress'), // Use IFNULL to handle users without progress

                // Handle lesson type case
                DB::raw('SUM(CASE WHEN l.type = "MEDIA" THEN 0 ELSE 1 END) AS total_non_media_lessons'),  // Count non-media lessons as 1

                DB::raw('COUNT(DISTINCT CASE WHEN l.type = "MEDIA" THEN m.id ELSE NULL END) AS total_media_lesson_files'),
                // Sum of non-media and media lessons
                DB::raw('SUM(CASE WHEN l.type = "MEDIA" THEN 0 ELSE 1 END) + COUNT(DISTINCT CASE WHEN l.type = "MEDIA" THEN m.id ELSE NULL END) AS total_lessons_completed'), // Sum of media and non-media lessons
            ])
            ->join('batches as b', 'u.batch_id', '=', 'b.id')
            ->join('enrollments as e', 'e.user_id', '=', 'u.id')
            ->join('courses as c', 'e.course_id', '=', 'c.id')
            ->leftJoin('topics as t', 't.course_id', '=', 'c.id')
            ->leftJoin('lessons as l', 'l.topic_id', '=', 't.id')
            ->leftJoin('media as m', function ($join) {
                $join->on('m.model_id', '=', 'l.id')
                    ->where('m.model_type', '=', Lesson::class);
            })
            ->leftJoin(DB::raw("({$subquery->toSql()}) as sp"), function ($join) {
                $join->on('sp.user_id', '=', 'u.id')
                    ->on('sp.course_id', '=', 'c.id');
            })
            ->whereNull('u.deleted_at')
            ->groupBy('c.id', 'u.id');

        return $query;
    }

    public function getColumnDef(): array
    {
        return [
            'DT_RowIndex' => [
                'title' => __('Sr No'),
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
                'title' => __('Student Name'),
                'data' => 'user_name',
                'name' => 'u.name',
                'column_type' => 'text',
            ],
            'course_name' => [
                'title' => __('Course Name'),
                'data' => 'course_name',
                'name' => 'u.name',
                'column_type' => 'text',
            ],
            'total_topics' => [
                'title' => __('Total Topics'),
                'data' => 'total_topics',
                'name' => 'total_topics',
                'column_type' => 'text',
            ],
            'total_lessons' => [
                'title' => __('Total Files'),
                'data' => 'total_lessons_completed',
                'name' => 'total_lessons_completed',
                'column_type' => 'text',
            ],
            'total_progress' => [
                'title' => __('Completed Files'),
                'data' => 'total_progress',
                'name' => 'total_progress',
                'column_type' => 'text',
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
                        '<a class="btn btn-info btn-sm" href="'.url('admin/courses/progress/details?course_id='.$row->course_id.'&user_id='.$row->user_id).'"><i class="fas fa-file-alt"></i> '.'</a>',
                    ];

                    return implode(' ', $actions);
                },
            ],
        ];
    }
}
