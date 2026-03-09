<?php

namespace App\Admin\DataTables\Courses;

use App\DataTables\BaseDataTable;
use Domain\Courses\Models\Course;
use Domain\Users\Enums\UserTypeEnum;
use Faker\Provider\Base;

class CoursesDataTable extends BaseDataTable
{
    protected $order_by = [[4, 'desc']];

    public function getBaseQuery()
    {
        $this->columns = [
            'courses.id',
            'name',
            'description',
            'course_status',
            'is_active',
            'created_at',

        ];

        $query = Course::query()
            ->select($this->columns);

        if (auth()->user()->isTeacher()) {
            $query->whereHas('teachers', function ($query) {
                $query->where('user_id', auth()->id());
            });
        }

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
            'name' => [
                'title' => __('Name'),
                'data' => 'name',
                'name' => 'name',
                'column_type' => 'text',
                'raw' => true,
                'content' => function ($row) {
                    return "<a href='".route('courses.edit', $row->id)."'>$row->name</a>";
                },
            ],
            'course_status' => [
                'title' => __('Status'),
                'data' => 'course_status',
                'name' => 'course_status',
                'column_type' => 'text',
            ],
            'is_active' => [
                'title' => __('Active'),
                'data' => 'is_active',
                'name' => 'is_active',
                'column_type' => 'boolean',
                'raw' => 'true',
                'content' => function ($row) {
                    $checked = $row->is_active ? 'checked' : '';

                    return '<input class="btn-status" data-url="'.route('courses.change.status', ['course' => $row->id]).'" '.
                        'type="checkbox" id="switch-'.$row->id.'" switch="primary" '.$checked.' /> '.
                        '<label for="switch-'.$row->id.'" data-on-label="True" data-off-label="False"></label>';
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
                    /*$actions = [
                        '<a class="dropdown-item" href="' .route('courses.edit',$row->id) . '"><i class="fas fa-edit"></i>&nbsp;Edit</a>',
                        '<a class="dropdown-item delete-item" data-url="' .route('courses.destroy',$row->id) . '"><i class="fas fas fa-trash-alt"></i>&nbsp;Delete</a>',
                    ];

                    return
                        '<div class="btn-group">' .
                        '<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">' . __('Actions') . ' <i class="mdi mdi-chevron-down"></i></button>' .
                        '<div class="dropdown-menu">' . implode('', $actions) . '</div>' .
                        '</div>';*/
                    $actions = [
                        '<a class="btn btn-primary btn-sm" href="'.route('courses.edit', $row->id).'"><i class="fas fa-edit"></i> | '.__('Edit').'</a>',
                        (auth()->user()->user_type == UserTypeEnum::ADMIN()) ? '<a class="btn btn-secondary btn-sm delete-item" data-url="'.route('courses.destroy', $row->id).'"><i class="fas fa-trash-alt"></i> | '.__('Delete').'</a>' : '',
                    ];

                    return implode(' ', $actions);
                },
            ],
        ];
    }
}
