<?php

namespace App\Admin\Blocks\UserDashboard;

use App\Admin\Blocks\BlockBase;
use App\Admin\DataTables\Settings\UsersDataTable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class UserReport extends BlockBase
{
    protected $datatable;

    protected function setFilters(): void
    {
        parent::setFilters();
        $this->datatable = new UsersDataTable($this->user, $this->user, $this->request);
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
        $date = $this->filters['custom_filters']['u.created_at'] ?? null;
        if (isset($date['from']) && isset($date['to'])) {
            $query->whereBetween(DB::raw('DATE(u.created_at)'), [$date['from'], $date['to']]);
        }

        if (isset($this->filters['custom_filters']['u.name'])) {
            $query->where('u.name', 'like', '%'.$this->filters['custom_filters']['u.name']['from'].'%');
        }

        if (isset($this->filters['custom_filters']['b.name'])) {
            $query->where('b.name', 'like', '%'.$this->filters['custom_filters']['b.name']['from'].'%');
        }
        if (isset($this->filters['custom_filters']['c.name'])) {
            $query->where('c.name', 'like', '%'.$this->filters['custom_filters']['c.name']['from'].'%');
        }

        return $query->orderBy('u.id', 'desc');

    }

    public function getExportColumns(): array
    {
        return [
            'name' => [
                'title' => __('Name'),
                'data' => 'user_name',
                'name' => 'u.name',
            ],
            'email' => [
                'title' => __('Email'),
                'data' => 'email',
                'name' => 'u.email',
            ],
            'mobile' => [
                'title' => __('Phone'),
                'data' => 'mobile',
                'name' => 'u.mobile',
            ],
            'user_type' => [
                'title' => __('User Type'),
                'data' => 'user_type',
                'name' => 'u.user_type',
            ],
            'batch_name' => [
                'title' => __('Batch'),
                'data' => 'batch_name',
                'name' => 'b.name',
            ],
            'course_name' => [
                'title' => __('Course Name'),
                'data' => 'course_name',
                'name' => 'c.name',
            ],
            //            'faculty'       => [
            //                'title'       => __('Faculty Name'),
            //                'data'        => 'course_faculty',
            //                'name'        => 'f.name',
            //            ],
            'created_at' => [
                'title' => __('Created At'),
                'data' => 'created_at',
                'name' => 'u.created_at',
            ],
        ];
    }
}
