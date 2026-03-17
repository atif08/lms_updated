<?php

namespace App\Admin\DataTables\Courses;

use App\Admin\DataTables\BaseDataTable;
use Domain\Courses\Models\Lesson;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CoursesProgressReportDetailDataTable extends BaseDataTable
{
    protected $order_by = [[0, 'desc']];

    public function getSelectStatement(): array
    {
        return [
            DB::raw('\'\' as DT_RowIndex'),
            //            DB::raw('b.name AS batch_name'),
            DB::raw('c.name AS course_name'),
            DB::raw('t.name AS topic_name'),
            DB::raw('l.name AS lesson_name'),
            DB::raw('m.name AS file_name'),
            DB::raw('u.name AS user_name'),
            DB::raw('b.name AS batch_name'),
            'p.completed',
            'p.created_at',
        ];
    }

    public function getBaseQuery()
    {

        return DB::table('lessons as l')
            ->select($this->getSelectStatement())
            ->join('topics as t', 'l.topic_id', '=', 't.id')
            ->join('courses as c', 't.course_id', '=', 'c.id')
            ->where('c.id', $this->request->course_id)
            ->leftJoin('media as m', function ($join) {
                $join->on('m.model_id', '=', 'l.id')
                    ->where('m.model_type', '=', Lesson::class); // Adjusting media type check
            })
            ->leftJoin('progress as p', function ($join) {
                $join->on(function ($condition) {
                    $condition->on('p.progressable_id', '=', 'l.id')
                        ->where('p.progressable_type', '=', Lesson::class)
                        ->orOn('p.progressable_id', '=', 'm.id')
                        ->where('p.progressable_type', '=', Media::class); // Checking both Lesson and Media
                })->where('p.user_id', '=', $this->request->user_id);
            })->leftJoin('users as u', 'p.user_id', '=', 'u.id')
            ->leftJoin('batches as b', 'u.batch_id', '=', 'b.id');
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
            //            'batch_name' => [
            //                'title'       => __('Batch'),
            //                'data'        => 'batch_name',
            //                'name'        => 'b.name',
            //                'column_type' => 'text',
            //                'orderable'   => false,
            //
            //            ],
            //            'student_name' => [
            //                'title'       => __('Student'),
            //                'data'        => 'user_name',
            //                'name'        => 'u.name',
            //                'column_type' => 'text',
            //                'orderable'   => false,
            //
            //            ],
            'course_name' => [
                'title' => __('Course Name'),
                'data' => 'course_name',
                'name' => 'c.name',
                'column_type' => 'text',
                'orderable' => false,

            ],
            'topic_name' => [
                'title' => __('Topic'),
                'data' => 'topic_name',
                'name' => 't.name',
                'column_type' => 'text',
            ],
            'lesson_name' => [
                'title' => __('Lesson'),
                'data' => 'lesson_name',
                'name' => 'l.name',
                'column_type' => 'text',
            ],
            'file_name' => [
                'title' => __('File Name'),
                'data' => 'file_name',
                'name' => 'm.name',
                'column_type' => 'text',
            ],
            'created_at' => [
                'title' => __('Date'),
                'data' => 'created_at',
                'name' => 'p.created_at',
                'column_type' => 'date',
                'raw' => true,
                'content' => function ($row) {
                    if ($row->created_at) {
                        return $row->created_at;
                    }

                    return 'N/A';
                },
            ],
            'completed' => [
                'title' => __('Progress Status'),
                'data' => 'completed',
                'name' => 'p.completed',
                'column_type' => 'boolean',
                'raw' => true,
                'content' => function ($row) {
                    if ($row->completed) {
                        return 'Completed';
                    }

                    return 'Not Yet started';
                },
            ],
        ];
    }
}
