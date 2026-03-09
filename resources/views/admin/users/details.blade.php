@extends('layouts.master')

@section('title', __('User Details'))

@section('content')
    @component('components.admin.page-title')
        @slot('li_1')
            {{ __('Settings') }}
        @endslot
        @slot('title')
            {{ __('User Details') }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">{{ __('Basic Info') }}</h4>
                </div>
                <div class="card-body">
                    {!! form($basic_info_form) !!}
                    {{--                    <x-media-library-collection name="media" :model="$user" rules="mimes:png,jpeg,pdf" multiple />--}}
                    {{--                    <livewire:media-library wire:model="images" multiple />--}}


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
@push('scripts')
    <script>
        function toggleFields() {
            let type = $('#user_type').val();

            if (type === 'ADMIN' || type === 'FACULTY_MEMBER') {

                // hide dropdowns
                $('#batch_id').closest('.form-group').hide();
                $('#course_id').closest('.form-group').hide();

                // disable inputs so they are NOT submitted
                $('#batch_id').prop('disabled', true).val('');
                $('#course_id').prop('disabled', true).val('');

            } else {

                // show dropdowns
                $('#batch_id').closest('.form-group').show();
                $('#course_id').closest('.form-group').show();

                // enable inputs
                $('#batch_id').prop('disabled', false);
                $('#course_id').prop('disabled', false);
            }
        }

        $(document).ready(function () {
            toggleFields();
            $('#user_type').on('change', toggleFields);
        });

    </script>
@endpush
