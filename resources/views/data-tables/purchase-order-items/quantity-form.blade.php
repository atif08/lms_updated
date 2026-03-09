<div class="row">
    <div class="col-6">
        <div class="form-group animated">
            <input type="text" value="41.74" class="form-control animated" placeholder=" ">
            <label class="animate-label" >{{__('Each Qty')}}</label>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group animated">
            <input type="text" value="11.99" class="form-control animated">
            <label class="animate-label">{{__('Case Qty')}}</label>
        </div>
    </div>
</div>
<table class="table custom-table">
    <tbody>
    <tr>
        <td class="td-custom white-bg fw-bold green">{{__('Case Size')}}</td>
        <td class="td-custom gray-bg">{{$row->sell_size}}</td>
    </tr>
    <tr>
        <td class="td-custom fw-bold white-bg green">{{__('UOM')}}</td>
        <td class="td-custom gray-bg">{{$row->sell_uom}}</td>
    </tr>
    </tbody>
</table>
