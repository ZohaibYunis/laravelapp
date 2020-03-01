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
                    <h4>Coordinators Information</h4>
                </div>
                <div class="content">

                    <!-- Both Contest -->
                    <form action="{{route('ContestCoordinators.store')}}" method="Post" id="bothContest ">

                        {{csrf_field()}}
                        <input type="hidden" name="contest_category_id[]"
                               value="{{$contest_activation[0]['contest_category_id']}}">
                        <input type="hidden" name="contest_category_id[]"
                               value="{{$contest_activation[1]['contest_category_id']}}">
                        <input type="hidden" name="contest_date" value="{{$contest_activation[0]['contest_registration_end_date']}}">
                        <div class="bg-card-blue" style=" color: white;">
                            <h4 class="first_contest" style="padding-left:1%">
                                {{$contest_activation[0]['contest_category_name']}}
                            </h4>
                        </div>
                        <div class="row first_contest">
                            <div class="col-md-4">
                                <div class="form-group @php if($errors->has('coordinator_name.0')) echo "has-error"  @endphp">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" name="coordinator_name[]" id=""
                                           placeholder="Name">
                                    @if ($errors->has('coordinator_name.0'))
                                        <em class="error  help-block"
                                            style="font-weight: 200">{{ $errors->first('coordinator_name.0') }}</em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group @php if($errors->has('coordinator_job_title.0')) echo "has-error"  @endphp">
                                    <label class="control-label">Job Title</label>
                                    <input type="text" class="form-control" name="coordinator_job_title[]" id=""
                                           placeholder="Job Title">
                                    @if ($errors->has('coordinator_job_title.0'))
                                        <em class="error  help-block"
                                            style="font-weight: 200">{{ $errors->first('coordinator_job_title.0') }}</em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="form-group @php if($errors->has('coordinator_mobile_no.0')) echo "has-error"  @endphp">
                                    <label class="control-label">mobile No</label>
                                    <input type="text" class="form-control" name="coordinator_mobile_no[]" id=""
                                           placeholder="Mobile No">
                                    @if ($errors->has('coordinator_mobile_no.0'))
                                        <em class="error  help-block"
                                            style="font-weight: 200">{{ $errors->first('coordinator_mobile_no.0') }}</em>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row first_contest">
                            <div class="col-md-4">
                                <div class="form-group @php if($errors->has('coordinator_landline.0')) echo "has-error"  @endphp">
                                    <label class="control-label">Landline</label>
                                    <input type="text" class="form-control" name="coordinator_landline[]" id=""
                                           placeholder="Landline No">
                                    @if ($errors->has('coordinator_landline.0'))
                                        <em class="error  help-block"
                                            style="font-weight: 200">{{ $errors->first('coordinator_landline.0') }}</em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group @php if($errors->has('coordinator_email.0')) echo "has-error"  @endphp">
                                    <label class="control-label">Email</label>
                                    <input type="email" class="form-control" name="coordinator_email[]" id=""
                                           placeholder="Email">
                                    @if ($errors->has('coordinator_email.0'))
                                        <em class="error  help-block"
                                            style="font-weight: 200">{{ $errors->first('coordinator_email.0') }}</em>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="bg-card-blue" style=" color: white;">
                            <h4 class="second_contest  " style="padding-left:1%">
                                {{$contest_activation[1]['contest_category_name']}}
                            </h4>
                        </div>

                        <div class="row second_contest">
                            <div class="col-md-4">
                                <div class="form-group @php if($errors->has('coordinator_name.1')) echo "has-error"  @endphp">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" name="coordinator_name[]" id=""
                                           placeholder="Name">
                                    @if ($errors->has('coordinator_name.1'))
                                        <em class="error  help-block"
                                            style="font-weight: 200">{{ $errors->first('coordinator_name.1') }}</em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group @php if($errors->has('coordinator_job_title.1')) echo "has-error"  @endphp">
                                    <label class="control-label">Job Title</label>
                                    <input type="text" class="form-control" name="coordinator_job_title[]" id=""
                                           placeholder="Job Title">
                                    @if ($errors->has('coordinator_job_title.1'))
                                        <em class="error  help-block"
                                            style="font-weight: 200">{{ $errors->first('coordinator_job_title.1') }}</em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group @php if($errors->has('coordinator_mobile_no.1')) echo "has-error"  @endphp">
                                    <label class="control-label">Mobile No</label>
                                    <input type="text" class="form-control" name="coordinator_mobile_no[]" id=""
                                           placeholder="Mobile No">
                                    @if ($errors->has('coordinator_mobile_no.1'))
                                        <em class="error  help-block"
                                            style="font-weight: 200">{{ $errors->first('coordinator_mobile_no.1') }}</em>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row second_contest">
                            <div class="col-md-4">
                                <div class="form-group @php if($errors->has('coordinator_landline.1')) echo "has-error"  @endphp">
                                    <label class="control-label">Landline</label>
                                    <input type="text" class="form-control" name="coordinator_landline[]" id=""
                                           placeholder="Landline No">
                                    @if ($errors->has('coordinator_landline.1'))
                                        <em class="error  help-block"
                                            style="font-weight: 200">{{ $errors->first('coordinator_landline.1') }}</em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group @php if($errors->has('coordinator_email.1')) echo "has-error"  @endphp">
                                    <label class="control-label">Email</label>
                                    <input type="email" class="form-control" name="coordinator_email[]" id=""
                                           placeholder="Email">
                                    @if ($errors->has('coordinator_email.1'))
                                        <em class="error  help-block"
                                            style="font-weight: 200">{{ $errors->first('coordinator_email.1') }}</em>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <hr/>
                        <div>
                            <a class="btn btn-primary btn-fill" href="{{route('contestSelectionView')}}">Go back</a>
                        <button type="submit" id="add_coordinators_info" class="btn btn-primary  btn-fill pull-right"
                                value="Save">Save
                        </button>
                        <div class="clearfix"></div>
                        </div>


                    </form>

                    <!--End Both Contest-->


                </div>
            </div>

        </div>

    </div>
@stop
