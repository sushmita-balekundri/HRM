@extends('layouts.master2')

@section('content')
<div class="container mt-4">
    {!! $calendar->calendar() !!}
    {!! $calendar->script() !!}
</div>

@endsection

@section('scripts')
<script>
  $('#calendar_1').fullCalendar({
        header: {
            left: '',
            center: 'title',
            right: ''
        },
        defaultView: 'month',
        editable: true,
        allDaySlot: true,
        selectable: true,
        selectHelper: true,
        selectOverlap: false,
        fixedWeekCount: false,
        showNonCurrentDates: false,
        
        select: function (start, end) {
            var title = "Available";
            var evid = SaveEvent(start, end, '1');
            $('#calendar_1').fullCalendar('unselect');
        },
        eventClick: function (calEvent, jsEvent, view) {
            var ev_id = calEvent.ID;
            var st_dt = calEvent.start;
            var ed_dt = calEvent.end;
            infoEventShow('1', ev_id, st_dt, ed_dt);
        },
        slotMinutes: 15,
        events: '/Aircrew/GetEvents/',
        eventColor: '#339900',
        
    });
</script>
@stop
