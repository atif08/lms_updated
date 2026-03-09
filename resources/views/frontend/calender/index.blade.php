<?php $page = 'course-grid'; ?>
@extends('frontend.layouts.mainlayout')
@section('content')
    @component('components.frontend.breadcrumb')
        @slot('title')
            Calender
        @endslot
        @slot('item1')
            Home
        @endslot
        @slot('item2')
            Calendar
        @endslot
    @endcomponent

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.min.css"
          media="print"/>
@endsection

<div class="page-content">
    <div class="container">
        <div class="row">

        @component('components.frontend.sidebar')
        @endcomponent
        <!-- Student Profile -->
            <div class="col-xl-9 col-lg-9">
                <div class="settings-widget card-details p-2">
                    <div id="calendar"></div>
                </div>
            </div>
            <!-- Student Profile -->

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

@include('components.admin.modals.add_calendar_event')
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
                        @foreach($calendarEvents as $event)
                    {
                        id: '{{ $event->id }}',
                        title: '{{ $event->title }}',
                        eventUrl: '{{ $event->url }}',
                        start: '{{ $event->start_datetime }}',
                        end: '{{ $event->end_datetime }}',
                        startDateTime: '{{ $event->start_datetime }}',
                        endDateTime: '{{ $event->end_datetime }}',
                        description: '{{ $event->description }}'
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
                var events = @json($calendarEvents);
                var filteredEvents = events.filter(function (event) {
                    return type === 'all' || event.type === type;
                });
                $('#calendar').fullCalendar('removeEvents');
                $('#calendar').fullCalendar('addEventSource', filteredEvents);
            };
        });
    </script>

@endpush
