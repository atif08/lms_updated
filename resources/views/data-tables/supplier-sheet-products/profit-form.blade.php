<table class="table custom-table">
    <tbody>
    <tr>
        <td class="td-custom white-bg" style="width: 50%">
            <div class="col-12">{{ __('ROI:') }}</div>
        </td>
        <td class="td-custom gray-bg">
            <div class="row">
                <div class="col-8 pr-0">
                    <span class="green @if($row->roi < 0) red @endif">
                        {{ round($row->roi, 2) }}%
                    </span>
                </div>
                <div class="col-4 text-end">
                    <i class="fa fa-info-circle gray" data-toggle="popover" data-bs-trigger="hover"
                       data-bs-content="{{ __('Return On Investment') }}"></i>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td class="td-custom white-bg" style="width: 50%">
            <div class="col-12">{{ __('PM:') }}</div>
        </td>
        <td class="td-custom gray-bg">
            <div class="row">
                <div class="col-8">
                    <span class="green @if($row->profit_margin < 0) red @endif">
                        {{ round($row->profit_margin, 2) }}%
                    </span>
                </div>
                <div class="col-4 text-end">
                    <i class="fa fa-info-circle gray" data-toggle="popover" data-bs-trigger="hover"
                       data-bs-content="{{ __('Profit Margin') }}"></i>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td class="td-custom white-bg" style="width: 50%">
            <div class="col-12">{{ __('P:') }}</div>
        </td>
        <td class="td-custom gray-bg">
            <div class="row">
                <div class="col-8">
                    <span class="green @if($row->profit < 0) red @endif">
                        {{ round($row->profit, 2) }}
                    </span>
                </div>
                <div class="col-4 text-end">
                    <i class="fa fa-info-circle gray" data-toggle="popover" data-bs-trigger="hover"
                       data-bs-content="{{ __('Profit') }}"></i>
                </div>
            </div>
        </td>
    </tr>
    </tbody>
</table>

