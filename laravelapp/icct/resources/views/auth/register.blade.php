<!doctype html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="{{asset('img/logo.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="_token" content="{{csrf_token()}}" />
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

        .fonts {
            font-weight: 300;
        }

        li {
            font-size: 16px !important;
        }
    </style>

</head>
<body>
@php$today_date = date("Y-m-d");
$contest_reg_end_date = $contest_activation[0]['contest_registration_end_date'];
//dd($contest_activation);
@endphp
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
              
            </button>
            <a class="logo pull-left" href="#"><img src="{{asset('img/logo.png')}}" width="100px" height="100px"></a>
            <span class="name  title pull-left"><b style="font-weight: 500"
                                                   class="title">International CATS Contests</b><br>
                    <p>Helping future leaders know their hidden potential</p>
                </span>
        </div>
    </div>
</nav>
@if($today_date<=$contest_reg_end_date)

    <div class="wrapper">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fadeIn ">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <span>
                        <strong>Error Highlighted on Form Icons</strong>! Registration not completed please go to highlighted section and correct them
                    </span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 ">
                        <div class="card">
                            <div class="navbar-ct-blue ">
                                <h3 class="title text-center " style="color: #fff;">Institution Registration</h3>
                            </div>
                            <div class="content">
                                <form id="ins_registration_form" action="{{ route('register') }}" method="POST">
                                    {{csrf_field()}}
                                    <div class="wizards">
                                        <div class="progressbar">
                                            <div class="progress-line" data-now-value="15.66" data-number-of-steps="4"
                                                 style="width: 15.66%;"></div> <!-- 19.66% -->
                                        </div>
                                        <div class="form-wizard active">
                                            <div class="wizard-icon"><i class="fa fa-file-text-o"></i></div>
                                            <p>Important Information</p>
                                        </div>
                                        <div class="form-wizard ">
                                            <div class="wizard-icon @if($errors->has('institute_off_account_no')||$errors->has('institute_name')|| $errors->has('institute_province') || $errors->has('institute_city') || $errors->has('institute_phone') || $errors->has('institute_address') || $errors->has('institute_email')) wizard-icon-error  @endif">
                                                <i class="fa fa-university"></i></div>
                                            <p>Institution's Details</p>
                                        </div>
                                        <div class="form-wizard">
                                            <div class="wizard-icon @if ( $errors->has('user_name')||$errors->has('head_job_title')|| $errors->has('head_mobile_no')|| $errors->has('head_land_line_no')||$errors->has('email') || $errors->has('register_password')) wizard-icon-error  @endif">
                                                <i class="fa fa-key"></i></div>
                                            <p>Login and Head Details</p>
                                        </div>
                                        <div class="form-wizard">
                                            <div class="wizard-icon"><i class="fa fa-check-circle"></i></div>
                                            <p>Finish</p>
                                        </div>
                                    </div>
                                    <fieldset>
                                        <div class="row" style="border: none">
                                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                                <div class="card">
                                                    <div class="content">
                                                        <div class="navbar-ct-blue">
                                                            <h4 class="" style="color: white;">Important
                                                                Information</h4>
                                                        </div>
                                                        {{--<div style="float:left; position:relative; width:100%;">--}}
                                                        <ul>
                                                            <li class="pull-left">It is a school based competition
                                                                open for all students from grade 1st to 10th /
                                                                O-Levels. The students will not be required to
                                                                travel anywhere, it will be held in their own
                                                                institution.
                                                            </li>
                                                            <li style="text-align: justify;">Minimum Participation
                                                                of 10 students from a participating grade is MUST.
                                                                There is no maximum limit; institutions can register
                                                                as many students from a grade as they wish.
                                                            </li>
                                                            <li style="text-align: justify;">The participation fee
                                                                is <strong>Rs. 700 </strong>per participant.
                                                            </li>
                                                            <li style="text-align: justify;">The registration will be
                                                                accepted from <strong
                                                                        class="text-primary">{{date('F d, Y', strtotime($contest_activation[0]['contest_registration_start_date']))}}</strong>&nbsp
                                                                till <strong
                                                                        class="text-primary">{{date('F d, Y', strtotime($contest_activation[0]['contest_registration_end_date']))}}</strong>,
                                                                thereafter no registration will be accepted.
                                                            </li>
                                                            <li style="text-align: justify;"><strong
                                                                        class="text-primary">{{$contest_activation[0]['contest_category_name']}}</strong>
                                                                will be
                                                                held on<strong
                                                                        class="text-primary"> {{date('F d, Y',strtotime($contest_activation[0]['contest_date']))}}
                                                                </strong>.
                                                            </li>
                                                            <li style="text-align: justify;"><strong
                                                                        class="text-primary">{{$contest_activation[1]['contest_category_name']}}</strong>
                                                                will be held on <strong
                                                                        class="text-primary ">{{date('F d, Y',strtotime($contest_activation[1]['contest_date']))}}
                                                                </strong>
                                                            </li>
                                                            <li>If you need any further assistance, don't hesitate
                                                                to contact the Program Coordinator at 92 42 35132277
                                                                or 0332 5132277 or through email at
                                                                info@catscontests.org
                                                            </li>
                                                        </ul>
                                                        <div class="navbar-ct-blue">
                                                            <h4 class="" style="color: white;">
                                                                Payment Options</h4>
                                                        </div>
                                                        <ul>
                                                            <li style="text-align: justify;">Bank draft / Pay order
                                                                drawn in favour of International CATS Contests.
                                                            </li>
                                                            <li style="text-align: justify;">Direct deposit into
                                                                International CATS Contests bank account.
                                                            </li>
                                                            <li style="text-align: justify;"> Online payment /
                                                                transfer into International CATS Contests bank
                                                                account.
                                                            </li>
                                                        </ul>
                                                        <p>Payment through any other medium is not acceptable. Bank
                                                            deposit, online payment slip should be attached with
                                                            the form.</p>
                                                        <p><strong>ICATS BANK ACCOUNT
                                                                DETAILS:</strong><br><strong>Title of
                                                                Account:</strong> International CATS
                                                            Contests<br><strong>Account No:</strong> 0109 0002 3584
                                                            0462<br><strong>For Online/ATM Transfer:</strong>
                                                            0559235840462<br><strong>IBAN: </strong>PK44 UNIL 0109
                                                            0002 3584 0462<br><strong>Bank name and
                                                                address:</strong> United Bank Limited, Ichra Branch,
                                                            Lahore.<br>
                                                            <strong>Branch Code: </strong>0559</p>
                                                        <p>A registration confirmation e-mail will be sent to
                                                            the given e-mail address on completion of the online
                                                            students' registration. If you need to change any of the
                                                            information, you can do so till registration deadline by
                                                            logging into your account.</p>

                                                    </div>
                                                    {{--</div>--}}

                                                    {{--</div>--}}

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check-label" style="font-size: 16px ;color: #1D62F0">
                                            <input class="form-check-input" type="checkbox" value="yes"> I have read the
                                            important information
                                        </div>
                                        <div class="wizard-buttons">
                                            <button type="button" class="btn btn-next">Next</button>
                                        </div>
                                    </fieldset>
                                    <fieldset style="min-height: 430px">
                                        <h4>Institution's Particulars</h4>
                                        <input type="hidden" name="institute_province_posted"
                                               id="institute_province_posted"
                                               value="">
                                        <div class="row">
                                            {{--<div class="col-md-6">--}}
                                            {{--<div class="form-group {{ $errors->has('user_name') ? ' has-error' : '' }}">--}}
                                            {{--<label>Institute's Head Name</label>--}}
                                            {{--<input style="text-transform:uppercase" type="text" name="user_name" id="user_name"--}}
                                            {{--value="{{ old('user_name') }}" class="form-control"--}}
                                            {{--placeholder="Enter User Name"/>--}}
                                            {{--@if ($errors->has('user_name'))--}}
                                            {{--<span class="help-block">--}}
                                            {{--{{ $errors->first('user_name') }}--}}
                                            {{--</span>--}}
                                            {{--@endif--}}
                                            {{--</div>--}}
                                            {{--</div>--}}

                                            <div class="col-md-12">
                                                <div class="form-group {{ $errors->has('institute_name') ? ' has-error' : '' }}">
                                                    <label>Insitution's Name</label>
                                                    <input style="text-transform:uppercase" type="text"
                                                           name="institute_name" id="institute_name"
                                                           class="form-control" value="{{ old('institute_name') }}"
                                                           placeholder="Enter Institution Name"/>
                                                    @if ($errors->has('institute_name'))
                                                        <span class="help-block">
                                        {{ $errors->first('institute_name') }}
                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group {{ $errors->has('institute_address') ? ' has-error' : '' }}">
                                                    <label>Insitution's Address</label>
                                                    <textarea name="institute_address"
                                                              class="form-control"
                                                              id="institute_address"
                                                              placeholder="Enter Institution Address">{{old('institute_address')}}</textarea>
                                                    {{--<p style="font-weight: 300; font-size: 14px;" class="text-primary">Insitute's Address must be less than 1022 characters</p>--}}
                                                    @if ($errors->has('institute_address'))
                                                        <span class="help-block">
                                      {{ $errors->first('institute_address') }}
                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('institute_city') ? ' has-error' : '' }} ">
                                                    <label for="institute_city">City</label>
                                                    <input style="text-transform:uppercase" type="text"
                                                           name="institute_city" id="institute_city"
                                                           class="form-control" value="{{ old('institute_city') }}"
                                                           placeholder="Enter City Name"/>
                                                    @if ($errors->has('institute_city'))
                                                        <span class="help-block">
                                                {{ $errors->first('institute_city') }}
                                                </span>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('institute_province') ? ' has-error' : '' }}">
                                                    <label for="institute_province">Province</label>
                                                    <select id="institute_province" name="institute_province"
                                                            class="form-control">
                                                        <option value="">Select Province</option>
                                                        <?php
                                                        foreach ($provinces as $row){ ?>
                                                        <option @php if(old('institute_province')){ echo 'selected="selected"';}@endphp value="@php  echo $row->province_name ; @endphp"> @php  echo $row->province_name;@endphp</option>
                                                        <?php } ?>
                                                    </select>
                                                    @if ($errors->has('institute_province'))
                                                        <span class="help-block">
                                        {{ $errors->first('institute_province') }}
                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('institute_phone') ? ' has-error' : '' }}">
                                                    <label>Phone No</label>
                                                    <input type="text" name="institute_phone" id="institute_phone"
                                                           class="form-control" value="{{ old('institute_phone') }}"
                                                           placeholder="Phone No(e.g 042-1111111)"/>
                                                    @if ($errors->has('institute_phone'))
                                                        <span class="help-block">
                                       {{ $errors->first('institute_phone') }}
                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('institute_email') ? ' has-error' : '' }}">
                                                    <label>Insititution's Official Email</label>
                                                    <input type="email" name="institute_email" id="institute_email"
                                                           class="form-control" value="{{ old('institute_email') }}"
                                                           placeholder="Enter Institute Email"/>
                                                    @if ($errors->has('institute_email'))
                                                        <span class="help-block">
                                       {{ $errors->first('institute_email') }}
                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('institute_off_account_no') ? ' has-error' : '' }}">
                                                    <label>Institution's Official Bank Account</label><br>
                                                    <em style="font-size: 11px;margin: 0; padding: 0;font-style: normal">(TO
                                                        BE USED FOR HONORARIUM PAYMENT)</em>
                                                    <input type="text" name="institute_off_account_no"
                                                           id="institute_off_account_no"
                                                           class="form-control"
                                                           value="{{ old('institute_off_account_no') }}"
                                                           placeholder="Enter Account Title"/>
                                                    @if ($errors->has('institute_off_account_no'))
                                                        <span class="help-block">
                                       {{ $errors->first('institute_off_account_no') }}
                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>

                                        <div class="wizard-buttons">
                                            <button type="button" class="btn btn-previous">Previous</button>
                                            <button type="button" class="btn btn-next">Next</button>
                                        </div>
                                    </fieldset>
                                    <fieldset style="min-height: 430px">
                                        <h4 class="text-primary">Institution's Head Details</h4>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group {{ $errors->has('user_name') ? ' has-error' : '' }}">
                                                    <label>Name</label>
                                                    <input style="text-transform:uppercase" type="text" name="user_name"
                                                           id="user_name"
                                                           value="{{ old('user_name') }}" class="form-control"
                                                           placeholder="Name"/>
                                                    @if ($errors->has('user_name'))
                                                        <span class="help-block">
                                       {{ $errors->first('user_name') }}
                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group {{ $errors->has('head_job_title') ? ' has-error' : '' }}">
                                                    <label>Job Title</label>
                                                    <input style="text-transform:uppercase" type="text"
                                                           name="head_job_title" id="head_job_title"
                                                           value="{{ old('head_job_title') }}" class="form-control"
                                                           placeholder="Job Title"/>
                                                    @if ($errors->has('head_job_title'))
                                                        <span class="help-block">
                                       {{ $errors->first('head_job_title') }}
                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group {{ $errors->has('head_mobile_no') ? ' has-error' : '' }}">
                                                    <label>Mobile No</label>
                                                    <input style="text-transform:uppercase" type="text"
                                                           name="head_mobile_no" id="head_mobile_no"
                                                           value="{{ old('head_mobile_no') }}" class="form-control"
                                                           placeholder="Mobile No"/>
                                                    @if ($errors->has('head_mobile_no'))
                                                        <span class="help-block">
                                       {{ $errors->first('head_mobile_no') }}
                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group {{ $errors->has('head_land_line_no') ? ' has-error' : '' }}">
                                                    <label>LandLine No </label>
                                                    <input style="text-transform:uppercase" type="text"
                                                           name="head_land_line_no" id="head_land_line_no"
                                                           value="{{ old('head_land_line_no') }}" class="form-control"
                                                           placeholder="LandLine No(0421111111)"/>
                                                    @if ($errors->has('head_land_line_no'))
                                                        <span class="help-block">
                                       {{ $errors->first('head_land_line_no') }}
                                    </span>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <label>Login Email</label>
                                                    <input type="email" name="email" id="email"
                                                           class="form-control" value="{{ old('email') }}"
                                                           placeholder=" Login Email"/>
                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                        {{ $errors->first('email') }}
                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4 {{ $errors->has('register_password') ? ' has-error' : '' }}">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" name="register_password"
                                                           id="register_password"
                                                           class="form-control" value=""
                                                           placeholder="Enter Your  Password"/>
                                                    @if ($errors->has('register_password'))
                                                        <span class="help-block">
                                       {{ $errors->first('register_password') }}
                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                        <div class="wizard-buttons">
                                            <button type="button" class="btn btn-previous">Previous</button>
                                            <button type="button" class="btn btn-next">Next</button>
                                        </div>
                                    </fieldset>

                                    <fieldset style="min-height: 430px">
                                        <div class="jumbotron text-center" style="background-color: white">
                                            <h4 class="">Please submit to complete registration of your institution.</h4>
                                            <p style="font-size: 14px">A registration confirmation e-mail will be sent to
                                                the given e-mail address. If you need to change any of the
                                                information, you can do so till registration deadline by
                                                logging into your account.</p>
                                        </div>
                                        <div class="wizard-buttons">
                                            <button type="button" class="btn btn-previous">Previous</button>
                                            <button type="submit" name="save" class="btn btn-primary btn-submit">Submit
                                            </button>
                                        </div>
                                    </fieldset>
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
                <h1 class="text-center " style="color: white;">Institution Registration Closed</h1>
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

    $(document).ready(function () {
        var alert_danger = $("#alert-danger").is('display');
        $(".alert").delay(10000).slideUp(500, function () {
            $(this).alert('close');
        });

        //formvalidationswizards
        $('form fieldset:first').fadeIn('slow');

        $('form input[type="text"], form input[type="password"], form textarea,form input[type="email"], select').on('focus', function () {
            $(this).removeClass('input-error');
        });

        $('form .btn-next').on('click', function () {
            var parent_fieldset = $(this).parents('fieldset');
            var next_step = true;
            var current_active_step = $(this).parents('form').find('.form-wizard.active');
            var progress_line = $(this).parents('form').find('.progress-line');

            parent_fieldset.find('input[type="text"], input[type="password"], input[type="username"], input[type="email"], input[type="tel"], input[type="url"], textarea ,select').each(function () {
                if ($(this).val() == "") {
                    $(this).addClass('input-error');
                    next_step = false;
                }
                else {
                    $(this).removeClass('input-error');
                }
            });

            parent_fieldset.find('input[type="checkbox"]').each(function () {
                if ($(this).prop("checked") == false) {
                    $('.form-check-label').css("color", "red");
                    next_step = false;
                }
                else {
                    $('.form-check-label').css("color", "#447DF7");
                }
            });

            if (next_step) {
                parent_fieldset.fadeOut(400, function () {
                    current_active_step.removeClass('active').addClass('activated').next().addClass('active');
                    bar_progress(progress_line, 'right');
                    $(this).next().fadeIn();
                    scroll_to_class($('form'), 50);
                });
            }

        });

        // previous step
        $('form .btn-previous').on('click', function () {
            var current_active_step = $(this).parents('form').find('.form-wizard.active');
            var progress_line = $(this).parents('form').find('.progress-line');

            $(this).parents('fieldset').fadeOut(400, function () {
                current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
                bar_progress(progress_line, 'left');
                $(this).prev().fadeIn();
                scroll_to_class($('form'), 50);
            });
        });

        $('form').on('submit', function (e) {
            $(this).find('input[type="text"], input[type="password"], input[type="username"], input[type="email"], input[type="tel"], input[type="url"], textarea ').each(function () {
                if ($(this).val() == "") {
                    e.preventDefault();
                    alert('Inputs are required please check form by pressing previous button')
                }
                else {
                    $(this).removeClass('input-error');
                }
            });

        });

        $('#ins_registration_form').validate({
            onfocusout: function (element) {
                $(element).valid();
            },
            rules: {
                institute_name: {
                    required: true
                },
                institute_province: {
                    required: true
                },
                institute_city: {
                    required: true
                },
                institute_phone: {
                    required: true,
                    digits:true
                },

                institute_address: {
                    required: true
                },
                institute_email: {
                    required: true,
                    email: true
                },
                institute_off_account_no: {
                    required: true
                },
                user_name: {
                    required: true
                },
                head_job_title: {
                    required: true
                },
                head_mobile_no: {
                    required: true,
                    digits:true

                },
                head_land_line_no: {
                    required: true,
                    digits:true
                },
                email: {
                    required: true,
                    email: true
                },
                register_password: {
                    required: true,
                    minlength: 8
                },
                messages: {
                    password: {
                        minlength: "Password length should be minimum 8 character/numbers"
                    }
                }

            },
            errorElement: "p",
            errorPlacement: function (error, element) {
                // Add the `help-block` class to the error element
                error.addClass("help-block fonts-3");
                error.insertAfter(element);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).parents(".form-group").addClass("has-error").removeClass("has-success");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents(".form-group").addClass("has-success").removeClass("has-error");
            }

        });

    });


    function scroll_to_class(element_class, removed_height) {
        var scroll_to = $(element_class).offset().top - removed_height;
        if ($(window).scrollTop() != scroll_to) {
            $('html, body').stop().animate({scrollTop: scroll_to}, 0);
        }
    }


    function bar_progress(progress_line_object, direction) {
        var number_of_steps = progress_line_object.data('number-of-steps');
        var now_value = progress_line_object.data('now-value');
        var new_value = 0;
        if (direction == 'right') {
            new_value = now_value + ( 100 / number_of_steps );
        }
        else if (direction == 'left') {
            new_value = now_value - ( 100 / number_of_steps );
        }
        progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
    }
</script>

</html>
