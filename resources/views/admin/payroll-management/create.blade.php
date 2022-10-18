@extends('layouts.master2')
  
@section('content')

<div class="top-content">
    <div style="float:right;"><a class="btn btn-dark btn-sqrt" href="{{ route('payroll.index') }}"> <i class="fas fa-angle-double-left"></i> Back</a></div>
    <div><h2 >Add Salary</h2></div>
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
   
<div style="padding:20px;">
    <form action="{{ route('payroll.store') }}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Employee Id</label>
            <div class="col-md-6">
                <select class="form-control form-group show total" name="emp_id" id="emp_id" onchange="">
                    <option value="" selected hidden> Select </option>
                    @foreach ($user->sortBy('emp_id') as $emp)
                        <option value="{{ $emp->emp_id}}"> {{ $emp->emp_id}}  </option>
                    @endforeach
                </select>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

       
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Name</label>
            <div class="col-md-6">
                <input type="text" id="name" class="form-control @error('email') is-invalid @enderror" name="name" value="" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Month</label>
            <div class="col-md-3 mr-3">
                <select name="month"  id="month" class="total salary-pay" required>
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
            <div class="col-md-3">
                <select class="total salary-pay" name="year" id="year" required>
                    <option value="<?php echo date('Y'); ?>" selected hidden>
                        <?php echo date('Y'); ?>
                    </option>
                @for ($year = date('Y'); $year > date('Y') - 20; $year--)
                <option value="{{$year}}">
                    {{$year}}
                </option>
                @endfor
                </select>
            </div>
        </div>
        
        <div class="text-center mb-3" id="block" style="margin-left:150px;">
            Gross Salary for this Employee is : <b><span id="value1"></span></b>
        </div>
        
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Gross Salary</label>
            <div class="col-md-6">
                <input type="text" id="data" class="form-control @error('email') is-invalid @enderror show1" name="basic_salary" value="" placeholder="Enter Gross Salary " required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row block1">
            <label for="email" class="col-md-4 col-form-label text-md-right">Professional Tax</label>
            <div class="col-md-6">
                <input type="text" id="tax" class="form-control @error('email') is-invalid @enderror" name="tax" value="" required readonly>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row block1">
            <label for="email" class="col-md-4 col-form-label text-md-right">ESI</label>
            <div class="col-md-6">
                <input type="text" id="esi" class="form-control @error('email') is-invalid @enderror" name="esi" value="" required readonly>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row block1">
            <label for="email" class="col-md-4 col-form-label text-md-right">PF</label>
            <div class="col-md-6">
                <input type="text" id="pf" class="form-control @error('email') is-invalid @enderror" name="pf" value="" required readonly>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <input type="hidden" class="form-control @error('email') is-invalid @enderror" id="totaldays" name="total_working_days" value="" required>
        
        <input type="hidden" class="form-control @error('email') is-invalid @enderror" id="presentdays" name="present_days" value="" required>

        <input type="hidden" class="form-control @error('email') is-invalid @enderror" id="lopdays" name="lop_days" value="0" required>

        <input type="hidden" class="form-control @error('email') is-invalid @enderror" id="daysalary" name="day_salary" value="" required>
        
        <input type="hidden" class="form-control @error('email') is-invalid @enderror" id="spcl_allowance" name="" value="">

        <input type="hidden" class="form-control @error('email') is-invalid @enderror" id="performance_bonus" name="" value="">

        <input type="hidden" class="form-control @error('email') is-invalid @enderror" id="night_allowance" name="" value="">

        <input type="hidden" class="form-control @error('email') is-invalid @enderror" id="statutory_bonus" name="" value="">

        <div class="form-group row block1">
            <label for="email" class="col-md-4 col-form-label text-md-right">LOP</label>
            <div class="col-md-6">
                <input type="text" id="lop" class="form-control @error('email') is-invalid @enderror"  name="lop" value="0" required readonly>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div style="font-size:11px;font-weight:600;color:red;">
                    Working Days(<span id="totaldays1"></span>), 
                    Present Days(<span id="present"></span>), 
                    Absent Days(<span id="absent"></span>) 
                    <span id="lop1"></span>
                </div>
            </div>   
        </div>

        <input type="hidden" class="form-control @error('email') is-invalid @enderror" id="deduction" name="deduction" value="" required>

        <div class="form-group row block1">
            <label for="email" class="col-md-4 col-form-label text-md-right">Net Salary</label>
            <div class="col-md-6">
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="netpay" name="net_salary" value="{{ old('email') }}" required readonly>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div style="font-size:11px;font-weight:600;color:blue;">
                    <span id="allow1"></span><span id="allow2"></span><span id="allow3"></span><span id="allow4"></span> 
                </div>
            </div>
        </div>

        
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Proccess
                </button>
            </div>
        </div>
    </form>
</div>
@endsection


@section('scripts')
<script>
    $('#emp_id').change(function() {
        var selected_id = $(this).val();
        var data1 = <?=  $user; ?>

        for(x in data1){
        if (selected_id == data1[x].emp_id) {
        $('#name').val(data1[x].name); 
        $('#value1').text(data1[x].gross_salary);
        $('#esi').val(data1[x].esi);
        $('#pf').val(data1[x].pf); 
        $('#spcl_allowance').val(data1[x].spcl_allowance); 
        $('#performance_bonus').val(data1[x].performance_bonus); 
        $('#night_allowance').val(data1[x].night_allowance); 
        $('#statutory_bonus').val(data1[x].statutory_bonus); 
        }}    
    });
</script>

<script>
    $('.total').change(function() {
        var selected_id1 = $('#emp_id').val();
        var selected_id2 = $('#month').val();
        var selected_id3 = $('#year').val();
        // alert(selected_id1 + ", " + selected_id2 + ", " + selected_id3);
        var data1 = <?=  $atten; ?>

        for(x in data1){
        if (selected_id1 == data1[x].emp_id && selected_id2 == data1[x].month && selected_id3 == data1[x].year) {
        $('#present').text(data1[x].present); 
        $('#presentdays').val(data1[x].present);
        $('#absent').text(data1[x].absent);
        $('#totaldays').val(data1[x].working_days); 
        $('#totaldays1').text(data1[x].working_days); 
        // }else{ $('#totaldays1').text(0); 
        }}         
    });
</script>

<script>
    $(function () {
     $('#block').hide();
     $('.show').change(function () {
        $('#block').show();
    });
 });

 $(function () {
     $('.block1').hide();
     $('.show1').change(function () {
        $('.block1').show();
    });
 });
</script>

<script>
$(function(){
    $('#data').change(function(){
        var value1 = parseFloat($('#data').val().replace(",",""));
        if (value1 > 15000) {
            $('#tax').val(200);
        }else{
            $('#tax').val(0);
        }
        });
    });


$(function(){
    $('#data,.total').change(function(){
        var value1 = $('#data').val().replace(",","");
        var value2 = $('#totaldays').val().replace(",",""); 
        $('#daysalary').val(value1 / value2);   
        });
    });


$(function(){
    $('#data,.total').change(function(){
        var value1 = parseFloat($('#daysalary').val().replace(",",""));
        var value2 = parseFloat($('#absent').text().replace(",","")); 
        if (value2 > 0) {
            $('#lop1').text("=\t" + (value2 - 1) + "\tDay LOP");
            $('#lopdays').val(value2 - 1);
            $('#lop').val((value1 * (value2 - 1)).toFixed(2));
        }else{
            $('#lop1').text("");
            $('#lop').val((value1 * value2).toFixed(2));
        }
        });
    });

$(function(){
    $('#data,.total').change(function(){
        var value1 = $('#spcl_allowance').val();
        var value2 = $('#performance_bonus').val(); 
        var value3 = $('#night_allowance').val();
        var value4 = $('#statutory_bonus').val(); 
        if (value1 > 0) {
            $('#allow1').text("(+" + (value1) + ")Special Allowance");
        }else{
            $('#allow1').text("");
        }

        if (value2 > 0) {
            $('#allow2').text(" (+" + (value2) + ")Performance bonus");
        }else{
            $('#allow2').text("");
        }

        if (value3 > 0) {
            $('#allow3').text(" (+" + (value3) + ")Night Allowance");
        }else{
            $('#allow3').text("");
        }

        if (value4 > 0) {
            $('#allow4').text(" (+" + (value4) + ")Statutory bonus");
        }else{
            $('#allow4').text("");
        }
        });
    });

$(function(){
    $('#data,.total').change(function(){
        var value1 = parseFloat($('#data').val().replace(",",""));
        var value2 = parseFloat($('#tax').val().replace(",",""));
        var value3 = parseFloat($('#esi').val().replace(",",""));
        var value4 = parseFloat($('#pf').val().replace(",",""));
        var value5 = parseFloat($('#lop').val().replace(",",""));
        var value6 = parseFloat($('#spcl_allowance').val().replace(",",""));
        var value7 = parseFloat($('#performance_bonus').val().replace(",",""));
        var value8 = parseFloat($('#night_allowance').val().replace(",",""));
        var value9 = parseFloat($('#statutory_bonus').val().replace(",",""));
        $('#deduction').val(value2 + value3 + value4 + value5);
        $('#netpay').val(value1 - value2 - value3 - value4 - value5 + value6 + value7 + value8 + value9);
        var cleanNum = parseFloat($('#netpay').val().replace(",","")).toFixed(0);
        cleanNum = isNaN(cleanNum) ? '0.00' : cleanNum;
        $('#netpay').val(cleanNum);
        });
    });
</script>

<script>
$(document).ready(function(){
  $("#month,#year").trigger('change');
});
</script>
@stop


