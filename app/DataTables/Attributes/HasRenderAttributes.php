<?php

namespace App\DataTables\Attributes;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

trait HasRenderAttributes {

    public function table($attributes = []): \Illuminate\Contracts\View\View {
        return view('data-tables.table', [
            'data_table' => $this,
            'attributes' => $attributes
        ]);
    }

    public function getDTParameters(array $parameters = []): array {
        return array_merge([
            "ajax"       => $this->ajax_url,
            "pageLength" => 10,
            "aoColumns"  => array_values($this->getColumnDef()),
            "ordering"   => false,
            //"aaSorting"  => $this->getOrderBy(),
            "sDom"       => "<'row dt-top-wrapper'>" .
                "<'#" . $this->getTableId() . ".row dt-wrapper '<'col-sm-12'tr>>" .
                "<'row pagination-wrapper mt-3'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'i><'col-sm-12 col-md-4'p>>",
        ], $parameters);
    }

    public function scripts(): string {
        $dt_parameters = $this->getDTParameters();
        return sprintf('<script type="text/javascript">loadDataTable("%s", %s)</script>' . PHP_EOL, $this->getTableId(), json_encode($dt_parameters));
    }

    public function filters($data = []): \Illuminate\Contracts\View\View {
        $data = array_merge($data, ['data_table' => $this]);

        $view = Str::kebab(str_replace('DataTable', '', get_class_name($this)));
        $view = 'data-tables.' . $view . '.custom-filters';

        if (View::exists($view)) {
            return view($view, $data);
        }

        return view('data-tables.custom-filters', $data);
    }
}
