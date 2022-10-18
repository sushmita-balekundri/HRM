@extends('layouts.master1')

@section('content')
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
        <p></p>
    </div>
@endif

<div class="top-content">
    <div style="float:right;"><a class="btn btn-dark btn-sqrt" href="{{ route('profile.create') }}"> Update Profile </a></div>
    <div>
        <h2>Details of Employee</h2>
    </div>
</div>

<div class="employee-data">
    <div class="container">
        <div class="row form-group">
            <div class="col-md-6 pr-0">
                <div class="emp-details m-4 radius" style="background-color:white;">
                    <table class="table">
                        <tr class="head">
                            <th colspan="2">Employee Details</th>
                        </tr>
                        <tr>
                            <th width="230">Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Employee Id</th>
                            <td>{{ $user->emp_id }}</td>
                        </tr>
                        <tr>
                            <th>Email ID</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Designation</th>
                            <td>{{ $user->designation }}</td>
                        </tr>
                        <tr>
                            <th>Emp Grade</th>
                            <td>{{ $user->emp_grade }}</td>
                        </tr>
                        <tr>
                            <th>Basic Salary</th>
                            <td>{{ number_format($user->basic_salary) }}</td>
                        </tr>
                        <tr>
                            <th>Joining letter issued on</th>
                            <td>{{ $user->doj }}</td>
                        </tr>
                        <tr>
                            <th>Experience letter issued on</th>
                            <td>{{ $user->dor }}</td>
                        </tr>
                    </table>
                </div>
                <div class="emp-personal m-4 radius" style="background-color:white;">
                    <table class="table">
                        <tr class="head">
                            <th colspan="2">Employee Personal Details</th>
                        </tr>
                        <tr>
                            <th width="200">DOB</th>
                            <td>{{ $user->dob }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $user->address }}</td>
                        </tr>
                        <tr>
                            <th>Blood Group</th>
                            <td>{{ $user->blood_group }}</td>
                        </tr>
                        <tr>
                            <th>Education</th>  
                            <td>{{ $user->education }}</td>
                        </tr>
                        <tr>
                            <th>Personal Number</th>  
                            <td>{{ $user->personal_no }}</td>
                        </tr>
                        <tr>
                            <th>Emergency Number</th>  
                            <td>{{ $user->emergency_no }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-6 pl-0">
                <div class="emp-bank m-4 radius" style="background-color:white;">
                    <table class="table">
                        <tr class="head">
                            <th colspan="2">Employee Bank Details</th>
                        </tr>
                        <tr>
                            <th width="180">Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Account</th>
                            <td>{{ $user->account }}</td>
                        </tr>
                        <tr>
                            <th>Aadhar-no</th>
                            <td>{{ $user->aadhar_no }}</td>
                        </tr>
                        <tr>
                            <th>PAN-no</th>
                            <td>{{ $user->pan_no }}</td>
                        </tr>
                        <tr>
                            <th>PF No</th>
                            <td>{{ $user->pf_no }}</td>
                        </tr>
                        <tr>
                            <th>UAN</th>
                            <td>{{ $user->uan }}</td>
                        </tr>
                        <tr>
                            <th>Allow Payslip</th>
                            <td>{{ $user->payslip }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
