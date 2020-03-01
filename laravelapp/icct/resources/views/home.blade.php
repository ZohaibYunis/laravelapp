@extends('masterlayouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12  col-md-offset-3 col-lg-offset-3 col-sm-offset-3 ">
            @if (Session::has('Success'))
                <div class="alert alert-success alert-dismissible fadeIn">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <span>
                        {{Session::get('Success')}}
                    </span>
                </div>
            @endif
            {{session()->forget('Success')}}
            @if (Session::has('Error'))
                <div class="alert alert-danger alert-dismissible fadeIn ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <span>
                        <strong>{{Session::get('Error')}}</strong>
                    </span>

                </div>
            @endif
            {{session()->forget('Error')}}
        </div>
    </div>
@if(auth()->user()->fk_role_id==2)
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="panel box-green ">
                    <div class=" panel-heading box-heading ">
                        <div class="row">
                            <div class="col-xs-2">
                                <i class="fa fa-file fa-4x "></i>
                            </div>
                            <div class="col-xs-10 ">
                                <div><b>CONTESTS TO PARTICIPATE</b>
                                    <b class="pull-right">CONTEST DATE</b>
                                </div>
                                <hr style="margin: 0; padding: 1%;">
                                <div style="padding-top: 1%" ><p>{!! $activated_contest[0]->contest_category_name!!}<span class="pull-right">{{date('M d,  Y',strtotime($activated_contest[0]->contest_date))}}</span></p>
                                    <p>{!! $activated_contest[1]->contest_category_name !!}<span class="pull-right">{{date('M d,  Y',strtotime($activated_contest[1]->contest_date))}}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(count($coordinators_info)!=2)
                    <a href="{{route('contestSelectionView')}}">
                        <div class="panel-footer" style="background-color: white ; ">
                            <span class="text-center animation-transition-fast pulse" style="font-size: 20px;">WANT TO PARTICIPATE? CLICK HERE</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                        @else
                        <div class="panel-footer" style="background-color: white; ">
                            <span class="pull-left text-primary" style="font-size: 20px;" >AlREADY PARTICIPATED</span>
                            <span class="pull-right text-primary"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    @endif

                </div>

            </div>
        </div>


    <div class="row">
        <div class="col-lg-4  col-md-4 col-sm-12 col-xs-12">
            <div class="panel box-green-2 ">
                <div class=" panel-heading box-heading ">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-home fa-5x "></i>
                        </div>
                        <div class="col-xs-9 text-left first-box">
                            <div><b style="text-transform: uppercase">INSTITUTION INFORMATION</b></div>
                            <hr style="margin: 0; padding: 1%;">
                            <div style="padding-top: 1%" class=""><p>{{ucwords(strtolower(auth()->user()->institute_name))}}</p></div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer" style="background-color: white; ">
                        <span class="pull-left"><a href="{{route('editInstInfo')}}" class="text-success">View Details</a></span>
                        <span class="pull-right"><a href="{{route('editInstInfo')}}" class="text-success"><i class="fa fa-arrow-circle-right"></i></a></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4  col-md-4 col-sm-12 col-xs-12 ">
            <div class="panel box-red">
                <div class=" panel-heading box-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x " aria-hidden="false"></i>
                        </div>
                        <div class="col-xs-9 third-box">
                            <div><b style="text-transform: uppercase">COORDINATOR(S) INFORMATION</b></div>
                            <hr style="margin: 0; padding: 1%;">
                            <div style="padding-top: 1%" class="">
                                @if(count($coordinators_info)==2)
                                    <p>{{ ucwords(strtolower($coordinators_info[0]->coordinator_name))}}</p>
                                    <p>{{ucwords(strtolower($coordinators_info[1]->coordinator_name))}}</p>
                                @elseif(count($coordinators_info)==1)
                                    <p>{{ucwords(strtolower($coordinators_info[0]->coordinator_name))}}</p>
                                @else
                                    <p>No info found</p>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <a href="{{route('ContestCoordinators.index')}}">
                    <div class="panel-footer" style="background-color: white; ">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4  col-md-4 col-sm-12 col-xs-12 ">
            <div class="panel box-yellow ">
                <div class=" panel-heading box-heading ">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x " aria-hidden="true"></i>
                        </div>
                        <div class="col-xs-9  second-box">
                            <div><b style="text-transform: uppercase">Total Registered Students</b></div>
                            <hr style="margin: 0; padding: 1%;">
                            <div style="padding-top: 1%" class=""><p style="font-size:32px">@if(!empty($student_info)){{count($student_info)}} @else {{0}}@endif</p></div>
                        </div>

                    </div>
                </div>
                    <div class="panel-footer" style="background-color: white; ">
                        @if(!empty($student_info))
                            <span class="pull-left"><a href="{{route('dashboardCurrStudentInfo')}}" class="text-warning">View Details</a></span>
                            <span class="pull-right"><a href="{{route('dashboardCurrStudentInfo')}}" class="text-warning"><i class="fa fa-arrow-circle-right"></i></a></span>
                            @else
                            <span class="pull-left"><a href="{{route('contestSelectionView')}}" class="text-warning">Register Students</a></span>
                            <span class="pull-right"><a href="{{route('contestSelectionView')}}" class="text-warning"><i class="fa fa-arrow-circle-right"></i></a></span>

                        @endif
                        <div class="clearfix"></div>
                    </div>
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <div class="panel box-green ">
                <div class=" panel-heading box-heading ">
                    <div class="row">
                        <div class="col-xs-2">
                            <i class="fa fa-file fa-4x "></i>
                        </div>
                        <div class="col-xs-10 ">
                            <div><b>Active Contests</b>
                                <b class="pull-right">CONTEST DATE</b>
                            </div>
                            <hr style="margin: 0; padding: 1%;">
                            <div style="padding-top: 1%" ><p>{!! $activated_contest[0]->contest_category_name!!}<span class="pull-right">{{date('M d,  Y',strtotime($activated_contest[0]->contest_date))}}</span></p>
                                <p>{!! $activated_contest[1]->contest_category_name !!}<span class="pull-right">{{date('M d,  Y',strtotime($activated_contest[1]->contest_date))}}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                    <a href="{{route('ContestCategory.index')}}">
                        <div class="panel-footer" style="background-color: white; ">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-6  col-md-6 col-sm-12 col-xs-12">
            <div class="panel box-green-2 ">
                <div class=" panel-heading box-heading ">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-home fa-5x "></i>
                        </div>
                        <div class="col-xs-9 text-left third-box">
                            <div><b style="text-transform: uppercase">TOTAL REGISTERED INSTITUTIONS </b></div>
                            <hr style="margin: 0; padding: 1%;">
                            <div style="padding-top: 1%;" ><p style="font-size:32px;">{{count($institutes_info)}}</p></div>
                        </div>
                    </div>
                </div>
                <a href="{{route('viewAllInstitutes')}}">
                    <div class="panel-footer" style="background-color: white; ">
                        <span class="pull-left"><a href="{{route('viewAllInstitutes')}}" class="text-success">View Details</a></span>
                        <span class="pull-right"><a href="{{route('viewAllInstitutes')}}" class="text-success"><i class="fa fa-arrow-circle-right"></i></a></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-6  col-md-6 col-sm-12 col-xs-12 ">
            <div class="panel box-yellow ">
                <div class=" panel-heading box-heading ">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x " aria-hidden="true"></i>
                        </div>
                        <div class="col-xs-9  second-box">
                            <div><b style="text-transform: uppercase">Total Registered Students</b></div>
                            <hr style="margin: 0; padding: 1%;">
                            <div style="padding-top: 1%" class=""><p style="font-size:32px">@if(!empty($student_info)){{count($student_info)}} @else {{0}}@endif</p></div>
                        </div>

                    </div>
                </div>
                <div class="panel-footer" style="background-color: white; ">
                        <span class="pull-left"><a href="{{route('ViewAllRegStudents')}}" class="text-warning">View Details</a></span>
                        <span class="pull-right"><a href="{{route('ViewAllRegStudents')}}" class="text-warning"><i class="fa fa-arrow-circle-right"></i></a></span>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    @endif

@endsection

