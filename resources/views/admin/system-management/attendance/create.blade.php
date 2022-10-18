@extends('layouts.master2')
   
@section('content')

<div class="top-content">
    <div style="float:right;"><a class="btn btn-dark btn-sqrt" href="{{ route('attendance.index') }}"> <i class="fas fa-angle-double-left"></i> Back</a></div>
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
        <span class="updateattn">Update Attendance <span class="checked"></span></span>
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
    </div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
            <span class="err"></span>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

<div class="main-content create" style="padding:20px;display:none;">    
    <form action="{{ route('attendance.store') }}" method="POST">
        @csrf
        <div class="container table-responsive p-0 att">
            <input type="hidden" class="form-control form-group check">
            <table class="table auto-index" id="addTable">
                <thead>
                    <th>No</th>
                    <th>EmpId</th>
                    <th colspan="31"><span id="dayswithdates"></span></th>
                    <th>Present</th>
                    <th>Absent</th>
                    <th>TotalDays</th> 
                    <th>WorkingDays</th>      
                </thead> 
                <tr></tr>   
            </table> 
        
            <div class="form-group row mb-3">
                <div class="col-md-6 offset-md-0">
                    <button type="submit" class="btn btn-primary">
                        Update Daily Attendance
                    </button>
                </div>
            </div>
        </div>   
    </form>
</div>


<div class="main-content update" style="padding:20px;display:none;">
    <form action="{{ route('attendance.update1') }}" method="POST">
        @csrf
        <div class="container table-responsive p-0 att">
            <span class="totalno1"></span> 
            <table class="table auto-index" id="userTable">  
                <thead>
                    <th>No</th>
                    <th>EmpId</th>
                    <th colspan="31"><span id="dayswithdates1"></span></th>
                    <th>Present</th>
                    <th>Absent</th>
                    <th>TotalDays</th> 
                    <th>WorkingDays</th>      
                </thead> 
                <tr></tr>           
            </table>

            <div class="form-group row mb-3">
            <div class="col-md-6 offset-md-0">
                <button type="submit" class="btn btn-primary">
                    Update Daily Attendance
                </button>
            </div>
            </div>
        </div>   
    </form>
</div>
@endsection


@section('scripts')
<script>
$(function(){
    $('.days-m,.days-y').change(function(){
        var value1 = $('.days-m').val().replace(",","");
        var value2 = $('.days-y').val().replace(",",""); 
        $('.month').val(value1); 
        $('.year').val(value2); 

        var monthName = moment.months(value1 - 1);
        $('.check').val(monthName +'_'+ value2);   
        $('.checked').text('(' + monthName +' '+ value2 +')'); 
        });
    });     
</script>

<script>
function check(){
    var month_year = $('.check').val();
        
    $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: '{{url('/masterattendance/checkdate')}}?month=' + month_year,
            data: {month_year:month_year},
            dataType: "json",
            success: function(res) {
                if(res.exists){ 
                    $('.create').show();
                    addRecords();
                }else{
                    $('.err').html('<label class="exists">No Master table Found For ' + month_year.replace(/_/g, ' ') +'..! </label>');
                } 
            },
            error: function (jqXHR, exception) {
            }
    });
}

$(function(){
    $('.days-m,.days-y').change(function(){
        var month_year = $('.check').val();
        $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '{{url('/attendance/checkdate')}}?month=' + month_year,
                data: {month_year:month_year},
                dataType: "json",
                success: function(res) {
                    if(res.exists){
                        $('.err').html('<label style="display:none;"></label>');
                        $('.update').show();
                        $('.create').hide();
                        upRecords();
                    }else{
                        check();
                        $('.err').html('<label style="display:none;"></label>');
                        $('.create').hide();
                        $('.update').hide();  
                    }  
                },
               
                error: function (jqXHR, exception) {
    
                }
        });
    });
});
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
    $('.totalno1').val(daysInMonth);
    
    const names = []
    
    for (let i = 1; i <= daysInMonth; i++) {
      let date = moment(`${month}-${i}-${year}`, 'MM-DD-YYYY')
      let dayName = date.format('ddd')
        names.push("<span style='display: inline-block;width: 121px;'>" + `${date.format('DD')}(${dayName})`+"</span>" )
        document.getElementById("dayswithdates").innerHTML = names.join('');
        document.getElementById("dayswithdates1").innerHTML = names.join('');
    } 
  }
  getDayNames(monthdata, yeardata);
    });    
}); 
</script>

<script>
    $(document).ready(function(){
      $(".sel,.check,select").trigger('change');
    });
</script>
 

<script>
function addRecords(){
    var total = $('.totalno1').val();
    var month_year = $('.check').val();
    var inputs = '';
    var data1 = <?=  $users;?>;
    var data2 = <?=  $attendance;?>;

    for(x in data1) { 
        for(y in data2) {
            if(data2[y].month_year == month_year)
            {
                inputs += "<tr><td></td><td>"+data1[x].emp_id+"</td>";
                for(var i= 1; i <= total;  i++)     
                { 
                    inputs += 
                       "<td>" +
                       "<select class='form-control form-group sel emp_attendance' name='emp_attendance["+x+"][" +i+"]'>" +
                       "<option value='"+data2[y].emp_attendance[i]+"'selected hidden>"+ data2[y].emp_attendance[i] +"</option> " +
                       "<option value='P'>P</option>" +
                       "<option value='A'>A</option>" +
                       "<option value='ML'>ML</option>" +
                       "<option value='CL'>CL</option>" +
                       "<option value='WFH'>WFH</option>" +
                       "<option value='OFF'>OFF</option>" +
                       "</select>" +
                       "</td>" ;
                }
                inputs +=
                    "<td><input type='hidden' class='form-control form-group'  name='emp_id["+x+"]' value='"+ data1[x].emp_id +"'></td>" +      
                    "<td><input type='hidden' class='form-control form-group'  name='name["+x+"]' value='"+ data1[x].name +"'></td>" +      
                    "<td><input type='text' class='form-control form-group'  name='present["+x+"]' value='0'></td>"+
                    "<td><input type='text' class='form-control form-group'  name='absent["+x+"]' value='0'></td>" +
                    "<td><input type='text' class='form-control form-group'  name='total_days["+x+"]' value='"+ data2[y].total_days +"'></td>" +
                    "<td><input type='text' class='form-control form-group'  name='working_days["+x+"]' value='"+ data2[y].working_days +"'></td>" +      
                    "<td><input type='hidden' class='form-control form-group month'  name='month["+x+"]' value='"+ data2[y].month +"'></td>" +      
                    "<td><input type='hidden' class='form-control form-group year'  name='year["+x+"]' value='"+ data2[y].year +"'></td>" +      
                    "<td><input type='hidden' class='form-control form-group check'  name='month_year["+x+"]' value='"+ data2[y].month_year +"'></td>"
                    +
                    "</tr>";
            }  
        } 
    }    
    $("#addTable tbody").empty().append(inputs);       
} 

function upRecords(){
    var month_year = $('.check').val();
    var total = $('.totalno1').val();
    var k = 0;
    var inputs = '';
    var data1 = <?=  $attend;?>;
    var data2 = <?=  $attendance;?>;
   
    for(x in data1) {
        for(y in data2) {
            if(data1[x].month_year  == month_year && data2[y].month_year  == month_year){   
                inputs += "<tr><td></td><td>"+data1[x].emp_id+"</td>"  ;
                    for(var i= 1; i <= total;  i++)     {  
                        if(data2[y].emp_attendance[i] == 'Add'){   
                        inputs += 
                        "<td>" +
                        "<select class='form-control form-group sel emp_attendance"+x+"' onchange='count()' name='emp_attendance["+x+"][" +i+"]'>" +
                        "<option value='"+data1[x].emp_attendance[i]+"'selected hidden>"+ data1[x].emp_attendance[i] +"</option> " +
                        "<option value='P'>P</option>" +
                        "<option value='A'>A</option>" +
                        "<option value='ML'>ML</option>" +
                        "<option value='CL'>CL</option>" +
                        "<option value='WFH'>WFH</option>" +
                        "<option value='OFF'>OFF</option>" +
                        "</select>" +
                        "</td>" ;
                        }else{
                            inputs += 
                        "<td>" +
                        "<select class='form-control form-group sel emp_attendance"+x+"' onchange='count()' name='emp_attendance["+x+"][" +i+"]'>" +
                        "<option value='"+data2[y].emp_attendance[i]+"'selected hidden>"+ data2[y].emp_attendance[i] +"</option> " +
                        "<option value='P'>P</option>" +
                        "<option value='A'>A</option>" +
                        "<option value='ML'>ML</option>" +
                        "<option value='CL'>CL</option>" +
                        "<option value='WFH'>WFH</option>" +
                        "<option value='OFF'>OFF</option>" +
                        "</select>" +
                        "</td>";
                        }
                    }
                        inputs += 
                        "<td><input type='text' class='form-control form-group cnt-p"+x+"' name='present["+x+"]' value='"+ data1[x].present +"'></td>"+
                        "<td><input type='text' class='form-control form-group cnt-a"+x+"'  name='absent["+x+"]' value='"+ data1[x].absent +"'></td>" +
                        "<td><input type='text' class='form-control form-group'  name='total_days["+x+"]' value='"+ data1[x].total_days +"'></td>" +
                        "<td><input type='text' class='form-control form-group cnt-w"+x+"'  name='working_days["+x+"]' value='"+ data1[x].working_days +"'></td>" +      
                        // "<td><input type='hidden' class='form-control form-group'  name='emp_id["+x+"]' value='"+ data1[x].emp_id +"'></td>" +      
                        // "<td><input type='hidden' class='form-control form-group month'  name='month["+x+"]' value='"+ data1[x].month +"'></td>" +      
                        // "<td><input type='text' class='form-control form-group year'  name='year["+x+"]' value='"+ data1[x].year +"'></td>" +      
                        "<td><input type='hidden' class='form-control form-group check'  name='month_year["+x+"]' value='"+ data1[x].month_year +"'></td>"
                        +
                        "</tr>";
                }
            } 
        }
    $("#userTable tbody").empty().append(inputs);       
} 
</script>

<script>
function count(){
    var data1 = <?=  $attend;?>;
    for(x in data1) {   
    var allSelects = $('.emp_attendance'+x);
    var p = 0;
    var a = 0;
    var w = 0
    $.each(allSelects, function(i, s) {
        // increase count
        if($(s).val() == 'P') { p++; }
        if($(s).val() == 'A') { a++; }
        if($(s).val() == 'OFF') { w++; }
    });
    
    var ww =  data1[x].total_days - w;
    $('.cnt-p'+x).val(p);
    $('.cnt-a'+x).val(a);
    $('.cnt-w'+x).val(ww);
    }
}
</script>
@stop

