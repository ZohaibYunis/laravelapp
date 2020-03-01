@extends('masterlayouts.app')
@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 ">
            <form action="{{route('ContestStudentStrength.store')}}" method="Post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="card ">
                    <div class="header">
                        <h5 class="header-text text-center">GRADE WISE SUMMARY OF STUDENTS</h5>
                    </div>
                    <div style="position:relative; padding:5px 30px 0px 30px">
                        <table border="4" class="table-bordered" cellspacing="0" cellpadding="0"
                               style="margin: 5px 0px 0px 0px ;background: white;width: 100%">
                            <thead>
                            {{--<tr>--}}
                            {{--<th colspan="4" class="text-center title"><h5>Total Student Summary</h5></th>--}}
                            {{--</tr>--}}
                            </thead>
                            <tbody>
                            <tr class="navbar-ct-blue">
                                <th class="title text-center" style="color: white"><b>Sr No</b></th>
                                <th class="title text-center" style="color: white"><b>Grades</b></th>
                                @if(count($coordinators)==2 && empty($contest_student_strength))
                                    <th class="title text-center" style="color: white">
                                        <b>{{$contest_activation[0]['contest_category_name'] }}@php echo " ".date('Y') @endphp</b><br><span>(No. of Students)</span>
                                    </th>
                                    <th class="title text-center" style="color: white">
                                        <b>{{$contest_activation[1]['contest_category_name'] }} @php echo " ". date('Y') @endphp</b><br><span>(No. of Students)</span>
                                    </th>
                                @elseif(count($coordinators)==1)
                                    <th class="title text-center" style="color: white">
                                        <b>{{$coordinators[0]->contest_category_name}}@php echo " ".date('Y') @endphp</b><br><span>(No. of Students)</span>
                                    </th>
                                @else
                                    <th class="title text-center" style="color: white">
                                        <b>{{$coordinators[1]->contest_category_name}}@php echo " ".date('Y') @endphp</b><br><span>(No. of Students)</span>
                                    </th>
                                @endif

                            </tr>
                            @if(count($coordinators)==2 && empty($contest_student_strength))
                                @foreach($classes_name as $row)
                                    <input type="hidden" name="check_students_str" value="0">
                                    <input type="hidden" name="check_coordinators" value="2">
                                    <tr>
                                        <input type="hidden" name="contest_class_id[]"
                                               value="{{$row->contest_class_id}}">
                                        <input type="hidden" name="cat_1[]"
                                               value="{{$contest_activation[0]['contest_category_id']}}">
                                        <input type="hidden" name="cat_2[]"
                                               value="{{$contest_activation[1]['contest_category_id']}}">
                                        <input type="hidden" name="coordinator_cat_1[]"
                                               value="{{$coordinators[0]->coordinator_id}}">
                                        <input type="hidden" name="coordinator_cat_2[]"
                                               value="{{$coordinators[1]->coordinator_id}}">
                                        <input type="hidden" name="contest_registration_date[]"
                                               value="{{$coordinators[0]->contest_registration_end_date}}">
                                        <td width="100" align="center" class="title">{{$row->contest_class_id}}</td>
                                        <td width="300" align="center" class="title">{{$row->contest_class_name}}</td>
                                        <td width="200" align="center" class="title"><input type="text"
                                                                                            name="no_of_students_cat_1[]"
                                                                                            id="no_of_students_{{$row->contest_class_id}}"
                                                                                            value=""
                                                                                            class=" singlestudent tblstudent"
                                                                                            onkeyup="singlestudent();"
                                                                                            onfocus="singlestudent();"
                                                                                            placeholder="Enter total student to register ">
                                        </td>
                                        <td width="200" align="center" class="title"><input type="text"
                                                                                            name="no_of_students_cat_2[]"
                                                                                            id="no_of_students_{{$row->contest_class_id}}"
                                                                                            value=""
                                                                                            class=" singlestudent tblstudent"
                                                                                            onkeyup="singlestudent();"
                                                                                            onfocus="singlestudent();"
                                                                                            placeholder="Enter total student to register ">
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <input type="hidden" name="check_students_str" value="{{count($contest_student_strength)}}">
                                <input type="hidden" name="check_coordinators" value="{{count($coordinators)}}">
                                @foreach($classes_name as $row)
                                    <tr>

                                        <input type="hidden" name="contest_class_id[]"
                                               value="{{$row->contest_class_id}}">
                                        @if(count($coordinators)==1)
                                        <input type="hidden" name="cat_1[]"
                                               value="{{$coordinators[0]->contest_category_id}}">
                                        <input type="hidden" name="coordinator_cat_1[]"
                                               value="{{$coordinators[0]->coordinator_id}}">
                                        <input type="hidden" name="contest_registration_date[]"
                                               value="{{$coordinators[0]->contest_registration_end_date}}">
                                            @else
                                            <input type="hidden" name="cat_1[]"
                                                   value="{{$coordinators[1]->contest_category_id}}">
                                            <input type="hidden" name="coordinator_cat_1[]"
                                                   value="{{$coordinators[1]->coordinator_id}}">
                                            <input type="hidden" name="contest_registration_date[]"
                                                   value="{{$coordinators[1]->contest_registration_end_date}}">
                                        @endif
                                        <td width="100" align="center" class="title">{{$row->contest_class_id}}</td>
                                        <td width="300" align="center" class="title">{{$row->contest_class_name}}</td>
                                        <td width="200" align="center" class="title"><input type="text"
                                                                                            name="no_of_students_cat_1[]"
                                                                                            id="no_of_students_{{$row->contest_class_id}}"
                                                                                            value=""
                                                                                            class=" singlestudent tblstudent"
                                                                                            onkeyup="singlestudent();"
                                                                                            onfocus="singlestudent();"
                                                                                            placeholder="Enter total student to register ">
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
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
                            </tbody>
                        </table>
                        <hr style="border-top: 1px solid #fff;">
                        <div style="padding-bottom: 10px">
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
    //called when key is pressed in textbox
    $(".singlestudent").keypress(function (e) {
    //if the letter is not digit then display error and don't type anything
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    //display error message
    //$("#errmsg").html("Number Only").show().fadeOut("slow");
    alert("Please enter only numbers for students strength ");
    return false;
    }
    });

    singlestudent();
    });
    // just get keyup event
    //$('.singlestudent').on('keyup', function(){
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
