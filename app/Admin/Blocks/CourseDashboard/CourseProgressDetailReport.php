<?php

namespace App\Admin\Blocks\CourseDashboard;

use App\Admin\Blocks\BlockBase;
use App\Admin\DataTables\Courses\CoursesProgressReportDetailDataTable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class CourseProgressDetailReport extends BlockBase
{
    protected $datatable;

    protected function setFilters(): void
    {
        parent::setFilters();
        $this->datatable = new CoursesProgressReportDetailDataTable($this->user, $this->user, $this->request);
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

        //        $date = $this->filters['custom_filters']['date'] ?? null;
        //        if (isset($date['from']) && isset($date['to'])) {
        //            $query->whereBetween(DB::raw('DATE(date)'), [$date['from'], $date['to']]);
        //        }

        return $query;
    }

    public function formatCompleted($value, $row): string
    {
        if ($value) {
            return 'Completed';
        }

        return 'Not Yet started';
    }

    public function formatCreatedAt($value, $row): string
    {
        if ($value) {
            return $row['created_at'];
        }

        return 'N/A';
    }

    public function getExportColumns(): array
    {
        return [
            'student_name' => [
                'title' => __('Student'),
                'data' => 'user_name',
                'name' => 'u.name',
            ],
            'course_name' => [
                'title' => __('Course Name'),
                'data' => 'course_name',
                'name' => 'c.name',
            ],
            'topic_name' => [
                'title' => __('Topic'),
                'data' => 'topic_name',
                'name' => 't.name',
            ],
            'lesson_name' => [
                'title' => __('Lesson'),
                'data' => 'lesson_name',
                'name' => 'l.name',
            ],
            'file_name' => [
                'title' => __('File Name '),
                'data' => 'file_name',
                'name' => 'm.name',
            ],
            'created_at' => [
                'title' => __('Date'),
                'data' => 'created_at',
                'name' => 'p.created_at',
                'columnType' => 'boolean-type',
            ],
            'completed' => [
                'title' => __('Progress Status'),
                'data' => 'completed',
                'name' => 'p.completed',
                'columnType' => 'boolean-type',
            ],
        ];
    }
}
