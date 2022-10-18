@extends('layouts.master')

@section('content')
@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
            <p></p>
        </div>
@endif
@guest                      
<div class="container-fluid homepage">
    <div class="row">
        <div class="col-md-4 p-0">
            <div class="login-form">
                <form action="{{ route('login') }}" method="POST"> @csrf
                    <div class="form-group logo">
                        <img src="assets/images/logo.png" width="50%" height="50%">
                    </div>
                    
                    <div class="form-group login">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="w-100  @error('email') is-invalid @enderror" placeholder="Email" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group login">
                        <input type="password" name="password" id="password" class="w-100  @error('password') is-invalid @enderror" placeholder="Password"required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <input type="hidden" name="role" value="Employee">
                    
                    <div class="form-group">
                        <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-default w-100 log-btn">Login</button>
                    </div>
                    
                    <hr class="hr">
                    <div class="text-center">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    <br>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-8 p-0">
            <img src="assets/images/login-background.png"   style="width: 100%;height: 100vh;" alt="">
        </div>
    </div>
</div>
@else
<div class="container-fluid homepage">
    <div class="row">
        <div class="col-md-4 p-0">
            <div class="login-form"> 
                <div class="sign">
                    You are already logged in<br> as <br> <b> <a href="{{ route('pro') }}"><i class="fas fa-user"></i> &nbsp;{{ Auth::user()->name }} </a> </b>
                </div>
            </div>
        </div>
        <div class="col-md-8 p-0">
            <img src="assets/images/login-background.png"  style="width: 100%;height: 100vh;" alt="">
        </div>
    </div>   
</div>
@endguest
@endsection
