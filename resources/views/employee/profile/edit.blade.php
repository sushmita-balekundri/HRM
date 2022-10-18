@extends('layouts.master1')
   
@section('content')
<div class="top-content">
    <div style="float:right;"><a class="btn btn-dark btn-sqrt" href="{{ route('pro') }}"> <i class="fas fa-angle-double-left"></i> Back</a></div>
    <div><h2 >Edit Profile</h2></div>
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
    <form action="{{ route('profile.update',$profile->id) }}" method="POST">
        @csrf
        @method('PUT')
            
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $profile->name }}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Blood-group</label>
            <div class="col-md-6">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="blood_group" value="{{ $profile->blood_group }}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>
        </div>
    
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Education</label>
            <div class="col-md-6">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="education" value="{{ $profile->education }}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>
        </div>
    
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Address</label>
            <div class="col-md-6">
                <textarea type="text" class="form-control @error('name') is-invalid @enderror" name="address" value=""  autocomplete="name">{{$profile->address}}</textarea>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>
        </div>
    
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Personal-no</label>
            <div class="col-md-6">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="personal_no" value="{{ $profile->personal_no }}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>
        </div>
    
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Emergency-no</label>
            <div class="col-md-6">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="emergency_no" value="{{ $profile->emergency_no }}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>
        </div>
    
        <div class="form-group row">
            {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}
            <div class="col-md-6">
                <input id="password" type="hidden" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ $profile->password }}" required autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>
        </div>
            
        <input type="hidden" name="email" value="{{ $profile->email }}">
            
        <input type="hidden" name="emp_id" value="{{ $profile->emp_id }}">
            
        <input type="hidden" name="designation" value="{{ $profile->designation }}">
            
        <input type="hidden" name="doj" value="{{ $profile->doj }}">
            
        <input type="hidden" name="dob" value="{{ $profile->dob }}">
            
        <input type="hidden" name="dor" value="{{ $profile->dor }}">
            
        <input type="hidden" name="account" value="{{ $profile->account }}">
            
        <input type="hidden" name="aadhar_no" value="{{ $profile->aadhar_no }}">
            
        <input type="hidden" name="pan_no" value="{{ $profile->pan_no }}">
            
        <input type="hidden" name="join_letter" value="{{ $profile->join_letter }}">
            
        <input type="hidden" name="exp_letter" value="{{ $profile->exp_letter }}">
            
        <input type="hidden" name="payslip" value="{{ $profile->payslip }}">
            
        <input type="hidden" name="role" value="{{ $profile->role }}">

        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary btn-sqrt">Update</button>
        </div>    
    </form>
</div>
@endsection