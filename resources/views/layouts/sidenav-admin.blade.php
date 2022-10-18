<div class="velozion">
    <a class="navbar-brand ml-4" href="{{route('pro')}}">
    <img src="/assets/images/logo.png" alt="" width="170px" height="70px"></a>
</div>
<div class="sidebar scrollbar-primary" id="sidebar">
    <div class="container">
        <!--Accordion wrapper-->
        <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
            <!-- Accordion card -->
            <div class="card">
                <!-- Card header -->
                <div class="show" role="tab" id="dashboard">
                    <a class="dropdown-item  text-white {{ Request::is('dashboard*') ? 'active' : '' }}" href="{{url('dashboard')}}" style="padding: 13px 4px !important;width: 98%!important;">
                        <i class="fas fa-tachometer-alt"></i> &nbsp;Dashboard
                    </a>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header" role="tab" id="headingOne1">
                    <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1">
                        <i class="far fa-user"></i> &nbsp;Employee Management <i class="fas fa-caret-down rotate-icon text-right"></i>
                    </a>
                </div>
                <!-- Card body -->
                <div id="collapseOne1" class="collapse {{ Request::is('employee*') ? 'active' : '' }}" role="tabpanel" aria-labelledby="headingOne1" data-parent="#accordionEx">
                    <div class="card-body left-border">
                        <a class="dropdown-item text-white {{ Request::is('employee*') ? 'active' : '' }}" href="{{route('employee.index')}}">User List</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" role="tab" id="headingTwo2">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">
                        <i class="far fa-address-card"></i> &nbsp;System Management <i class="fas fa-caret-down rotate-icon"></i>
                    </a>
                </div>
                <div id="collapseTwo2" class="collapse {{ (Request::is('designation*') || Request::is('attendance*') || Request::is('report*')) ? 'active' : '' }}" href="{{route('designation.index')}}" role="tabpanel" aria-labelledby="headingTwo2" data-parent="#accordionEx">
                    <div class="card-body left-border">
                        <a class="dropdown-item text-white {{ Request::is('designation*') ? 'active' : '' }}" href="{{route('designation.index')}}">Designation</a>
                        <a class="dropdown-item text-white {{ Request::is('attendance*') ? 'active' : '' }}" href="{{route('attendance.index')}}">Attendance</a>
                        <a class="dropdown-item text-white {{ Request::is('report*') ? 'active' : '' }}" href="{{route('report')}}">Report</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" role="tab" id="headingThree3">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree3" aria-expanded="false" aria-controls="collapseThree3">
                        <i class="far fa-calendar-check"></i> &nbsp;Leave Management <i class="fas fa-caret-down rotate-icon"></i>
                    </a>
                </div>
                <div id="collapseThree3" class="collapse {{ Request::is('leave*') ? 'active' : '' }}" role="tabpanel" aria-labelledby="headingThree3" data-parent="#accordionEx">
                    <div class="card-body left-border">
                        <a class="dropdown-item text-white {{ Request::is('leave*') ? 'active' : '' }}" href="{{route('leave.index')}}"> Leave Requests </a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" role="tab" id="headingFour4">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseFour4" aria-expanded="false" aria-controls="collapseFour4">
                        <i class="far fa-calendar-alt"></i> &nbsp;Event Management <i class="fas fa-caret-down rotate-icon"></i>
                    </a>
                </div>
                <div id="collapseFour4" class="collapse {{ (Request::is('admin/calendar*') || Request::is('events*')) ? 'active' : '' }}" role="tabpanel" aria-labelledby="headingFour4" data-parent="#accordionEx">
                    <div class="card-body left-border">
                        <a class="dropdown-item text-white {{ Request::is('admin/calendar') ? 'active' : '' }}" href="{{route('calendar')}}"> Calendar </a>
                        <a class="dropdown-item text-white {{ Request::is('events*') ? 'active' : '' }}" href="{{route('event-index')}}"> Add Events </a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" role="tab" id="headingFive5">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseFive5" aria-expanded="false" aria-controls="collapseFive5">
                        <i class="fas fa-hand-holding-usd"></i> &nbsp;Payroll Management <i class="fas fa-caret-down rotate-icon"></i>
                    </a>
                </div>
                <div id="collapseFive5" class="collapse {{ Request::is('payroll*') || Request::is('paystructure*') ? 'active' : '' }}" role="tabpanel" aria-labelledby="headingFive5" data-parent="#accordionEx">
                    <div class="card-body left-border">
                        <a class="dropdown-item text-white {{ Request::is('paystructure*') ? 'active' : '' }}" href="{{route('paystructure.index')}}">Salary Structure </a>
                        <a class="dropdown-item text-white {{ Request::is('payroll*') ? 'active' : '' }}" href="{{route('payroll.index')}}">Add Salary </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
