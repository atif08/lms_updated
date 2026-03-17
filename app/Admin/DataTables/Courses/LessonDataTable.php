<?php

namespace App\Admin\DataTables\Courses;

use App\Admin\DataTables\BaseDataTable;
use Domain\Courses\Models\Lesson;

class LessonDataTable extends BaseDataTable
{
    protected $order_by = [[0, 'desc']];

    public function getBaseQuery()
    {

        return Lesson::query()->with(['topic.course', 'topic'])->select('*');
    }

    public function getColumnDef(): array
    {
        return [
            'id' => [
                'title' => __('UID'),
                'data' => 'id',
                'name' => 'id',
                'column_type' => 'integer',
            ],

            'name' => [
                'title' => __('Name'),
                'data' => 'name',
                'name' => 'name',
                'column_type' => 'text',
            ],
            'created_at' => [
                'title' => __('Created At'),
                'data' => 'created_at',
                'name' => 'created_at',
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
                        //                        '<a class="dropdown-item" href="' . route('courses.topics.lessons.edit', ['course' => $row->topic->course_id, 'topic' => $row->topic_id, 'lesson' => $row->id]) . '"><i class="fas fa-edit"></i>&nbsp;Edit</a>',
                        //                        '<a class="dropdown-item" href="' . route('courses.topics.lessons.destroy', ['course' => $row->topic->course_id, 'topic' => $row->topic_id, 'lesson' => $row->id]) . '"><i class="fas fa-trash-alt"></i>&nbsp;Delete</a>',
                    ];

                    return
                        '<div class="btn-group">'.
                        '<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">'.__('Actions').' <i class="mdi mdi-chevron-down"></i></button>'.
                        '<div class="dropdown-menu">'.implode('', $actions).'</div>'.
                        '</div>';
                },
            ],
        ];
    }
}
