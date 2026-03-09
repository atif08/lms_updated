<?php

namespace App\Admin\DataTables\Quizzes;

use App\DataTables\BaseDataTable;
use Domain\Quizzes\Models\Quiz;
use Domain\Users\Enums\UserTypeEnum;

class QuizDataTable extends BaseDataTable
{
    protected $order_by = [[3, 'desc']];

    public function getBaseQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $this->columns = [
            'quizzes.id',
            'user_id',
            'quizzes.name as q_name',
            'b.name',
            //            'users.name as u_name',
            'quizzes.batch_id',
            'quizzes.description',
            'quizzes.created_at',
            'quizzes.updated_at',
        ];

        $query = Quiz::query()->select($this->columns)
            ->join('users as u', 'quizzes.user_id', '=', 'u.id')
            ->leftJoin('batches as b', 'quizzes.batch_id', '=', 'b.id');
        if ($this->user->user_type == UserTypeEnum::FACULTY_MEMBER()) {
            $query->where('user_id', $this->user->id);
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
            'b_name' => [
                'title' => __('Batch'),
                'data' => 'name',
                'name' => 'b.name',
                'column_type' => 'text',
            ],
            'name' => [
                'title' => __('Name'),
                'data' => 'q_name',
                'name' => 'q_name',
                'column_type' => 'text',
                'raw' => true,
                'content' => function ($row) {
                    return "<a href='".route('quizzes.edit', $row->id)."'>$row->name</a>";

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
                'raw' => true,
                'content' => function ($row) {
                    $actions = [
                        '<a class="btn btn-primary btn-sm" href="'.route('quizzes.edit', ['quiz' => $row->id]).'"><i class="fas fa-edit"></i> | '.__('Edit').'</a>',
                        '<a class="btn btn-secondary btn-sm delete-item" data-url="'.route('quizzes.destroy', ['quiz' => $row->id]).'"><i class="fas fa-trash-alt"></i> | '.__('Delete').'</a>',
                    ];

                    return implode(' ', $actions);
                },
            ],
        ];
    }
}
