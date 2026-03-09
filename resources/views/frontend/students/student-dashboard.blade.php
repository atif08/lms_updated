<?php $page = 'student-dashboard'; ?>
@extends('frontend.layouts.mainlayout')
@section('style')
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.min.css"
          media="print"/>
    <style>
        body {
            background-color: #f7f7f7;
            /* font-family: 'Arial', sans-serif; */
        }

        .dashboard-header {

            background-size: cover;
            background-position: center;
            color: #fff;
            padding: 20px;
            display: flex;
            border-radius: 10px;
        }

        .dashboard-header img {
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .dashboard-header h4 {
            margin-bottom: 5px;
        }

        .dashboard-header p {
            font-size: 14px;
        }

        .dashboard-box {
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            color: #fff;
            cursor: pointer;
        }


        .dashboard-box:hover {
            opacity: 0.9;
        }

        .calendar-container {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .card-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .dashboard-card {
            flex: 1;
            max-width: 32%;
            margin: 20px;
            text-align: center;
            padding: 70px;
            border-radius: 10px;
            /* background-color: #f5f5ff; */
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-10px);
        }

        .dashboard-card h2 {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        .dashboard-card p {
            font-weight: bold;
            /* color: #7b87a3; */
        }

        /* .card-bg {
             background-color: #eef3ff;
             color: #1D1D56;
         } */

        .text-white {
            color: white;
        }

        .custom-font-size {
            font-size: 20px;
        }

        .dashboard-icon {
            font-size: 2rem;
            margin-bottom: 10px;
            width: 60px;
            height: 60px;
            line-height: 60px;
            border-radius: 50%;
            background-color: #fff;
            display: inline-block;
            color: inherit;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        .img-styles {
            height: 90px;
            width: 90px;
        }

        .moving-text-banner {
      white-space: nowrap;
      overflow: hidden;
      /* background-color: #1d1d56;  */
      color: white;
      padding: 10px 0;
      font-size: 1.25rem;
      font-weight: 600;
    }

    .moving-text {
      display: inline-block;
      padding-left: 100%; /* Start from outside the screen */
      animation: initialLoad 2s ease-out, slowScroll 20s linear infinite;
    }

    @keyframes initialLoad {
      0% {
        transform: translateX(100%);
      }
      100% {
        transform: translateX(0); /* Quickly move into view */
      }
    }

    @keyframes slowScroll {
      0% {
        transform: translateX(0);
      }
      100% {
        transform: translateX(-100%); /* Slowly scroll out of view */
      }
    }

        @media (max-width: 992px) {
            .dashboard-card {
                max-width: 100%;
                padding: 25px;
            }
            .card-container{
                justify-content: center;
            }
        }


    </style>
@endsection
@section('content')
    @component('components.frontend.breadcrumb')
        @slot('title')
            Dashboard
        @endslot
        @slot('item1')
            Home
        @endslot
        @slot('item2')
            Dashboard
        @endslot
    @endcomponent


    <!-- Page Content -->
    <div class="page-content">
        <div class="container">
              <!-- Moving Text Banner -->
  <div class="w-100 moving-text-banner">
    <div class="moving-text">
       {!!$latest_announcement?->announcement!!}
    </div>
  </div>

            <div class="dashboard-header mt-4">
                <img class="img-styles" src="{{get_image(Auth::user()->media)}}" alt="User Avatar">
                <div class="p-3">
                    <h4 class="text-white">{{Auth::user()->name}}</h4>
                    <p>{{Auth::user()->email}}</p>
                </div>

            </div>

            <div class="card-container custom-font-size">

                <a href="{{route('students.get.profile')}}" class="dashboard-card card-bg">
                    <div class="dashboard-icon">
                        <i class="bx bxs-user"></i>
                    </div>

                    <p>MY PROFILE</p>
                </a>
                <a href="{{ route('courses.get.enrolled') }}" class="dashboard-card card-bg">
                    <div class="dashboard-icon">
                        <i class="bi bi-mortarboard"></i>
                    </div>
                    {{-- <h2>9</h2> --}}
                    <p>ENROLLED COURSES</p>
                </a>
                <a href="{{ route('students.get.quiz-attempts') }}" class="dashboard-card card-bg">
                    <div class="dashboard-icon">
                        <i class="bx bxs-shapes"></i>
                    </div>
                    {{-- <h2>1</h2> --}}
                    <p>QUIZ ATTEMPTS</p>
                </a>
            </div>

            <div class="row mt-4">
                <!-- Calendar Component Goes Here -->
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    <!-- Event Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <p><strong>Title:</strong> <span id="eventTitle" class="text-capitalize"></span></p>
                    <p><strong>Description:</strong> <span id="eventDescription"></span></p>
                    <p><strong>Time:</strong> <span id="eventTime"></span></p>
                    <a href="#" id="eventUrl" style="color: cornflowerblue" target="_blank">Visit event page</a>
                </div>
                <div class="p-4" style="text-align: center;">
                    {{--                <button type="button" class="btn btn-danger deleteItem"--}}
                    {{--                        data-bs-dismiss="modal"--}}
                    {{--                        aria-label="Close"--}}
                    {{--                        id="deleteEventBtn">--}}
                    {{--                    Delete--}}
                    {{--                </button>--}}

                    {{--                <button type="button" class="btn btn-success"--}}
                    {{--                        data-bs-toggle="modal"--}}
                    {{--                        data-bs-target="#addCalendarEventModal"--}}
                    {{--                        data-bs-dismiss="modal"--}}
                    {{--                        aria-label="Close"--}}
                    {{--                        id="editEventBtn">--}}
                    {{--                    Edit--}}
                    {{--                </button>--}}
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            aria-label="Close">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/gcal.min.js"></script>
    <script>

        $(document).ready(function () {
            var baseUrl = '{{ url('/') }}';
            // Initialize FullCalendar
            $('#calendar').fullCalendar({
                events: [
                        @foreach($calendar_events as $event)
                    {
                        id: '{{ $event->id }}',
                        title: '{{ $event->title }}',
                        eventUrl: '{{ $event->url }}',
                        start: '{{ $event->start_datetime }}',
                        end: '{{ $event->end_datetime }}',
                        startDateTime: '{{ $event->start_datetime }}',
                        endDateTime: '{{ $event->end_datetime }}',
                        description: "{!! str_replace(["\r", "\n"], ' ', $event->description) !!}"
                    },
                    @endforeach
                ],
                editable: true,
                selectable: true,
                selectHelper: true,
                eventClick: function (event, element) {
                    $('#eventTitle').text(event.title || 'No title');
                    $('#eventDescription').html(event.description || 'No description available');
                    // Check if start and end dates are available and format them
                    if (event.startDateTime && event.endDateTime) {
                        var formattedStart = moment(event.startDateTime).format('ddd, MMM D - hh:mm A');
                        var formattedEnd = moment(event.endDateTime).format('ddd, MMM D - hh:mm A');
                        $('#eventTime').text(formattedStart + ' to ' + formattedEnd);
                    } else {
                        $('#eventTime').text('No start or end time available');
                    }
                    $('#eventUrl').attr('href', event.eventUrl || '#');
                    $('#deleteEventBtn').attr('data-url', event.id ? baseUrl + '/admin/calendars/' + event.id : '#');
                    $('#editEventBtn').attr('data-url', event.id ? baseUrl + '/admin/calendars/' + event.id + '/edit' : '#');
                    $('#eventModal').modal('show');
                },
                eventDrop: function (event) {
                    // AJAX request to update event in the database
                },
                eventResize: function (event) {
                    // AJAX request to update event in the database
                }
            });
            $('.fc-today-button').addClass('btn btn-primary');


            window.filterEvents = function (type) {
                var events = @json($calendar_events);
                var filteredEvents = events.filter(function (event) {
                    return type === 'all' || event.type === type;
                });
                $('#calendar').fullCalendar('removeEvents');
                $('#calendar').fullCalendar('addEventSource', filteredEvents);
            };
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var dashboardHeader = document.querySelector('.dashboard-header');
            var movingTextBanner = document.querySelector('.moving-text-banner');
            var currentUrl = window.location.href;

            if (currentUrl.includes('portal.astiacademy.ac.ae')) {
                dashboardHeader.style.backgroundImage = "url('/frontend/img/Asti-Bg.png')";
                movingTextBanner.style.backgroundColor = '#e42327';
            } else {
                dashboardHeader.style.backgroundImage = "url('/frontend/img/buc-Bg.png')";
                movingTextBanner.style.backgroundColor = '#1d1d56';

            }
        });
    </script>

@endpush
