<?php

namespace App\Http\Controllers;

use App\Contest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
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


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::user()->fk_role_id == 2) {
            $today_date = Carbon::now()->toDateString();
            $activated_contest = DB::table('contest_categories')->select('*')->where('status', 'Active')->get()->toArray();
            $coordinators_info = DB::table('coordinators')->select('*')->
            where(['fk_user_id' => Auth::user()->user_id, 'contest_date' => $activated_contest[0]->contest_registration_end_date])->
            get()->toArray();
            $contest_student_strength = DB::table('cat_wise_contest_student_strength')->where(['fk_user_id' => Auth::user()->user_id, 'contest_date' => $activated_contest[0]->contest_registration_end_date])->get()->toArray();
            $student_info = DB::table('contest_student_info')->select('contest_student_info.*', 'contest_categories.contest_category_name', 'contest_categories.contest_category_id', 'contest_classes.contest_class_name', 'contest_classes.contest_class_id')->
            join('cat_wise_contest_student_strength', 'contest_student_info.fk_cat_contest_std_st_id', '=', 'cat_wise_contest_student_strength.cat_contest_std_st_id')->
            join('contest_categories', 'cat_wise_contest_student_strength.fk_contest_cat_id', '=', 'contest_categories.contest_category_id')->
            join('contest_classes', 'class_id', '=', 'contest_class_id')->
            where(['contest_student_info.fk_user_id' => Auth::user()->user_id,
                'contest_student_info.registration_last_date' =>
                    $activated_contest[0]->contest_registration_end_date
            ])->get()->toArray();
            if (empty($coordinators_info)) {
                return redirect()->route('contestSelectionView');
            } elseif (!empty($coordinators_info) && empty($contest_student_strength) && $today_date <= $activated_contest[0]->contest_registration_end_date) {

                return redirect()->route('ContestStudentStrength.index');
            } else {
                $total_strength = count($contest_student_strength);
                $check_student_strength = 0;
                for ($i = 0; $i < $total_strength; $i++) {
                    $check_student_strength += $contest_student_strength[$i]->total_student_strength;
                }
                if ($check_student_strength == count($student_info)) {
                    return view('home', compact('student_info', 'coordinators_info', 'activated_contest'));
                } else {
                    return redirect()->route('addStudentInfoForm');
                }
            }

        } else {
            $activated_contest = DB::table('contest_categories')->select('*')->where('status', 'Active')->get()->toArray();
            $institutes_info = DB::table('users')->select('*')->where('fk_role_id', 2)->where('users_status', 1)->orderBy('users.user_id', 'asc')->get()->toArray();
            $student_info = DB::table('contest_student_info')->select('contest_student_info.*', 'contest_categories.contest_category_name', 'contest_categories.contest_category_id',
                'users.institute_name', 'contest_classes.contest_class_name', 'contest_classes.contest_class_id')->
            join('cat_wise_contest_student_strength', 'contest_student_info.fk_cat_contest_std_st_id', '=', 'cat_wise_contest_student_strength.cat_contest_std_st_id')->
            join('contest_categories', 'cat_wise_contest_student_strength.fk_contest_cat_id', '=', 'contest_categories.contest_category_id')->
            join('contest_classes', 'class_id', '=', 'contest_class_id')->
            join('users', 'user_id', '=', 'contest_student_info.fk_user_id')->
            where(['users.users_status' => 1, 'contest_student_info.registration_last_date' => $activated_contest[0]->contest_registration_end_date])
                ->get()->toArray();

            return view('home', compact('student_info', 'institutes_info', 'activated_contest'));
        }

    }

}
