@extends('layouts.master2')
 
@section('content')
<div class="col-md-4 navbar pagesearch">
    <form action="/payroll/search" method="POST" role="search">
        {{ csrf_field() }}
        <div class="searchbar">
            <input class="search_input" type="text" placeholder="Search by emp_id or name" name="q">   
            <button type="submit" class="search_icon" style="background-color: transparent;border: none;"><i class="fas fa-search"></i></button>
        </div>
    </form>
</div>

<div class="top-content">
    <div style="float:right;"><a class="btn btn-dark btn-sqrt" href="{{ route('payroll.create') }}"> Add Salary</a></div>
    <div><h2 >List of Employee</h2></div>
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
        @if(isset($salary))  
        <table class="table auto-index">
            <tr class="table-secondary">
                <th>No</th>
                <th>Emp ID</th>
                <th>Emp Name</th>
                <th>Month</th>
                <th>Gross Salary</th>
                <th>Deduction Amount</th>
                <th>Net Pay</th>
                <th>Action</th>
            </tr>
            @foreach($salary as $salaries)
            <tr>
                <td></td>
                <td>
                    {{ $salaries->emp_id }}
                </td>
                <td>
                    {{ $salaries->name }}
                </td>
                <td>
                    {{ $salaries->month }}
                    <?php 
                    
                        // if($salaries->month == 01) echo "January";
                        // if($salaries->month == 02) echo "February";
                        // if($salaries->month == 03) echo "March";
                        // if($salaries->month == 04) echo "April";
                        // if($salaries->month == 05) echo "May";
                        // if($salaries->month == 06) echo "June";
                        // if($salaries->month == 07) echo "July";
                        // if($salaries->month == 08) echo "August";
                        // if($salaries->month == 09) echo "September";
                        // if($salaries->month == 10) echo "October";
                        // if($salaries->month == 11) echo "November";
                        // if($salaries->month == 12) echo "December";
                    ?>
                    {{-- {{ $salaries->month }} --}}
                </td>
                <td>
                    {{ number_format($salaries->basic_salary) }}
                </td>
                <td>
                    {{ number_format($salaries->deduction) }}
                </td>
                <td>
                    {{ number_format($salaries->net_salary) }}
                </td>
                <td>
                    <a href="{{ route('payroll.show',$salaries->id) }}"><i class="fas fa-eye" style="margin-right:20px; color:black;"></i></a>
                </td>
            </tr>
            @endforeach
        </table>
        {!! $salary->links() !!}@endif
    </div>
</div> 

@if(isset($details))
    <p class="text-center"> The Search results for <b> {{ $query }} </b> are : <a class="remove-filter-link" href="{{ route('payroll.index') }}"> <i class="fas fa-times-circle fa-lg"></i> Clear all </a></p>
        <div class="main-content"> 
            <div class="container table-responsive p-0"> 
                <table class="table auto-index">
                    <tr class="table-secondary">
                        <th>No</th>
                        <th>Emp ID</th>
                        <th>Emp Name</th>
                        <th>Month</th>
                        <th>Gross Salary</th>
                        <th>Deduction Amount</th>
                        <th>Net Pay</th>
                        <th>Action</th>
                    </tr>
                    
                    @foreach($details as $salaries)
                    <tr>
                        <td></td>
                        <td>
                            {{ $salaries->emp_id }}
                        </td>
                        <td>
                            {{ $salaries->name }}
                        </td>
                        <td>
                            {{ $salaries->month }}
                        </td>
                        <td>
                            {{ number_format($salaries->basic_salary) }}
                        </td>
                        <td>
                            {{ number_format($salaries->deduction) }}
                        </td>
                        <td>
                            {{ number_format($salaries->net_salary) }}
                        </td>
                        <td>
                            <a href="{{ route('payroll.show',$salaries->id) }}"><i class="fas fa-eye" style="margin-right:20px; color:black;"></i></a>
                        </td>
                    </tr>
                    @endforeach	
                </table>
                @if($details){!! $details->render() !!}@endif
            </div>
        </div>    
              
    @elseif(isset($messages))
    <p class="text-center">{{ $messages }} <a class="remove-filter-link" href="{{ route('payroll.index') }}"> <i class="fas fa-times-circle fa-lg"></i> Clear all </a> </p>
@endif
@endsection



