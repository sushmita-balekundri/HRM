@extends('layouts.master2')
   
@section('content')

<div class="top-content">
    <div style="float:right;"><a class="btn btn-dark btn-sqrt" href="{{ route('paystructure.index') }}"> <i class="fas fa-angle-double-left"></i> Back</a></div>
    <div><h2 >Edit Pay Structure</h2></div>
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
    <form action="{{ route('paystructure.update',$paystructure->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Employee Id</label>
            <div class="col-md-6">
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="emp_id" value="{{$paystructure->emp_id}}" required readonly>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
       
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Name</label>
            <div class="col-md-6">
                <input type="text" id="name" class="form-control @error('email') is-invalid @enderror" name="name" value="{{$paystructure->name}}" required readonly>
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
                <input type="text" id="designation" class="form-control @error('email') is-invalid @enderror" name="designation" placeholder="" value="{{$paystructure->designation}}" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Gross Salary</label>
            <div class="col-md-6">
                <input type="text" id="data" class="form-control @error('email') is-invalid @enderror" name="gross_salary" value="{{$paystructure->gross_salary}}" required>
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
                <input type="text" id="basic" class="form-control @error('email') is-invalid @enderror" name="basic" value="{{$paystructure->basic}}" required>
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
                <input type="text" id="hra" class="form-control @error('email') is-invalid @enderror" name="hra" value="{{$paystructure->hra}}" required>
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
                <input type="text" id="conveyance" class="form-control @error('email') is-invalid @enderror" name="conveyance" value="{{$paystructure->conveyance}}" required>
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
                <input type="text" id="esi" class="form-control @error('email') is-invalid @enderror"  name="esi" value="{{$paystructure->esi}}" required>
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
                <input type="text" id="pf" class="form-control @error('email') is-invalid @enderror" name="pf" value="{{$paystructure->pf}}" required>
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
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="spcl_allowance" value="{{$paystructure->spcl_allowance}}" required>
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
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="performance_bonus" value="{{$paystructure->performance_bonus}}" required>
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
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="night_allowance" value="{{$paystructure->night_allowance}}" required>
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
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="statutory_bonus" value="{{$paystructure->statutory_bonus}}" required>
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