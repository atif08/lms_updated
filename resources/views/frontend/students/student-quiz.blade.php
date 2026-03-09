<?php $page = 'student-quiz'; ?>
@extends('frontend.layouts.mainlayout')
@section('content')
    @component('components.frontend.breadcrumb')
        @slot('title')
            Quiz Attempts
        @endslot
        @slot('item1')
            Home
        @endslot
        @slot('item2')
            Quiz Attempts
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
                                <h3>My Quiz Attempts</h3>
                            </div>
                            <div class="checkout-form">
                                <div class="table-responsive custom-table">

                                    <!-- Referred Users-->
                                    <table class="table table-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Topic</th>
                                            <th>Question</th>
                                            <th>Total Points</th>
                                            <th>Correct Answers</th>
                                            <th>Incorrect Answers</th>
                                            <th>Earned Points</th>
                                            <th>Date</th>
                                            <th>Result</th>
                                            <th>Details</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($quiz_attempts as $key => $quiz_attempt)
                                            @php
                                                $correctPointsPercentage = get_points_percentage($quiz_attempt->total_points,$quiz_attempt->earned_points);
                                            @endphp
                                            <tr>
                                                <td>{{$key+1}}</td>

                                                <td>
                                                    <div class="quiz-table">
                                                        <p>{{ $quiz_attempt->topic?->name}}</p>
                                                    </div>
                                                </td>
                                                <td>{{$quiz_attempt->total_questions}}</td>
                                                <td>{{$quiz_attempt->total_points}}</td>
                                                <td>{{$quiz_attempt->correct_answers}}</td>
                                                <td>{{$quiz_attempt->incorrect_answers}}</td>
                                                <td>{{$quiz_attempt->earned_points}}({{$correctPointsPercentage}}%)
                                                </td>
                                                <td>{{ $quiz_attempt->created_at->format(config('constants.date_format')) }}</td>
                                                <td>
                                                    @if($correctPointsPercentage >= 50)
                                                        <span class="resut-badge badge-light-success">Pass</span>
                                                    @else
                                                        <span class="resut-badge badge-light-danger">Failed</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{route('students.quiz-attempts.result',$quiz_attempt->id)}}"
                                                       class="btn btn-light-danger quiz-view">Details</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">No data found</td>
                                            </tr>
                                        @endforelse
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
