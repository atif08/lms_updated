<table class='table w-100'>
    <tbody>
    <tr>
        <th class='white-bg text-nowrap'>
            <div class='row'>
                <div class='col-9'>{{ __('Tot. Fulfillable:') }}</div>
                <div class='col-3 text-end'>
                    <span class='badge badge-pill bg-soft-success font-size-12'>
                        {{ $row->afn_fulfillable_quantity ?? 0 }}
                    </span>
                </div>
            </div>
        </th>
        <th class='gray-bg text-nowrap'>
            <div class='row'>
                <div class='col-9'>{{ __('Tot. Unfulfillable:') }}</div>
                <div class='col-3 text-end'>
                    <span class='badge badge-pill bg-soft-danger font-size-12'>
                        {{ $row->afn_unsellable_quantity ?? 0 }}
                    </span>
                </div>
            </div>
        </th>
    </tr>
    <tr>
        <td class='white-bg text-nowrap'>
            <div class='row'>
                <div class='col-9'>{{ __('Available:') }}</div>
                <div class='col-3 text-end'>
                    <span class='badge badge-pill bg-soft-success font-size-12'>
                        {{ $row->afn_warehouse_quantity ?? 0 }}
                    </span>
                </div>
            </div>
        </td>
        <td class='gray-bg text-nowrap'>
            <div class='row'>
                <div class='col-9'>{{ __('Cust. Damage:') }}</div>
                <div class='col-3 text-end'>
                    <span class='badge badge-pill bg-soft-danger font-size-12'>
                        {{ 0 }}
                    </span>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td class='white-bg text-nowrap'>
            <div class='row'>
                <div class='col-9'>{{ __('Inbound:') }}</div>
                <div class='col-3 text-end'>
                    <span class='badge badge-pill bg-soft-success font-size-12'>
                        {{ ($row->afn_inbound_working_quantity ?? 0) + ($row->afn_inbound_shipped_quantity ?? 0) + ($row->afn_inbound_receiving_quantity ?? 0) }}
                    </span>
                </div>
            </div>
        </td>
        <td class='gray-bg text-nowrap'>
            <div class='row'>
                <div class='col-9'>{{ __('WH Damage:') }}</div>
                <div class='col-3 text-end'>
                    <span class='badge badge-pill bg-soft-danger font-size-12'>
                        {{ 0 }}
                    </span>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td class='white-bg text-nowrap'>
            <div class='row'>
                <div class='col-9'>{{ __('Reserved:') }}</div>
                <div class='col-3 text-end'>
                    <span class='badge badge-pill bg-soft-success font-size-12'>
                        {{ $row->afn_reserved_quantity ?? 0 }}
                    </span>
                </div>
            </div>
        </td>
        <td class='gray-bg text-nowrap'>
            <div class='row'>
                <div class='col-9'>{{ __('Dist. Damage') }}</div>
                <div class='col-3 text-end'>
                    <span class='badge badge-pill bg-soft-danger font-size-12'>
                        {{ 0 }}
                    </span>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td class='white-bg text-nowrap'>
            <div class='row'>
                <div class='col-9'>{{ __('Research:') }}</div>
                <div class='col-3 text-end'>
                    <span class='badge badge-pill bg-soft-success font-size-12'>
                        {{ $row->afn_researching_quantity ?? 0 }}
                    </span>

                </div>
            </div>
        </td>
        <td class='gray-bg text-nowrap'>
            <div class='row'>
                <div class='col-9'>{{ __('Carr. Damage') }}</div>
                <div class='col-3 text-end'>
                    <span class='badge badge-pill bg-soft-danger font-size-12'>
                        {{ 0 }}
                    </span>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td class='white-bg text-nowrap'>
            <div class='row'>
                <div class='col-9'>{{ __('Fut. Supply:') }}</div>
                <div class='col-3 text-end'>
                    <span class='badge badge-pill bg-soft-success font-size-12'>
                        {{ ($row->afn_reserved_future_supply ?? 0) + ($row->afn_future_supply_buyable ?? 0) }}
                    </span>
                </div>
            </div>
        </td>
        <td class='gray-bg text-nowrap'>
            <div class='row'>
                <div class='col-8'>{{ __('Def: | Exp: ') }}</div>
                <div class='col-4 text-end'>
                    <span class='badge badge-pill bg-soft-danger font-size-12'>
                        {{ 0 }}
                    </span> |
                    <span class='badge badge-pill bg-soft-danger font-size-12'>
                        {{ 0 }}
                    </span>
                </div>
            </div>
        </td>
    </tr>
    </tbody>
</table>
