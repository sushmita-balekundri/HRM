@extends('layouts.master2')
  
@section('content')
<div class="top-content">
    <div style="float:right;"><a class="btn btn-dark btn-sqrt" href="{{ route('employee.index') }}"> <i class="fas fa-angle-double-left"></i> Back</a></div>
    <div><h2 >Add Employee</h2></div>
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
    <form action="{{ route('employee.store') }}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
            <div class="col-md-6">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required >
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
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" onblur="duplicateEmail(this)" value="{{ old('email') }}" required >
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <span id="error_email"></span>
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Emp id</label>
            <div class="col-md-6">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="emp_id" value="{{ old('name') }}" required >
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
                    <option value="" selected hidden> Select </option>
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
                {{-- <input type="text" class="form-control @error('name') is-invalid @enderror" name="designation" value="{{ old('name') }}" required autocomplete="name" autofocus> --}}
                <select class="form-control form-group" name="designation">
                    <option value="" selected hidden> Select </option>
                    @foreach ($designation as $dd)
                        <option value="{{ $dd->name}}"> {{ $dd->name}}  </option>
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
                <input type="date" class="form-control @error('name') is-invalid @enderror" name="doj" value="{{ old('name') }}" required>
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
                <input type="date" class="form-control @error('name') is-invalid @enderror" name="dob" value="{{ old('name') }}" required>
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
                <input type="date" class="form-control @error('name') is-invalid @enderror" name="dor" value="{{ old('name') }}">
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
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="blood_group" value="{{ old('name') }}" required>
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
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="education" value="{{ old('name') }}" required>
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
                <textarea type="text" class="form-control @error('name') is-invalid @enderror" name="address" value="{{ old('name') }}" required></textarea>
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
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="account" value="{{ old('name') }}" required>
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
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="bank_name" value="ICICI Bank" required>
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
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="aadhar_no" value="{{ old('name') }}" required>
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
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="pan_no" value="{{ old('name') }}" required>
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
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="personal_no" value="{{ old('name') }}" required>
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
                <input type="text" id="value1" class="form-control @error('name') is-invalid @enderror" name="basic_salary" value="{{ old('name') }}" required>
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
                <input type="text"  class="form-control @error('name') is-invalid @enderror" name="pf_no" value="{{ old('name') }}" required>
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
                <input type="text"  class="form-control @error('name') is-invalid @enderror" name="uan" value="{{ old('name') }}" required>
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
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="emergency_no" value="{{ old('name') }}" required>
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
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="join_letter" value="{{ old('name') }}" required>
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
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="exp_letter" value="{{ old('name') }}" required>
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
                <select class="form-control form-group" name="payslip">
                    <option value="" selected hidden> Select </option>
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
                <select class="form-control form-group" name="user_status">
                    <option value="" selected hidden> Select </option>
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
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>

        <input type="hidden"  name="role" value="Employee">
                        
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" id="register" class="btn btn-primary btn-sqrt">
                    save
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
function duplicateEmail(element){
        var email = $(element).val();
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            type: "POST",
            url: '{{url('/employee/checkemail')}}?email=' + email,
            data: {email:email},
            dataType: "json",
            success: function(res) {
                if(res.exists){
                    $('#error_email').html('<label class="text-danger">Email Already Exist</label>');
					$('#email').addClass('has-error');
					$('#register').attr('disabled', 'disabled');
                }else{
                    $('#error_email').html('<label style="display:none;">Email Already Exist</label>');
					$('#email').removeClass('has-error');
					$('#register').attr('disabled', false);
                }
            },
            error: function (jqXHR, exception) {

            }
        });
    }
</script>
@stop