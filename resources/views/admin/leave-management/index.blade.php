@extends('layouts.master2')
 
@section('content')
<div class="col-md-4 navbar pagesearch">
    <form action="/leave/search" method="POST" role="search">
        {{ csrf_field() }}
        <div class="searchbar">
            <input class="search_input" type="text" placeholder="Search..." name="q">   
            <button type="submit" class="search_icon" style="background-color: transparent;border: none;"><i class="fas fa-search"></i></button>
        </div>
    </form>
</div>

<div class="top-content">
    <div><h2 >Leave Requests </h2></div>
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
    </div>
@endif

<div class="main-content"> 
    <div class="container table-responsive p-0"> 
    @if(isset($leave))    
    <table class="table auto-index">
        <tr class="table-secondary">
            <th>No</th>
            <th width="115px">Name</th>
            <th width="115px">Emp Id</th>
            <th>Reason</th>
            <th width="115px">Date from</th>
            <th width="115px">Date to</th>
            <th width="115px">No. of days</th>
            <th width="160px">Sataus of Leave</th>
        </tr>
      
        @foreach ($leave as $leaves)
        <tr>
            <td></td>
            <td>{{ $leaves->name }}</td>
            <td>{{ $leaves->emp_id }}</td>
            <td>{{ $leaves->reason }}</td>
            @php $date=date_create($leaves->date_from); @endphp
            <td>{{date_format($date,"d/m/Y")}}</td>
            @php $date=date_create($leaves->date_to); @endphp
            <td>{{date_format($date,"d/m/Y")}}</td>
            <td>{{ $leaves->days }}</td>
            <td>
                @if($leaves->status == 'approved')
                    <span class="badge badge-success">Approved</span>
                @elseif($leaves->status == 'rejected')
                    <span class="badge badge-danger">Rejected</span>
                @elseif($leaves->status == 'cancel')
                    <span class="badge badge-can">Cancelled</span>
                @elseif($leaves->status == 'pending' && strtotime($leaves->date_to) < strtotime('-8 days'))
                    <span class="badge badge-danger">Expired</span>
                @else
                <form action="{{ route('leave.update', $leaves->id) }}" method="POST" class="form-group status">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="approved" />
                    <button type="submit" class="btn btn-warning btn-sm btn-sqrt">Approve</button>
                </form>
                <form action="{{ route('leave.update', $leaves->id) }}" method="POST" class="form-group">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="rejected" />
                    <button type="submit" class="btn btn-warning btn-sm btn-sqrt">Reject</button>
                </form>
                @endif   
            </td>
        </tr>
        @endforeach
    </table>  
    {!! $leave->links() !!}@endif
    </div>
</div> 

@if(isset($details))
    <p class="text-center"> The Search results for <b> {{ $query }} </b> are : <a class="remove-filter-link" href="{{ route('leave.index') }}"> <i class="fas fa-times-circle fa-lg"></i> Clear all </a></p>
        <div class="main-content"> 
            <div class="container table-responsive p-0"> 
                <table class="table auto-index">
                    <tr class="table-secondary">
                        <th>No</th>
                        <th width="115px">Name</th>
                        <th width="115px">Emp Id</th>
                        <th>Reason</th>
                        <th width="115px">Date from</th>
                        <th width="115px">Date to</th>
                        <th width="115px">No. of days</th>
                        <th width="160px">Sataus of Leave</th>
                    </tr>
                    
                    @foreach ($details as $leaves)
                    <tr>
                        <td></td>
                        <td>{{ $leaves->name }}</td>
                        <td>{{ $leaves->emp_id }}</td>
                        <td>{{ $leaves->reason }}</td>
                        @php $date=date_create($leaves->date_from); @endphp
                        <td>{{date_format($date,"d/m/Y")}}</td>
                         @php $date=date_create($leaves->date_to); @endphp
                        <td>{{date_format($date,"d/m/Y")}}</td>
                        <td>{{ $leaves->days }}</td>
                        <td>
                        @if($leaves->status == 'approved')
                            <span class="badge badge-success">Approved</span>
                        @elseif($leaves->status == 'rejected')
                            <span class="badge badge-danger">Rejected</span>
                        @elseif($leaves->status == 'cancel')
                            <span class="badge badge-can">Cancelled</span>
                        @else
                        <form action="{{ route('leave.update', $leaves->id) }}" method="POST" class="form-group status">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="approved" />
                        <button type="submit" class="btn btn-warning btn-sm btn-sqrt">Approve</button>
                        </form>
                        <form action="{{ route('leave.update', $leaves->id) }}" method="POST" class="form-group">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="rejected" />
                        <button type="submit" class="btn btn-warning btn-sm btn-sqrt">Reject</button>
                        </form>
                    @endif   
                    </td>
                    </tr>
                @endforeach
                </table>
                @if($details){!! $details->render() !!}@endif
            </div>
        </div>    
           
        @elseif(isset($messages))
            <p class="text-center">{{ $messages }} <a class="remove-filter-link" href="{{ route('leave.index') }}"> <i class="fas fa-times-circle fa-lg"></i> Clear all </a></p>
        @endif
@endsection