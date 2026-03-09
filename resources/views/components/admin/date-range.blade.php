<div id="date-range" data-name="{{$filter_column}}" class="btn btn-primary calender-di"
     data-start-date="{{ $date_object->getFromDate()->format('Y-m-d') }}"
     data-end-date="{{ $date_object->getToDate()->format('Y-m-d') }}">
    <i class="fas fa-calendar-alt"></i> | <span>{{ $date_object->displayRange() }}</span>
</div>
