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
        @if(!empty($contest_add_coordinators))
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-card-blue" style="padding-bottom: 10px">
                            <h3 style="color: white; text-align: center">Additional Coordinators Information</h3>
                        </div>
                        <div class="content">
                            <p id="year" style="display: none">{{date('Y',strtotime($contest_year))}}</p>
                            <div class="row">
                                <div class="col-lg-6 col-lg-offset-6 " id="export_button">

                                </div>

                            </div>
                            <table id="datatables" class="table table-striped table-bordered table-hover table-responsive" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>INSTITUTION NAME</th>
                                    <th>INSTITUTION CODE</th>
                                    <th>NAME</th>
                                    <th>MOBILE</th>
                                    <th>PHONE</th>
                                    <th>EMAIl</th>
                                    <th>CONTEST</th>
                                    <th>JOB TITLE</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $j=1 @endphp
                                @foreach($contest_add_coordinators as $row)
                                    <tr>
                                        <td>{{$j}}</td>
                                        <td>{{strtoupper($row->institute_name)}}</td>
                                        <td>{{""}}</td>
                                        <td>{{ strtoupper($row->add_coordinator_name)}}</td>
                                        <td>{{$row->add_coordinator_mobile}}</td>
                                        <td>{{$row->add_coordinator_landline}}</td>
                                        <td>{{$row->add_coordinator_email}}</td>
                                        <td>{{strtoupper($row->contest_category_name)." ".date('Y',strtotime($contest_year))}}</td>
                                        <td>{{strtoupper("Icats Coordinator")}}</td>
                                        <td><a href="{{route('editAddiCoorInfoAdm',["id"=>$row->add_coordinator_id])}}" class="btn btn-primary btn-fill btn-sm"><i class="fa fa-pencil"></i>Edit</a></td>
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
    var n =$('#year').html();

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
    {{--"order": [[ 2, "asc" ]],--}}
    language: {
    search: "_INPUT_",
    searchPlaceholder: "Search records"
    },
    dom: 'lBfrtip',
    buttons: [
    {
    extend:    'csv',
    filename: 'ICATS_Additional_Coordinators_Info'+ n ,
    text:      '<i class="fa fa-files-o"></i> CSV ',
    titleAttr: 'CSV',
    className: 'btn btn-primary  btn-sm',
    exportOptions: {
    columns:[2,3,4,5,6,7,8]

    }
    },
    {
    extend:    'excel',
    filename: 'ICATS_Additional_Coordinators_Info'+ n ,
    text:      '<i class="fa fa-files-o"></i> Excel',
    title:null,
    titleAttr: 'Excel',
    className: 'btn btn-primary btn-sm',
    exportOptions: {
    columns:[2,3,4,5,6,7,8]
    }
    },
    {
    extend:    'pdf',
    filename: 'ICATS_Coordinators_Info_'+ n ,
    text:      '<i class="fa fa-file-pdf-o"></i> PDF',
    title:  'ICATS_Additional_Coordinators_Info'+ n,
    titleAttr: 'PDF',
    className: 'btn btn-primary  btn-sm',
    exportOptions: {
    columns:[2,3,4,5,6,7,8]
    }
    },
    {
    extend:    'print',
    filename: 'ICATS_Coordinators_Info'+ n,
    text:      '<i class="fa fa-print"></i> Print',
    title: 'ICATS_Additional_Coordinators_Info'+n ,
    titleAttr: 'Print',
    className: 'btn btn-primary  btn-sm',
    exportOptions: {
    columns:[2,3,4,5,6,7,8]
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