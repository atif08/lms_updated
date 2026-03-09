<?php

namespace App\DataTables\Attributes;

use Carbon\Carbon;
use Illuminate\Support\Collection;

trait HasFilterAttributes {

    protected function setCustomFilters($data_table): void
    {
        if (empty($this->custom_filters)) {
            return;
        }

        $column_def = $this->getColumnDef();

        $data_table->filter(function ($query) use ($column_def) {
            foreach ($this->custom_filters as $key => $custom_filter) {
                if ($key == 'sort_by') continue;

                $column_key = $key == 'search_by' ? $custom_filter['key'] : $key;
                $column = $column_def[$column_key] ?? null;
                if (!isset($column)) continue;

                if (isset($column['filter']) && is_callable($column['filter'])) {
                    $column['filter']($query, $custom_filter);
                    continue;
                }

                if (isset($custom_filter['min']) && isset($custom_filter['max'])) {
                    $this->setRangeFilter($query, $column, $custom_filter['min'], $custom_filter['max']);
                } else {
                    $this->setDefaultFilter($query, $column, $custom_filter['value'] ?? '');
                }
            }
        }, false);
    }

    protected function setDefaultFilter($query, $column, $search): void {
        if (!empty($search)) {
            $query->havingRaw("({$column['name']} LIKE '%" . $search . "%')");
        }
    }

    protected function setRangeFilter($query, $column, $from, $to): void {
        [$condition, $bindings] = $this->getRangeCondition($from, $to);
        if (is_null($condition)) {
            return;
        }

        $condition = sprintf($condition, $column['name']);
        $query->havingRaw($condition, $bindings);
    }

    protected function getRangeCondition($from, $to) {
        $condition = null;
        $bindings = [];

        if (strtotime($from) && strtotime($to)) {
            $from = $from ? Carbon::parse($from)->startOfDay()->toDateTime() : '';
            $to = $to ? Carbon::parse($to)->endOfDay()->toDateTime() : '';
        }

        if (!is_empty($from) && !is_empty($to)) {
            return ['(%s BETWEEN ? AND ?)', [$from, $to]];
        }

        if (!is_empty($from)) {
            return ['(%s >= ?)', [$from]];
        }

        if (!is_empty($to)) {
            return ['(%s <= ?)', [$to]];
        }

        return [$condition, $bindings];
    }

    public function getSearchable() {
        $list = collect($this->getColumnDef());
        $filter = $list->filter(function ($item) {
            $type_match = ($item['column_type'] ?? 'text') === 'text';
            return ($item['searchable'] ?? true) && !($item['advance'] ?? false) && $type_match;
        });
        return $filter->pluck('title', 'data');
    }

    public function getAdvanceSearchable($column_type = 'text'): Collection {
        $list = collect($this->getColumnDef());
        return $list->filter(function ($item) use ($column_type) {
            $_type = ($item['column_type'] ?? 'text');
            $type_match = match ($column_type) {
                'range' => in_array($_type, ['amount', 'integer', 'percent', 'percent2', 'float']),
                default => in_array($_type, ['text', 'sub_string', 'boolean']),
            };
            return ($item['searchable'] ?? true) && ($item['advance'] ?? false) && $type_match;
        });
    }
}
