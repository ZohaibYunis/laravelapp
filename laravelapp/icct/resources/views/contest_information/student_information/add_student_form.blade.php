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
                <div class="header bg-card-blue" style="padding-bottom: 10px">

                    <h4 class="title text-left" style="color: white; ">Grade {{$student_strength->class_id}}: Add Student(s) Information</h4>
                    {{--<h4 class="text-center title" style="color: white;">Add Student Information </h4>--}}

                </div>
                <div class="content">
                    <form action="{{route('storeStudentInfo')}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <?php $j = 0;

                        if ($activated_contest[0]['contest_category_id'] == $student_strength->fk_contest_cat_id) {
                            echo "<h3 class='text-primary'>" . $activated_contest[0]['contest_category_name'] . "</h3>";
                        } else {
                            echo "<h3 class='text-primary'>" . $activated_contest[1]['contest_category_name'] . "</h3>";
                        }
                        ?>
                        <table class="table  table-responsive table-no-bordered">
                            <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Student Name</th>
                                <th>Father Name</th>
                                <th>Father Cell No</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $j=0; @endphp
                            @for($i=1;$i<=$student_strength->total_student_strength;$i++)
                                <tr>

                                    <input type="hidden" name="total_student_strength" value="{{$student_strength->total_student_strength}}">
                                    <input type="hidden" name="contest_cat_student_strength_id[]"
                                           value="{{$student_strength->cat_contest_std_st_id}}">
                                    <input type="hidden" name="contest_class_id[]"
                                           value="{{$student_strength->class_id}}">
                                    <input type="hidden" name="registration_last_date[]" value="{{$activated_contest[0]['contest_registration_end_date']}}">
                                    <td>{{$i}}</td>
                                    <td>
                                        <input type="text" name="student_name[]" value="" class="form-control" placeholder="Student Name">
                                        @if ($errors->has('student_name.'.$j))
                                            <em class=" has-error error  help-block">{{ $errors->first('student_name.'.$j) }}</em>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="text" name="student_father_name[]" value="" class="form-control" placeholder="Father Name">
                                        {{--@if ($errors->has('student_father_name.'.$j))--}}
                                            {{--<em class=" has-error error help-block">{{ $errors->first('student_father_name.'.$j) }}</em>--}}
                                        {{--@endif--}}
                                    </td>
                                    <td>
                                        <input type="text" name="student_father_cell_no[]" value="" class="form-control" placeholder="Cell No">
                                        {{--@if ($errors->has('student_father_cell_no.'.$j))--}}
                                            {{--<em class=" has-error error  help-block">{{ $errors->first('student_father_cell_no.'.$j) }}</em>--}}
                                        {{--@endif--}}

                                    </td>
                                </tr>
                                @php $j++; @endphp
                            @endfor
                            </tbody>

                        </table>

                        <hr>
                        <div>
                            <a class="btn btn-primary btn-fill" href="{{route('ContestStudentStrength.edit',['id'=>$student_strength->cat_contest_std_st_id])}}">Change Student Strength</a>
                        <button type="submit" id="add_student_info" class="btn btn-primary  btn-fill pull-right"
                                value="Save">Save
                        </button>
                        <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@stop







