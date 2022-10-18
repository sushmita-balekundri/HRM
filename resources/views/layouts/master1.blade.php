<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Velozion') }}</title> --}}
    <title>HR Management</title>
       <!-- Scripts -->
       <script src="{{ asset('js/app.js') }}" ></script>
       <script>
           var $i = jQuery.noConflict();
       </script> 
       
   
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/calendar.css') }}" rel="stylesheet">
       
   
         <!-- fontawesome -->
       {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> --}}
       <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
       <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
   
   
        <!-- js -->
        {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> --}}
        <script src="{{ asset('assets/js/bootstrap.min.js') }}" ></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   
        {{-- calendar --}}
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/> --}}
        <link href="{{ asset('assets/css/fullcalendar.min.css') }}" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script> --}}
        <script src="{{ asset('assets/js/moment.min.js') }}" ></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script> --}}
        <script src="{{ asset('assets/js/fullcalendar.min.js') }}" ></script>
</head>
<body>
<div id="app">
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-2 p-0"> @include('layouts.sidenav-employee') </div>
        <div class="col-md-10 p-0">
            <div> @include('layouts.topnav') </div>
            <div class="start">
                <main class="content scrollbar-primary">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    </div>   
</div>

@yield ('scripts')

</body>
</html>
