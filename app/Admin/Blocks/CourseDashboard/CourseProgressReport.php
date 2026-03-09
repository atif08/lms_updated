<?php

namespace App\Admin\Blocks\CourseDashboard;

use App\Admin\Blocks\BlockBase;
use App\Admin\DataTables\Courses\CoursesProgressReportDataTable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class CourseProgressReport extends BlockBase
{
    protected $datatable;

    protected function setFilters(): void
    {
        parent::setFilters();
        $this->datatable = new CoursesProgressReportDataTable($this->user, $this->user, $this->request);
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

        $date = $this->filters['custom_filters']['date'] ?? null;
        if (isset($date['from']) && isset($date['to'])) {
            $query->whereBetween(DB::raw('DATE(date)'), [$date['from'], $date['to']]);
        }

        if (isset($this->filters['custom_filters']['u.name'])) {
            $query->where('u.name', 'like', '%'.$this->filters['custom_filters']['u.name']['from'].'%');
        }

        if (isset($this->filters['custom_filters']['b.name'])) {
            $query->where('b.name', 'like', '%'.$this->filters['custom_filters']['b.name']['from'].'%');
        }

        return $query->orderBy('u.id', 'desc');

    }

    public function getExportColumns(): array
    {
        return [
            'batch_name' => [
                'title' => __('Batch'),
                'data' => 'batch_name',
                'name' => 'b.name',
            ],
            'user_name' => [
                'title' => __('Student Name'),
                'data' => 'user_name',
                'name' => 'u.name',
            ],
            'course_name' => [
                'title' => __('Course Name'),
                'data' => 'course_name',
                'name' => 'c.name',
            ],
            'total_topics' => [
                'title' => __('Total Topics'),
                'data' => 'total_topics',
                'name' => DB::raw('COUNT(DISTINCT t.id) AS total_topics'),
            ],

            'total_lessons_completed' => [
                'title' => __('Total Files'),
                'data' => 'total_lessons_completed',
                'name' => DB::raw('SUM(CASE WHEN l.type = "MEDIA" THEN 0 ELSE 1 END) + COUNT(DISTINCT CASE WHEN l.type = "MEDIA" THEN m.id ELSE NULL END) AS total_lessons_completed'),
            ],

            'total_progress' => [
                'title' => __('Completed Files'),
                'data' => 'total_progress',
                'name' => DB::raw('IFNULL(sp.total_progress, 0) AS total_progress'),
            ],
        ];
    }
}
