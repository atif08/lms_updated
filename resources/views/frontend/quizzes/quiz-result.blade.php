<?php $page = 'quiz result'; ?>
@extends('frontend.layouts.mainlayout')
@section('content')
    @component('components.frontend.breadcrumb')
        @slot('title')
            Quiz Result
        @endslot
        @slot('item1')
            Home
        @endslot
        @slot('item2')
            {{$quiz_attempt->quiz->name}}
        @endslot
    @endcomponent
    <!-- Page Content -->
    <div class="page-content">
        <div class="container">
            @include('admin.quizzes.attempts.quiz-result-partial')

        </div>
    </div>
    <!-- Event Modal -->
@endsection


@push('scripts')


@endpush
