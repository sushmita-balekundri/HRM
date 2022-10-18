@extends('layouts.master2')
@section('content')

<div class="top-content">
    <div style="float:right;">
        <a href="{{ route('pdfview1',$salary->id,['download'=>'pdf']) }}" class="btn btn-danger btn-sqrt">Download Payslip</a>
        <a class="btn btn-dark btn-sqrt" href="{{ route('payroll.index') }}"> <i class="fas fa-angle-double-left"></i> Back</a></div>
    <div>
        <h2>Salary</h2>
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
        <div class="row">
            @foreach ($user as $emp)
            @if($salary->emp_id == $emp->emp_id) 
            <div class="col-md-6 pr-0">
                <div class="emp-details m-4 radius" style="background-color:white;">
                    <table class="table table-bordered">
                        <tr class="head">
                            <th colspan="2">Block1</th>
                        </tr>
                        <tr>
                            <th width="200px">Employee Code</th>
                            <td>{{ $salary->emp_id }}</td>
                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            @php $date=date_create($emp->dob); @endphp
                            <td>{{date_format($date,"d/m/Y")}}</td>
                        </tr>
                        
                        <tr>
                            <th>Designation</th>
                            <td>{{$emp->designation}}</td>
                        </tr>
                        <tr>
                            <th>Bank Account Number</th>
                            <td>{{$emp->account}}</td>
                        </tr>
                        
                        <tr>
                            <th>PF No</th>
                            <td>{{$emp->pf_no}}</td>
                        </tr>
                        <tr>
                            <th>No. of Days LOP</th>
                            <td>{{number_format($salary->lop_days,2)}}/{{number_format($salary->present_days,2)}}/{{number_format($salary->total_working_days,2)}}</td>
                        </tr>
                        <tr>
                            <th>UAN</th>
                            <td>{{$emp->uan}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="col-md-6 pl-0">
                <div class="emp-bank m-4 radius" style="background-color:white;">
                    <table class="table table-bordered">
                        <tr class="head">
                            <th colspan="2">Block2</th>
                        </tr>
                        <tr>
                            <th width="200px">Employee Name</th>
                            <td>{{ $salary->name }}</td>
                        </tr>
                        <tr>
                            <th>Date of Joining</th>
                            @php $date=date_create($emp->doj); @endphp
                            <td>{{date_format($date,"d/m/Y")}}</td>
                        </tr>
                        <tr>
                            <th>Bank Name</th>
                            <td>{{$emp->bank_name}}</td>
                        </tr>
                        <tr>
                            <th>PAN No</th>
                            <td>{{$emp->pan_no}}</td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td>Bengaluru</td>
                        </tr>
                        <tr>
                            <th>Employee Grade</th>
                            <td>{{$emp->emp_grade}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        
        <div class="emp-personal m-4 radius" style="margin-top: 5px !important;">
            <div class="row">
            @foreach ($structure as $struct)
            @if($salary->emp_id == $struct->emp_id)    
            <div class="col-md-8 pr-1 paychart">
              <table class="table table-bordered table-sm" style="background-color:white;">
                <tr class="head">
                    <th colspan="5">Earnings</th> 
                </tr>
                <tr>
                    <th width="200px">Description</th>
                    <th class="text-center">CTC Ref</th> 
                    <th class="text-center">Amount</th> 
                    <th class="text-center">Arr Amount</th>
                    <th class="text-center" width="100px">Total</th>   
                </tr>  
                <tr>
                    <th>Basic</th>
                    <td>{{number_format($struct->basic)}}</td>
                    <td>{{number_format($struct->basic)}}</td>
                    <td>0.0</td>
                    <td>{{number_format($struct->basic)}}</td>
                </tr>
                <tr>
                    <th>HRA</th>
                    <td>{{number_format($struct->hra)}}</td>
                    <td>{{number_format($struct->hra)}}</td>
                    <td>0.0</td>
                    <td>{{number_format($struct->hra)}}</td>
                </tr>
                <tr>
                    <th>Conveyance</th>
                    <td>{{number_format($struct->conveyance)}}</td>
                    <td>{{number_format($struct->conveyance)}}</td>
                    <td>0.0</td>
                    <td>{{number_format($struct->conveyance)}}</td>
                </tr>
                <tr>
                    <th>Special Allowance</th>
                    <td>-</td>
                    <td>-</td>
                    <td>0.0</td>
                    <td>{{number_format($struct->spcl_allowance,1)}}</td>
                </tr>
                <tr>
                    <th>Performance Bonus</th>
                    <td>-</td>
                    <td>-</td>
                    <td>0.0</td>
                    <td>{{number_format($struct->performance_bonus,1)}}</td>
                </tr>
                <tr>
                    <th>Night Shift Allowance</th>
                    <td>-</td>
                    <td>-</td>
                    <td>0.0</td>
                    <td>{{number_format($struct->night_allowance,1)}}</td>
                </tr>
                <tr>
                    <th>Statutory Bonus</th>
                    <td>-</td>
                    <td>-</td>
                    <td>0.0</td>
                    <td>{{number_format($struct->statutory_bonus,1)}}</td>
                </tr>
                <tr>
                    <th>Gross Earnings</th>
                    <td>-</td>
                    <td>{{number_format($struct->gross_salary)}}</td>
                    <td>0.0</td>
                    <td>{{number_format($struct->gross_salary)}}</td>
                </tr> 
                <tr height="50">
                    <th>Net Pay</th>
                    <td colspan="3"></td>
                    <td>{{number_format($salary->net_salary) }}</td>
                </tr>      
              </table>
            </div>
                       
            <div class="col-md-4 pl-1 paychart">
              <table class="table table-bordered table-sm"  style="background-color:white;">
                    <tr class="head">   
                        <th colspan="2">Deductions</th>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <th class="text-center">Amount</th> 
                    </tr>  
                    <tr>
                        <th>Professional Tax</th>
                        <td>{{ number_format($salary->tax,2) }}</td>
                    </tr>
                    <tr>
                        <th>ESI</th>
                        <td>{{number_format($struct->esi,2)}}</td>
                    </tr>
                    <tr>
                        <th>PF</th>
                        <td>{{number_format($struct->pf,2)}}</td>
                    </tr>
                    <tr>
                        <th>LOP</th>
                        <td>{{number_format($salary->lop,2) }}</td>
                    </tr>
                    <tr height="33">
                        <th></th>
                        <td></td>
                    </tr>         
                    <tr height="33">
                        <th></th>
                        <td></td>
                    </tr> 
                    <tr height="33">
                        <th></th>
                        <td></td>
                    </tr> 
                    <tr height="33">
                        <th></th>
                        <td></td>
                    </tr> 
                    <tr height="50">
                        <th>Total</th>
                        <td>{{number_format($salary->deduction,2) }}/-</td>
                    </tr> 
              </table>
            </div>
            @endif
            @endforeach
            </div>
        </div>             
    </div>
</div>
@endsection