@extends('layouts.master1')
  
@section('content')

<div class="top-content">
    <div style="float:right;"><a class="btn btn-dark btn-sqrt" href="{{ route('userleave.index') }}"> <i class="fas fa-angle-double-left"></i> Back</a></div>
    <div><h2 >Leave Request</h2></div>
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
    
    <form action="{{ route('userleave.store') }}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Reason</label>
            <div class="col-md-6">
                <textarea type="text" class="form-control @error('name') is-invalid @enderror" name="reason" value="{{ old('name') }}" required></textarea>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Date From</label>
            <div class="col-md-6">
                <input type="date" id="date1" min="{{date('Y-m-d')}}" class="form-control @error('name') is-invalid @enderror" name="date_from" required>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Date To</label>
            <div class="col-md-6">
                <input onchange="CalculateDiff()" type="date" id="date2" min="{{date('Y-m-d')}}" class="form-control @error('name') is-invalid @enderror" name="date_to" required>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">No of Days</label>
            <div class="col-md-6">
                <input type="text" id="calculated" class="form-control @error('email') is-invalid @enderror" name="days" value="" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <input type="hidden"  name="name" value="{{auth()->user()->name}}">
    
        <input type="hidden"  name="emp_id" value="{{auth()->user()->emp_id}}">
       
        <input type="hidden"  name="status" value="pending">

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Apply
                </button>
            </div>
        </div>
    </form>
</div>

@endsection
@section('scripts')
<script>
 function CalculateDiff() {
        if ($("#date1").val() != "" && $("#date2").val() != "") {
            var From_date = new Date($("#date1").val());
            var To_date = new Date($("#date2").val());
            var diff_date = To_date - From_date;
            var days = Math.floor((diff_date / (1000 * 60 * 60 * 24) + 1));
            $("#calculated").val(+days + "");
        } else {
            alert("Please select dates");
            return false;
        }
    }
</script>
@stop
