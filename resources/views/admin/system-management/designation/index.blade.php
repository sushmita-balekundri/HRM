@extends('layouts.master2')
 
@section('content')
<div class="col-md-4 navbar pagesearch">
    <form action="/designation/search" method="POST" role="search">
        {{ csrf_field() }}
        <div class="searchbar">
            <input class="search_input" type="text" placeholder="Search..." name="q">   
            <button type="submit" class="search_icon" style="background-color: transparent;border: none;"><i class="fas fa-search"></i></button>
        </div>
    </form>
</div>

<div class="top-content">
    <div style="float:right;"><a class="btn btn-dark btn-sqrt" href="{{ route('designation.create') }}"> Add Role</a></div>
    <div><h2 >Roles</h2></div>
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
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="main-content"> 
    <div class="container table-responsive p-0"> 
    @if(isset($designation))    
    <table class="table auto-index">
        <tr class="table-secondary">
            <th>No</th>
            <th>Role Id</th>
            <th>Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($designation as $role)
        <tr>
            <td></td>
            <td>{{ $role->code }}</td>
            <td>{{ $role->name }}</td>
            <td>
                <form action="{{ route('designation.destroy',$role->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    {{-- <a href="{{ route('designation.show',$role->id) }}"><i class="fas fa-eye" style="margin-right:20px; color:black;"></i></a> --}}
                    <a href="{{ route('designation.edit',$role->id) }}"><i class="fas fa-edit" style="margin-right:15px;color:black;"></i></a>
                    <button type="submit" class="btn btn-danger del"><i class="fas fa-trash" style="margin-right:20px; color:black;"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $designation->links() !!}@endif
    </div>
</div>

@if(isset($details))
    <p class="text-center"> The Search results for <b> {{ $query }} </b> are : <a class="remove-filter-link" href="{{ route('designation.index') }}"> <i class="fas fa-times-circle fa-lg"></i> Clear all </a></p>
        <div class="main-content"> 
            <div class="container table-responsive p-0"> 
                <table class="table auto-index">
                    <tr class="table-secondary">
                        <th>No</th>
                        <th>Role Id</th>
                        <th>Name</th>
                        <th width="280px">Action</th>
                    </tr>
                    
                    @foreach($details as $role)
                    <tr>
                        <td></td>
                        <td>{{ $role->code }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <form action="{{ route('designation.destroy',$role->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                {{-- <a href="{{ route('designation.show',$role->id) }}"><i class="fas fa-eye" style="margin-right:20px; color:black;"></i></a> --}}
                                <a href="{{ route('designation.edit',$role->id) }}"><i class="fas fa-edit" style="margin-right:15px;color:black;"></i></a>
                                <button type="submit" class="btn btn-danger del"><i class="fas fa-trash" style="margin-right:20px; color:black;"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach	
                </table>
                @if($details){!! $details->render() !!}@endif
            </div>
        </div>    
             
        @elseif(isset($messages))
        <p class="text-center">{{ $messages }} <a class="remove-filter-link" href="{{ route('designation.index') }}"> <i class="fas fa-times-circle fa-lg"></i> Clear all </a> </p>
@endif
@endsection