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
                @if (Session::has('Warning'))
                    <div class="alert alert-warning">
                        {{Session::get('Warning')}}
                    </div>
                @endif
                {{session()->forget('Warning')}}
        </div>
        @if(count($student_info)>0)
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-card-blue" style="padding-bottom:6px;padding-top:2px">
                        <h4 style="color: white; text-align: center">Upload Payment Receipt (Optional)</h4>
                    </div>
                    <div class="content">
                        <form class="" action="{{route("UploadPaymentFile")}}" method="post"  enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{--@if(empty($payment_info))--}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('payment_date') ? ' has-error' : '' }}">
                                        <label for="payment_date" class="control-label">Payment Date</label>
                                        <input type="text" name="payment_date" id="payment_date" class="form-control datepicker"
                                               placeholder="Enter the payment Date" autocomplete="off" value="{{old('payment_date')}}">
                                        @if ($errors->has('payment_date'))
                                            <span class="help-block">{{ $errors->first('payment_date') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group {{ $errors->has('payment_file') ? ' has-error' : '' }}">
                                        <label for="payment_file" class="control-label">Payment Image File</label>
                                        <input type="file" name="payment_file" id="payment_file" class="form-control"
                                               placeholder="Add Image File of Payment Slip"
                                               autocomplete="off">
                                        @if ($errors->has('payment_file'))
                                            <span class="help-block">{{ $errors->first('payment_file') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label style="visibility: hidden;">upload</label><br>
                                        <input type="submit" class="btn btn-success btn-fill" value="Upload">
                                    </div>
                                </div>
                            </div>
                                {{--@else--}}
                                {{--<div class="card">--}}
                                    {{--<div class="header navbar-ct-green" style="padding-bottom:6px">--}}
                                        {{--<h5 class="text-center" style="color: white">Payment receipt has been already uploaded </h5>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--@endif--}}
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-card-blue" style="padding-bottom: 10px;padding-top:2px">
                        <div>
                            <a class="btn btn-default btn-fill pull-left text-primary" href="{{route('ContestStudentStrength.index')}}" style="background-color: white">Add More Student(s)</a>
                            <h4 style="color: white; text-align: center">Carefully review the registered participants information</h4>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="content">
                        <div class="row hidden" >
                            <div class="col-md-3">
                                <label>Institute Name</label>
                                <hr style="padding: 0 ;margin: 0">
                                <p id="insitute_name">{{ Auth::user()->institute_name}}</p>
                            </div>
                        </div>
                            {{--</div>--}}
                            {{--<div class="col-md-3">--}}
                                {{--<label class="">Coordinator For {{$activated_contest[0]['contest_category_name']}} </label>--}}
                                {{--<hr style="padding: 0 ;margin: 0">--}}
                                {{--<p>{{$coordinators_info[0]->coordinator_name}}</p>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-3">--}}
                                {{--<label class="">Coordinator For {{$activated_contest[1]['contest_category_name']}}</label>--}}
                                {{--<hr  style="padding: 0 ;margin: 0">--}}
                                {{--<p>{{$coordinators_info[1]->coordinator_name}}</p>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-3">--}}
                                {{--<label >Total # Students</label>--}}
                                {{--<hr  style="padding: 0 ;margin: 0">--}}
                                {{--<p>{{count($student_info)}}</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <hr  style="padding: 0">
                        {{--<div class="row">--}}
                            {{--<div class="col-lg-6 col-lg-offset-6 " id="export_button">--}}

                            {{--</div>--}}

                        {{--</div>--}}
                            <table id="datatables" class="table table-striped table-bordered table-hover table-responsive" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Contest Name</th>
                                    <th>Grade</th>
                                    <th>Student Name</th>
                                    <th>Father Name</th>
                                    <th>Father's Cell No</th>
                                    <th>Registration Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $j=1 @endphp
                                @foreach($student_info as $row)
                                    <tr>
                                        <td class="text-center">{{$j}}</td>
                                        <td>{{ strtoupper($row->contest_category_name)}}</td>
                                        <td class="text-center">{{$row->contest_class_id}}</td>
                                        <td>{{ strtoupper($row->student_name)}}</td>
                                        <td>{{strtoupper($row->father_name)}}</td>
                                        <td>{{$row->fathers_mobile}}</td>
                                        <td>{{$row->registration_status}}</td>
                                        <td> <a class=" btn  btn-primary btn-sm " href="{{route('editStudentInfo',['id'=>$row->contest_student_info_id])}}">
                                                <i class="fa fa-pencil"></i>Edit Info
                                            </a></td>
                                    </tr>
                                    @php $j++ @endphp
                                @endforeach

                                </tbody>

                            </table>
                        <hr>
                        <form action="{{route('updateCurrentStdRegStatus')}}" method="post" id="confirm_registration_form">
                            {{csrf_field()}}
                            @foreach($student_info as $row)
                                @if($row->registration_status=="pending")
                                    <input type="hidden" name="contest_std_no[]" value="{{$row->contest_student_info_id}}">
                                    <input type="hidden" name="contest_std_status[]" value="confirm">
                                @endif
                            @endforeach
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group pull-left">
                                        <a  href='{{route("home")}}' class="btn btn-warning btn-fill btn-md">Go back
                                        </a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-md-offset-4">
                                    <div class="form-group pull-right">
                                        <button type="submit" class="btn btn-warning btn-fill btn-md">Confirm Registration
                                        </button>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
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
    "pagingType": "full_numbers",
    "lengthMenu": [
    [10, 25, 50, -1],
    [10, 25, 50, "All"]
    ],
    responsive: true,
    columnDefs: [ {
    searchable:false,
    orderable: false, targets: [0] } ],
    "order": [[ 1, "asc" ]],
    language: {
    search: "_INPUT_",
    searchPlaceholder: "Search records"
    },
    dom: 'lBfrtip',
    buttons: [
    {
    extend:    'copy',
    text:      '<i class="fa fa-files-o"></i> Copy ',
    title: insitute_name ,
    titleAttr: 'Copy',
    className: 'btn btn-primary btn-sm'
    },
    {
    extend:    'csv',
    filename: 'ICATS_Students_Info_'+ insitute_name ,
    text:      '<i class="fa fa-files-o"></i> CSV ',
    titleAttr: 'CSV',
    className: 'btn btn-primary  btn-sm',
    exportOptions: {
    columns:[0,1,2,3,4,5,6]
    }
    },
    {
    extend:    'excel',
    filename: 'ICATS_Students_Info_'+ insitute_name ,
    text:      '<i class="fa fa-files-o"></i> Excel',
    title: insitute_name ,
    titleAttr: 'Excel',
    className: 'btn btn-primary btn-sm',
    exportOptions: {

    columns:[0,1,2,3,4,5,6]
    }
    },
    {
    extend:    'pdf',
    title:"International Cats Contests",
    filename: 'ICATS_Students_Info_'+ insitute_name ,
    text:      '<i class="fa fa-file-pdf-o"></i> PDF',
    titleAttr: 'PDF',
    className: 'btn btn-primary  btn-sm',
    exportOptions: {
    columns:[0,1,2,3,4,5,6]
    }
    },
    {
    extend:    'print',
    title:"International Cats Contests",
    filename: 'ICATS_Students_Info_'+insitute_name ,
    text:      '<i class="fa fa-print"></i> Print',
    titleAttr: 'Print',
    className: 'btn btn-primary  btn-sm',
    exportOptions: {
    columns:[0,1,2,3,4,5,6]
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