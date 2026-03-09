<?php $page = 'course-grid'; ?>
@extends('frontend.layouts.mainlayout')
@section('content')
    @component('components.frontend.breadcrumb')
        @slot('title')
            Home
        @endslot
        @slot('item1')
            Courses
        @endslot
        @slot('item2')
            All Courses
        @endslot
    @endcomponent
    <!-- Course -->
    <section class="course-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @component('components.admin.alert')
                    @endcomponent
                    {{--                    @component('components.frontend.filter')--}}
                    {{--                    @endcomponent--}}
                    <div class="row">
                        @foreach($courses as $course)
                            @include('frontend.courses.partial.course-card',["hide_enrolled"=>false])
                        @endforeach
                    </div>

{{--                    @component('components.frontend.pagination',["item"=>$courses])--}}
{{--                    @endcomponent--}}

                </div>
            </div>
        </div>
    </section>
    <!-- /Course -->
@endsection
