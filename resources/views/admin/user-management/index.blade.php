@extends('layouts.master2')
 
@section('content')
<div class="col-md-4 navbar pagesearch">
    <form action="/employee/search" method="POST" role="search">
        {{ csrf_field() }}
        <div class="searchbar">
            <input class="search_input" type="text" placeholder="Search..." name="q">   
            {{-- <a href="#" class="search_icon"><i class="fas fa-search"></i></a> --}}
            <button type="submit" class="search_icon" style="background-color: transparent;border: none;"><i class="fas fa-search"></i></button>
        </div>
    </form>
</div>

<div class="top-content">
    <div style="float:right;"><a class="btn btn-dark btn-sqrt" href="{{ route('employee.create') }}"> Add Employee</a></div>
    <div style="margin-top:-10px;">
        <span style="font-size: 2rem;font-weight: 500;">Employee List</span> &nbsp;&nbsp;
        {{-- <select style="padding:7px 10px 7px 10px !important;" id="mylist" onchange="myFunction2()" class="att-sel">
                <option value="" selected hidden>Sort By grade</option>
                <option value="m">All</option>
                <option value="m1">M1</option>
                <option value="m2">M2</option> 
                <option value="m3">M3</option>
        </select> --}}
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
@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
            <p></p>
        </div>
@endif
    
<div class="main-content"> 
    <div class="container table-responsive p-0"> 
        @if(isset($employee))
        <table id="example-table" class="display auto-index" style="width:100%">
            <thead style="display: table-row-group;">
                <tr style="background-color:#a59d9d;">
                    <th width="50px">No</th>
                    <th>Name</th>
                    <th>Emp Id</th>
                    <th>Emp Grade</th>
                    <th>Date of Joining</th>
                    <th>Basic Salary</th>
                    <th>Emp Status</th>
                    <th width="140px">Action</th>
                </tr>
            </thead>
            <tbody>   
            @foreach ($employee as $users)
            <tr>
                <td></td>
                <td>{{ $users->name }}</td>
                <td>{{ $users->emp_id }}</td>
                <td>{{ $users->emp_grade }}</td>
                @php $date=date_create($users->doj); @endphp
                <td>{{date_format($date,"d/m/Y")}}</td>
                <td>{{ number_format($users->basic_salary) }}</td>
                <td>
                    @if($users->user_status == 'Active')
                        <span class="badge badge-success">Active</span>
                    @elseif($users->user_status == 'Relieved')
                        <span class="badge badge-warning">Relieved</span>
                    @elseif($users->user_status == 'Fired')
                        <span class="badge badge-danger">Fired</span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('employee.destroy',$users->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('employee.show',$users->id) }}"><i class="fas fa-eye" style="margin-right:20px; color:black;"></i></a>
                        <a href="{{ route('employee.edit',$users->id) }}"><i class="fas fa-edit" style="margin-right:15px;color:black;"></i></a>
                        <button type="submit" class="btn btn-danger del" Onclick="return ConfirmDelete()"><i class="fas fa-trash" style="margin-right:20px; color:black;"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
            <tfoot style="display: table-header-group;">
            <tr>
                <th style="visibility: hidden!important;"></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </tfoot>
        </table>
        {{-- <div class="paging"></div> --}}
        @endif
    </div> 
</div> 

@if(isset($details))
    <p class="text-center"> The Search results for <b> {{ $query }} </b> are : <a class="remove-filter-link" href="{{ route('employee.index') }}"> <i class="fas fa-times-circle fa-lg"></i> Clear all </a></p>
        <div class="main-content"> 
            <div class="container table-responsive p-0"> 
                <table class="table" id="myTable" >
                    <tr class="table-secondary">
                        <th>No</th>
                        <th>Name</th>
                        <th>Emp-Id</th>
                        <th>Emp Grade</th>
                        <th>Date of Joining</th>
                        <th>Emp Status</th>
                        <th width="280px">Action</th>
                    </tr>
                    
                    @foreach($details as $users)
                    <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $users->name }}</td>
                            <td>{{ $users->emp_id }}</td>
                            <td>{{ $users->emp_grade }}</td>
                            @php $date=date_create($users->doj); @endphp
                            <td>{{date_format($date,"d/m/Y")}}</td>
                            <td>
                                    @if($users->user_status == 'Active')
                                        <span class="badge badge-success">Active</span>
                                    @elseif($users->user_status == 'Relieved')
                                        <span class="badge badge-warning">Relieved</span>
                                    @elseif($users->user_status == 'Fired')
                                        <span class="badge badge-danger">Fired</span>
                                    @endif
                                </td>
                            <td>
                                <form action="{{ route('employee.destroy',$users->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('employee.show',$users->id) }}"><i class="fas fa-eye" style="margin-right:20px; color:black;"></i></a>
                                    <a href="{{ route('employee.edit',$users->id) }}"><i class="fas fa-edit" style="margin-right:15px;color:black;"></i></a>
                                    <button type="submit" class="btn btn-danger del" Onclick="return ConfirmDelete()"><i class="fas fa-trash" style="margin-right:20px; color:black;"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach	
                </table>
                @if($details){!! $details->render() !!}@endif
            </div>
        </div>    
               
        @elseif(isset($messages))
        <p class="text-center">{{ $messages }} <a class="remove-filter-link" href="{{ route('employee.index') }}"> <i class="fas fa-times-circle fa-lg"></i> Clear all </a></p>
        @endif       
@endsection


@section('scripts')
<script>
function ConfirmDelete()
{
  return confirm("Are you sure to Delete the user?");
}
</script>

{{-- <script src='https://cdn.rawgit.com/Holt59/datatable/master/js/datatable.jquery.js'></script>
<script src='https://cdn.rawgit.com/Holt59/datatable/master/js/datatable.js'></script>
<script id="rendered-js">
$('#example-table').datatable({
    
  pageSize: 9,
  sort: [true, true, true,true,true,true,true],
  filters: [false, true,false,'select',false,false,'select',false],
  filterText: 'Search..',
  filterSelect: 'Search..asxsad',
  
  onChange: function (old_page, new_page) {
    console.log('changed from ' + old_page + ' to ' + new_page);
  } }); 
</script> --}}

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#example-table').DataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value="">Select</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} );

</script>
@stop