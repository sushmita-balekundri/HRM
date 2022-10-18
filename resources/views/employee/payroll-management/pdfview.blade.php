<html>

<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @page {
            margin: 0cm 0cm;
        }

        /* Define now the real margins of every page in the PDF */
        body {
            background-color: transparent !important;
            font-size: 10.3px;
            color: #000;
            font-family: sans-serif !important;
        }

        /* Define the header rules */ 
        header {
            position: fixed;
            top: 1.5cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            text-align: center;
        }

        main {
            margin-top: 175px;
            margin-left: 40px; 
            margin-right: 40px; 
        }
        
        * {
            box-sizing: border-box;
        }

        .box {
            float: left;
            width: 48.5%;
            /* border:1px solid #2e2f2f; */
            border-radius: 0px; 
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }


        .two{ 
            width: 40em; 
            max-width: 50%; 
        }
        .two p{ 
            display: inline-block; 
            width: 161px; 
            border:1px solid #000;
            border-bottom:none;
            border-radius: 0px;
            padding:7px 5px 7px 5px; 
            text-indent:0.5em;
            margin: 6.4px 0px -7px 0px;
        }
        .two p:nth-child(1) { float:left; }
        .two p:nth-child(1) { float:right; }

        table{
            margin-top: 21px;
            margin-left: -1;
        }

        .block1 {
            float: left;
            width: 65%;
            /* border:1px solid #2e2f2f; */
            border-radius: 0px; 
        }

        .block2 {
            float: left;
            width: 32%;
            /* border:1px solid #2e2f2f; */
            border-radius: 0px; 
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .one{ 
            width: 40em; 
            max-width: 50%; 
        }
        .one p{ 
            display: inline-block; 
            width: 64.1px; 
            border:1px solid #000;
            border-bottom:none;
            border-radius: 0px; 
            padding:7px 5px 7px 5px; 
            text-indent:0.5em;
            margin: 6.4px -0.5px -7px -2px;
        }
        .one p:nth-child(1) { float:left; }
        .one p:nth-child(1) { float:right; }

    </style>
</head>

<body>
    <header>
        <img src="assets/images/logo.png" width="16%" height="48px">
        <div class="text-center" style="font-size:12px !important; margin:15px 0px 5px 0px;letter-spacing: 0.7px;">VELOZION TECHNOLOGIES PVT LTD</div>
        <div class="text-center" style="font-size:10px !important;">#5/1, 2nd Floor, Saraswathamma Complex, TC Palya Main Road, Ramamurthy Nagar, Bangalore - 560016, India.</div>
    </header>
    
    <main>
        <div class="clearfix">
            <div class="box" style="margin-right:10px !important;">
                @foreach($user as $emp)
                @if($salary->emp_id == $emp->emp_id )
                <div class="two">
                    <p><b>Employee Code</b></p>
                    <p style="border-left:none !important; ">{{ $salary->emp_id }}</p>
                </div>
                <div class="two">
                    <p><b>Date of Birth</b></p>
                    @php $date=date_create($emp->dob); @endphp
                    <p style="border-left:none !important; ">{{date_format($date,"d/m/Y")}}</p>
                </div>
                <div class="two">
                    <p><b>Designation</b></p>
                    <p style="border-left:none !important; ">{{ $emp->designation }}</p>
                </div>
                <div class="two">
                    <p><b>Bank Account No.</b></p>
                    <p style="border-left:none !important; ">{{ $emp->account }}</p>
                </div>
                <div class="two">
                    <p><b>PF No</b></p>
                    <p style="border-left:none !important; ">{{ $emp->pf_no }}</p>
                </div>
                <div class="two">
                    <p><b>No. of Days LOP</b></p>
                    <p style="border-left:none !important; ">{{number_format($salary->lop_days,2)}}/{{number_format($salary->present_days,2)}}/{{number_format($salary->total_working_days,2)}}</p>
                </div>
                <div class="two">
                    <p style="border-bottom:1px solid #000 !important; "><b>UAN</b></p>
                    <p style="border-bottom:1px solid #000 !important;border-left:none !important;">{{ $emp->uan }}</p>
                </div>
                @endif
                @endforeach
            </div>
            <div class="box" style="margin-left:9px !important; margin-top:0px !important;">
                @foreach($user as $emp)
                @if($salary->emp_id == $emp->emp_id )
                <div class="two">
                    <p><b>Employee Name</b></p>
                    <p style="border-left:none !important; ">{{ $salary->name }}</p>
                </div>
                <div class="two">
                    <p><b>Date of Joining</b></p>
                    @php $date=date_create($emp->doj); @endphp
                    <p style="border-left:none !important; ">{{date_format($date,"d/m/Y")}}</p>
                </div>
                <div class="two">
                    <p><b>Bank Name</b></p>
                    <p style="border-left:none !important; ">{{ $emp->bank_name }}</p>
                </div>
                <div class="two">
                    <p><b>PAN No</b></p>
                    <p style="border-left:none !important; ">{{ $emp->pan_no }}</p>
                </div>
                <div class="two">
                    <p><b>Location</b></p>
                    <p style="border-left:none !important; ">Bengaluru</p>
                </div>
                <div class="two">
                    <p><b>Employee Grade</b></p>
                    <p style="border-left:none !important; ">{{ $emp->emp_grade }}</p>
                </div>
                <div class="two">
                    <p style="color:white;border-bottom:1px solid #000 !important;">-</p>
                    <p style="color:white;border-bottom:1px solid #000 !important;border-left:none !important; ">-</p>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        
        <table style="margin-top:15px">
            <tr style="background-color: #dfe3e6;">
                <td width="535" style="border: 1px solid black;border-right: none;border-left: none;padding:4px -10px 4px 10px;text-indent:-0.5em !important;font-size:12px;">Payslip for the month of {{$salary->month}} {{$salary->year}}</td>
            </tr>
        </table>

        <table>
            <tr>
                <td width="353" height="25" style="border:1px solid #2e2f2f;font-size:12px;"><center>Earnings</center></td>
                <td width="179.5" height="25" style="border:1px solid #2e2f2f;font-size:12px;"><center>Deductions</center></td>
            </tr>
        </table>

        <div class="clearfix"  style="margin-top:15px !important;">
            <div class="block1" style="margin-right:10px !important;">
                @foreach($structure as $struct)
                @if($salary->emp_id == $struct->emp_id )
                <div class="one">
                    <p style="width:100 !important;margin-right:-1 !important;"><b>Description</b></p>
                    <p class="text-center" style="margin-right:-1 !important;border-left:none !important;text-indent:0!important;"><b>CTC Ref</b></p>
                    <p class="text-center" style="margin-right:1 !important;border-left:none !important;text-indent:0!important;"><b>Amount</b></p>
                    <p class="text-center" style="width:63.3 !important;margin-right:-1 !important;border-left:none !important;text-indent:0!important;"><b>Arr Amount</b></p>
                    <p class="text-center" style="width:47 !important; margin-left:-0.2 !important;border-left:none !important;text-indent:0!important;"><b>Total</b></p>
                </div>
                <div class="one">
                    <p style="width:100 !important;margin-right:-1 !important;">Basic </p>
                    <p class="text-center" style="margin-right:-1 !important;border-left:none !important;text-indent:0!important;">{{number_format($struct->basic)}}</p>
                    <p class="text-center" style="margin-right:1 !important;border-left:none !important;text-indent:0!important;">{{number_format($struct->basic)}}</p>
                    <p class="text-center" style="width:63.3 !important;margin-right:-1 !important;border-left:none !important;text-indent:0!important;">0.0</p>
                    <p class="text-center" style="width:47 !important; margin-left:-0.2 !important;border-left:none !important;text-indent:0!important;">{{number_format($struct->basic)}}</p>
                </div>
                <div class="one">
                    <p style="width:100 !important;margin-right:-1 !important;">HRA</p>
                    <p class="text-center" style="margin-right:-1 !important;border-left:none !important;text-indent:0!important;">{{number_format($struct->hra)}}</p>
                    <p class="text-center" style="margin-right:1 !important;border-left:none !important;text-indent:0!important;">{{number_format($struct->hra)}}</p>
                    <p class="text-center" style="width:63.3 !important;margin-right:-1 !important;border-left:none !important;text-indent:0!important;">0.0</p>
                    <p class="text-center" style="width:47 !important; margin-left:-0.2 !important;border-left:none !important;text-indent:0!important;">{{number_format($struct->hra)}}</p>
                </div>
                <div class="one">
                   <p style="width:100 !important;margin-right:-1 !important;">Conveyance</p>
                    <p class="text-center" style="margin-right:-1 !important;border-left:none !important;text-indent:0!important;">{{number_format($struct->conveyance)}}</p>
                    <p class="text-center" style="margin-right:1 !important;border-left:none !important;text-indent:0!important;">{{number_format($struct->conveyance)}}</p>
                    <p class="text-center" style="width:63.3 !important;margin-right:-1 !important;border-left:none !important;text-indent:0!important;">0.0</p>
                    <p class="text-center" style="width:47 !important; margin-left:-0.2 !important;border-left:none !important;text-indent:0!important;">{{number_format($struct->conveyance)}}</p>
                </div>
                <div class="one">
                    <p style="width:100 !important;margin-right:-1 !important;">Special Allowance</p>
                    <p class="text-center" style="margin-right:-1 !important;border-left:none !important;text-indent:0!important;">-</p>
                    <p class="text-center" style="margin-right:1 !important;border-left:none !important;text-indent:0!important;">-</p>
                    <p class="text-center" style="width:63.3 !important;margin-right:-1 !important;border-left:none !important;text-indent:0!important;">0.0</p>
                    <p class="text-center" style="width:47 !important; margin-left:-0.2 !important;border-left:none !important;text-indent:0!important;">{{number_format($struct->spcl_allowance,1)}}</p>
                </div>
                <div class="one">
                    <p style="width:100 !important;margin-right:-1 !important;">Performance Bonus</p>
                    <p class="text-center" style="margin-right:-1 !important;border-left:none !important;text-indent:0!important;">-</p>
                    <p class="text-center" style="margin-right:1 !important;border-left:none !important;text-indent:0!important;">-</p>
                    <p class="text-center" style="width:63.3 !important;margin-right:-1 !important;border-left:none !important;text-indent:0!important;">0.0</p>
                    <p class="text-center" style="width:47 !important; margin-left:-0.2 !important;border-left:none !important;text-indent:0!important;">{{number_format($struct->performance_bonus,1)}}</p>
                </div>
                <div class="one">
                   <p style="width:100 !important;margin-right:-1 !important;">Night Shift Allowance</p>
                    <p class="text-center" style="margin-right:-1 !important;border-left:none !important;text-indent:0!important;">-</p>
                    <p class="text-center" style="margin-right:1 !important;border-left:none !important;text-indent:0!important;">-</p>
                    <p class="text-center" style="width:63.3 !important;margin-right:-1 !important;border-left:none !important;text-indent:0!important;">0.0</p>
                    <p class="text-center" style="width:47 !important; margin-left:-0.2 !important;border-left:none !important;text-indent:0!important;">{{number_format($struct->night_allowance,1)}}</p>
                </div>
                <div class="one">
                   <p style="width:100 !important;margin-right:-1 !important;">Statutory Bonus</p>
                    <p class="text-center" style="margin-right:-1 !important;border-left:none !important;text-indent:0!important;">-</p>
                    <p class="text-center" style="margin-right:1 !important;border-left:none !important;text-indent:0!important;">-</p>
                    <p class="text-center" style="width:63.3 !important;margin-right:-1 !important;border-left:none !important;text-indent:0!important;">0.0</p>
                    <p class="text-center" style="width:47 !important; margin-left:-0.2 !important;border-left:none !important;text-indent:0!important;">{{number_format($struct->statutory_bonus,1)}}</p>
                </div>
                <div class="one">
                   <p style="width:100 !important;margin-right:-1 !important;"><b>Gross Earnings</b></p>
                    <p class="text-center" style="margin-right:-1 !important;border-left:none !important;text-indent:0!important;">-</p>
                    <p class="text-center" style="margin-right:1 !important;border-left:none !important;text-indent:0!important;">{{number_format($struct->gross_salary)}}</p>
                    <p class="text-center" style="width:63.3 !important;margin-right:-1 !important;border-left:none !important;text-indent:0!important;">0.0</p>
                    <p class="text-center" style="width:47 !important; margin-left:-0.2 !important;border-left:none !important;text-indent:0!important;">{{number_format($struct->gross_salary)}}</p>
                </div>
                <div class="one">
                   <p style="width:100 !important;margin-right:-1 !important;"><b>Net Pay</b></p>
                    <p class="text-center" style="color:white;margin-right:-1 !important;border-left:none !important;text-indent:0!important;">-</p>
                    <p class="text-center" style="color:white;margin-right:1 !important;border-left:none !important;text-indent:0!important;">-</p>
                    <p class="text-center" style="width:63.3 !important;margin-right:-1 !important;border-left:none !important;text-indent:0!important;">-</p>
                    <p class="text-center" style="width:47 !important; margin-left:-0.2 !important;border-left:none !important;text-indent:0!important;">{{number_format($salary->net_salary) }}</p>
                </div>
                @endif
                @endforeach
            </div>
            <div class="block2" style="margin-left:9px !important; margin-top:0px !important;">
                @foreach($structure as $struct)
                @if($salary->emp_id == $struct->emp_id )
                <div class="one">
                    <p style="width:110 !important;"><b>Description</b></p>
                    <p class="text-center" style="width:46 !important;margin-left:40.5px; !important;border-left:none !important;text-indent:0!important;"><b>Amount</b></p>
                </div>
                <div class="one">
                    <p style="width:110 !important;">Professional Tax</p>
                    <p class="text-center" style="width:46 !important;margin-left:40.5px; !important;border-left:none !important;text-indent:0!important;">{{ number_format($salary->tax,2) }}</p>
                </div>
                <div class="one">
                    <p style="width:110 !important;">ESI</p>
                    <p class="text-center" class="text-center" style="width:46 !important;margin-left:40.5px; !important;border-left:none !important;text-indent:0!important;">{{number_format($struct->esi,2)}}</p>
                </div>
                <div class="one">
                    <p style="width:110 !important;">PF</p>
                    <p class="text-center" style="width:46 !important;margin-left:40.5px; !important;border-left:none !important;text-indent:0!important;">{{number_format($struct->pf,2)}}</p>
                </div>
                <div class="one">
                    <p style="width:110 !important;text-indent:0.5em !important;">LOP & Other Deduction</p>
                    <p class="text-center" style="width:46 !important;margin-left:40.5px; !important;border-left:none !important;text-indent:0!important;">{{number_format($salary->lop,2) }}</p>
                </div>
                <div class="one">
                    <p style="width:110 !important;color:white;">-</p>
                    <p style="width:46 !important;margin-left:40.5px; !important;color:white;border-left:none !important;text-indent:0!important;">-</p>
                </div>
                <div class="one">
                    <p style="width:110 !important;color:white;">-</p>
                    <p style="width:46 !important;margin-left:40.5px; !important;color:white;border-left:none !important;text-indent:0!important;">-</p>
                </div>
                <div class="one">
                    <p style="width:110 !important;color:white;">-</p>
                    <p style="width:46 !important;margin-left:40.5px; !important;color:white;border-left:none !important;text-indent:0!important;">-</p>
                </div>
                <div class="one">
                    <p style="width:110 !important;color:white;">-</p>
                    <p style="width:46 !important;margin-left:40.5px; !important;color:white;border-left:none !important;text-indent:0!important;">-</p>
                </div>
                <div class="one">
                    <p style="width:110 !important;"><b>Total</b></p>
                    <p class="text-center"class="text-center" style="width:46 !important;margin-left:40.5pxpx; !important;border-left:none !important;text-indent:0!important;"><b>{{number_format($salary->deduction,2) }}/-</b></p>
                </div>
                @endif
                @endforeach
            </div>
        </div>

        <table style=" margin-top: -1px; !important;">
            <tr>
                <td width="532.8" style="border:1px solid #2e2f2f;padding:7px -10px 7px 10px;"><b>Net Pay in words:</b> 
                {{-- </?php $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                      echo ucwords($f->format($salary->net_salary))." Only.";?> --}}
                </td>
            </tr>
        </table>

        <div style="margin-top:10px;">
            Remarks: This is a computer generated payslip and does not require authentication.
        </div>

    </main>
</body>

</html>