@extends('layouts.master2')

@section('content')
<div class="top-content">
    <div style="float:right;">
        <a class="btn btn-dark btn-sqrt" href="{{ route('employee.edit',$employee->id)}}"> <i class="fa fa-edit fa-sm"></i> Edit</a>
        <a class="btn btn-dark btn-sqrt" href="{{ route('employee.index') }}"> <i class="fas fa-angle-double-left"></i> Back</a></div>
    <div>
        <h2>Details of Employee</h2>
    </div>
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
                                <td>{{ $employee->name }}</td>
                            </tr>
                            <tr>
                                <th>Employee Id</th>
                                <td>{{ $employee->emp_id }}</td>
                            </tr>
                            <tr>
                                <th>Email ID</th>
                                <td>{{ $employee->email }}</td>
                            </tr>
                            <tr>
                                <th>Designation</th>
                                <td>{{ $employee->designation }}</td>
                            </tr>
                            <tr>
                                <th>Emp Grade</th>
                                <td>{{ $employee->emp_grade }}</td>
                            </tr>
                            <tr>
                                <th>Basic Salary</th>
                                <td>{{ number_format($employee->basic_salary) }}</td>
                            </tr>
                            <tr>
                                <th>Joining letter issued on</th>
                                @php $date=date_create($employee->doj); @endphp
                                <td>{{date_format($date,"d/m/Y")}}</td>
                            </tr>
                            <tr>
                                <th>Experience letter issued on</th>
                                <td>
                                    @if($employee->dor == '')
                                        -
                                    @endif
                                    @php $date=date_create($employee->dor); @endphp
                                    {{date_format($date,"d/m/Y")}}
                                </td>
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
                                @php $date=date_create($employee->dob); @endphp
                                <td>{{date_format($date,"d/m/Y")}}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $employee->address }}</td>
                            </tr>
                            <tr>
                                <th>Blood Group</th>
                                <td>{{ $employee->blood_group }}</td>
                            </tr>
                            <tr>
                                <th>Education</th>  
                                <td>{{ $employee->education }}</td>
                            </tr>
                            <tr>
                                <th>Personal Number</th>  
                                <td>{{ $employee->personal_no }}</td>
                            </tr>
                            <tr>
                                <th>Emergency Number</th>  
                                <td>{{ $employee->emergency_no }}</td>
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
                                <td>{{ $employee->name }}</td>
                            </tr>
                            <tr>
                                <th>Account</th>
                                <td>{{ $employee->account }}</td>
                            </tr>
                            <tr>
                                <th>Aadhar-no</th>
                                <td>{{ $employee->aadhar_no }}</td>
                            </tr>
                            <tr>
                                <th>PAN-no</th>
                                <td>{{ $employee->pan_no }}</td>
                            </tr>
                            <tr>
                                <th>PF No</th>
                                <td>{{ $employee->pf_no }}</td>
                            </tr>
                            <tr>
                                <th>UAN</th>
                                <td>{{ $employee->uan }}</td>
                            </tr>
                            <tr>
                                <th>Allow Payslip</th>
                                <td>{{ $employee->payslip }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection