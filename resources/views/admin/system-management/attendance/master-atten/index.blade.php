@extends('layouts.master2')
  
@section('content')

<div class="top-content">
    <div style="float:right;"><a class="btn btn-dark btn-sqrt" href="{{ route('attendance.index') }}"> <i class="fas fa-angle-double-left"></i> Back</a></div>
    <div><h2 >Create Attendance </h2></div>
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

<div class="main-content att" style="padding:20px;">
        @csrf
        <input type="hidden" id="mm" value="<?php echo date('m'); ?>">
        <input type="hidden" id="yy" value="<?php echo date('Y'); ?>">
    
        <div class="text-center p5 mb-1">
            <select class="att-sel" name="" id="year"  required>
                <option value="<?php echo date('Y'); ?>" selected hidden>
                    <?php echo date('Y'); ?>
                </option>
                @for ($year = date('Y') + 1; $year > date('Y') - 6; $year--)
                    <option value="{{$year}}">
                        {{$year}}
                    </option>
                @endfor
            </select>
            
            <select name="month"  id="month" class="att-sel month1"  required>
                <option value="<?php echo date('m'); ?>" selected hidden>
                    <?php echo date('F'); ?>
                </option>
                @foreach(range(1,12) as $month)
                    <option value="{{date("m", strtotime('2016-'.$month))}}">
                        {{date("F", strtotime('2016-'.$month))}}
                    </option>
                @endforeach
            </select>
            
            <button type="submit" id="adduser" class="btn btn-md btn-secondary att-btn">
                Create
            </button> 
            <span id="updatebtn"></span>    
        </div>

        <span id="test"></span>  
         
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 text-center">
                    <span class="err"></span>
                    <span class="update"></span>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>

    <div class="container table-responsive p-0 atten mt-10" id="atten" style="display:none;padding-top:30px !important;">
        <span id="dayswithdates"></span>
        <table id='userTable'>
        <tr>     
            <input type="text" style="display:none;"class="form-control form-group mm"   value="<?php echo date('F'); ?>">    
            <input type="text"  style="display:none;"class="form-control form-group yy"  value="<?php echo date('Y'); ?>">      
            <input type="text" style="display:none;"class="form-control form-group check"  value="<?php echo date('F' .'_');  echo date('Y');?>">     
            <input type="text" style="display:none;"class="form-control form-group total"   value="0">        
            <input type="text" style="display:none;"class="form-control form-group ww"   value="0">          
        </tr>   
        </table> 
    </div>
</div>
@endsection

@section('scripts')
<script> 
$(function () {
     $('.atten').hide();
     $('.month1').change(function () {
        $('.atten').show();
    });
 });

// -----Attendace data------- //
$('#month').change(function() {
    var value1 = $('#month').val()
    $('.mm').val(value1);
});

$('#year').change(function() {
    var value1 = $('#year').val()
    $('.yy').val(value1);
});
</script>

{{-- To get all daysname with dates --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script>
    $(function () {
     $('#month,#year').change(function () {
    var monthdata =  parseFloat($('#month').val());
    var yeardata =  parseFloat($('#year').val());
    
    const getDayNames = (month, year) => {
    const daysInMonth = moment(`${month}-01-${year}`, 'MM-DD-YYYY').daysInMonth()
    $('.total').val(daysInMonth);
   
    const names = []
    
    for (let i = 1; i <= daysInMonth; i++) {
      let date = moment(`${month}-${i}-${year}`, 'MM-DD-YYYY')
      let dayName = date.format('ddd')
        names.push("<span class='calday'>" + `${date.format('DD')}(${dayName})`+"</span>" )
        document.getElementById("dayswithdates").innerHTML = names.join('');
    } 
  }
  getDayNames(monthdata, yeardata);
    });    
});    
</script>


{{-- To concat date and year  --}}
<script>
$(function(){
    $('#month,#year').change(function(){
        var value1 = $('#month').val().replace(",","");
        var value2 = $('#year').val().replace(",",""); 
        var monthName = moment.months(value1 - 1);
        $('.check').val(monthName +'_'+ value2);      
        });
    });    
</script>


{{-- To Check Data is Already exists --}}
<script>
$(function(){
    $('#month,#year').change(function(){
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
                    // alert('true'); 
                    $('.err').html('<label class="exists">Attendance Already Created for ' + month_year.replace(/_/g, ' ') + '</label>');
                    $('#month').addClass('has-error');
					$('#adduser').hide();
                    $('#updatebtn').show();
                    fetchRecords();  
                    
                }else{
                    $('.update').html('<label style="display:none;"></label>');
                    $('.err').html('<label style="display:none;"></label>');
					$('#month').removeClass('has-error');
					$('#adduser').show();
                    $('#updatebtn').hide();
                    addRecords();
                   
                } 
            },
            
            error: function (jqXHR, exception) {

            }
        });
    });
});
</script>

<script>
    $(document).ready(function(){
      $(".month1").trigger('change');
    });
</script>

{{-- To Fetch data --}}
<script>
function fetchRecords(){
    $("#userTable tbody tr").empty();
    var month_year1 = $('.check').val();
    var total = $('.total').val();
    $.ajax({
    url: '{{url('/master-attendance/getUsers')}}',
    type: 'get',
    dataType: 'json',
    success: function(response){
       
        var len = 0;
        if(response['data'] != null){
            len = response['data'].length;
        }

        if(len > 0){
            for(var i=0; i<len; i++)
            {
                var id = response['data'][i].id;
                var month = response['data'][i].month;
                var year = response['data'][i].year;
                var month_year = response['data'][i].month_year;
                var total_days = response['data'][i].total_days;
                var working_days = response['data'][i].working_days;
                var emp_attendance = response['data'][i].emp_attendance;

                $.each(JSON.parse(emp_attendance), function(key, value){
                 
                if(month_year == month_year1)
                {
                    var tr_str1 = "<td>" + "<select class='form-control form-group sel emp_attendance_"+id+"' >" +
                    "<option value='"  + value + "'selected hidden>"  + value + " </option> " +
                    "<option value='P'>P</option>" +
                    "<option value='A'>A</option>" +
                    "<option value='ML'>ML</option>" +
                    "<option value='CL'>CL</option>" +
                    "<option value='WFH'>WFH</option>" +
                    "<option value='OFF'>OFF</option>" +
                    "</select>" + "</td>" +
                    "<input type='hidden'  value='" + month + "' id='month_"+id+"' >" +
                    "<input type='hidden'  value='" + year + "' id='year_"+id+"' >" +
                    "<input type='hidden'  value='" + month_year + "' id='month_year_"+id+"' >" 
                   ;
                   
                   $("#userTable tbody tr").append(tr_str1);
                     
                    var updatebtn = 
                    "<input type='button' value='Update' class='btn btn-md btn-secondary att-btn update' data-id='"+id+"' >";
                    $("#updatebtn").empty().append(updatebtn);

                } 
                });
            } 
        }
        
        else{
            alert("asd");
            var tr_str1 = "<tr class='norecord'>" +
            "<td align='center' colspan='4'>No record found.</td>" +
            "</tr>";

            $("#userTable tbody tr").empty().append(tr_str1);
        }
    }
  });
}
</script>

{{-- To Add Data --}}
<script>
function addRecords(){
    var total = $('.total').val();
    var inputs = '';
        for (var i = 1; i <= total; i++) {
        inputs += 
                    "<td>" +
                    "<select class='form-control form-group sel emp_attendance'>" +
                    "<option value='Add'selected hidden>Add </option> " +
                    "<option value='P'>P</option>" +
                    "<option value='A'>A</option>" +
                    "<option value='ML'>ML</option>" +
                    "<option value='CL'>CL</option>" +
                    "<option value='WFH'>WFH</option>" +
                    "<option value='OFF'>OFF</option>" +
                    "</select>" +
                    "</td>";
        }
        $("#userTable tbody tr").empty().append(inputs);
}

$('#adduser').click(function(){
	var i = 0;
    var attend_det = new Array();
    $('.emp_attendance').each(function(e){
      attend_det[i]=$(this).val();
      i++;
    });
    
    var month       = $('.mm').val();
    var year        = $('.yy').val();
    var month_year  = $('.check').val();
    var total_days     = $('.total').val();
    var working_days  = $('.ww').val();
 
	$.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '{{url('/master-attendance/addUser')}}',
        type: 'post',
        dataType : 'json',
        data: {month: month,year: year,month_year: month_year,attend_det: attend_det,total_days:total_days,working_days:working_days},
        success: function(data){
			
        }
    });
    // $('.emp_attendance').val("");
    $("#test").html("<div class='alert-success'style='padding: 9px 15px 10px !important;'>Attendance Created successfully.</div>");
    window.location = '/attendance';
    // return false;
});
</script>

{{--  Update record --}}
<script>
$(document).on("click", ".update" , function() {
  var edit_id = $(this).data('id');

  var month = $('#month_'+edit_id).val();
  var year = $('#year_'+edit_id).val();
  var month_year = $('#month_year_'+edit_id).val();
  var i = 0;
    var attend_det = new Array();
    $('.emp_attendance_'+edit_id).each(function(e){
      attend_det[i]=$(this).val();
      i++;
    });

    if(month !='' && year != '' && month_year != '' ){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
      url: '{{url('/master-attendance/updateUser')}}',
      type: 'post',
      data: {editid: edit_id,month: month,year: year,month_year: month_year,attend_det:attend_det},
      success: function(response){
        // alert(response);
      }
    });
    $("#test").html("<div class='alert-success'style='padding: 9px 15px 10px !important;'>Attendance Updated successfully.</div>");
    window.location = '/attendance';
  }else{
    alert('Fill all fields');
  }
});
</script>

@stop