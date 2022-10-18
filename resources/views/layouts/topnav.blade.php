<div class="container">
    <div class="row">   
        <div class="col-md-4 navbar topsearch"></div>
        
        <div class="col-md-8">
            <nav class="navbar fixed-top navbar-light bg-light1 justify-content-between">
                <div></div>
                <div class="form-inline">
                    <div class="nav-item dropdown">
                        @guest
                            <a class="nav-link dropdown-toggle" href="{{ route('login') }}" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Login
                            </a>
                        @else
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="text-white">{{ Auth::user()->name }} </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right logoutbtn" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item log" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                </a>
                    
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        @endguest  
                    </div>
                    <a href="/dashboard"><i class="fas fa-home text-white"></i></a>
                </div>
            </nav>
        </div>
    </div>
</div>
 