<?php

namespace App\Http\Controllers\ContestStudents;

use App\Contest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ContestStudentStrengthControler extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'revalidate']);
    }

//todo check all methods auth conditions and routes

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $contest_activation = Contest::select('*')->where(['status' => 'Active'])->get()->toArray();
        $contest_last_date=$contest_activation[0]['contest_registration_end_date'];
        $coordinators = DB::table('coordinators')->join('contest_categories', 'contest_categories.contest_category_id', '=', 'coordinators.fk_contest_category_id')->where(['coordinators.fk_user_id' => Auth::user()->user_id, 'coordinators.contest_date' => $contest_activation[0]['contest_registration_end_date']])->get()->toArray();

        $contest_student_strength = DB::table('cat_wise_contest_student_strength')
            ->select('cat_wise_contest_student_strength.*', 'contest_classes.*','contest_categories.contest_category_name')
            ->join('contest_classes','contest_classes.contest_class_id','=','cat_wise_contest_student_strength.class_id')
            ->join('contest_categories','contest_categories.contest_category_id','=','cat_wise_contest_student_strength.fk_contest_cat_id')
            ->where(['fk_user_id' => Auth::user()->user_id,
                'cat_wise_contest_student_strength.contest_date' => $contest_last_date])
            ->orderby('contest_classes.contest_class_id','asc')
            ->get()->toArray();
        $today_date = Carbon::now()->toDateString();
       // dd($contest_student_strength);

        if (empty($contest_student_strength) && !empty($coordinators) || count($contest_student_strength) < 20 && count($coordinators) == 2) {
            $classes_name = DB::table('contest_classes')->select('*')->get();
            return view('contest_information.add_student_strength', compact('contest_activation', 'classes_name', 'coordinators','contest_student_strength'));
        } elseif (!empty($contest_student_strength) && $today_date <= $contest_activation[0]['contest_registration_end_date']) {
            $classes_name = DB::table('contest_classes')->select('*')->get();
            return view('contest_information.add_more_student_strength', compact('contest_student_strength', 'classes_name', 'contest_activation', 'coordinators','contest_student_strength'));
        } elseif (!empty($contest_student_strength) && $today_date > $contest_activation[0]['contest_registration_end_date']) {
            Session::flash('Error', 'Registration Closed');
            return redirect()->route('dashboardCurrStudentInfo');
        } else {
            Session::flash('Warning', 'Please select contest(s) and  add coordinators information to proceed ');
            return redirect()->route('contestSelectionView');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $coordinators = DB::table('coordinators')->join('contest_categories', 'contest_categories.contest_category_id', '=', 'coordinators.fk_contest_category_id')->where(['coordinators.fk_user_id' => Auth::user()->user_id, 'contest_categories.status' => 'Active'])->get()->toArray();
//        $contest_student_strength = DB::table('cat_wise_contest_student_strength')->select('*')->where('fk_user_id', Auth::user()->user_id)->get()->toArray();
//        $contest_activation = Contest::select('*')->where(['status' => 'Active'])->get()->toArray();
//        $today_date = Carbon::now()->toDateString();
//        if (empty($contest_student_strength) && !empty($coordinators)) {
//            $classes_name = DB::table('contest_classes')->select('*')->get();
//            return view('contest_information.add_student_strength', compact('contest_activation', 'classes_name', 'coordinators'));
//        } elseif (!empty($contest_student_strength) && $today_date <= $contest_activation[0]['contest_registration_end_date']) {
//            Session::flash('Warning', 'Student strength already added.You can only update student strength');
//            return redirect()->route('ContestStudentStrength.index');
//        }
////        elseif (!empty($contest_student_strength) && $today_date<=$contest_activation[0]['contest_registration_end_date']) {
////            $classes_name = DB::table('contest_classes')->select('*')->get();
////            return view('contest_information.add_student_strength', compact('contest_activation', 'classes_name', 'coordinators'));
////        }
//        else {
//            // Session::flash('Error', 'Sorry,Contest Registration Date Has Been Closed Now');
//            Session::flash('Warning', 'Student strength already added.You can only update student strength');
//            return redirect()->route('dashboardCurrStudentInfo');
//        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->input('check_coordinators') == 2&&$request->input('check_students_str')==0) {
            $no_of_students_cat_1[] = $request->input('no_of_students_cat_1');
            $no_of_students_cat_2[] = $request->input('no_of_students_cat_2');
            $class_id[] = $request->input('contest_class_id');
            $first_cat[] = $request->input('cat_1');
            $second_cat[] = $request->input('cat_2');
            $first_cat_coordinator[] = $request->input('coordinator_cat_1');
            $second_cat_coordinator[] = $request->input('coordinator_cat_2');
            $contest_date[] = $request->input('contest_registration_date');
            for ($i = 0; $i <= 9; $i++) {
                $class_wise_student_count_cat_1 = array(
                    'fk_user_id' => Auth::user()->user_id,
                    'class_id' => $class_id[0][$i],
                    'fk_contest_cat_id' => $first_cat[0][$i],
                    'fk_coordinator_id' => $first_cat_coordinator[0][$i],
                    'total_student_strength' => $no_of_students_cat_1[0][$i],
                    'contest_date' => $contest_date[0][$i],
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString()
                );
                $class_wise_student_count_cat_2 = array(
                    'fk_user_id' => Auth::user()->user_id,
                    'class_id' => $class_id[0][$i],
                    'fk_contest_cat_id' => $second_cat[0][$i],
                    'fk_coordinator_id' => $second_cat_coordinator[0][$i],
                    'total_student_strength' => $no_of_students_cat_2[0][$i],
                    'contest_date' => date('Y-m-d', strtotime($contest_date[0][$i])),
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString()
                );

                DB::table('cat_wise_contest_student_strength')->insert($class_wise_student_count_cat_1);
                DB::table('cat_wise_contest_student_strength')->insert($class_wise_student_count_cat_2);

            }
            Session::flash('Success', 'Student(s) strength added, please enter student(s) data');
            return redirect()->route('addStudentInfoForm');
        } else {
            $no_of_students_cat_1[] = $request->input('no_of_students_cat_1');
            $class_id[] = $request->input('contest_class_id');
            $first_cat[] = $request->input('cat_1');
            $first_cat_coordinator[] = $request->input('coordinator_cat_1');
            $contest_date[] = $request->input('contest_registration_date');

            for ($i = 0; $i <= 9; $i++) {
                $class_wise_student_count_cat_1 = array(
                    'fk_user_id' => Auth::user()->user_id,
                    'class_id' => $class_id[0][$i],
                    'fk_contest_cat_id' => $first_cat[0][$i],
                    'fk_coordinator_id' => $first_cat_coordinator[0][$i],
                    'total_student_strength' => $no_of_students_cat_1[0][$i],
                    'contest_date' => $contest_date[0][$i],
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString()
                );
                DB::table('cat_wise_contest_student_strength')->insert($class_wise_student_count_cat_1);

            }
            Session::flash('Success', 'Student(s) strength added, please enter student(s) data');
            return redirect()->route('addStudentInfoForm');

        }


    }

    public function add_more_student_strength(Request $request)
    {
        if ($request->input('check_coor_val') == 2 && $request->input('check_strength')==20) {
            $prev_no_of_students_cat_1[] = $request->input('prev_no_of_students_cat_1');
            $new_no_of_students_cat_1[] = $request->input('new_no_of_students_cat_1');
            $prev_no_of_students_cat_2[] = $request->input('prev_no_of_students_cat_2');
            $new_no_of_students_cat_2[] = $request->input('new_no_of_students_cat_2');
            $student_strength_id_cat_1[] = $request->input('student_strength_id_cat_1');
            $student_strength_id_cat_2[] = $request->input('student_strength_id_cat_2');

            for ($i = 0; $i <= 9; $i++) {
                $update_class_wise_student_count_cat_1 = array(
                    //this is checking if error occur then uncomment it
                    //'cat_contest_std_st_id' => $student_strength_id_cat_1[0][$i],
                    'total_student_strength' => $prev_no_of_students_cat_1[0][$i]+$new_no_of_students_cat_1[0][$i],
                    'updated_at' => Carbon::now()->toDateTimeString()
                );
                $update_class_wise_student_count_cat_2 = array(
                    //this is checking if error occur then uncomment it
                    //'cat_contest_std_st_id' => $student_strength_id_cat_2[0][$i],
                    'total_student_strength' => $prev_no_of_students_cat_2[0][$i]+$new_no_of_students_cat_2[0][$i],
                    'updated_at' => Carbon::now()->toDateTimeString()
                );


               DB::table('cat_wise_contest_student_strength')->where('cat_contest_std_st_id', $student_strength_id_cat_1[0][$i])->update($update_class_wise_student_count_cat_1);
                DB::table('cat_wise_contest_student_strength')->where('cat_contest_std_st_id', $student_strength_id_cat_2[0][$i])->update($update_class_wise_student_count_cat_2);
            }
           Session::flash('Success', 'Additional student(s) strength added, please enter student(s) data');
            return redirect()->route('addStudentInfoForm');
        } else {
            $prev_no_of_students_cat_1[] = $request->input('no_of_students_cat_1');
            $new_no_of_students_cat_1[]=$request->input('updated_no_of_students_cat_1');
            $student_strength_id_cat_1[] = $request->input('student_strength_id_cat_1');


            for ($i = 0; $i <= 9; $i++) {
                $update_class_wise_student_count_cat_1 = array(
                    //this is test if error occurs then change it;
                    //'cat_contest_std_st_id' => $student_strength_id_cat_1[0][$i],
                    'total_student_strength' => $prev_no_of_students_cat_1[0][$i]+ $new_no_of_students_cat_1[0][$i],
                    'updated_at' => Carbon::now()->toDateTimeString()
                );

                DB::table('cat_wise_contest_student_strength')->where('cat_contest_std_st_id', $student_strength_id_cat_1[0][$i])->update($update_class_wise_student_count_cat_1);

            }
            Session::flash('Success', 'Additional student(s) strength added, please enter student(s) data');
            return redirect()->route('addStudentInfoForm');

        }


    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student_strength=DB::table('cat_wise_contest_student_strength')
            ->join('contest_categories','contest_categories.contest_category_id','=','cat_wise_contest_student_strength.fk_contest_cat_id')
            ->join('contest_classes','contest_classes.contest_class_id','=','cat_wise_contest_student_strength.class_id')
            ->select('cat_wise_contest_student_strength.*','contest_categories.contest_category_name','contest_classes.contest_class_name')
            ->where(['cat_wise_contest_student_strength.cat_contest_std_st_id'=>$id,
                'cat_wise_contest_student_strength.fk_user_id'=>Auth::user()->user_id])->get()->toArray();
       // dd($student_strength);
        return view('contest_information.edit_specific_class_strength',compact('student_strength'));



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $edited_student_strength=array(
            'total_student_strength'=>$request->input('edited_student_strength'),
            'updated_at'=>Carbon::now()
        );
        DB::table('cat_wise_contest_student_strength')->where('cat_contest_std_st_id', $id)->update($edited_student_strength);
        Session::flash('Success', 'Student(s) strength updated successfully');
        return redirect()->route('addStudentInfoForm');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
