@extends('layouts.master2')
@section('content')

<div class="top-content">
    <div style="float:right;"><a class="btn btn-dark btn-sqrt" href="{{ route('paystructure.index') }}"> <i class="fas fa-angle-double-left"></i> Back</a></div>
    <div>
        <h2>Paystructure Details</h2>
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
  
<div class="main-content">
    <div class="role-data">
        <table class="table">
            <tr>
                <th width="300">Name</th>
                <td>{{ $paystructure->name }}</td>
            </tr>
            <tr>
                <th>Gross Salary</th>
                <td>{{ number_format($paystructure->gross_salary) }}</td>
            </tr>
            <tr>
                <th>Basic</th>
                <td>{{ number_format($paystructure->basic) }}</td>
            </tr>
            <tr>
                <th>HRA</th>
                <td>{{ number_format($paystructure->hra) }}</td>
            </tr>
            <tr>
                <th>Conveyance</th>
                <td>{{ number_format($paystructure->conveyance) }}</td>
            </tr>
            <tr>
                <th>Esi</th>
                <td>{{ number_format($paystructure->esi,2) }}</td>
            </tr>
            <tr>
                <th>Pf</th>
                <td>{{ number_format($paystructure->pf,2) }}</td>
            </tr>
            <tr>
                <th>Special Allowance</th>
                <td>{{ number_format($paystructure->spcl_allowance) }}</td>
            </tr>
            <tr>
                <th>Performance Bonus</th>
                <td>{{ number_format($paystructure->performance_bonus) }}</td>
            </tr>
            <tr>
                <th>Night Shift Allowance</th>
                <td>{{ number_format($paystructure->night_allowance) }}</td>
            </tr>
            <tr>
                <th>Statutory Bonus </th>
                <td>{{ number_format($paystructure->statutory_bonus) }}</td>
            </tr>    
        </table>
    </div>
</div>              
@endsection