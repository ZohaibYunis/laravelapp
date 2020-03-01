@extends('masterlayouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">

            @if (Session::has('Error'))
                <div class="alert alert-danger">
                    {{Session::get('Error')}}
                </div>
            @endif
            @if (Session::has('Success'))
                <div class="alert alert-success">
                    {{Session::get('Success')}}
                </div>
            @endif
            {{session()->forget('Success')}}
            {{session()->forget('Error')}}
            <div class="card">
                <div class="header bg-card-blue" style="padding-bottom:6px;padding-top: 2px">
                    <h4 style="color: white" class="text-center">Edit Institution/Head Information</h4>
                </div>
                <div class="content">
                    @if(auth()->user()->fk_role_id==2)
                    <form id="institute_info_form" action="{{route("updateInstInfo")}}" method="post">
                        @else
                            <form id="institute_info_form" action="{{route("updateInstInfoAdm",["id"=>$get_inst_info[0]->user_id])}}" method="post">
                                @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                               <h4 class="text-primary">Institution's Information</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('institute_name') ? ' has-error' : '' }}">
                                    <label for="institute_name" >Institution Name</label>
                                    <input style="text-transform:uppercase" type="text" name="institute_name"
                                           id="institute_name"
                                           class="form-control" value="{{$get_inst_info[0]->institute_name}}"
                                           />
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
                                    <label for="institute_address">Institution Address</label>
                                    <textarea name="institute_address"
                                              class="form-control"
                                              id="institute_address"
                                              >{{$get_inst_info[0]->institute_address}}</textarea>
                                    @if ($errors->has('institute_address'))
                                        <span class="help-block">
                 {{ $errors->first('institute_address')}}
                 </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('institute_city') ? ' has-error' : '' }} ">
                                    <label for="institute_city">City</label>
                                    <input style="text-transform:uppercase" type="text" name="institute_city"
                                           id="institute_city"
                                           class="form-control" value="{{$get_inst_info[0]->institute_city}}"
                                    />
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
                                        <option @php if($row->province_name==$get_inst_info[0]->institute_province){ echo 'selected="selected"';}@endphp value="@php  echo $row->province_name ; @endphp"> @php  echo strtoupper($row->province_name);@endphp</option>
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
                                    <label for="institute_phone">Phone No</label>
                                    <input type="text" name="institute_phone" id="institute_phone"
                                           class="form-control" value="{{$get_inst_info[0]->institute_phone}}"
                                          />
                                    @if ($errors->has('institute_phone'))
                                        <span class="help-block">
                 {{ $errors->first('institute_phone') }}
                 </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('institute_email') ? ' has-error' : '' }}">
                                    <label for="institute_email">Institution Official Email</label>
                                    <input type="email" name="institute_email" id="institute_email"
                                           class="form-control" value="{{$get_inst_info[0]->institute_email}}"
                                          />
                                    @if ($errors->has('institute_email'))
                                        <span class="help-block">
                 {{ $errors->first('institute_email') }}
                 </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                             <hr>
                             <h4 class="text-primary">Institution's Head Information</h4>
                             <div class="row">
                                 <div class="col-md-4">
                                     <div class="form-group {{ $errors->has('user_name') ? ' has-error' : '' }}">
                                         <label>Head Name</label>
                                         <input style="text-transform:uppercase" type="text" name="user_name" id="user_name"
                                                value="{{$get_inst_info[0]->institute_head}}" class="form-control"
                                                placeholder="Enter Head Name"/>
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
                                         <input style="text-transform:uppercase" type="text" name="head_job_title" id="head_job_title"
                                                value="{{$get_inst_info[0]->inst_head_job_title}}" class="form-control"
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
                                         <input style="text-transform:uppercase" type="text" name="head_mobile_no" id="head_mobile_no"
                                                value="{{$get_inst_info[0]->inst_head_mobile_no}}" class="form-control"
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
                                         <input style="text-transform:uppercase" type="text" name="head_land_line_no" id="head_land_line_no"
                                                value="{{$get_inst_info[0]->inst_head_landline_no}}" class="form-control"
                                                placeholder="LandLine No"/>
                                         @if ($errors->has('head_land_line_no'))
                                             <span class="help-block">
                                       {{ $errors->first('head_land_line_no') }}
                                    </span>
                                         @endif
                                     </div>

                                 </div>
                                 {{--<div class="col-md-4">--}}
                                     {{--<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">--}}
                                         {{--<label>Institution's Head Email</label>--}}
                                         {{--<input type="email" name="email" id="email"--}}
                                                {{--class="form-control" value="{{$get_inst_info[0]->email}}"--}}
                                                {{--placeholder="Enter Head Email"/>--}}
                                         {{--@if ($errors->has('email'))--}}
                                             {{--<span class="help-block">--}}
                                        {{--{{ $errors->first('email') }}--}}
                                    {{--</span>--}}
                                         {{--@endif--}}
                                     {{--</div>--}}
                                 {{--</div>--}}
                             </div>
                        <hr>
                                <h4 class="text-primary">Institution's Official Bank Account Information</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('institute_off_account_no') ? ' has-error' : '' }}">
                                            <label>Institution's Official Bank Account</label><br>
                                            <em style="font-size: 11px;margin: 0; padding: 0;font-style: normal">(TO BE USED FOR HONORARIUM PAYMENT)</em>
                                            <input type="text" name="institute_off_account_no" id="institute_off_account_no"
                                                   class="form-control" value="{{$get_inst_info[0]->inst_official_bank_ac_no}}"
                                                   placeholder="Official Bank Account Title"/>
                                            @if ($errors->has('institute_off_account_no'))
                                                <span class="help-block">
                                       {{ $errors->first('institute_off_account_no') }}
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>


                        <div class="text-center ">
                            <button type="submit" class="btn btn-primary btn-fill pull-right  text-center" value="update_info">Update Info
                            </button>
                            <div class="clearfix"></div>
                        </div>

                    </form>

                </div>

            </div>
        </div>

    </div>
@endsection
@section('script')
    $(document).ready(function () {


    var alert_danger = $("#alert-danger").is('display');
    $(".alert").delay(10000).slideUp(500, function () {
    $(this).alert('close');
    });

    $('#institute_info_form').validate({
    onfocusout: function (element) {
    $(element).valid();
    },
    rules: {
    institute_name: {
    required: true
    },
    institute_province: "required",
    institute_city: {
    required: true
    },
    institute_phone: {
    required: true,
    digits,
    },

    institute_address: {
    required: true
    },
    institute_email: {
    required: true,
    email: true
    },
    institute_off_account_no:{
    required: true
    },
    user_name: {
    required: true
    },
    head_job_title:{
    required: true
    },
    head_mobile_no:{
    required: true,
    digits:true
    },
    head_land_line_no:{
    required: true,
    digits:true
    },
    email: {
    required: true,
    email: true
    },
    register_password: {
    required: true,
    min:8
    },
    messages: {
    password:{
    min:"Password length must be greater or equal to 8"
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
    {{--$(function ($) {--}}
    {{--$('#institute_phone').mask('99999999999')--}}
    {{--$('#head_land_line_no').mask('99999999999');--}}
    {{--$('#head_mobile_no').mask('99999999999');--}}
    {{--});--}}

    });
    @stop
