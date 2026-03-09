@extends('data-tables.custom-filters')

@section('extra-filters')
{{--    <div class="row">--}}
{{--        <div class="col-lg-3">--}}
{{--            <div class="d-flex h-100">--}}
                <div class="form-group ms-2 mb-2 mt-2">
                    <button type="button" class="btn btn-secondary waves-effect waves-light btn-import float-end"
                            data-bs-toggle="modal" data-bs-target="#importModal"
                            data-report-type="{{\App\Enums\ReportTypeEnum::UPCS()->value}}">
                        <i class="fa fa-plus"></i> | {{__('Import UPC')}}
                    </button>
                </div>
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
