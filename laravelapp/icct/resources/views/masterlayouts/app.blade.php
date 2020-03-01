<!doctype html>
<html lang="{{app()->getLocale()}}" class="perfect-scrollbar-on">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="{{asset('img/logo.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>International Cats Contests</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>

    <!-- Bootstrap core CSS     -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/>
    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{asset('css/light-bootstrap-dashboard.css?v=1.4.1')}}" rel="stylesheet"/>
    <link href="{{asset('css/demo.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/animate.min.css')}}" rel="stylesheet"/>
    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{asset('css/pe-icon-7-stroke.css')}}" rel="stylesheet"/>
    <style>

        .tblstudent {
            border: 1px solid #FFFFFF !important;
            text-align: center !important;
            width: 100% !important;
        }

        .ps-container > .ps-scrollbar-x-rail,
        .ps-container > .ps-scrollbar-y-rail {
            opacity: 1;
        }

        .dt-buttons {
            width: 40%;
            text-align: center;
            display: inline-block;
        }

        #datatables_length {
            width: 25%;
            display: inline-block;
        }

        #datatables_filter {
            width: 25%;
            display: inline-block;
            text-align: right !important;
        }

    </style>
</head>
<body class>

<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="{{asset('img/bg.PNG')}}">
        @if(auth()->user()->fk_role_id==2)
            <div class="logo">
                <a href="" class="simple-text logo-mini">
                    RP
                </a>
                <a href="{{route('home')}}" class="simple-text logo-normal" style="font-size: 14.5px">Registration
                    Portal
                </a>
            </div>
        @endif
        @if(auth()->user()->fk_role_id==1)
            <div class="logo">
                <a href="" class="simple-text logo-mini">
                    DB
                </a>

                <a href="{{route('home')}}" class="simple-text logo-normal">
                    ICATS Dashboard
                </a>
            </div>
        @endif


        <div class="sidebar-wrapper">
            <ul class="nav">
                <!-- Start Admin Navbar NavBar-->
                @if(auth()->user()->fk_role_id==1)
                    <li>
                        <a href="{{route('home')}}">
                            <i class="pe-7s-home"></i>
                            <p>Home
                            </p>
                        </a>
                    </li>

                    <li>
                        <a data-toggle="collapse" href="#contest_activation">
                            <i class="pe-7s-notebook"></i>
                            <p>Contest Activation
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="contest_activation">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('ContestCategory.index')}}">
                                        <span class="sidebar-mini">VIF</span>
                                        <span class="sidebar-normal">View Contests</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </li>

                    <li>
                        <a data-toggle="collapse" href="#student_information">
                            <i class="pe-7s-users"></i>
                            <p>Inst/student Info
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="student_information">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('viewAllInstitutes')}}">
                                        <span class="sidebar-mini">VII</span>
                                        <span class="sidebar-normal">View Institutes Information </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('ViewAllRegStudents')}}">
                                        <span class="sidebar-mini">VII</span>
                                        <span class="sidebar-normal">View All Reg Students  </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('viewAllInActiveInst')}}">
                                        <span class="sidebar-mini">VII</span>
                                        <span class="sidebar-normal">View InActive Institutes  </span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </li>

                    <li>
                        <a data-toggle="collapse" href="#coordinators">
                            <i class="pe-7s-user"></i>
                            <p>Contest Coordinators
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="coordinators">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('viewAllCoordinators')}}">
                                        <span class="sidebar-mini">VIC</span>
                                        <span class="sidebar-normal">View All Coordinators </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('viewAllAddiCoordinators')}}">
                                        <span class="sidebar-mini">VAC</span>
                                        <span class="sidebar-normal">View Additional Coordinators </span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </li>
                @endif
            <!--  End  Admin NavBar-->
                @if(auth()->user()->fk_role_id==2)
                    <li>
                        <a href="{{route('home')}}">
                            <i class="pe-7s-home"></i>
                            <p>Home
                            </p>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#inst_information">
                            <i class="pe-7s-home"></i>
                            <p>Institution Info
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="inst_information">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('editInstInfo')}}">
                                        <span class="sidebar-mini">EII</span>
                                        <span class="sidebar-normal">View/Edit Institution Info </span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </li>
                    <li>
                        <a data-toggle="collapse" href="#coordinators">
                            <i class="pe-7s-user"></i>
                            <p>Coordinator Info
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="coordinators">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('ContestCoordinators.index')}}">
                                        <span class="sidebar-mini">VIC</span>
                                        <span class="sidebar-normal">View/Edit All Coordinators </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('contestSelectionView')}}">
                                        <span class="sidebar-mini">AAC</span>
                                        <span class="sidebar-normal">Add Coordinators </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('ContestAdditionalCoordinators.create')}}">
                                        <span class="sidebar-mini">AAC</span>
                                        <span class="sidebar-normal">Add More Coordinators </span>
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#student_information">
                            <i class="pe-7s-users"></i>
                            <p>Student Info
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="student_information">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('dashboardCurrStudentInfo')}}">
                                        <span class="sidebar-mini">VSI</span>
                                        <span class="sidebar-normal">View/Edit Student Info </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('ContestStudentStrength.index')}}">
                                        <span class="sidebar-mini">AMS</span>
                                        <span class="sidebar-normal">Add More Students</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </li>
                @endif


            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-minimize">
                    <button id="minimizeSidebar" class="btn btn-primary btn-fill btn-round btn-icon">
                        <i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
                        <i class="fa fa-navicon visible-on-sidebar-mini"></i>
                    </button>
                </div>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="logo pull-left" href="{{route('home')}}"><img src="{{asset('img/logo.png')}}"
                                                                            width="100px" height="100px"></a>
                    <span class="name  title pull-left" style="padding-top:0.5%"><b style="font-weight: 500"
                                                                                    class="title">INTERNATIONAL CATS CONTESTS</b><br>
                    <p>Helping future leaders know their hidden potential</p>
                </span>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">

                        <li class="dropdown dropdown-with-icons">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{asset('/img/logo.png')}}" class="user_image img-rounded img-thumbnail"
                                     style="width: 40px;">
                                <span class=" text-primary ">
                                      Welcome {{ucwords(strtolower(Auth::user()->institute_head))}}
                                    <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu dropdown-with-icons">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                       class="text-danger">
                                        <i class="pe-7s-close-circle"></i>
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>

                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>


        <div class="main-content">
            <div class="container-fluid">
                @yield('content')


            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a>
                                Contact Us: info@catscontests.org
                            </a>
                        </li>

                        <!--        here you can add more links for the footer                       -->
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    ©CopyRight
                    <script>document.write(new Date().getFullYear())</script>
                    <a href="{{route('home')}}" class="text-primary"> ICATS Contests</a>
                </p>
            </div>
        </footer>
    </div>
</div>


</body>

{{--<!--   Core JS Files   -->--}}
<script src="{{asset('js/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('js/nouislider.min.js')}}"></script>

<!--  Charts Plugin -->
<script src="{{asset('js/chartist.min.js')}}"></script>

<!--  Notifications Plugin    -->
<!--  Google Maps Plugin    -->
<script src="{{asset('js/jquery.bootstrap.wizard.min.js')}}"></script>
<script src="{{asset('js/bootstrap-table.js')}}"></script>
<script src="{{asset('js/jquery.datatables.js')}}"></script>
<script src="{{asset('js/light-bootstrap-dashboard.js?v=1.4.1')}}"></script>

<script src="{{asset('js/bootstrap-notify.js')}}"></script>
<script src="{{asset('js/demo.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        // Init DatetimePicker
        demo.initFormExtendedDatetimepickers();
        var h = $('.third-box').height();
        $('.second-box,.first-box').css('height', h);

    });
</script>
<script src="{{asset('js/jquery.maskedinput.min.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>


@yield('external-script')
<script type="text/javascript">
    @yield('script')
</script>
<script type="text/javascript">
    $(document).ready(function () {


        var alert_danger = $("#alert-danger").is('display');
        $(".alert").delay(15000).slideUp(500, function () {
            $(this).alert('close');
        });

        $('#search_coorinators_by_date').on('click', function (e) {
            var date_from = $('#input_date_from').val();
            var date_to = $('#input_date_to').val();
//
            $.ajax({
                url: "<?php echo route('viewCoordinatorsByDate') ?>",
                type:"post",
                data:{'_token': "{{ csrf_token() }}",'date_from': date_from, 'date_to': date_to},
                success: function (data, textStatus, jqXHR) {
                    //var table_data = JSON.parse(data);
                    console.log(data);
                    var n =$('#year').html();
                    var table = $('#datatables').DataTable({
                        "clear":true,
                        "bDestroy": true,
                        data:data,
                        "lengthMenu": [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ],
                        responsive: true,
                        columnDefs: [ {
                            searchable:true,
                            orderable: false, targets: [0]},
                            { className:"text-transform", targets:[3]}
                            ],
                        language: {
                            search: "_INPUT_",
                            searchPlaceholder: "Search records"
                        },
                        order:[[0,"asc"]],
                        dom: 'lBfrtip',
                        columns: [
                            {
                                targets:[0],
                                data:"id",
                                defaultContent: ''
                            },

                            {
                            targets:[1],
                            data:"institute_name"
                        },
                            {
                                targets:[2],
                                defaultContent: ''
                            },
                            {
                                targets:[3],
                                data:"coordinator_name"
                            },
                            {
                                targets:[4],
                                data:"coordinator_mobile"
                            },
                            {
                                targets:[5],
                                data:"coordinator_landline"
                            },
                            {
                                targets:[6],
                                data:"coordinator_email"
                            },
                            {
                                targets:[7],
                                data:"contest_category_name"
                            },
                            {
                                targets:[8],
                                defaultContent: 'ICATS COORDINATOR'
                            }


                        ],
                        buttons: [
                            {
                                extend:    'csv',
                                filename: 'ICATS_Coordinators_Info_'+ n ,
                                text:      '<i class="fa fa-files-o"></i> CSV ',
                                titleAttr: 'CSV',
                                className: 'btn btn-primary  btn-sm',
                                exportOptions: {
                                    columns:[1,2,3,4,5,6,7,8]

                                }
                            },
                            {
                                extend:    'excel',
                                filename: 'ICATS_Coordinators_Info_'+ n ,
                                text:      '<i class="fa fa-files-o"></i> Excel',
                                title:null,
                                titleAttr: 'Excel',
                                className: 'btn btn-primary btn-sm',
                                exportOptions: {
                                    columns:[1,2,3,4,5,6,7,8]
                                }
                            },
                            {
                                extend:    'pdf',
                                filename: 'ICATS_Coordinators_Info_'+ n ,
                                text:      '<i class="fa fa-file-pdf-o"></i> PDF',
                                title:  'ICATS_Coordinators_Info_'+ n,
                                titleAttr: 'PDF',
                                className: 'btn btn-primary  btn-sm',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                exportOptions: {
                                    columns:[1,2,3,4,5,6,7,8]
                                }
                            },
                            {
                                extend:    'print',
                                filename: 'ICATS_Coordinators_Info'+ n,
                                text:      '<i class="fa fa-print"></i> Print',
                                title: 'ICATS_Coordinators_Info'+n ,
                                titleAttr: 'Print',
                                className: 'btn btn-primary  btn-sm',
                                exportOptions: {
                                    columns:[1,2,3,4,5,6,7,8]
                                }
                            },
                        ]


                    });
                    table.on( 'order.dt search.dt', function () {
                        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                            cell.innerHTML = i+1;
                        } );
                    } ).draw();
                    $('.text-transform').css('text-transform' ,"uppercase");
//                    table.clear().draw();
//                    table.destroy();
                }
            });



        });


    });


</script>

</html>
