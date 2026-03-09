<div id="linkPoModal" class="modal fade" tabindex="-1" role="dialog"
     aria-labelledby="linkPoModalLabel" aria-hidden="true">
    <div id="linkPoModalBody" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="linkPoModalLabel"> {{__('Link Purchase Order')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>
            <form method="post" action="{{route('purchase-orders.post.details')}}" class="column-mapping"
                  id="advanceFiltersForm">
                <input value="{{$supplier_sheet->supplier_id}}" type="hidden" name="supplier_id"/>
                <input value="{{$supplier_sheet->id}}" type="hidden" name="supplier_sheet_id"/>
                <div class="modal-body">
                    {{--  dropdown 1 upc--}}
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label  class="control-label">{{__('Select Option')}}</label>
                            <select  name="connect_po_option" class="form-select">
                                <option value="create">Create</option>
                                <option value="connect">Connect</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 po-list" style="display: none">
                        <div class="mb-3">
                            <label  class="control-label">{{__('Purchase Orders')}}</label>
                            <select  name="purchase_order_id" class="form-select required">
                                <option value="">Select</option>
                                @foreach($purchase_orders as $purchase_order)
                                    <option value="{{$purchase_order->id}}">{{$purchase_order->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <p class="has-error red"></p>

                    </div>
                    {{--  dropdown 2 case pack--}}
                    <div class="col-lg-12 po-name show">
                        <div class="mb-3">
                            <label  class="control-label required">{{__('Purchase Orders')}}</label>
                            <input  type="text" class="form-control" name="name"/>

                        </div>
                        <p class="has-error red"></p>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect waves-light">
                        <i class="fas fa-window-close"></i>
                        Cancel
                    </button>
                    <button type="button" class="btn btn-primary waves-effect waves-light btn-save">{{__('Save')}}
                    </button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).on('click', '.btn-save', function (e) {
            e.preventDefault();
            let form = $(this).closest('form');
            $.post(form.attr('action'), form.serialize(), function (r) {
                $('#name').val('');
                $('.has-error').html('');
                success_alert(r.message);
                $('.btn-close').click();
                window.location.reload();
            }).fail(function (r) {
                $('.has-error').text(r.responseJSON.message);
                // console.log(r.responseJSON.errors.name );
                // displayValidationErrors($('.right-sidebar-container form'), r);
            })
        });

        $(document).on('change', '#po-type', function (e) {
            let select = $(this).val();
            if (select === 'create') {
                $('.po-name').show();
                $('.po-list').hide();

            } else {
                $('.po-name').hide();
                $('.po-list').show();
            }
        });
    </script>
@endpush
