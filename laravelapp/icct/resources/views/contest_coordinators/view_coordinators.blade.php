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
                <div class="header text-center bg-card-blue" style="color: white; padding-bottom: 6px">
                     <h5 class="text-center">All Coordinators Information</h5>
                </div>
                <div class="content">
                    @if(count($contest_coordinators)>0)
                    <table id="view_coordinators" class="table table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Contest Name</th>
                            <th>Name</th>
                            <th>Job Title</th>
                            <th>Mobile No</th>
                            <th>Landline</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=1 @endphp
                        @foreach($contest_coordinators as $row)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$row->contest_category_name}}</td>
                                <td>{{$row->coordinator_name}}</td>
                                <td>{{$row->coordinator_job_title}}</td>
                                <td>{{$row->coordinator_mobile}}</td>
                                <td>{{$row->coordinator_landline}}</td>
                                <td>{{$row->coordinator_email}}</td>
                              <td><a class="btn btn-primary " href="{{route('ContestCoordinators.edit',$row->coordinator_id)}}"><span class="fa fa-pencil"></span> Edit Info</a></td>
                            </tr>
                            @php $i++ @endphp
                            @endforeach
                        </tbody>
                    </table>
                        @else
                        <div>
                            <p>No information found </p>
                            <a href="{{route('contestSelectionView')}}" class="btn btn-primary btn-fill pull-right  text-center" >Add Coordinators
                            </a>
                            <div class="clearfix"></div>
                        </div>
                        @endif
                </div>
            </div>
            <hr>
                <div class="card">
                    <div class="header text-center bg-card-blue" style="color: white;padding-bottom: 6px">
                        <h5 class="text-center">Additional Coordinators Information</h5>
                    </div>
                    <div class="content">
                        @if(count($contest__add_coordinators)>0)
                        <table id="view_coordinators" class="table table-bordered table-responsive">
                            <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Contest Name</th>
                                <th>Name</th>
                                <th>Job Title</th>
                                <th>Mobile No</th>
                                <th>Landline</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i=1 @endphp
                            @foreach($contest__add_coordinators as $rows)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$rows->contest_category_name}}</td>
                                    <td>{{$rows->add_coordinator_name}}</td>
                                    <td>{{$rows->add_coordinator_job_title}}</td>
                                    <td>{{$rows->add_coordinator_mobile}}</td>
                                    <td>{{$rows->add_coordinator_landline}}</td>
                                    <td>{{$rows->add_coordinator_email}}</td>
                                    <td><a class="btn btn-primary " href="{{route('ContestAdditionalCoordinators.edit',$rows->add_coordinator_id)}}"><span class="fa fa-pencil"></span> Edit Info</a></td>
                                </tr>
                                @php $i++ @endphp
                            @endforeach
                            </tbody>
                        </table>
                        @else
                            <div>
                                <p>No information found </p>
                                <a href="{{route('ContestAdditionalCoordinators.create')}}" class="btn btn-primary btn-fill pull-right  text-center" >Add More Coordinators (if any)
                                </a>
                                <div class="clearfix"></div>
                            </div>
                            @endif
                    </div>
                </div>

        </div>

    </div>


    @stop