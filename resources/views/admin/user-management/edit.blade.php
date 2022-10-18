@extends('layouts.master2')
   
@section('content')
<div class="top-content">
    <div style="float:right;"><a class="btn btn-dark btn-sqrt" href="{{ route('employee.index') }}"> <i class="fas fa-angle-double-left"></i> Back</a></div>
    <div><h2 >Edit Employee Details</h2></div>
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
    <form action="{{ route('employee.update',$employee->id) }}" method="POST">
        @csrf
        @method('PUT')
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $employee->name }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
    
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $employee->email }}" required readonly>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Emp id</label>
                <div class="col-md-6">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="emp_id" value="{{ $employee->emp_id }}" required readonly>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Emp Grade</label>
                <div class="col-md-6">
                    {{-- <input type="text" class="form-control @error('name') is-invalid @enderror" name="emp_grade" value="{{ old('name') }}" required autocomplete="name" autofocus> --}}
                    <select class="form-control form-group" name="emp_grade">
                        <option value="{{ $employee->emp_grade }}" selected hidden> {{ $employee->emp_grade }} </option>
                        <option value="M1">M1</option>
                        <option value="M2">M2</option>
                        <option value="M3">M3</option>
                    </select>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
    
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Designation</label>
                <div class="col-md-6">
                    <select class="form-control form-group" name="designation">
                        <option value="{{ $employee->designation }}" selected hidden> {{ $employee->designation }} </option>
                        @foreach ($designation as $dd)
                            <option value="{{ $dd->name}}"> {{ $dd->name}} </option>
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
                <label for="name" class="col-md-4 col-form-label text-md-right">DOJ</label>
                <div class="col-md-6">
                    <input type="date" class="form-control @error('name') is-invalid @enderror" name="doj" value="{{ $employee->doj }}" required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
    
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">DOB</label>
                <div class="col-md-6">
                    <input  type="date" class="form-control @error('name') is-invalid @enderror" name="dob" value="{{ $employee->dob }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
    
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">DOR</label>
                <div class="col-md-6">
                    <input type="date" class="form-control @error('name') is-invalid @enderror" name="dor" value="{{ $employee->dor }}">
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
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="blood_group" value="{{ $employee->blood_group }}" required>
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
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="education" value="{{ $employee->education }}" required>
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
                    <textarea type="text" class="form-control @error('name') is-invalid @enderror" name="address" value="" required autocomplete="name">{{$employee->address}}</textarea>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
    
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Bank Account no</label>
                <div class="col-md-6">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="account" value="{{ $employee->account }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Bank Name</label>
                <div class="col-md-6">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="bank_name" value="{{ $employee->bank_name }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
    
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Aadhar-no</label>
                <div class="col-md-6">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="aadhar_no" value="{{ $employee->aadhar_no }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
    
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">PAN-no</label>
                <div class="col-md-6">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="pan_no" value="{{ $employee->pan_no }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
    
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Personal Mobile No.</label>
                <div class="col-md-6">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="personal_no" value="{{ $employee->personal_no }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
    
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Emergency Mobile No.</label>
                <div class="col-md-6">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="emergency_no" value="{{ $employee->emergency_no }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
    
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Basic Salary</label>
                <div class="col-md-6">
                    <input type="text" id="value1" class="form-control @error('name') is-invalid @enderror" name="basic_salary" value="{{ $employee->basic_salary }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Pf no</label>
                <div class="col-md-6">
                    <input type="text" id="result" class="form-control @error('name') is-invalid @enderror" name="pf_no" value="{{ $employee->pf_no }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">UAN</label>
                <div class="col-md-6">
                    <input type="text" id="result" class="form-control @error('name') is-invalid @enderror" name="uan" value="{{ $employee->uan }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Joining letter issued on</label>
                <div class="col-md-6">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="join_letter" value="{{ $employee->join_letter }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
    
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Experience letter issued on</label>
                <div class="col-md-6">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="exp_letter" value="{{ $employee->exp_letter }}" required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
    
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Allow Payslip</label>
                <div class="col-md-6">
                    {{-- <input type="text" class="form-control @error('name') is-invalid @enderror" name="payslip" value="{{ $employee->payslip }}" required autocomplete="name" autofocus> --}}
                    <select class="form-control form-group" name="payslip">
                        <option value="{{ $employee->payslip }}" selected hidden> {{ $employee->payslip }} </option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
    
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">User Status</label>
                <div class="col-md-6">
                    {{-- <input type="text" class="form-control @error('name') is-invalid @enderror" name="payslip" value="{{ old('name') }}" required autocomplete="name" autofocus> --}}
                    <select class="form-control form-group" name="user_status">
                        <option value="{{ $employee->user_status }}" selected hidden> {{ $employee->user_status }} </option>
                        <option value="Active">Active</option>
                        <option value="Relieved">Relieved</option>
                        <option value="Fired">Fired</option>
                    </select>
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
                    <input id="password" type="hidden" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ $employee->password }}" autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <input type="hidden" name="role" value="Employee">
    
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary btn-sqrt">Update</button>
            </div>    
        </form>
    </div>
@endsection
