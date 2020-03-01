<!doctype html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="{{asset('img/logo.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>International Cats Contests</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>


    <!-- Bootstrap core CSS     -->

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/>

    <!-- Animation library for notifications   -->
    <link href="  {{asset('css/animate.min.css')}}" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{asset('css/light-bootstrap-dashboard.css?v=1.4.0')}}" rel="stylesheet"/>


    {{--<!--  CSS for Demo Purpose, don't include it in your project     -->--}}
    <link href="{{asset('css/demo.css')}}" rel="stylesheet"/>

    <link href="{{asset('css/custom.css')}}" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{asset('css/pe-icon-7-stroke.css')}}" rel="stylesheet"/>
    <style>
        span {
            margin: 0;
            color: #ffffff;
            font-weight: 300;
        }
        .logo {
            padding: 10px 10px 0 10px;
        }

        .name {
            font-size: 24px;
            color: #333;
            padding-top: 15px;
        }
    </style>

</head>
<body>
@php $today_date = date("Y-m-d");
$contest_reg_start_date = $contest_activation[0]['contest_registration_end_date'];
@endphp

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
              
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
@if($today_date<=$contest_reg_start_date)
<div class="wrapper">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class=" col-lg-offset-3   col-md-offset-3 col-lg-6 col-md-6 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2">
                    @if (Session::has('Error'))
                        <div class="alert alert-danger">
                            <strong><i class="fa fa-exclamation-triangle"></i> {{Session::get('Error')}}</strong>
                        </div>
                    @endif
                    {{session()->forget('Error')}}
                </div>

            <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 col-md-offset-4 col-lg-offset-4 col-sm-8 col-xs-12 col-sm-offset-2 " >
                    <div class="card ">
                        <div class="header bg-card-orange" style="padding-bottom: 10px">
                            {{--<h3 class=" text-center title" style="color: white;">ICATS</h3>--}}
                            <h5 class=" text-center title" style="color: white;">Login to your account</h5>
                        </div>
                        <div class="content">
                            <div class="logo-img text-center">
                                <img src="{{asset('/img/logo.png')}}" class=" img-square  img-responsive"
                                     style="width: 35%">
                                <div class="clearfix"></div>
                            </div>
                            <br>
                            <form class="form-horizontal" method="POST" action="">
                                {{ csrf_field() }}
                                {{--<em style="font-size: 12px;font-style: normal;" class="text-warning">Login email is your insitution's head email</em>--}}
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-3 control-label " style="color: black">
                                        Email</label>

                                    <div class="col-md-9">
                                        <input id="email" type="text" class="form-control"
                                               placeholder="Insitution's Head Email" name="email"
                                               value="{{ old('name') }}"  required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-3 control-label"
                                           style="color: black">Password</label>

                                    <div class="col-md-9">
                                        <input id="password" type="password" placeholder="Password" class="form-control"
                                               name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-fill  text-center">Login
                                    </button>
                                    <div class="clearfix"></div>
                                </div>
                                <hr>
                               <div class="row">
                                   <div class="col-md-12">
                                       <a class="text-primary " href="{{ route('password.request') }}">Forgot Password?</a>
                                   </div>
                               </div>
                                <div class="text-center">
                                    <a class="btn btn-primary btn-fill btn-block text-center" href="{{route("register")}}">New Registration
                                    </a>
                                    <div class="clearfix"></div>
                                </div>



                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
    @else
    <div class="container">
        <div class="card">
            <div class=" navbar-ct-blue ">
                <h1 class="text-center " style="color: white;">Registration Closed</h1>
            </div>
        </div>

    </div>
</div>

    @endif

</body>

<!--   Core JS Files   -->
<script src="{{asset('js/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="{{asset('js/chartist.min.js')}}"></script>

<!--  Notifications Plugin    -->
<script src="{{asset('js/bootstrap-notify.js')}}"></script>
<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="{{asset('js/light-bootstrap-dashboard.js?v=1.4.0')}}"></script>


{{--<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->--}}
<script src="{{asset('js/demo.js')}}"></script>
<script src="{{asset('js/jquery.maskedinput.min.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        var alert_danger=$("#alert-danger").is('display');
        $(".alert").delay(5000).slideUp(500, function() {
            $(this).alert('close');
        });
    });
</script>


