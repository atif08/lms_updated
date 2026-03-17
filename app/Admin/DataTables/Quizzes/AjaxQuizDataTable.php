<?php

namespace App\Admin\DataTables\Quizzes;

use App\Admin\DataTables\BaseDataTable;
use Domain\Quizzes\Models\Quiz;

class AjaxQuizDataTable extends BaseDataTable
{
    protected $order_by = [[0, 'desc']];

    public function getBaseQuery()
    {

        return Quiz::query()->select('*')->where('is_active', 1);
    }

    public function getColumnDef(): array
    {
        return [
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
                        '<a class="btn btn-secondary btn-sm btn-quiz" data-url="'.route('topics.quizzes.save', ['topic' => $this->request->topic_id, 'quiz' => $row->id]).'"> '.__('Attach').'</a>',
                    ];

                    return implode(' ', $actions);
                },
            ],
        ];
    }
}
