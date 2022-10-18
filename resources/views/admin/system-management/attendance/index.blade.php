@extends('layouts.master2')
 
@section('content')
{{-- <div class="col-md-4 navbar pagesearch">
    <form action="/attendance/search" method="POST" role="search">
        {{ csrf_field() }}
        <div class="searchbar">
            <input class="search_input" type="text" placeholder="Search by month or year" name="q">   
            <button type="submit" class="search_icon" style="background-color: transparent;border: none;"><i class="fas fa-search"></i></button>
        </div>
    </form>
</div> --}}

<div class="top-content">
    <div style="float:right;"><a class="btn btn-info btn-sqrt" href="{{ route('master-attendance') }}"> Create Attendance of Month</a> &nbsp;<a class="btn btn-info btn-sqrt" href="{{ route('attendance.create') }}"> Update Daily Attendance</a></div>
    <div><h2 >Attendance</h2></div>
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
    <div class="dispaly-att">
        <div class="dispaly-label">
            <span class="checked"></span> 
        </div>
        
        <div>
            <select class="att-sel filter days-y" name="year" id="filter-year">
            <option value="<?php echo date('Y'); ?>" selected hidden>
                    <?php echo date('Y'); ?>
            </option>
            @for ($year = date('Y') + 1; $year > date('Y') - 6; $year--)
            <option value="{{$year}}">
                {{$year}}
            </option>
            @endfor
            </select>
            
            <select name="month" class="filter att-sel days-m" id="filter-date">
            <option value="<?php echo date('m'); ?>" selected hidden>
                    <?php echo date('F'); ?>
            </option>
            @foreach(range(1,12) as $month)
                <option value="{{date("m", strtotime('2016-'.$month))}}">
                        {{date("F", strtotime('2016-'.$month))}}
                </option>
            @endforeach
            </select>
        </div>
    </div>
   
    <div class="container table-responsive p-0">
    @if(isset($attendance)) 
    <table class="table auto-index" id="myTable">
        <thead>
        <tr class="table-secondary">
            <th>No</th>
            <th>Emp Name</th>
            <th>Present</th>
            <th>Absent </th>
            <th width="200">WorkingDays</th>  
            <th colspan="31"><span id="dayswithdates"></span></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($attendance->sortBy('id') as $att)
        <tr>
            
            <td></td>
            <td>{{ $att->name }}({{ $att->emp_id }})</td>
            <td  style="display:none;" class="year" data-year="{{ $att->year }}">{{ $att->year }}</td>
            <td style="display:none;" class="date" data-date="{{ $att->month }}">{{ $att->month }}</td>
            {{-- @php 
            $p = count(array_keys($att->emp_attendance, "P"));
            $a = count(array_keys($att->emp_attendance, "A"));
            @endphp      --}}
            <td>
                {{-- {{ $p }} --}}
                {{ $att->present }}
            </td>
            <td>
                {{-- {{ $a }} --}}
                {{ $att->absent }}   
            </td>
            <td>
                {{-- {{ $a }} --}}
                {{ $att->working_days }}  
            </td>
            @php  
            foreach ($att->emp_attendance as $att1)
                { 
                    if($att1 != null){
                        if($att1 == 'P')
                        {
                            $p = '<img style="height:16px;cursor: pointer;" src="assets/images/check-mark.png" title="Present">';
                            echo "<td width='100px'>" .$p . "</td>";
                        }elseif($att1 == 'A')
                        {
                            $a = '<img style="height:16px;cursor: pointer;" src="assets/images/delete.png" title="Absent" >';
                            echo "<td width='100px'>" .$a . "</td>"; 
                        }elseif($att1 == 'ML')
                        {
                            $ml = 'ML';
                            echo "<td width='100px' style='color: #1f1310;font-weight: 500;'>" .$ml. "</td>"; 
                        }elseif($att1 == 'CL')
                        {
                            $cl = 'CL';
                            echo "<td width='100px' style='color: #1f1310;font-weight: 500;'>" .$cl. "</td>"; 
                        }elseif($att1 == 'WFH')
                        {
                            $wfh = 'WFH';
                            echo "<td width='100px' style='color: #1f1310;font-weight: 500;'>" .$wfh. "</td>"; 
                        }elseif($att1 == 'OFF')
                        {
                            $off = '<img style="height:35px;width:44px;cursor: pointer;margin-left:-10px;" src="assets/images/off.jpg" title="Day Off" >';
                            echo "<td width='100px'>" .$off. "</td>"; 
                        }elseif($att1 == 'Add')
                        {
                            echo "<td width='100px'>" . '-' ."</td>"; 
                        }
                    }
                }
            @endphp  
              
        </tr>
        @endforeach
    </tbody>
    </table> 
    {!! $attendance->links() !!}
    @endif
    </div>
</div>


@if(isset($details))
    <p class="text-center"> The Search results for <b> {{ $query }} </b> are : <a class="remove-filter-link" href="{{ route('attendance.index') }}"> <i class="fas fa-times-circle fa-lg"></i> Clear all </a></p>
        <div class="main-content"> 
            <div class="container table-responsive p-0"> 
                <table class="table auto-index">
                    <tr class="table-secondary">
                        <th>No</th>
                        <th>EmpId</th>
                        <th>Month</th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>9</th>
                        <th>10</th>
                        <th>11</th>
                        <th>12</th>
                        <th>13</th>
                        <th>14</th>
                        <th>15</th>
                        <th>16</th>
                        <th>17</th>
                        <th>18</th>
                        <th>19</th>
                        <th>20</th>
                        <th>21</th>
                        <th>22</th>
                        <th>23</th>
                        <th>24</th>
                        <th>25</th>
                        <th>26</th>
                        <th>27</th>
                        <th>28</th>
                        <th>29</th>
                        <th>30</th>
                        <th>31</th>
                        <th width="115px">Present Days</th>
                        <th>Absent Days</th>
                    </tr>
                    
                    @foreach($details as $att)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $att->emp_id }}</td>
                        <td>{{ $att->date }} {{ $att->year }}</td>
                        @php  
                        foreach ($att->emp_attendance as $att1)
                                { 
                                    if($att1 != null){
                                        echo "<td>" .$att1 . "</td>";
                                    }else{
                                        echo "<td>" . "-" ."</td>";
                                    }
                                }
                        @endphp 
                        @php 
                            $p = count(array_keys($att->emp_attendance, "p"));
                            $a = count(array_keys($att->emp_attendance, "a"));
                        @endphp     
                        <td>
                            @if($att->present == '')
                                    -
                                @else
                                    {{-- {{ $p }} --}}
                                    {{ $att->present }}
                            @endif
                        </td>
                        <td>
                            @if($att->absent == '')
                                    -
                                @else
                                    {{-- {{ $a }} --}}
                                    {{ $att->absent }}
                            @endif    
                        </td>
                    </tr>
                    @endforeach	
                </table>
                @if($details){!! $details->render() !!}@endif
            </div>
        </div>    
               
        @elseif(isset($messages))
            <p class="text-center">{{ $messages }} <a class="remove-filter-link" href="{{ route('attendance.index') }}"> <i class="fas fa-times-circle fa-lg"></i> Clear all </a></p>
        @endif     
@endsection


@section('scripts')
<script>
	$('.filter').change(function(){    
    filter_function(); 
});
$('table tbody tr').show(); //intially all rows will be shown
function filter_function(){
  $('table tbody tr').hide(); //hide all rows  
  var dateFlag = 0;
  var dateValue = $('#filter-date').val();
  var yearFlag = 0;
  var yearValue = $('#filter-year').val();
  $('table tr').each(function() {  
    if(dateValue == 0){   //if no value then display row
        dateFlag = 1;
    }
    else if(dateValue == $(this).find('td.date').data('date')){ 
        dateFlag = 1;       //if value is same display row
    }
    else{
        dateFlag = 0;
    }
       
    if(yearValue == 0){
        yearFlag = 1;
    }
    else if(yearValue == $(this).find('td.year').data('year')){
        yearFlag = 1;
    }
    else{
        yearFlag = 0;
    }

    if(dateFlag && yearFlag){
     $(this).show();  //displaying row which satisfies all conditions
   }

});
}
</script>

{{-- To get all daysname with dates --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script>
    $(function () {
     $('.days-m,.days-y').change(function () {
    var monthdata =  parseFloat($('.days-m').val());
    var yeardata =  parseFloat($('.days-y').val());
    
    const getDayNames = (month, year) => {
    const daysInMonth = moment(`${month}-01-${year}`, 'MM-DD-YYYY').daysInMonth()
    $('.total').val(daysInMonth);
   
    const names = []
    
    for (let i = 1; i <= daysInMonth; i++) {
      let date = moment(`${month}-${i}-${year}`, 'MM-DD-YYYY')
      let dayName = date.format('ddd')
        names.push("<span style='display: inline-block;width: 80px;'>" + `${date.format('DD')}(${dayName})`+"</span>" )
        document.getElementById("dayswithdates").innerHTML = names.join('');
    } 
  }
  getDayNames(monthdata, yeardata);
    });    
}); 

$(function(){
    $('.days-m,.days-y').change(function(){
        var value1 = $('.days-m').val().replace(",","");
        var value2 = $('.days-y').val().replace(",",""); 
        var monthName = moment.months(value1 - 1); 
        $('.checked').text('(' + monthName +' '+ value2 +')');   
    });
}); 

$(document).ready(function(){
  $(".days-m,.days-y").trigger('change');
});
</script>
@stop