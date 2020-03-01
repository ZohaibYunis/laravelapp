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
                    <h4 class="title text-left" style="color: white; ">Grade {{$student_strength[0]->class_id}}: Edit Student(s) Strength</h4>
                </div>
                <div class="content">
                    <form action="{{route('ContestStudentStrength.update',['id'=>$student_strength[0]->cat_contest_std_st_id])}}" method="post" >
                        {{csrf_field()}}
                        {{method_field('patch')}}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="contest_name">Contest Name</label>
                                    <input  id="contest_name" class="form-control" type="text" readonly="readonly" value="{{$student_strength[0]->contest_category_name}}">
                                </div>
                            </div>
                        <div class="col-md-4">
                                <div class="form-group">
                                    <label for="contest_name">Grade</label>
                                    <input  id="contest_name" class="form-control" type="text" readonly="readonly" value="{{$student_strength[0]->contest_class_name}}">
                                </div>
                        </div>
                        <div class="col-md-4">

                                <div class="form-group">
                                    <label for="contest_name">Student Strength</label>
                                    <input  id="contest_name" class="form-control" type="text" name="edited_student_strength"  value="{{$student_strength[0]->total_student_strength}}">
                                </div>
                        </div>
                        </div>
                        <hr>
                        <button type="submit" id="edit_student_strength" class="btn btn-primary  btn-fill pull-right"
                                value="Save">Save
                        </button>
                        <div class="clearfix"></div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection