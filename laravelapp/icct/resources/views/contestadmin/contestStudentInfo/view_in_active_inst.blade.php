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
        @if(!empty($institutes_info))
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-card-blue" style="padding-bottom: 10px">
                            <h3 style="color: white; text-align: center">All In Active Institutes</h3>
                        </div>
                        <div class="content">
                            <table id="datatables" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>SR.#</th>
                                    <th>Actions</th>
                                    <th>INSTITUTION CODE</th>
                                    <th>INSTITUTION NAME</th>
                                    <th>INSTITUTION ADDRESS</th>
                                    <th>CITY</th>
                                    <th>PROVINCE</th>
                                    <th>PHONE</th>
                                    <th>EMAIL</th>
                                    <th>INST HEAD NAME</th>
                                    <th>JOB TITLE</th>
                                    <th>HEAD MOBILE</th>
                                    <th>HEAD PHONE</th>
                                    <th>HEAD EMAIl</th>
                                    <th>ACCOUNT TITLE</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $i=1 @endphp
                                @foreach($institutes_info as  $row)
                                    <tr>
                                        <td style="font-size: 10px">{{$i}}</td>
                                        <td>
                                            <a class="btn btn-warning btn-fill btn-sm remove-record" data-toggle="modal" data-url="{!! URL::route('UpdateInstStatus',['id'=>$row->user_id]) !!}" data-id="{{$row->user_id}}" data-target="#custom-width-modal">Active</a>
                                        </td>
                                        <td>{{""}}</td>
                                        <td>{{ strtoupper($row->institute_name)}}</td>
                                        <td>{{strtoupper($row->institute_address)}}</td>
                                        <td >{{strtoupper($row->institute_city)}}</td>
                                        <td>{{strtoupper($row->institute_province)}}</td>
                                        <td >{{strtoupper($row->institute_phone)}}</td>
                                        <td >{{$row->institute_email}}</td>
                                        <td >{{ strtoupper($row->institute_head)}}</td>
                                        <td >{{ strtoupper($row->inst_head_job_title)}}</td>
                                        <td >{{ $row->inst_head_mobile_no}}</td>
                                        <td >{{ $row->inst_head_landline_no}}</td>
                                        <td >{{$row->email}}</td>
                                        <td>{{ strtoupper($row->inst_official_bank_ac_no)}}</td>

                                    </tr>
                                    @php $i++ @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

            </div>
            <!--Deleted Modal -->
            <form action="" method="POST" class="remove-record-model">
                {{csrf_field()}}
                <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" style="width:55%;">
                        <div class="modal-content">
                            <div class="modal-header navbar-ct-blue" >
                                <button type="button" class="close remove-data-from-delete-form" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                                <h4 class="modal-title" style="color: #ffffff;" id="custom-width-modalLabel">Institute Activation</h4>
                            </div>
                            <div class="modal-body">
                                <h4>Do you really want to active/restore this institute ?</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-fill waves-effect remove-data-from-delete-form" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success btn-fill waves-effect waves-light">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--End Delete Modal-->
        @else
            <div class="jumbotron bg-card-blue">
                <h3 class="text-center" style="color: white">Currently No Information to Display</h3>
            </div>
        @endif



    </div>
@stop
@section('script')

    $(document).ready(function() {
    var insitute_name ="all_institutes"
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
    filename: 'ICATS_All_Institutions' ,
    text:      '<i class="fa fa-files-o"></i> CSV ',
    titleAttr: 'CSV',
    className: 'btn btn-primary btn-fill  btn-sm',
    exportOptions: {
    columns:[2,3,4,5,6,7,8,9,10,11,12,13,14]
    }
    },
    {
    extend:    'excel',
    filename: 'ICATS_All_Institutions' ,
    text:      '<i class="fa fa-files-o"></i> Excel',
    title: null ,
    titleAttr: 'Excel',
    className: 'btn btn-primary btn-fill btn-sm',
    exportOptions: {
    {{--columns: ':visible'--}}
    columns:[2,3,4,5,6,7,8,9,10,11,12,13,14]
    }
    },
    {
    extend:    'pdf',
    filename: 'ICATS_All_Institutions' ,
    text:      '<i class="fa fa-file-pdf-o"></i> PDF',
    title: insitute_name ,
    titleAttr: 'PDF',
    className: 'btn btn-primary btn-fill btn-sm',
    exportOptions: {
    columns:[2,3,4,5,6,7,8,9,10,11,12,13,14]
    }
    },
    {
    extend:    'print',
    filename: 'ICATS_All_Institutions',
    text:      '<i class="fa fa-print"></i> Print',
    title: insitute_name ,
    titleAttr: 'Print',
    className: 'btn btn-primary btn-fill  btn-sm',
    exportOptions: {
    columns:[2,3,4,5,6,7,8,9,10,11,12,13,14]
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

    //update inst

    $('.remove-record').click(function() {
    var id = $(this).attr('data-id');
    var url = $(this).attr('data-url');
    $(".remove-record-model").attr("action",url);
    $('body').find('.remove-record-model').append('<input name="_method" type="hidden" value="PATCH">');
    $('body').find('.remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
    });

    $('.remove-data-from-delete-form').click(function() {
    $('body').find('.remove-record-model').find( "input" ).remove();
    $('body').find('.remove-record-model').append('<?php echo csrf_field();?>');

    });

    });


@stop