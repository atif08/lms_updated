<?php

namespace App\Admin\DataTables\Quizzes;

use App\Admin\DataTables\BaseDataTable;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class QuizAttemptDataTable extends BaseDataTable
{
    protected $order_by = [[11, 'desc']];

    public function getSelectStatement(): array
    {
        return [
            'qa.id as quiz_attempt_id',
            'qa.is_re_attempt',
            'qa.participant_id',
            'qa.quiz_name',
            'qa.total_questions',
            'qa.total_points',
            'qa.correct_answers',
            'qa.incorrect_answers',
            'qa.earned_points',
            'qa.created_at',
            DB::raw('u.name AS user_name'),
            DB::raw('b.name AS batch_name'),
            DB::raw('t.name AS topic_name'),
            DB::raw('c.name AS course_name'),
            DB::raw('\'\' as result'),
            DB::raw('\'\' as DT_RowIndex'),
        ];
    }

    public function getBaseQuery(): Builder
    {

        return DB::table('quiz_attempts as qa')
            ->join('topics as t', 'qa.topic_id', '=', 't.id')
            ->join('courses as c', 't.course_id', '=', 'c.id')
            ->join('users as u', 'qa.participant_id', '=', 'u.id')
            ->leftJoin('batches as b', 'u.batch_id', '=', 'b.id')
            ->whereNull('u.deleted_at')
            ->select($this->getSelectStatement());
    }

    public function getColumnDef(): array
    {
        return [
            'DT_RowIndex' => [
                'title' => __('No'),
                'data' => 'DT_RowIndex',
                'name' => 'DT_RowIndex',
            ],
            'batch' => [
                'title' => __('Batch'),
                'data' => 'batch_name',
                'name' => 'b.name',
                'column_type' => 'text',
            ],
            'student' => [
                'title' => __('Student'),
                'data' => 'user_name',
                'name' => 'u.name',
                'column_type' => 'text',
            ],
            'course' => [
                'title' => __('Course'),
                'data' => 'course_name',
                'name' => 'c.name',
                'column_type' => 'text',
            ],
            'topic' => [
                'title' => __('Topic'),
                'data' => 'topic_name',
                'name' => 't.name',
                'column_type' => 'text',
            ],
            'total_questions' => [
                'title' => __('Total Questions'),
                'data' => 'total_questions',
                'name' => 'total_questions',
                'column_type' => 'integer',
            ],
            'total_points' => [
                'title' => __('Total Points'),
                'data' => 'total_points',
                'name' => 'total_points',
                'column_type' => 'integer',
            ],
            'correct_answers' => [
                'title' => __('Correct Answers'),
                'data' => 'correct_answers',
                'name' => 'correct_answers',
                'column_type' => 'integer',
                'raw' => true,
                'content' => function ($row) {
                    return '<strong class="badge badge-pill bg-soft-success font-size-14">'.$row->correct_answers.'</strong>';
                },
            ],
            'incorrect_answers' => [
                'title' => __('Incorrect Answers'),
                'data' => 'incorrect_answers',
                'name' => 'incorrect_answers',
                'column_type' => 'integer',
                'raw' => true,
                'content' => function ($row) {
                    return '<strong class="badge badge-pill bg-soft-danger font-size-14">'.$row->incorrect_answers.'</strong>';
                },
            ],
            'earned_points' => [
                'title' => __('Earned Points'),
                'data' => 'earned_points',
                'name' => 'earned_points',
                'column_type' => 'integer',
                'raw' => true,
                'content' => function ($row) {
                    $percent = get_points_percentage($row->total_points, $row->earned_points);

                    return $row->earned_points.' ('.$percent.'%)';
                },
            ],
            'is_re_attempt' => [
                'title' => __('Attempts'),
                'data' => 'is_re_attempt',
                'name' => 'is_re_attempt',
                'column_type' => 'text',
                //                'raw'         => true,
                //                'content'     => function ($row) {
                //                    return $row->is_re_attempt ? 'Yes' : 'No';
                //                },
            ],
            'created_at' => [
                'title' => __('Attempt At'),
                'data' => 'created_at',
                'name' => 'qa.created_at',
                'column_type' => 'date',
            ],
            'result' => [
                'title' => __('Result'),
                'data' => 'result',
                'name' => 'result',
                'column_type' => 'text',
                'raw' => true,
                'content' => function ($row) {
                    $percent = get_points_percentage($row->total_points, $row->earned_points);
                    if ($percent >= 50) {
                        return '<strong class="badge badge-pill bg-soft-success font-size-14">Passed</strong>';
                    }

                    return '<strong class="badge badge-pill bg-soft-danger font-size-14">Fail</strong>';
                },
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
                        '<a class="btn btn-info btn-sm" href="'.route('quiz-attempts.show', $row->quiz_attempt_id).'"><i class="fas fa-file-alt"></i>  '.'</a>',
                    ];

                    return implode(' ', $actions);
                },
            ],
        ];
    }
}
