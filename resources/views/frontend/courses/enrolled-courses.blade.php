<?php $page = 'student-profile'; ?>
@extends('frontend.layouts.mainlayout')
@section('content')
    @component('components.frontend.breadcrumb')
        @slot('title')
        Enrolled Courses
        @endslot
        @slot('item1')
         Home
        @endslot
        @slot('item2')
        Enrolled Courses
        @endslot
    @endcomponent


	<!-- Page Content -->
    <div class="page-content">
        <div class="container">
            <div class="row">

               @component('components.frontend.sidebar')

               @endcomponent

                <!-- Student Courses -->
                <div class="col-xl-9 col-lg-9">

                    <div class="settings-widget card-info">
                        <div class="settings-menu p-0">
                            {{-- <div class="profile-heading">
                                <h3>Enrolled Courses</h3>
                            </div> --}}
                            <div class="checkout-form pb-0">
                                <div class="wishlist-tab">
                                    <ul class="nav">
                                        {{-- <li class="nav-item">
                                            <a href="javascript:void(0);" class="active" data-bs-toggle="tab" data-bs-target="#enroll-courses">Enrolled Courses ({{count($courses)}})</a>
                                        </li> --}}
{{--                                        <li class="nav-item">--}}
{{--                                            <a href="javascript:void(0);" data-bs-toggle="tab" data-bs-target="#active-courses">Active Courses (03)</a>--}}
{{--                                        </li>--}}
{{--                                        <li class="nav-item">--}}
{{--                                            <a href="javascript:void(0);" data-bs-toggle="tab" data-bs-target="#complete-courses">Completed Courses (03)</a>--}}
{{--                                        </li>--}}
                                    </ul>
                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="enroll-courses">
                                        <div class="row">

                                            <!-- Course Grid -->
                                            @forelse($courses as $course)
                                                @include('frontend.courses.partial.course-card',['hide_enrolled'=>true])
                                            @empty
                                                <div class="col-md-12">
                                                    <div class="text-center p-4">
                                                        <p class="mb-0">No data found</p>
                                                    </div>
                                                </div>
                                            @endforelse
                                            <!-- /Course Grid -->

                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="active-courses">
                                        <div class="row">
                                            <!-- Course Grid -->
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="complete-courses">
                                        <div class="row">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /Student Courses -->

            </div>
        </div>
    </div>
    <!-- /Page Content -->

    @endsection
