<?php $page = 'student-quiz'; ?>
@extends('frontend.layouts.mainlayout')
@section('content')
    @component('components.frontend.breadcrumb')
        @slot('title')
            Attendance
        @endslot
        @slot('item1')
            Home
        @endslot
        @slot('item2')
            Attendance
        @endslot
    @endcomponent
    <!-- Page Content -->
    <div class="page-content">
        <div class="container">
            <div class="row">

                @component('components.frontend.sidebar')
                @endcomponent
                <!-- Student Quiz -->
                <div class="col-xl-9 col-lg-9">

                    <div class="settings-widget card-details">
                        <div class="settings-menu p-0">
                            @component('components.admin.alert')
                            @endcomponent
                            <div class="profile-heading">
                                <h3>Attendance</h3>
                            </div>
                            <div class="checkout-form">
                                <div class="table-responsive custom-table">

                                    <!-- Referred Users-->
                                    <table class="table table-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Active Session</th>
                                            <th>Ended Session</th>
                                            <th>Hours</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($attendance as $atten)
                                            <tr>
                                                <td>{{$atten->date}}</td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($atten->check_in)->format('H:i') }}
                                                </td>
                                                <td>
                                                    @if($atten->check_out) {{ \Carbon\Carbon::parse($atten->check_out)->format('H:i') }}@endif
                                                </td>
                                                <td>
                                                    <strong>{{$atten->hours}} Hrs</strong>
                                                </td>
                                                <td>
                                                    @if($atten->status == 'ABSENT')
                                                        <span class="resut-badge badge-light-danger">Absent</span>
                                                    @elseif($atten->status == 'PRESENT')
                                                        <span class="resut-badge badge-light-success">Present</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Student Quiz -->

            </div>
        </div>
    </div>
    <!-- /Page Content -->
@endsection
@push('scripts')
@endpush
