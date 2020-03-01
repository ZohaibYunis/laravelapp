@extends('masterlayouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            @if (Session::has('Error'))
                <div class="alert alert-danger">
                    {{Session::get('Error')}}
                </div>
            @endif
            @if (Session::has('Warning'))
                <div class="alert alert-warning">
                    {{Session::get('Warning')}}
                </div>
            @endif
            {{session()->forget('Warning')}}
            {{session()->forget('Error')}}
            <div class="card">
                <div class="header text-center bg-card-blue" style=" color: white; padding-bottom:1%">
                    <h4>Edit Additional Coordinators Information</h4>
                </div>
                <div class="content">
                    @if(auth()->user()->fk_user_id==2)
                    <form action="{{route('ContestAdditionalCoordinators.update',$contest_coordinators->add_coordinator_id)}}" method="Post" id="additonal_coordinators">
                        @else
                            <form action="{{route('updateAddiCoordinatorsInfoAdm',["id"=>$contest_coordinators->add_coordinator_id])}}" method="Post" id="additonal_coordinators">
                                @endif
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group @php if($errors->has('contest_name')) echo "has-error"  @endphp">
                                    <label for="contest_name" class="control-label">Contest Name</label>
                                    <select type="text" class="form-control" name="contest_name" id="contest_name" >
                                        <option value="">Select Contest</option>
                                        <option  @php if($activated_contest[0]['contest_category_id']==$contest_coordinators->fk_contest_category_id){ echo 'selected="selected"';}@endphp value="{{$activated_contest[0]['contest_category_id']}}">{{$activated_contest[0]['contest_category_name']}}</option>
                                        <option  @php if($activated_contest[1]['contest_category_id']==$contest_coordinators->fk_contest_category_id){ echo 'selected="selected"';}@endphp value="{{$activated_contest[1]['contest_category_id']}}">{{$activated_contest[1]['contest_category_name']}}</option>
                                    </select>
                                    @if ($errors->has('contest_name'))
                                        <em class="error  help-block" style="font-weight: 200">{{ $errors->first('contest_name') }}</em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group @php if($errors->has('coordinator_name')) echo "has-error"  @endphp">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" name="coordinator_name" id="" value="{{$contest_coordinators->add_coordinator_name}}" placeholder="Name">
                                    @if ($errors->has('coordinator_name'))
                                        <em class="error  help-block" style="font-weight: 200">{{ $errors->first('coordinator_name') }}</em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group @php if($errors->has('coordinator_job_title')) echo "has-error"  @endphp">
                                    <label class="control-label">Job Title</label>
                                    <input type="text" class="form-control" name="coordinator_job_title" id=""  value="{{$contest_coordinators->add_coordinator_job_title}}" placeholder="Job Title">
                                    @if ($errors->has('coordinator_job_title'))
                                        <em class="error  help-block" style="font-weight: 200">{{ $errors->first('coordinator_job_title') }}</em>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 ">
                                <div class="form-group @php if($errors->has('coordinator_mobile_no')) echo "has-error"  @endphp">
                                    <label class="control-label">mobile No</label>
                                    <input type="text" class="form-control" name="coordinator_mobile_no" id="coordinator_mobile_no"  value="{{$contest_coordinators->add_coordinator_mobile}}" placeholder="Mobile No">
                                    @if ($errors->has('coordinator_mobile_no'))
                                        <em class="error  help-block" style="font-weight: 200">{{ $errors->first('coordinator_mobile_no') }}</em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group @php if($errors->has('coordinator_landline')) echo "has-error"  @endphp">
                                    <label class="control-label">Landline</label>
                                    <input type="text" class="form-control" name="coordinator_landline" id="coordinator_landline" value="{{$contest_coordinators->add_coordinator_landline}}" placeholder="Landline No">
                                    @if ($errors->has('coordinator_landline'))
                                        <em class="error  help-block" style="font-weight: 200">{{ $errors->first('coordinator_landline') }}</em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group @php if($errors->has('coordinator_email')) echo "has-error"  @endphp">
                                    <label class="control-label">Email</label>
                                    <input type="email" class="form-control" name="coordinator_email" id=""   value="{{$contest_coordinators->add_coordinator_email}}" placeholder="Email">
                                    @if ($errors->has('coordinator_email'))
                                        <em class="error  help-block" style="font-weight: 200">{{ $errors->first('coordinator_email') }}</em>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <button type="submit" id="add_coordinators_info" class="btn btn-primary  btn-fill pull-right"
                                value="Save">Update Info
                        </button>
                        <div class="clearfix"></div>

                    </form>

                </div>

            </div>

        </div>

    </div>
@stop

@section('script')
    $(document).ready(function () {

    var alert_danger = $("#alert-danger").is('display');
    $(".alert").delay(10000).slideUp(500, function () {
    $(this).alert('close');
    });

    $('#additonal_coordinators').validate({
    onfocusout: function (element) {
    $(element).valid();
    },
    rules: {
    contest_name: {
    required: true
    },
    coordinator_name: "required",
    coordinator_job_title: {
    required: true
    },
    coordinator_mobile_no: {
    required: true
    },

    coordinator_landline: {
    required: true
    },
    coordinator_email: {
    required: true,
    email: true
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

    {{--$(function ($) {--}}
    {{--$('#coordinator_landline').mask('99999999999')--}}
    {{--$('#coordinator_mobile_no').mask('99999999999');--}}
    {{--});--}}

    });
@stop