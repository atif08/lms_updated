@extends('layouts.master')

@section('li_1', __('Settings'))
@section('title', __('User Details'))


@section('content')

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">{{ __('Basic Info') }}</h4>
                </div>
                <div class="card-body">
                    {!! form($basic_info_form) !!}
                </div>
            </div>
        </div> <!-- end col -->

        @if($password_form)
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">{{ __('Change Password') }}</h4>
                    </div>
                    <div class="card-body">
                        {!! form($password_form) !!}
                    </div>
                </div>
            </div>
        @endif
    </div> <!-- end row -->
@endsection
