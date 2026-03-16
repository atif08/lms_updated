@extends('layouts.master')

@section('title', __('Course Details'))
@section('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <link href="{{ url('css/courses/course-form-style.css') }}" rel="stylesheet" type="text/css"/>

@endsection
@section('extra-buttons')
    <a href="{{url('enrolled-courses/'.$course->slug)}}" target="_blank" class="btn btn-success float-end">Preview</a>
@endsection

@section('content')
    @component('components.admin.page-title')
        @slot('li_1')
            {{ __('Settings') }}
        @endslot
        @slot('title')
            {{ __('Course Details') }}
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
        </div>
        @if(isset($course) && !empty($course->id))
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">{{ __('Course Builder') }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="sortable accordion" id="sortable-list">
                            @include('admin.courses.components.topic-list')
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>
    @include('components.admin.modals.add_lesson_modal')
    @include('components.admin.modals.add_quiz_modal')
    @include('components.admin.modals.add_topic_modal')

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            function initializeSelect2() {
                $('.select2').select2({
                    width: '100%' // Set the width to 100%
                });
            }
            const settings = {
                animation: 150,
                ghostClass: 'ghost',
                dragClass: 'dragging',
                group: {
                    name: 'main',
                    pull: true,
                    put: false
                },
                fallbackOnBody: true,
                swapThreshold: 0.65,
            }
            const mainList = document.getElementById('sortable-list');
            const childLists = document.querySelectorAll('.child-sortable');
            // Main level Sortable
            new Sortable(mainList, {
                ...settings,
                onEnd: function (evt) {
                    const newOrder = Array.from(evt.item.parentNode.children).map(function (el) {
                        return el.getAttribute('data-topic-id');
                    });
                    $.ajax({
                        url: '{{route('courses.topics.order',$course->id ?? 1)}}', // Replace with your server endpoint
                        method: 'POST',
                        data: {order: newOrder},
                        success: function (response) {
                            console.log('Order saved successfully:', response);
                        }
                    });
                }
            });

            // Child level Sortables
            childLists.forEach(function (el) {
                new Sortable(el, {
                    ...settings,
                    onEnd: function (evt) {
                        const newOrder = Array.from(evt.item.parentNode.children).map(function (el) {
                            return el.getAttribute('data-lesson-id');
                        });
                        $.ajax({
                            url: '{{route('topics.order',$course->id)}}', // Replace with your server endpoint
                            method: 'POST',
                            data: {order: newOrder},
                            success: function (response) {
                                console.log('Order saved successfully:', response);
                            }
                        });
                    }
                });
            });

            //add topic form

            $(document).on('click', '.add-topic-btn', function (e) {
                const url = $(this).attr('data-url');
                e.preventDefault();
                makeGetCall(url, {}, function (response) {
                    $('#addTopicModal .add-topic').html(response);
                    initializeTinyMCE("textarea.elm1");
                    initializeSelect2();


                })
            });

            // Edit topic

            $(document).on('click', '.edit-topic-btn', function (e) {
                const url = $(this).attr('data-url');
                e.preventDefault();
                makeGetCall(url, {}, function (response) {
                    $('#addTopicModal .add-topic').html(response);
                    initializeTinyMCE("textarea.elm1");
                    initializeSelect2();
                })
            });

            /// Add new lesson form
            $(document).on('click', '.add-lesson-btn', function (e) {
                const url = $(this).attr('data-url');
                e.preventDefault();
                makeGetCall(url, {}, function (response) {
                    $('#addLessonModal .add-lesson').html(response);
                    initializeTinyMCE("textarea.elm1");
                    initializeSelect2();

                })
            });
            /// Add  quiz form
            $(document).on('click', '.add-quiz-btn', function (e) {
                const url = $(this).attr('data-url');
                e.preventDefault();

                makeGetCall(url, {}, function (response) {
                    $('#addQuizModal .add-quiz').html(response);
                    initializeTinyMCE("textarea.elm1");


                })
            });
            /// Add new lesson form
            $(document).on('click', '.edit-lesson-btn', function (e) {
                const url = $(this).attr('data-url');
                e.preventDefault();
                makeGetCall(url, {}, function (response) {
                    $('#addLessonModal .add-lesson').html(response);
                    lessonTypeOptions();
                    initializeTinyMCE("textarea.elm1");
                    initializeSelect2();

                })
            });

            /// Save quizz
            $(document).on('click', '.btn-quiz', function (e) {
                e.preventDefault();
                let url = $(this).data('url');
                makePostCall(url, {}, function (r) {
                    $('.btn-close').click();
                    alertify.success(r.message);

                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }, function (r) {
                    alertify.error('Something went wrong');
                })
            });
        });

        function lessonTypeOptions() {
            var lessonType = $('#lessonType').val();
            switch (lessonType) {
                case 'EXTERNAL_LINK':
                    $('.iframe').hide();
                    $('.quiz_link').hide()
                    $('.external_link').show();
                    $('#mediaId').hide();
                    break;
                case 'IFRAME':
                    $('.iframe').show();
                    $('.quiz_link').hide()
                    $('.external_link').hide();
                    $('#mediaId').hide();
                    break;
                case 'MEDIA':
                    $('.iframe').hide();
                    $('.external_link').hide();
                    $('.quiz_link').hide()
                    $('#mediaId').show();

                    break;
                default:

                    break;
            }
        }
    </script>
@endpush
