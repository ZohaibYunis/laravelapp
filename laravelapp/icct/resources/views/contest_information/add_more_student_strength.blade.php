@extends('masterlayouts.app')
@section('content')


    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 ">
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

            <form action="{{route('addMoreStudents')}}" method="Post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card ">
                    <div class="header">
                        <h5 class="header-text text-center">INCREASE GRADE-WISE SUMMARY OF STUDENTS </h5>
                    </div>
                    <div style="position:relative; padding:5px 30px 0px 30px;text-align: center">
                        <table border="4" class="table-bordered" cellspacing="0" cellpadding="0"
                               style="margin: 5px 0px 0px 0px ;background: white ;width: 100%;">
                            <thead>
                            {{--<tr>--}}
                            {{--<th colspan="4" class="text-center title"><h3>Total Student Summary</h3></th>--}}
                            {{--</tr>--}}
                            </thead>
                            <tbody>
                            <tr class="navbar-ct-blue">
                                <th class="title text-center" style="color: white"><b>Sr No</b></th>
                                <th class="title text-center" style="color: white"><b>Grades</b></th>
                                @if(count($coordinators)==2 && count($contest_student_strength)==20)
                                    <th class="title text-center" style="color: white">
                                        <b>{{$contest_student_strength[0]->contest_category_name}}@php echo " ".date('Y') @endphp</b><br><span>(Previous No. of Students)</span>
                                    </th>
                                    <th class="title text-center" style="color: white">
                                        <b>{{$contest_student_strength[0]->contest_category_name}}@php echo " ".date('Y') @endphp</b><br><span>(New No. of Students)</span>
                                    </th>
                                    <th class="title text-center" style="color: white">
                                        <b>{{$contest_student_strength[1]->contest_category_name}} @php echo " ". date('Y') @endphp</b><br><span>(Previous No. of Students)</span>
                                    </th>
                                    <th class="title text-center" style="color: white">
                                        <b>{{$contest_student_strength[1]->contest_category_name}}@php echo " ".date('Y') @endphp</b><br><span>(New No. of Students)</span>
                                    </th>
                                @elseif(count($coordinators)==1)
                                    <th class="title text-center" style="color: white">
                                        <b>{{$coordinators[0]->contest_category_name}}@php echo " ".date('Y') @endphp</b><br><span>(Previous No. of Students)</span>
                                    </th>
                                    <th class="title text-center" style="color: white">
                                        <b>{{$coordinators[0]->contest_category_name}}@php echo " ".date('Y') @endphp</b><br><span>(New No. of Students)</span>
                                    </th>
                                @else
                                    <th class="title text-center" style="color: white">
                                        <b>{{$coordinators[1]->contest_category_name}}@php echo " ".date('Y') @endphp</b><br><span>(Previous No. of Students)</span>
                                    </th>
                                    <th class="title text-center" style="color: white">
                                        <b>{{$coordinators[1]->contest_category_name}}@php echo " ".date('Y') @endphp</b><br><span>(New No. of Students)</span>
                                    </th>



                                @endif
                            </tr>
                            {{--                            {{$contest_student_strength}}--}}
                            @if( count($coordinators)==2 && count($contest_student_strength)==20 )
                                <input type="hidden" name="check_strength" value="{{count($contest_student_strength)}}">
                                <input type="hidden" name="check_coor_val" value="{{count($coordinators)}}">
                                @for($i=0;$i<count($contest_student_strength);$i++)

                                    <tr>
                                        <?php $j = $i + 1; ?>
                                        <input type="hidden" name="student_strength_id_cat_1[]"
                                               value="{{$contest_student_strength[$i]->cat_contest_std_st_id}}">
                                        <input type="hidden" name="student_strength_id_cat_2[]"
                                               value="{{$contest_student_strength[$j]->cat_contest_std_st_id}}">

                                        <td width="50" align="center"
                                            class="title">{{$contest_student_strength[$i]->class_id}}</td>
                                        <td width="150" align="center"
                                            class="title">{{$contest_student_strength[$i]->contest_class_name}}</td>

                                        <td width="200" align="center" class="title"><input type="text"
                                                                                            name="prev_no_of_students_cat_1[]"
                                                                                            id="prev_no_of_students_{{$contest_student_strength[$i]->class_id}}"
                                                                                            value="{{$contest_student_strength[$i]->total_student_strength}}"
                                                                                            class=" singlestudent tblstudent"
                                                                                            onkeyup="singlestudent();"
                                                                                            onfocus="singlestudent();"
                                                                                            placeholder="0" readonly="readonly">
                                        </td>
                                            <td width="200" align="center" class="title"><input type="text"
                                                                                                name="new_no_of_students_cat_1[]"
                                                                                                id="new_no_of_students_{{$contest_student_strength[$i]->class_id}}"
                                                                                                value=""
                                                                                                class=" singlestudent tblstudent"
                                                                                                onkeyup="singlestudent();"
                                                                                                onfocus="singlestudent();"
                                                                                                placeholder="Enter new student strength ">
                                            </td>

                                        <td width="200" align="center" class="title"><input type="text"
                                                                                            name="prev_no_of_students_cat_2[]"
                                                                                            id="prev_no_of_students_{{$contest_student_strength[$j]->class_id}}"
                                                                                            value="{{$contest_student_strength[$j]->total_student_strength}}"
                                                                                            class=" singlestudent tblstudent"
                                                                                            onkeyup="singlestudent();"
                                                                                            onfocus="singlestudent();"
                                                                                            placeholder="0" readonly="readonly">
                                        </td>
                                            <td width="200" align="center" class="title"><input type="text"
                                                                                                name="new_no_of_students_cat_2[]"
                                                                                                id="new_no_of_students_{{$contest_student_strength[$j]->class_id}}"
                                                                                                value=""
                                                                                                class=" singlestudent tblstudent"
                                                                                                onkeyup="singlestudent();"
                                                                                                onfocus="singlestudent();"
                                                                                                placeholder="Enter new student strength">
                                            </td>

                                    </tr>

                                    <?php $i++; ?>
                                @endfor
                                <tr>
                                    <td colspan="2" class="text-center title" style="font-size: 14px"><strong>Total No. of
                                            Students</strong></td>
                                    <td colspan="4"><input type="text" name="total_student" class="tblstudent"
                                                           id="total_student" onload="singlestudent();" readonly=""
                                                           placeholder="Total Students" value="0"></td>
                                </tr>
                                <tr>

                                    <td colspan="2" class="text-center title" style="font-size: 14px"><strong>Total
                                            Fee </strong></td>
                                    <td colspan="4"><input type="text" name="total_registration_fee" class="tblstudent"
                                                           id="total_registration_fee" onload="singlestudent();" readonly=""
                                                           placeholder="Total Students" value="0"></td>
                                </tr>

                            @else

                                <input type="hidden" name="check_coor_val" value="{{count($coordinators)}}">
                                @for($i=0;$i<count($contest_student_strength);$i++)

                                    <tr>
                                        <input type="hidden" name="student_strength_id_cat_1[]"
                                               value="{{$contest_student_strength[$i]->cat_contest_std_st_id}}">
                                        <td width="100" align="center"
                                            class="title">{{$contest_student_strength[$i]->class_id}}</td>
                                        <td width="100" align="center"
                                            class="title">{{$contest_student_strength[$i]->contest_class_name}}</td>

                                        <td width="200" align="center" class="title"><input type="text"
                                                                                            name="no_of_students_cat_1[]"
                                                                                            id="no_of_students_{{$contest_student_strength[$i]->class_id}}"
                                                                                            value="{{$contest_student_strength[$i]->total_student_strength}}"
                                                                                            class=" singlestudent tblstudent"
                                                                                            onkeyup="singlestudent();"
                                                                                            onfocus="singlestudent();"
                                                                                            placeholder="0"
                                                                                            readonly="readonly">
                                        </td>
                                        <td width="200" align="center" class="title"><input type="text"
                                                                                            name="updated_no_of_students_cat_1[]"
                                                                                            id="no_of_students_{{$contest_student_strength[$i]->class_id}}"
                                                                                            class=" singlestudent tblstudent"
                                                                                            onkeyup="singlestudent();"
                                                                                            onfocus="singlestudent();"
                                                                                            placeholder="Enter new student strength " >

                                        </td>


                                    </tr>

                                @endfor
                                <tr>
                                    <td colspan="2" class="text-center title" style="font-size: 14px"><strong>Total No. of
                                            Students</strong></td>
                                    <td colspan="2"><input type="text" name="total_student" class="tblstudent"
                                                           id="total_student" onload="singlestudent();" readonly=""
                                                           placeholder="Total Students" value="0"></td>
                                </tr>
                                <tr>

                                    <td colspan="2" class="text-center title" style="font-size: 14px"><strong>Total
                                            Fee </strong></td>
                                    <td colspan="2"><input type="text" name="total_registration_fee" class="tblstudent"
                                                           id="total_registration_fee" onload="singlestudent();" readonly=""
                                                           placeholder="Total Students" value="0"></td>
                                </tr>

                            @endif

                            </tbody>
                        </table>
                        <hr style="border-top: 1px solid #fff;">
                        <div style="padding-bottom: 10px">
                            <a href="{{route('home')}}" class="btn btn-primary btn-fill pull-left ">Go back</a>
                            <button type="submit" value="Next" id="add_student_strength"
                                    class="btn btn-primary btn-fill pull-right">Next
                            </button>
                            <div class="clearfix"></div>
                        </div>

                    </div>

                </div>

            </form>
        </div>
    </div>



@stop
@section('script')
    $(document).ready(function () {
    {{--$("#check_previous_value").val("");--}}
    {{--var previous_val=0;--}}
    {{--$(".singlestudent").on("focus",function(e){--}}
    {{--previous_val=$(this).val();--}}
    {{--});--}}
    //called when key is pressed in textbox
    $(".singlestudent").keypress(function (e) {
    //empty the input previous for check;
    //if the letter is not digit then display error and don't type anything
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    //display error message
    //$("#errmsg").html("Number Only").show().fadeOut("slow");
    alert("Please enter only numbers for students strength (0-9) ");
    return false;
    }
    });
    {{--$(".singlestudent").on('blur',function(){--}}
    {{--var   current_val=$(this).val();--}}
    {{--if(current_val < previous_val){--}}
    {{--alert(" Student Strength should be greater than your previous strength value  that is " + previous_val);--}}
    {{--return false;--}}
    {{--}--}}
    {{--});--}}
    singlestudent();
    });
    // just get keyup event
    //$('.singlestudent').on('blur', function(){
    function singlestudent(){
    var total = 0;
    // on every keyup, loop all the elements and add all the results
    $('.singlestudent').each(function(index, element) {
    var val = parseFloat($(element).val());

    if( !isNaN( val )){
    total += val;
    }
    });
    $('#total_student').val(total);
    $('#total_registration_fee').val((total)*700);

    }
    //});
@stop