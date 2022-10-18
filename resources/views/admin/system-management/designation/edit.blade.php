@extends('layouts.master2')
   
@section('content')

<div class="top-content">
    <div style="float:right;"><a class="btn btn-dark btn-sqrt" href="{{ route('designation.index') }}"> <i class="fas fa-angle-double-left"></i> Back</a></div>
    <div><h2 >Edit Role</h2></div>
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
    <form action="{{ route('designation.update',$designation->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Code</label>
            <div class="col-md-6">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="code" value="{{ $designation->code }}" required>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Role Name</label>
            <div class="col-md-6">
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="name" value="{{ $designation->name }}" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
            
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>    
    </form>
</div>
@endsection