@extends('layouts.master')

@section('title', __('Lesson Details'))
@section('style')
    <style>

        .modal {
            top: 0px;
            position: absolute !important;
        }

    </style>
@endsection
@section('content')
    @component('components.admin.page-title')
        @slot('li_1')
            {{ __('Settings') }}
        @endslot
        @slot('title')
            {{ __('Lesson Details') }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">{{ __('Basic Info') }}</h4>
                </div>
                <div class="card-body">
                    {!! form($createForm) !!}

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <input type="hidden" id="lessonType" value="{{(isset($lesson) && !empty($lesson))?$lesson->type:''}}">
@endsection

