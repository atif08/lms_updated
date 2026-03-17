<?php

namespace App\Admin\DataTables\Attributes;

use Carbon\Carbon;

trait HasFormattingAttributes
{
    protected function setEditableColumns($data_table)
    {
        $column_def = $this->getColumnDef();
        foreach ($column_def as $column) {
            if (($column['data'] ?? '') === 'DT_RowIndex') {
                continue;
            }

            if (isset($column['content']) && is_callable($column['content'])) {
                $data_table->editColumn($column['data'], $column['content']);

                continue;
            }

            match ($column['column_type'] ?? 'text') {
                'amount' => $this->editAmountColumn($data_table, $column),
                'integer' => $this->editIntegerColumn($data_table, $column),
                'percent' => $this->editPercentColumn($data_table, $column),
                'percent2' => $this->editPercent2Column($data_table, $column),
                'float' => $this->editFloatColumn($data_table, $column),
                'boolean' => $this->editBooleanColumn($data_table, $column),
                'date' => $this->editDateColumn($data_table, $column),
                'sub_string' => $this->editSubStringColumn($data_table, $column),
                default => $this->editDefaultColumn($data_table, $column)
            };
        }
    }

    protected function editAmountColumn($data_table, $column)
    {
        $data_table->editColumn($column['data'], function ($row) use ($column) {
            $currency = $row->currency ?? $this->current_account->marketplace?->currency ?? 'USD';

            return format_amount($row->{$column['data']}, $currency);
        });
    }

    protected function editIntegerColumn($data_table, $column)
    {
        $data_table->editColumn($column['data'], function ($row) use ($column) {
            return format_integer($row->{$column['data']});
        });
    }

    protected function editPercentColumn($data_table, $column)
    {
        $data_table->editColumn($column['data'], function ($row) use ($column) {
            return format_percent($row->{$column['data']});
        });
    }

    protected function editPercent2Column($data_table, $column)
    {
        $data_table->editColumn($column['data'], function ($row) use ($column) {
            return format_percent($row->{$column['data']}, 100);
        });
    }

    protected function editFloatColumn($data_table, $column)
    {
        $data_table->editColumn($column['data'], function ($row) use ($column) {
            return format_number($row->{$column['data']});
        });
    }

    protected function editBooleanColumn($data_table, $column)
    {
        $data_table->editColumn($column['data'], function ($row) use ($column) {
            return $row->{$column['data']} ?
                '<span class="badge badge-pill bg-soft-success font-size-12">'.($column['options'][1] ?? 'True').'</span>' :
                '<span class="badge badge-pill bg-soft-danger font-size-12">'.($column['options'][0] ?? 'False').'</span>';
        });
    }

    protected function editDateColumn($data_table, $column)
    {
        $data_table->editColumn($column['data'], function ($row) use ($column) {
            $format = $column['format'] ?? 'D. M d, Y h:i:s A';

            return $row->{$column['data']} ? Carbon::parse($row->{$column['data']})->format($format) : '';
        });
    }

    protected function editSubStringColumn($data_table, $column)
    {
        $data_table->editColumn($column['data'], function ($row) use ($column) {
            return mb_substr($row->{$column['data']}, 0, 30).'...';
        });
    }

    protected function editDefaultColumn($data_table, $column)
    {
        $data_table->editColumn($column['data'], function ($row) use ($column) {
            return $row->{$column['data']};
        });
    }
}
