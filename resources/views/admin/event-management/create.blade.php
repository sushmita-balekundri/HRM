@extends('layouts.master2')

@section('content')

<div class="top-content">
    <div style="float:right;"><a class="btn btn-dark btn-sqrt" href="{{ route('event-index') }}"> <i class="fas fa-angle-double-left"></i> Back</a></div>
    <div><h2 >Add Event</h2></div>
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
    <form action="{{ route('event-store') }}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Event Name</label>
            <div class="col-md-6">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="event_name" value="{{ old('name') }}" required autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Start Date</label>
            <div class="col-md-6">
                <input type="date" min="{{date('Y-m-d')}}" class="form-control @error('email') is-invalid @enderror" name="start_date" value="{{ old('email') }}" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
		</div>
		
		<div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">End Date</label>
            <div class="col-md-6">
                <input type="date" min="{{date('Y-m-d')}}" class="form-control @error('email') is-invalid @enderror" name="end_date" value="{{ old('email') }}" required>
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
