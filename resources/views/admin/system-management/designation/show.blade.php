@extends('layouts.master2')
@section('content')

<div class="top-content">
    <div style="float:right;"><a class="btn btn-dark btn-sqrt" href="{{ route('designation.index') }}"> <i class="fas fa-angle-double-left"></i> Back</a></div>
    <div>
        <h2>Roles</h2>
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
                <th>Code</th>
                <td>{{ $designation->code }}</td>
            </tr>
            <tr>
                <th>Role Name</th>
                <td>{{ $designation->name }}</td>
            </tr>
        </table>
    </div>
</div>              
@endsection