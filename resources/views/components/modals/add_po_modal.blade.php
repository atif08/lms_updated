<div id="addPoModal" class="modal fade" tabindex="-1" role="dialog"
     aria-labelledby="addPoModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="min-width: 90%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="addPoModalLabel">{{__('Supplier Item Details')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>
            <form method="post" action="{{route('purchase-orders.post.items.details')}}">
                <div class="modal-body add-po-form"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary waves-effect waves-light po-save">
                        ADD NOW <i class="fas fa-angle-right"></i>
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
