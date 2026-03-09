<?php

namespace App\Admin\Blocks\AssignmentReport;

use App\Admin\Blocks\BlockBase;
use App\Admin\DataTables\SubmittedAssignmentsDataTable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class AssignmentReport extends BlockBase
{
    protected $datatable;

    protected function setFilters(): void
    {
        parent::setFilters();
        $this->datatable = new SubmittedAssignmentsDataTable(user: $this->user, request: $this->request);
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

    public function formatFileName($value, $row): string
    {
        if (! empty($row['file_name'])) {
            return asset('storage/media/'.$row['media_id'].'/'.$row['file_name']);
        }

        return 'N/A';
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

        return $query->orderBy('a.id', 'desc');

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
                'title' => __('Submitted By'),
                'data' => 'user_name',
                'name' => 'u.name',
            ],
            'course_name' => [
                'title' => __('Course'),
                'data' => 'course_name',
                'name' => 'c.name',
            ],
            'topic_name' => [
                'title' => __('Assignment Topic'),
                'data' => 'topic_name',
                'name' => 't.name',
            ],
            'description' => [
                'title' => __('Student Notes'),
                'data' => 'description',
                'name' => 'sa.description',
            ],
            'score' => [
                'title' => __('Score'),
                'data' => 'score',
                'name' => 'sa.score',
            ],
            'comments' => [
                'title' => __('Faculty Feedback/Notes'),
                'data' => 'comments',
                'name' => 'sa.comments',
            ],
            //            'file'        => [
            //                'title'       => __('Assignment'),
            //                'data'        => 'file_name',
            //                'name'        => 'file_name',
            //                'columnType' => 'boolean-type',
            //            ],
            'status' => [
                'title' => __('Submission Status'),
                'data' => 'status',
                'name' => 'sa.status',
            ],
            'assignment_submit_date' => [
                'title' => __('Due Date'),
                'data' => 'assignment_submit_date',
                'name' => 't.assignment_submit_date',
                'column_type' => 'date',
            ],
            'created_at' => [
                'title' => __('Submitted At'),
                'data' => 'created_at',
                'name' => 'sa.created_at',
                'searchable' => false,
                'column_type' => 'date',
            ],
        ];
    }
}
