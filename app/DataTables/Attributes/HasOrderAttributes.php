<?php

namespace App\DataTables\Attributes;

trait HasOrderAttributes {

    protected function setCustomOrder($data_table) {
        if (!isset($this->custom_filters['sort_by']['key']) ||
            $this->custom_filters['sort_by']['key'] == 'default') {
            return;
        }

        $column_def = collect($this->getColumnDef());

        $data_table->order(function ($query) use ($column_def) {
            $column = (array)$column_def->where('data', $this->custom_filters['sort_by']['key'])->first();

            if (isset($column['order']) && is_callable($column['order'])) {
                $column['order']($query, $this->custom_filters['sort_by']['value']);
                return;
            }

            if ($column['orderable'] ?? true) {
                $query->orderBy($column['name'], $this->custom_filters['sort_by']['value']);
            }
        });
    }

    public function getSortable() {
        $list = collect($this->getColumnDef());
        $filter = $list->filter(function ($item) {
            return ($item['orderable'] ?? true);
        });
        return $filter->pluck('title', 'data');
    }

}
