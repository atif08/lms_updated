<?php

namespace App\Admin\DataTables;

use Domain\Categories\Models\Category;

class CategoryDataTable extends BaseDataTable
{
    protected $order_by = [[3, 'desc']];

    public function getBaseQuery()
    {

        return Category::query()->select('*')->with('courses');
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
            'name' => [
                'title' => __('Name'),
                'data' => 'name',
                'name' => 'name',
                'column_type' => 'text',
                'raw' => true,
                'content' => function ($row) {
                    return "<a href='".route('categories.edit', $row->id)."'>$row->name</a>";

                },
            ],
            'course' => [
                'title' => __('courses'),
                'data' => 'updated_at',
                'name' => 'updated_at',
                'column_type' => 'text',
                'raw' => true,
                'content' => function ($row) {
                    $courseList = '';
                    foreach ($row->courses as $course) {
                        $courseList .= "<a href='".route('courses.edit', $course->id)."'>$course->name</a>, ";

                    }

                    return $courseList;
                },
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
                    //                    $actions = [
                    //                        '<a class="dropdown-item" href="' . route('categories.edit',$row->id) . '"><i class="fas fa-edit"></i>&nbsp;Edit</a>',
                    //                        '<a class="dropdown-item delete-item" href="#" data-url="' . route('categories.destroy', $row->id) . '"><i class="fas fa-trash-alt"></i>&nbsp;Delete</a>',
                    //                    ];
                    //
                    //                    return
                    //                        '<div class="btn-group">' .
                    //                        '<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">' . __('Actions') . ' <i class="mdi mdi-chevron-down"></i></button>' .
                    //                        '<div class="dropdown-menu">' . implode('', $actions) . '</div>' .
                    //                        '</div>';
                    $actions = [
                        '<a class="btn btn-primary btn-sm" href="'.route('categories.edit', $row->id).'"><i class="fas fa-edit"></i> | '.__('Edit').'</a>',
                        '<a class="btn btn-secondary btn-sm delete-item" data-url="'.route('categories.destroy', $row->id).'"><i class="fas fa-trash-alt"></i> | '.__('Delete').'</a>',
                    ];

                    return implode(' ', $actions);
                },
            ],
        ];
    }
}
