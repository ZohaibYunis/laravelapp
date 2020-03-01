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
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-card-blue" style="padding-bottom: 10px">
                            <h3 style="color: white; text-align: center">Student Information</h3>
                        </div>
                        <div class="content">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Institute Name</label>
                                    <hr style="padding: 0 ;margin: 0">
                                    <p id="insitute_name">{{$student_info[0]->institute_name}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label >Total # Students</label>
                                    <hr  style="padding: 0 ;margin: 0">
                                    <p>{{count($student_info)}}</p>
                                </div>
                            </div>
                            <hr  style="padding: 0">
                            <div class="row">
                                <div class="col-lg-6 col-lg-offset-6 " id="export_button">

                                </div>

                            </div>
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
                                </tr>
                                </thead>
                                <tbody>
                                @php $j=1 @endphp
                                @foreach($student_info as $row)
                                    <tr>
                                        <td>{{$j}}</td>
                                        <td>{{ strtoupper($row->contest_category_name)}}</td>
                                        <td>{{strtoupper($row->contest_class_name)}}</td>
                                        <td>{{ strtoupper($row->student_name)}}</td>
                                        <td>{{strtoupper($row->father_name)}}</td>
                                        <td>{{$row->fathers_mobile}}</td>
                                        <td>{{$row->registration_status}}</td>
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
    "pagingType": "full_numbers",
    "lengthMenu": [
    [10, 25, 50, -1],
    [10, 25, 50, "All"]
    ],
    responsive: true,
    columnDefs: [ {
    searchable:false,
    orderable: false, targets: [0] } ],
    "order": [[ 2, "asc" ]],
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
    columns: ':visible'

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

    columns: ':visible'
    }
    },
    {
    extend:    'pdf',
    filename: 'ICATS_Students_Info_'+ insitute_name ,
    text:      '<i class="fa fa-file-pdf-o"></i> PDF',
    title: insitute_name ,
    titleAttr: 'PDF',
    className: 'btn btn-primary  btn-sm',
    exportOptions: {
    columns: ':visible'
    }
    },
    {
    extend:    'print',
    filename: 'ICATS_Students_Info_'+insitute_name ,
    text:      '<i class="fa fa-print"></i> Print',
    title: insitute_name ,
    titleAttr: 'Print',
    className: 'btn btn-primary  btn-sm',
    exportOptions: {
    columns: ':visible'
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