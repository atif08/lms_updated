@extends('data-tables.custom-filters')

@section('extra-filters')
{{--    <div class="row">--}}
{{--        <div class="col-lg-3">--}}
{{--            <div class="d-flex h-100">--}}
                <div class="form-group ms-2 mb-2 mt-2">
                    <button type="button" class="btn btn-secondary waves-effect waves-light btn-connections float-end">
                        <i class="fa fa-edit"></i> | {{ __('Credentials') }}
                    </button>
                </div>
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
