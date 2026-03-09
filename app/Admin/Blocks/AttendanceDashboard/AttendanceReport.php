<?php

namespace App\Admin\Blocks\AttendanceDashboard;

use App\Admin\Blocks\BlockBase;
use App\Admin\DataTables\AttendanceDataTable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class AttendanceReport extends BlockBase
{
    protected $datatable;

    protected function setFilters(): void
    {
        parent::setFilters();
        $this->datatable = new AttendanceDataTable($this->user, $this->user, $this->request);
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

        return $query->orderBy('a.id', 'desc');

    }

    public function getExportColumns(): array
    {
        return [
            'batch' => [
                'title' => __('Batch'),
                'data' => 'b_name',
                'name' => 'b.name',
            ],
            'name' => [
                'title' => __('Student'),
                'data' => 'name',
                'name' => 'u.name',
            ],
            'course' => [
                'title' => __('Course'),
                'data' => 'c_name',
                'name' => 'c.name',
            ],
            'user_type' => [
                'title' => __('Student Type'),
                'data' => 'user_type',
                'name' => 'u.user_type',
            ],
            'date' => [
                'title' => __('Date'),
                'data' => 'date',
                'name' => 'date',
            ],
            'status' => [
                'title' => __('Status'),
                'data' => 'status',
                'name' => 'a.status',
            ],
            'check_in' => [
                'title' => __('Active Session'),
                'data' => 'check_in',
                'name' => 'check_in',
            ],
            'check_out' => [
                'title' => __('Ended Session'),
                'data' => 'check_out',
                'name' => 'check_out',
            ],
            'hours' => [
                'title' => __('Logged Hours'),
                'data' => 'hours',
                'name' => 'hours',
            ],
        ];
    }
}
