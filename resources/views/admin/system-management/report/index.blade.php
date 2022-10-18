@extends('layouts.master2')
 
@section('content')
   
<div class="col-md-4 navbar pagesearch">
    <form action="/report/search" method="POST" role="search">
        {{ csrf_field() }}
        <div class="searchbar">
            <input class="search_input" type="text" placeholder="Search..." name="q">   
            {{-- <a href="#" class="search_icon"><i class="fas fa-search"></i></a> --}}
            <button type="submit" class="search_icon" style="background-color: transparent;border: none;"><i class="fas fa-search"></i></button>
        </div>
    </form>
</div>

<div class="top-content">
    <div style="float:right;"></div>
    <div><h2 >Employee Reports (<?php echo date('Y'); ?>)</h2></div>
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
    @if(isset($user))
    <table class="table auto-index">
        <tr class="table-secondary">
            <th>No</th>
            <th>EmpId</th>
            <th>Name</th>
            <th>Jan</th>
            <th>Feb</th>
            <th>Mar</th>
            <th>Apr</th>
            <th>May</th>
            <th>Jun</th>
            <th>Jul</th>
            <th>Aug</th>
            <th>Sep</th>
            <th>Oct</th>
            <th>Nov</th>
            <th>Dec</th>
            <th width="116">Total Leaves</th>
        </tr>
        @foreach ($user as $users)
        <tr>
            <td></td>
            <td>{{ $users->emp_id }}</td>
            <td>{{ $users->name }}</td>
            
            <td> 
                @foreach ($attendance as $att)
                <?php $a = date('Y');?>
                
                @if($att->emp_id == $users->emp_id && $att->month == '01' && $att->year == $a)
                    {{ $att->absent }} 
                @endif
                @endforeach
            </td>
            <td> 
                @foreach ($attendance as $att)
                @if($att->emp_id == $users->emp_id && $att->month == '02' && $att->year == $a)
                    {{ $att->absent }} 
                @endif
                @endforeach
            </td>
            <td>
                @foreach ($attendance as $att)
                @if($att->emp_id == $users->emp_id && $att->month == '03' && $att->year == $a)
                    {{ $att->absent }}
                @endif
                @endforeach
            </td>
            <td>
                @foreach ($attendance as $att)
                @if($att->emp_id == $users->emp_id && $att->month == '04' && $att->year == $a)
                    {{ $att->absent }}
                @endif
                @endforeach
            </td>
            <td>
                @foreach ($attendance as $att)
                @if($att->emp_id == $users->emp_id && $att->month == '05' && $att->year == $a)
                    {{ $att->absent }}
                @endif
                @endforeach
            </td>
            <td>
                @foreach ($attendance as $att)
                @if($att->emp_id == $users->emp_id && $att->month == '06' && $att->year == $a)
                    {{ $att->absent }}
                @endif
                @endforeach
            </td>
            <td>
                @foreach ($attendance as $att)
                @if($att->emp_id == $users->emp_id && $att->month == '07' && $att->year == $a)
                    {{ $att->absent }}
                @endif
                @endforeach
            </td>
            <td>
                @foreach ($attendance as $att)
                @if($att->emp_id == $users->emp_id && $att->month == '08' && $att->year == $a)
                    {{ $att->absent }}
                @endif
                @endforeach
            </td>
            <td>
                @foreach ($attendance as $att)
                @if($att->emp_id == $users->emp_id && $att->month == '09' && $att->year == $a)
                    {{ $att->absent }}
                @endif
                @endforeach
            </td>
            <td>
                @foreach ($attendance as $att)
                @if($att->emp_id == $users->emp_id && $att->month == '10' && $att->year == $a)
                    {{ $att->absent }}
                @endif
                @endforeach
            </td>
            <td>
                @foreach ($attendance as $att)
                @if($att->emp_id == $users->emp_id && $att->month == '11' && $att->year == $a)
                    {{ $att->absent }}
                @endif
                @endforeach
            </td>
            <td>
                @foreach ($attendance as $att)
                @if($att->emp_id == $users->emp_id && $att->month == '12' && $att->year == $a)
                    {{ $att->absent }}
                @endif
                @endforeach
            </td>
            <td> 
                @php
                    $sum = 0;
                @endphp
                @foreach ($attendance as $att)
                    @if($att->emp_id == $users->emp_id && $att->year == $a)
                        @php
                        $sum += $att->absent;
                        @endphp
                    @endif
                @endforeach
                {{$sum}}
            </td>
        </tr>
        @endforeach
    </table> 
    {!! $user->links() !!}@endif
    </div>
</div>

@if(isset($details))
    <p class="text-center"> The Search results for <b> {{ $query }} </b> are : <a class="remove-filter-link" href="{{ route('report') }}"> <i class="fas fa-times-circle fa-lg"></i> Clear all </a> </p>
        <div class="main-content"> 
            <div class="container table-responsive p-0"> 
                <table class="table auto-index">
                    <tr class="table-secondary">
                        <th>No</th>
                        <th>EmpId</th>
                        <th>Name</th>
                        <th>Jan</th>
                        <th>Feb</th>
                        <th>Mar</th>
                        <th>Apr</th>
                        <th>May</th>
                        <th>Jun</th>
                        <th>Jul</th>
                        <th>Aug</th>
                        <th>Sep</th>
                        <th>Oct</th>
                        <th>Nov</th>
                        <th>Dec</th>
                        <th width="116">Total Leaves</th>
                    </tr>
                    @foreach ($details as $users)
                    <tr>
                        <td></td>
                        <td>{{ $users->emp_id }}</td>
                        <td>{{ $users->name }}</td>
                        
                        <td> 
                            @foreach ($attendance as $att)
                            <?php $a = date('Y');?>
                            
                            @if($att->emp_id == $users->emp_id && $att->month == '01' && $att->year == $a)
                                {{ $att->absent }} 
                            @endif
                            @endforeach
                        </td>
                        <td> 
                            @foreach ($attendance as $att)
                            @if($att->emp_id == $users->emp_id && $att->month == '02' && $att->year == $a)
                                {{ $att->absent }} 
                            @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($attendance as $att)
                            @if($att->emp_id == $users->emp_id && $att->month == '03' && $att->year == $a)
                                {{ $att->absent }}
                            @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($attendance as $att)
                            @if($att->emp_id == $users->emp_id && $att->month == '04' && $att->year == $a)
                                {{ $att->absent }}
                            @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($attendance as $att)
                            @if($att->emp_id == $users->emp_id && $att->month == '05' && $att->year == $a)
                                {{ $att->absent }}
                            @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($attendance as $att)
                            @if($att->emp_id == $users->emp_id && $att->month == '06' && $att->year == $a)
                                {{ $att->absent }}
                            @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($attendance as $att)
                            @if($att->emp_id == $users->emp_id && $att->month == '07' && $att->year == $a)
                                {{ $att->absent }}
                            @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($attendance as $att)
                            @if($att->emp_id == $users->emp_id && $att->month == '08' && $att->year == $a)
                                {{ $att->absent }}
                            @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($attendance as $att)
                            @if($att->emp_id == $users->emp_id && $att->month == '09' && $att->year == $a)
                                {{ $att->absent }}
                            @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($attendance as $att)
                            @if($att->emp_id == $users->emp_id && $att->month == '10' && $att->year == $a)
                                {{ $att->absent }}
                            @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($attendance as $att)
                            @if($att->emp_id == $users->emp_id && $att->month == '11' && $att->year == $a)
                                {{ $att->absent }}
                            @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($attendance as $att)
                            @if($att->emp_id == $users->emp_id && $att->month == '12' && $att->year == $a)
                                {{ $att->absent }}
                            @endif
                            @endforeach
                        </td>
                        <td> 
                            @php
                                $sum = 0;
                            @endphp
                            @foreach ($attendance as $att)
                                @if($att->emp_id == $users->emp_id && $att->year == $a)
                                    @php
                                    $sum += $att->absent;
                                    @endphp
                                @endif
                            @endforeach
                            {{$sum}}
                        </td>
                    </tr>
                    @endforeach
                </table>
            @if($details){!! $details->render() !!}@endif
            </div>
        </div>    
        
    @elseif(isset($messages))
    <p class="text-center">{{ $messages }} <a class="remove-filter-link" href="{{ route('report') }}"> <i class="fas fa-times-circle fa-lg"></i> Clear all </a> </p>
@endif
@endsection
