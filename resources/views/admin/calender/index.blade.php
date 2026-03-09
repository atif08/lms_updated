@extends('layouts.master')

@section('title', __('Calendar Events'))

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.min.css"  media="print"/>
<style>

    .select2-container {
        z-index: 2051; /* Higher than the modal's z-index */
    }

    .select2-container .select2-dropdown {
        z-index: 2052; /* Ensures the dropdown is above the modal content */
    }

</style>
@endsection

@section('content')
    @component('components.admin.page-title')
        @slot('li_1')
            {{ __('Settings') }}
        @endslot
        @slot('title')
            {{ __('Calendar Event List') }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2 p-0 text-right">
                            <a style="margin: 7px"
{{--                               data-bs-toggle="modal"--}}
{{--                               data-bs-target="#addCalendarEventModal"--}}
                               data-url="{{ route('calendars.create') }}"
                               class="btn btn-primary add-event-btn" href="#"><i class="fa fa-plus"></i> Add Event</a>
                        </div>
                    </div>
                    <div class="table-responsive mt-2">
                        <div id="calendar"></div>
                    </div>
                </div>
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
                    <a href="#" id="eventUrl" target="_blank">Visit event page</a>
                </div>
                <div class="p-4" style="text-align: center;">
                    <button type="button"
                            class="btn btn-danger deleteItem"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                            id="deleteEventBtn">
                        Delete
                    </button>

                    <button type="button" class="btn btn-success"
                            data-bs-toggle="modal"
                            data-bs-target="#addCalendarEventModal"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                            id="editEventBtn">
                        Edit
                    </button>
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

            // Event delete handler
            $(document).on('click', '.deleteItem', function (e) {
                e.preventDefault();
                var deleteUrl = $(this).attr('data-url');
                delete_alert().then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: deleteUrl,
                            type: 'DELETE',
                            success: function (response) {
                                success_alert(response.message);
                                // Remove the event from FullCalendar
                                $('#calendar').fullCalendar('removeEvents', response.item.id);
                            },
                            error: function (xhr, status, error) {
                                error_alert('Error deleting event.');
                            }
                        });
                    }
                });
            });

            // Event edit handler
            $(document).on('click', '#editEventBtn', function (e) {
                const url = $(this).attr('data-url');
                e.preventDefault();
                makeGetCall(url, {}, function (response) {
                    $('#addCalendarEventModal .add-event').html(response);
                    $('#addCalendarEventModal').on('shown.bs.modal', function () {
                        // Initialize select2 for the dynamically loaded form fields
                        $('.select2').select2({
                            placeholder: 'Choose ...',
                            allowClear: true,
                            width: '100%',
                        });
                    });
                    // Show the modal
                    $('#addCalendarEventModal').modal('show');
                });
            });

            // Add event button handler
            // Add event button handler
            $(document).on('click', '.add-event-btn', function (e) {
                const url = $(this).attr('data-url');
                e.preventDefault();

                // Make an AJAX call to fetch the form
                makeGetCall(url, {}, function (response) {
                    // Inject the form into the modal's content area
                    $('#addCalendarEventModal .add-event').html(response);
                    // Ensure the modal is fully shown before initializing select2
                    $('#addCalendarEventModal').on('shown.bs.modal', function () {
                        // Initialize select2 for the dynamically loaded form fields
                        $('.select2').select2({
                            placeholder: 'Choose ...',
                            allowClear: true,
                            width: '100%',
                        });
                    });
                    // Show the modal
                    $('#addCalendarEventModal').modal('show');
                });
            });



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
                        description: "{!! str_replace(["\r", "\n"], ' ', $event->description) !!}"
                    },
                    @endforeach
                ],
                editable: true,
                selectable: true,
                selectHelper: true,
                eventClick: function (event, element) {
                    $('#eventTitle').text(event.title || 'No title');
                    $('#eventDescription').text(event.description || 'No description available');
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
