<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ICATS CONTESTS') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div style="background-color: #F5F5F5" >
    {{--<nav class="navbar navbar-default navbar-static-top">--}}
    {{--<div class="container">--}}
    {{--<div class="navbar-header">--}}

    {{--<!-- Collapsed Hamburger -->--}}
    {{--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">--}}
    {{--<span class="sr-only">Toggle Navigation</span>--}}
    {{--<span class="icon-bar"></span>--}}
    {{--<span class="icon-bar"></span>--}}
    {{--<span class="icon-bar"></span>--}}
    {{--</button>--}}

    {{--<!-- Branding Image -->--}}
    {{--<a class="navbar-brand" href="{{ url('/') }}">--}}
    {{--{{ config('app.name', 'Laravel') }}--}}
    {{--</a>--}}
    {{--</div>--}}

    {{--<div class="collapse navbar-collapse" id="app-navbar-collapse">--}}
    {{--<!-- Left Side Of Navbar -->--}}
    {{--<ul class="nav navbar-nav">--}}
    {{--&nbsp;--}}
    {{--</ul>--}}

    {{--<!-- Right Side Of Navbar -->--}}
    {{--<ul class="nav navbar-nav navbar-right">--}}
    {{--<!-- Authentication Links -->--}}
    {{--@if (Auth::guest())--}}
    {{--<li><a href="{{ route('login') }}">Login</a></li>--}}
    {{--<li><a href="{{ route('register') }}">Register</a></li>--}}
    {{--@else--}}
    {{--<li class="dropdown">--}}
    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">--}}
    {{--{{ Auth::user()->user_name }} <span class="caret"></span>--}}
    {{--</a>--}}

    {{--<ul class="dropdown-menu" role="menu">--}}
    {{--<li>--}}
    {{--<a href="{{ route('logout') }}"--}}
    {{--onclick="event.preventDefault();--}}
    {{--document.getElementById('logout-form').submit();">--}}
    {{--Logout--}}
    {{--</a>--}}

    {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
    {{--{{ csrf_field() }}--}}
    {{--</form>--}}
    {{--</li>--}}
    {{--</ul>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</nav>--}}

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="logo pull-left" href="#"><img src="{{asset('img/logo.png')}}" width="100px" height="100px"></a>
                <span class="name  title pull-left"><b style="font-weight: 500" class="title">INTERNATIONAL CATS CONTESTS</b><br>
                    <p>Helping future leaders know their hidden potential</p>
                </span>
            </div>
            <!--  <div id="navbar" class="navbar-collapse collapse">
                  <ul class="nav navbar-nav pull-right" style="padding: 40px 5px 0px 5px;margin: 30px 0px 0px 0px; font-size: 100%">
                      <li class="active"><a href="#">Home</a></li>
                      <li><a href="#about">Contest</a></li>
                      <li><a href="#contact">About US</a></li>
                      <li><a href="#contact">About US</a></li>
                      <li><a href="#contact">About US</a></li>
                      <li><a href="#contact">About US</a></li>
                      <li><a href="#contact">About US</a></li>

                  </ul>
              </div><!--/.nav-collapse -->
        </div>
    </nav>

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{asset('js/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script type="text/javascript">
    @yield('script')
</script>
</body>
</html>
