@extends('layouts.master2')

@section('content')
<div class="col-md-4 navbar pagesearch">
    <form action="/event/search" method="POST" role="search">
        {{ csrf_field() }}
        <div class="searchbar">
                <input class="search_input" type="text" placeholder="Search by year" name="q">   
                {{-- <a href="#" class="search_icon"><i class="fas fa-search"></i></a> --}}
                <button type="submit" class="search_icon" style="background-color: transparent;border: none;"><i class="fas fa-search"></i></button>
            </div>
    </form>
</div>

<div class="top-content">
    <div style="float:right;"><a class="btn btn-dark btn-sqrt" href="{{route('event-add')}}"> Add Event</a></div>
    <div>
        <h2>List of Events</h2>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
    <p></p>
</div>
@endif

<div class="main-content">
    <div class="container table-responsive p-0">
        @if(isset($event))
        <table class="table auto-index">
            <tr class="table-secondary">
                <th>No</th>
                <th>Event</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>

            @foreach ($event as $ev)
            <tr>
                <td></td>
                <td>{{ $ev->event_name }}</td>
                @php $date=date_create($ev->start_date); @endphp
                <td>{{date_format($date,"d/m/Y")}}</td>
                @php $date=date_create($ev->end_date); @endphp
                <td>{{date_format($date,"d/m/Y")}}</td>
            </tr>
            @endforeach
        </table>
        {!! $event->links() !!}@endif
    </div>
</div>

@if(isset($details))
    <p class="text-center"> The Search results for <b> {{ $query }} </b> are : <a class="remove-filter-link" href="{{ route('event-index') }}"> <i class="fas fa-times-circle fa-lg"></i> Clear all </a></p>
        <div class="main-content"> 
            <div class="container table-responsive p-0"> 
                <table class="table auto-index">
                    <tr class="table-secondary">
                        <th>No</th>
                        <th>Event</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                    </tr>
                    
                    @foreach ($details as $ev)
                    <tr>
                        <td></td>
                        <td>{{ $ev->event_name }}</td>
                        @php $date=date_create($ev->start_date); @endphp
                        <td>{{date_format($date,"d/m/Y")}}</td>
                        @php $date=date_create($ev->end_date); @endphp
                        <td>{{date_format($date,"d/m/Y")}}</td>
                    </tr>
                    @endforeach	
                </table>
                @if($details){!! $details->render() !!}@endif
            </div>
        </div>    
        
        
        @elseif(isset($messages))
            <p class="text-center">{{ $messages }} <a class="remove-filter-link" href="{{ route('event-index') }}"> <i class="fas fa-times-circle fa-lg"></i> Clear all </a> </p>
        @endif
@endsection