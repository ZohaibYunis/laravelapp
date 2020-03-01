@extends('masterlayouts.app')
@section('content')
   <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
               <div class="header text-center bg-card-blue" style="color: white;padding-bottom: 1%">
                   <h4 class="text-center">Edit Coordinator Info</h4>
               </div>
               <div class="content">
                   @if(auth()->user()->fk_role_id==2)
                  <form  action="{{route('ContestCoordinators.update',$contest_coordinators->coordinator_id)}}" method="post">
                      @else
                          <form  action="{{route('updateCoordinatorsInfoAdm',["id"=>$contest_coordinators->coordinator_id])}}" method="post">
                              @endif

                      {{csrf_field()}}
                      <input name="_method" type="hidden" value="PATCH">
                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group @php if($errors->has('coordinator_name')) echo "has-error"  @endphp">
                                  <label class="control-label">Name</label>
                                  <input type="text" class="form-control" name="coordinator_name" id="" value="{{$contest_coordinators->coordinator_name}}" placeholder="Enter Coordinator Name">
                                  @if ($errors->has('coordinator_name'))
                                      <em class="error  help-block" style="font-weight: 200">{{ $errors->first('coordinator_name') }}</em>
                                  @endif
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group @php if($errors->has('coordinator_job_title')) echo "has-error"  @endphp">
                                  <label class="control-label">Job Title</label>
                                  <input type="text" class="form-control" name="coordinator_job_title" id=""  value="{{$contest_coordinators->coordinator_job_title}}" placeholder="Enter Coordinator Name">
                                  @if ($errors->has('coordinator_job_title'))
                                      <em class="error  help-block" style="font-weight: 200">{{ $errors->first('coordinator_job_title') }}</em>
                                  @endif
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group @php if($errors->has('coordinator_mobile_no')) echo "has-error"  @endphp">
                                  <label class="control-label">Mobile No</label>
                                  <input type="text" class="form-control" name="coordinator_mobile_no" id="" value="{{$contest_coordinators->coordinator_mobile}}" placeholder="Enter Coordinator Name">
                                  @if ($errors->has('coordinator_mobile_no'))
                                      <em class="error  help-block" style="font-weight: 200">{{ $errors->first('coordinator_mobile_no') }}</em>
                                  @endif
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group @php if($errors->has('coordinator_landline')) echo "has-error"  @endphp">
                                  <label class="control-label">Landline</label>
                                  <input type="text" class="form-control" name="coordinator_landline" id=""  value="{{$contest_coordinators->coordinator_landline}}" placeholder="Enter Coordinator Name">
                                  @if ($errors->has('coordinator_landline'))
                                      <em class="error  help-block" style="font-weight: 200">{{ $errors->first('coordinator_landline') }}</em>
                                  @endif
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group @php if($errors->has('coordinator_email')) echo "has-error"  @endphp">
                                  <label class="control-label">Email</label>
                                  <input type="email" class="form-control" name="coordinator_email" id="" value="{{$contest_coordinators->coordinator_email}}" placeholder="Enter Coordinator Name">
                                  @if ($errors->has('coordinator_email'))
                                      <em class="error  help-block" style="font-weight: 200">{{ $errors->first('coordinator_email') }}</em>
                                  @endif
                              </div>
                          </div>
                      </div>

                      <hr/>
                      <button type="submit" id="add_coordinators_info" class="btn btn-primary  btn-fill pull-right"
                              value="Update Info">Update Info
                      </button>
                      <div class="clearfix"></div>


                  </form>

               </div>

           </div>

       </div>

   </div>
    @stop