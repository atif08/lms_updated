@extends('layouts.master')

@section('title', __('Batch Details'))

@section('content')
    @component('components.admin.page-title')
        @slot('li_1')
            {{ __('Settings') }}
        @endslot
        @slot('title')
            {{ __('Batch Details') }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">{{ __('Batch Info') }}</h4>
                </div>
                <div class="card-body">
                    {!! form($form) !!}

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
