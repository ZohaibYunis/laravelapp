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
                <div class="header navbar-ct-blue" style="padding-bottom: 1.5%">
                    <h3 class="title text-center " style="color: white">Contest Categories</h3>
                </div>
                <div class="content">
                    <form action="{{route('ContestCategory.store')}}" method="post">
                        {{csrf_field()}}
                        @foreach($result as $row)

                        <div class="row ">
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group">
                                    <input type="hidden" name="contest_id[{{$row->contest_category_id}}]" value="{{$row->contest_category_id}}">
                                    <label for="contest_name[{{$row->contest_category_id}}]" class="control-label">Contest {{$row->contest_category_id}}</label>
                                    <input type="text" name="contest_name[{{$row->contest_category_id}}]" class="form-control" value="{{$row->contest_category_name}}" id="contest_name[{{$row->contest_category_id}}]" readonly="readonly">
                                   </div>
                            </div>
                                <div class="col-md-2 col-lg-2">
                                    <div class="form-group @php if($errors->has('contest_registartion_start_date.'.$row->contest_category_id)) echo "has-error"  @endphp">
                                        <label for="contest_registartion_start_date[{{$row->contest_category_id}}]" class="control-label"> Reg Start Date</label>
                                        <input type="text" name="contest_registartion_start_date[{{$row->contest_category_id}}]" id="contest_registartion_start_date[{{$row->contest_category_id}}]" class="form-control datepicker"
                                               value="{{date('d-F-Y',strtotime($row->contest_registration_start_date))}}" autocomplete="off">
                                        @if ($errors->has('contest_registartion_start_date.'.$row->contest_category_id))
                                            <em class="error  help-block">{{ $errors->first('contest_registartion_start_date.'.$row->contest_category_id) }}</em>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <div class="form-group @php if($errors->has('contest_registartion_end_date.'.$row->contest_category_id)) echo "has-error"  @endphp">
                                        <label for="contest_registartion_end_date[{{$row->contest_category_id}}]" class="control-label"> Reg End Date</label>
                                        <input type="text" name="contest_registartion_end_date[{{$row->contest_category_id}}]" id="contest_registartion_end_date[{{$row->contest_category_id}}]" class="form-control datepicker"
                                               value="{{date('d-F-Y',strtotime($row->contest_registration_end_date))}}"  autocomplete="off">
                                        @if ($errors->has('contest_registartion_end_date.'.$row->contest_category_id))
                                            <em class="error  help-block" style="font-weight: 200">{{ $errors->first('contest_registartion_end_date.'.$row->contest_category_id) }}</em>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <div class="form-group @php if($errors->has('contest_date.'.$row->contest_category_id)) echo "has-error"  @endphp">
                                        <label for="contest_date[{{$row->contest_category_id}}]" class="control-label"> Contest Date</label>
                                        <input type="text" name="contest_date[{{$row->contest_category_id}}]" id="contest_date[{{$row->contest_category_id}}]" class="form-control datepicker"
                                               value="{{date('d-F-Y',strtotime($row->contest_date))}}"  autocomplete="off">
                                        @if ($errors->has('contest_date.'.$row->contest_category_id))
                                            <em class="error  help-block" style="font-weight: 200" >{{ $errors->first('contest_date.'.$row->contest_category_id) }}</em>
                                        @endif
                                    </div>

                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <div class="form-group @php if($errors->has('contest_status.'.$row->contest_category_id)) echo "has-error"  @endphp">
                                        <label for="contest_status[{{$row->contest_category_id}}]">Status</label>
                                        <select name="contest_status[{{$row->contest_category_id}}]" id="contest_status[{{$row->contest_category_id}}]" class="form-control">
                                            <option value="">Select Status</option>
                                            <option @if($row->status=="Active"){{'selected="selected"'}} @endif value="Active">Active</option>
                                            <option @if($row->status=="InActive"){{'selected="selected"'}} @endif  value="InActive">InActive</option>
                                        </select>
                                        @if ($errors->has('contest_status.'.$row->contest_category_id))
                                            <em class="error  help-block">{{ $errors->first('contest_status.'.$row->contest_category_id) }}</em>
                                        @endif
                                    </div>
                                </div>
                                </div>
                            @endforeach
                        <hr>
                            <button type="submit" class="btn btn-primary btn-fill pull-right" value="Update Status">Update Status </button>
                            <div class="clearfix">
                        </div>

                    </form>
                        </div>
                </div>

            </div>

        </div>


    @stop
