@extends('layouts.master2')
  
@section('content')

<div class="top-content">
    <div style="float:right;"><a class="btn btn-dark btn-sqrt" href="{{ route('paystructure.index') }}"> <i class="fas fa-angle-double-left"></i> Back</a></div>
    <div><h2 >Add Pay Structure</h2></div>
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
    <form action="{{ route('paystructure.store') }}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Employee Id</label>
            <div class="col-md-6">
                <select class="form-control form-group show" name="emp_id" id="emp_id" onchange="">
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
            <label for="email" class="col-md-4 col-form-label text-md-right">Designation</label>
            <div class="col-md-6">
                <input type="text" id="designation" class="form-control @error('email') is-invalid @enderror" name="designation" value="" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{-- <div class="text-center mb-3" id="block" style="margin-left:150px;">
            Gross Salary for this Employee is : <b><span id="value1"></span></b>
        </div>  --}}

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Gross Salary</label>
            <div class="col-md-6">
                <input type="text" id="data" class="form-control @error('email') is-invalid @enderror" name="gross_salary" placeholder="Enter Gross Salary" value="" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Basic</label>
            <div class="col-md-6">
                <input type="text" id="basic" class="form-control @error('email') is-invalid @enderror" name="basic" value="0" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">HRA</label>
            <div class="col-md-6">
                <input type="text" id="hra" class="form-control @error('email') is-invalid @enderror" name="hra" value="0" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Conveyance</label>
            <div class="col-md-6">
                <input type="text" id="conveyance" class="form-control @error('email') is-invalid @enderror" name="conveyance" value="0">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">ESI</label>
            <div class="col-md-6">
                <input type="text" id="esi" class="form-control @error('email') is-invalid @enderror" name="esi" value="0" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">PF</label>
            <div class="col-md-6">
                <input type="text" id="pf" class="form-control @error('email') is-invalid @enderror" name="pf" value="0" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Special Allowance</label>
            <div class="col-md-6">
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="spcl_allowance" value="0" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Performance Bonus</label>
            <div class="col-md-6">
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="performance_bonus" value="0" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Night Shift Allowance</label>
            <div class="col-md-6">
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="night_allowance" value="0" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Statutory Bonus </label>
            <div class="col-md-6">
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="statutory_bonus" value="0" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    save
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
        $('#value1').text(data1[x].basic_salary);  
        $('#designation').val(data1[x].designation);
        }}    
    });
</script>

// <script>
//     $(function () {
//      $('#block').hide();
//      $('.show').change(function () {
//         $('#block').show();
//     });
//  });
// </script>

<script>
$(function(){
    $('#data').change(function(){
        var value1 = parseFloat($('#data').val().replace(",","")); 
        $('#basic').val((value1 * 30 / 100));   
        $('#hra').val((value1 * 40 / 100)); 
        $('#conveyance').val((value1 * 30 / 100));
        $('#esi').val((value1 * 1.75 / 100).toFixed(2)); 
    });
});
</script>

<script>
$(function(){
    $('#data').change(function(){ 
        var value1 = parseFloat($('#basic').val());
        var value2 = parseFloat($('#conveyance').val());
        $('#pf').val(((value1 + value2) * 12 / 100).toFixed(2));
    });
});
</script>
@stop