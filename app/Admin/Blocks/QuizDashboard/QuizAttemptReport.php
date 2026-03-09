<?php

namespace App\Admin\Blocks\QuizDashboard;

use App\Admin\Blocks\BlockBase;
use App\Admin\DataTables\Quizzes\QuizAttemptDataTable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class QuizAttemptReport extends BlockBase
{
    protected $datatable;

    protected function setFilters(): void
    {
        parent::setFilters();
        $this->datatable = new QuizAttemptDataTable(user: $this->user, request: $this->request);
    }

    protected function getQuery(): array
    {
        $table = $this->datatable->getData();

        return [
            'data' => json_encode($table->getData(true)['data']),
            'columns' => $this->datatable->getColumnDef(),
            'export' => ! $this->user->isSeller(),
        ];
    }

    public function getDtInstance()
    {
        return $this->datatable;
    }

    protected function loadHtml($data): View
    {
        return view('blocks.accounts-dashboard.per-account', $data);
    }

    public function getSelectStatement()
    {
        return $this->datatable->getSelectStatement();
    }

    public function getExportQuery()
    {
        $query = $this->datatable->getData(true)->getFilteredQuery();

        $date = $this->filters['custom_filters']['qa.created_at'] ?? null;
        if (isset($date['from']) && isset($date['to'])) {
            $query->whereBetween(DB::raw('DATE(qa.created_at)'), [$date['from'], $date['to']]);
        }

        if (isset($this->filters['custom_filters']['u.name'])) {
            $query->where('u.name', 'like', '%'.$this->filters['custom_filters']['u.name']['from'].'%');
        }

        if (isset($this->filters['custom_filters']['b.name'])) {
            $query->where('b.name', 'like', '%'.$this->filters['custom_filters']['b.name']['from'].'%');
        }

        return $query->orderBy('qa.id', 'desc');

    }

    public function formatIsReAttempt($value): string
    {
        return $value ? 'Yes' : 'No';
    }

    public function formatResult($value, $row): string
    {

        $percent = get_points_percentage($row['total_points'], $row['earned_points']);
        if ($percent >= 50) {
            return 'Passed';
        }

        return 'Fail';
    }

    public function getExportColumns(): array
    {
        return [
            'batch' => [
                'title' => __('Batch'),
                'data' => 'batch_name',
                'name' => 'b.name',
            ],
            'student' => [
                'title' => __('Student'),
                'data' => 'user_name',
                'name' => 'u.name',
            ],
            'course' => [
                'title' => __('Course'),
                'data' => 'course_name',
                'name' => 'c.name',
            ],
            'topic' => [
                'title' => __('Topic'),
                'data' => 'topic_name',
                'name' => 't.name',
            ],
            'total_questions' => [
                'title' => __('Total Questions'),
                'data' => 'total_questions',
                'name' => 'total_questions',
                'columnType' => 'integer-type',
            ],
            'total_points' => [
                'title' => __('Total Points'),
                'data' => 'total_points',
                'name' => 'total_points',
                'columnType' => 'integer-type',
            ],
            'earned_points' => [
                'title' => __('Earned Points'),
                'data' => 'earned_points',
                'name' => 'earned_points',
                'columnType' => 'integer-type',
            ],
            'correct_answers' => [
                'title' => __('Correct Answers'),
                'data' => 'correct_answers',
                'name' => 'correct_answers',
                'columnType' => 'integer-type',

            ],
            'incorrect_answers' => [
                'title' => __('Incorrect Answers'),
                'data' => 'incorrect_answers',
                'name' => 'incorrect_answers',
                'columnType' => 'integer-type',

            ],
            'is_re_attempt' => [
                'title' => __('Attempts'),
                'data' => 'is_re_attempt',
                'name' => 'is_re_attempt',
                'columnType' => 'boolean-type',
            ],
            'created_at' => [
                'title' => __('Attempt At'),
                'data' => 'created_at',
                'name' => 'qa.created_at',
            ],
            'result' => [
                'title' => __('Result'),
                'data' => 'result',
                'name' => DB::raw('\'\' as result'),
                'columnType' => 'boolean-type',
            ],

        ];
    }
}
