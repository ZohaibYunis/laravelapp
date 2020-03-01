@extends('masterlayouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                <div class=" header bg-card-blue" style=" color: white;padding-bottom:10px;">
                    <h5 style="padding-left:1%">Select contest(s) in which you want to participate</h5>
                </div>
                <div class="content">


                    <form action="{{route('contestSelection')}}" method="post" id="select_contest">
                        {{csrf_field()}}
                        <div class="row ">
                            <div class="col-md-4 col-md-offset-4">
                                <div class="form-group form-inline">
                                    <label for="contest_selection" class="control-label">Select Contest</label>
                                    <select class="form-control" name="select_contest" id="contest_selection">
                                        @if(empty($coordinators))
                                            <option value="" selected>--Select Contests--</option>
                                            <option value=1>BOTH CONTESTS</option>
                                            <option value=2>{{$contest_activation[0]['contest_category_name']}}</option>
                                            <option value=3>{{$contest_activation[1]['contest_category_name']}}</option>
                                        @elseif($contest_activation[0]['contest_category_id']!=$coordinators[0]->fk_contest_category_id)
                                            <option value="" selected>--Select Contests--</option>
                                            <option value=2>{{$contest_activation[0]['contest_category_name']}}</option>
                                        @elseif($contest_activation[1]['contest_category_id']!=$coordinators[0]->fk_contest_category_id)
                                            <option value="" selected>--Select Contests--</option>
                                            <option value=3>{{$contest_activation[1]['contest_category_name']}}</option>
                                        @else
                                            <option value="" selected>--No Contest Found--</option>

                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" id="contest_selection" class="btn btn-primary  btn-fill pull-right"
                                value="Save">Proceed
                        </button>
                        <div class="clearfix"></div>
                    </form>


                </div>

            </div>
        </div>

    </div>




@stop
