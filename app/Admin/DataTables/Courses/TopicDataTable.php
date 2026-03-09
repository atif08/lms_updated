<?php

namespace App\Admin\DataTables\Courses;

use App\DataTables\BaseDataTable;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class TopicDataTable extends BaseDataTable
{
    protected $order_by = [[0, 'desc']];

    public function getBaseQuery(): ?Builder
    {
        $this->columns = [
            'u.id',
            'u.course_id',
            'u.name',
            'u.description',
            'u.is_active',
            'u.created_at',

        ];

        return DB::table('topics AS u')
            ->select($this->columns);
    }

    public function getColumnDef(): array
    {
        return [
            'id' => [
                'title' => __('UID'),
                'data' => 'id',
                'name' => 'u.id',
                'column_type' => 'integer',
            ],
            'name' => [
                'title' => __('Name'),
                'data' => 'name',
                'name' => 'u.name',
                'column_type' => 'text',
            ],
            'created_at' => [
                'title' => __('Created At'),
                'data' => 'created_at',
                'name' => 'created_at',
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
                        //                        '<a class="dropdown-item" href="' .route('courses.topics.edit',['course'=>$row->course_id,'topic'=>$row->id]) . '"><i class="fas fa-edit"></i>&nbsp;Edit</a>',
                        '<a class="dropdown-item" href="'.route('courses.topics.destroy', ['course' => $row->course_id, 'topic' => $row->id]).'"><i class="fas fa-trash-alt"></i>&nbsp;Delete</a>',
                        '<a class="dropdown-item" href="'.route('courses.topics.lessons', ['course' => $row->course_id, 'topic' => $row->id]).'"><i class="fas fa-eye"></i>&nbsp;Show Lessons</a>',
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
