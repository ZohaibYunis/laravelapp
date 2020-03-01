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
            <div class="card" >
                <div class="header bg-card-blue" style="padding-bottom: 10px">
                    <h3 style="color: white; text-align: center"> Edit Student Information</h3>
                </div>
                <div class="content">
                    @if(auth()->user()->fk_role_id==2)
                    <form action="{{route('updateStudentInfo',$student_info[0]->contest_student_info_id)}}" method="post" id="edit_student_info">
                        @else
                        <form action="{{route('updateInstStudentInfoAdm',['id'=>$student_info[0]->contest_student_info_id ,'ins_id'=>$student_info[0]->fk_user_id])}}" method="post" id="edit_student_info">
                       @endif
                        {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PATCH">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('edit_student_name') ? ' has-error' : '' }}">
                                    <label for="edit_student_name" class="control-label">Student Name</label>
                                    <input type="text" name="edit_student_name" id="edit_student_name" class="form-control"
                                           value="{{$student_info[0]->student_name}}">
                                    @if ($errors->has('edit_student_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('edit_student_name') }}</strong></span>
                                        @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('edit_father_name') ? ' has-error' : '' }}">
                                    <label for="edit_father_name" class="control-label">Father Name</label>
                                    <input type="text" name="edit_father_name" id="edit_father_name" class="form-control"
                                           value="{{$student_info[0]->father_name}}">
                                    @if ($errors->has('edit_father_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('edit_father_name') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="form-group {{ $errors->has('edit_father_cell_no') ? ' has-error' : '' }}">
                                    <label for="edit_father_cell_no" class="control-label">Father Cell No</label>
                                    <input type="text" name="edit_father_cell_no" id="edit_father_cell_no" class="form-control"
                                           value="{{$student_info[0]->fathers_mobile}}">
                                    @if ($errors->has('edit_father_cell_no'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('edit_father_cell_no') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <button type="submit" class="btn btn-primary btn-fill pull-right">Save
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

    $('#edit_student_info').validate({
    onfocusout: function (element) {
    $(element).valid();
    },
    rules: {
    edit_student_name: {
    required: true
    },
    edit_father_cell_no: "required",
    edit_father_name: {
    required: true
    },
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
    {{--$("#edit_father_cell_no").mask('99999999999');--}}
    {{--});--}}
    @stop()