@extends('data-tables.custom-filters')

@section('extra-filters')
{{--    <div class="row">--}}
{{--        <div class="col-lg-3">--}}
{{--            <div class="d-flex h-100">--}}
                <div class="form-group ms-2 mb-2 mt-2">
                    <a type="button" class="btn btn-secondary waves-effect waves-light float-end"
                       href="{{ route('users.get.details') }}">
                        <i class="fa fa-plus"></i> | {{ __('Add User') }}
                    </a>
                </div>
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
