<?php

namespace App\Admin\DataTables;

use App\Admin\DataTables\Attributes\HasFilterAttributes;
use App\Admin\DataTables\Attributes\HasFormattingAttributes;
use App\Admin\DataTables\Attributes\HasOrderAttributes;
use App\Admin\DataTables\Attributes\HasRenderAttributes;
use App\Helpers\CarbonHelper;
use Domain\Users\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\QueryDataTable;

class BaseDataTable {

    use HasFilterAttributes, HasOrderAttributes, HasFormattingAttributes, HasRenderAttributes;

    /** @var User */
    protected $user;
    /** @var User */
    protected $current_account;
    /** @var Request */
    protected $request;
    protected $custom_filters;

    /** @var CarbonHelper */
    protected $date_object;
    protected $date_range = null;
    protected $columns = [];
    protected $table_id = '';
    protected $order_by = [[1, 'asc']];
    protected $row_id = null;
    protected $ajax_url = null;

    public function __construct(User $user, User $current_account = null, Request $request = null) {
        $this->user = $user;
        $this->current_account = $current_account ?: $user;

        $this->request = $request;
        if ($this->request->has('custom_filters')) {
            $this->custom_filters = $this->request->get('custom_filters');
        }

        $this->setTableId(get_class_name($this));
        $this->ajax_url = $request->fullUrl();

        $this->setOrderBy();
        $this->setDateRange();
    }

//    public function getBaseQuery() {
//        return null;
//    }

    public function getColumnDef(): array {
        return [];
    }

    public function getColumns(): array {
        return $this->columns;
    }

    public function getTableId(): string {
        return $this->table_id;
    }

    public function setTableId($table_id) {
        $this->table_id = $table_id;
    }

    protected function setOrderBy() {
        if ($this->request->get('order')) {
            $this->order_by = $this->request->get('order');
        }
    }

    public function getOrderBy() {
        return $this->order_by;
    }

    protected function setDateRange() {
        $this->date_object = new CarbonHelper($this->user, $this->request, 30);
        $this->date_range = $this->date_object->getFullDayRange();
        return $this;
    }

    protected function getDateRange() {
        return $this->date_range;
    }

    public function getData($return = false) {
        $base_query = $this->getBaseQuery();

        // END THIS IS NEEDED IN CASE OF BLOCKS

        /** @var QueryDataTable $data_table */
        $data_table = Datatables::of($base_query);

        $this->setEditableColumns($data_table);
        $this->setRawColumns($data_table);
        $this->setCustomOrder($data_table);
        $this->setCustomFilters($data_table);

        if ($this->row_id) {
            $data_table->setRowId($this->row_id);
        }

        if ($return) {
            return $data_table;
        }

        return $data_table->make(true);
    }

    protected function setRawColumns($data_table) {
        $column_def = $this->getColumnDef();
        $raw_columns = collect($column_def)->where('raw', true)->pluck('data')->toArray();
        if (!empty($raw_columns)) {
            $data_table->rawColumns($raw_columns);
        }
    }

}
