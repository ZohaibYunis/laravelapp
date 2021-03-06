@extends('masterlayouts.app')
@section('content')

    <div class="row">
        <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @if (Session::has('Error'))
                <div class="alert alert-danger">
                    {{Session::get('Error')}}
                </div>
            @endif
            {{session()->forget('Error')}}

            @if (Session::has('Success'))
                <div class="alert alert-success">
                    {{Session::get('Success')}}
                </div>
            @endif
            {{session()->forget('Success')}}
        </div>
        @if(!empty($student_info))
  <div class="text-center ">
                    <a href="{{route('ContestAdditionalCoordinators.show',['id'=>encrypt($student_info[0]->fk_user_id)])}}" class="btn btn-warning btn-fill pull-right  text-center" >Add Additional Coordinators
                    </a>
                    <div class="clearfix"></div>
                </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-card-blue" style="padding-bottom: 10px">
                            <h3 style="color: white; text-align: center">Institution Information</h3>
                    </a>
                        </div>
                        <div class="content">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Institution Name</label><br>
                                    <hr style="padding: 0 ;margin: 0">
                                    <p id="insitute_name">{{$student_info[0]->institute_name}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="">Coordinators</label>
                                    <hr style="padding: 0 ;margin: 0">
                                    @if(count($coordinators_info)==2)
                                        <p>{{$coordinators_info[0]->contest_category_name.": "}}<span class="pull-right">{{ucwords(strtolower($coordinators_info[0]->coordinator_name))}}</span></p>
                                        <p>{{$coordinators_info[1]->contest_category_name.": "}}<span class="pull-right">{{ucwords(strtolower($coordinators_info[1]->coordinator_name))}}</span></p>
                                        @else
                                        <p>{{$coordinators_info[0]->contest_category_name.": "}}<span class="pull-right">{{ucwords(strtolower($coordinators_info[0]->coordinator_name))}}</span></p>
                                        @endif

                                </div>
                                <div class="col-md-3">
                                    <label>Total No of Students</label><br>
                                    <hr style="padding: 0 ;margin: 0">
                                    <p>{{count($student_info)}}</p>
                                </div>
                            </div>
                            <hr style="padding: 0">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-card-blue" style="padding-bottom: 10px">
                            <h3 style="color: white; text-align: center">Student Information</h3>
                        </div>
                        <div class="content">
                            <table id="datatables"
                                   class="table table-striped table-bordered table-hover table-responsive"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>INSTITUTION NAME</th>
                                    <th>INSTITUTION CODE</th>
                                    <th>CONTEST NAME</th>
                                    <th>GRADE</th>
                                    <th>STUDENT NAME</th>
                                    <th>FATHER NAME</th>
                                    <th>FATHER CELL NO</th>
                                    <th>REG. STATUS</th>
                                    <th>ACTIONS</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $j=1 @endphp
                                @foreach($student_info as $row)
                                    <tr>
                                        <td>{{$j}}</td>
                                        <td>{{ strtoupper($row->institute_name)}}</td>
                                        <td>{{""}}</td>
                                        <td>{{ strtoupper($row->contest_category_name)." ".date("Y",strtotime($contest_year))}}</td>
                                        <td>{{strtoupper($row->contest_class_id)}}</td>
                                        <td>{{ strtoupper($row->student_name)}}</td>
                                        <td>{{strtoupper($row->father_name)}}</td>
                                        <td>{{$row->fathers_mobile}}</td>
                                        <td>{{$row->registration_status}}</td>
                                        <td><a class="btn btn-primary btn-fill btn-sm" href="{{route("editInstStudentInfoAdm",["id"=>$row->contest_student_info_id,"ins_id"=>$row->fk_user_id])}}"><i class="fa fa-pencil"></i>Edit Info</a></td>
                                    </tr>
                                    @php $j++ @endphp
                                @endforeach

                                </tbody>

                            </table>
                        </div>

                    </div>

                </div>

            </div>
        @else
            <div class="jumbotron bg-card-blue">
                <h3 class="text-center" style="color: white">Currently No Information to Display</h3>
            </div>
        @endif


    </div>
@stop
@section('script')
    $(document).ready(function() {
    var insitute_name =$('#insitute_name').html();
    var table= $('#datatables').DataTable({
    {{--"pagingType": "full_numbers",--}}
    "lengthMenu": [
    [10, 25, 50, -1],
    [10, 25, 50, "All"]
    ],
    responsive: true,
    columnDefs: [ {
    {{--targets: -1,--}}
    {{--visible: false,--}}
    {{--searchable:false,--}}
    orderable: false, targets: [0] } ],
    "order": [[ 2, "asc" ]],
    language: {
    {{--search: "_INPUT_",--}}
    searchPlaceholder: "Search records"
    },
    dom: 'lBfrtip',
    buttons: [
    {
    extend:    'csv',
    filename: 'ICATS_Students_Info_'+ insitute_name ,
    text:      '<i class="fa fa-files-o"></i> CSV ',
    titleAttr: 'CSV',
    className: 'btn btn-primary btn-fill  btn-sm',
    exportOptions: {
    columns:[1,2,5,6,7,4,3]
    }
    },
    {
    extend:    'excel',
    filename: 'ICATS_Students_Info_'+ insitute_name ,
    text:      '<i class="fa fa-files-o"></i> Excel',
    title: null ,
    titleAttr: 'Excel',
    className: 'btn btn-primary btn-fill btn-sm',
    exportOptions: {
    {{--columns: ':visible'--}}
    columns:[1,2,5,6,7,4,3]
    }
    },
    {
    extend:    'pdf',
    filename: 'ICATS_Students_Info_'+ insitute_name ,
    text:      '<i class="fa fa-file-pdf-o"></i> PDF',
    title: insitute_name ,
    titleAttr: 'PDF',
    className: 'btn btn-primary btn-fill btn-sm',
    exportOptions: {
    columns:[1,2,5,6,7,4,3]
    }
    },
    {
    extend:    'print',
    filename: 'ICATS_Students_Info_'+insitute_name ,
    text:      '<i class="fa fa-print"></i> Print',
    title: insitute_name ,
    titleAttr: 'Print',
    className: 'btn btn-primary btn-fill  btn-sm',
    exportOptions: {
    columns:[1,2,5,6,7,4,3]
    }
    },
    ]
    });
    table.on( 'order.dt search.dt', function () {
    table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
    cell.innerHTML = i+1;
    } );
    } ).draw();
    table.buttons().container()
    .appendTo( '#datatable_wrapper .col-sm-6:eq(0)' );

    $('[data-toggle="popover"]').popover();
    });

@stop