<div class="velozion emppage-logo">
    <a class="navbar-brand ml-4" href="{{route('pro')}}">
    <img src="/assets/images/logo.png" alt="" width="170px" height="70px"></a>
</div>
<div class="employee-dashboard sidebar scrollbar-primary" id="sidebar">
    <div class="container">
        <!--Accordion wrapper-->
        <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
            <!-- Accordion card -->
            <div class="card">
                <!-- Card header -->
                <div class="show" role="tab" id="dashboard">
                    <a class="dropdown-item text-white {{ Request::is('dashboard*') ? 'active' : '' }}" href="{{url('dashboard')}}">
                        <i class="fas fa-tachometer-alt"></i> &nbsp; Dashboard
                    </a>
                </div>
            </div>

            <div class="card">
                <!-- Card header -->
                <div class="show" role="tab" id="dashboard">
                    <a class="dropdown-item text-white {{ Request::is('profile*') ? 'active' : '' }}" href="{{route('profile.index')}}">
                        <i class="far fa-user"></i> &nbsp; My Profile
                    </a>
                </div>
            </div>

            <div class="card">
                <!-- Card header -->
                <div class="show" role="tab" id="dashboard">
                    <a class="dropdown-item text-white {{ Request::is('calendar*') ? 'active' : '' }}" href="{{route('ecalendar')}}">
                        <i class="far fa-calendar-alt"></i> &nbsp; Event Management
                    </a>
                </div>
            </div>

            <div class="card">
                <!-- Card header -->
                <div class="show" role="tab" id="dashboard">
                    <a class="dropdown-item text-white {{ Request::is('userleave*') ? 'active' : '' }}" href="{{route('userleave.index')}}">
                        <i class="far fa-calendar-check"></i> &nbsp; Leave Management
                    </a>
                </div>
            </div>

            <div class="card">
                <!-- Card header -->
                <div class="show" role="tab" id="dashboard">
                    <a class="dropdown-item text-white sidelinks{{ Request::is('salary*') ? 'active' : '' }}" href="{{route('salary.index')}}">
                        <i class="fas fa-hand-holding-usd"></i> &nbsp; Payslips
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
