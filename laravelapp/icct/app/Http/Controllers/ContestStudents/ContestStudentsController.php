<?php

namespace App\Http\Controllers\ContestStudents;

use App\Contest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ContestStudentsController extends Controller
{
    //todo add role based auth in methods and check routes;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $contest_reg_las_date;
    protected $contest_1;
    protected $contest_2;

    public function __construct()
    {
        $this->middleware(['auth', 'revalidate']);
        $activated_contest = Contest::select('*')->where(['status' => 'Active'])->get()->toArray();
        $this->contest_reg_las_date = $activated_contest[0]['contest_registration_end_date'];
        $this->contest_1 = $activated_contest[0]['contest_category_name'];
        $this->contest_2 = $activated_contest[1]['contest_category_name'];

    }

    //Student Information Methods
    public function index()
    {


        $activated_contest = Contest::select('*')->where(['status' => 'Active'])->get()->toArray();

        $coordinators_info = DB::table('coordinators')->select('coordinators.*')->
        join('contest_categories', 'coordinators.fk_contest_category_id', '=', 'contest_categories.contest_category_id')
            ->where(['coordinators.fk_user_id' => Auth::user()->user_id,
                'coordinators.contest_date' => $activated_contest[0]['contest_registration_end_date']])->get()->toArray();
        $contest_student_strength = DB::table('cat_wise_contest_student_strength')->select('*')
            ->where(['fk_user_id' => Auth::user()->user_id, 'contest_date' => $activated_contest[0]['contest_registration_end_date']])->get()->toArray();
        $student_info = DB::table('contest_student_info')->select('contest_student_info.*', 'contest_categories.contest_category_name', 'contest_categories.contest_category_id', 'contest_classes.contest_class_name', 'contest_classes.contest_class_id')->
        join('cat_wise_contest_student_strength', 'contest_student_info.fk_cat_contest_std_st_id', '=', 'cat_wise_contest_student_strength.cat_contest_std_st_id')->
        join('contest_categories', 'cat_wise_contest_student_strength.fk_contest_cat_id', '=', 'contest_categories.contest_category_id')->
        join('contest_classes', 'class_id', '=', 'contest_class_id')->
        where(['contest_student_info.fk_user_id' => Auth::user()->user_id,
            'contest_student_info.registration_last_date' =>
                $activated_contest[0]['contest_registration_end_date'],
        ])->get()->toArray();
        $payment_info = DB::table('contest_payment')->select('*')
            ->where(['fk_user_id' => Auth::user()->user_id, 'contest_reg_end_date' => $activated_contest[0]['contest_registration_end_date']])->get()->toArray();

        if (empty($coordinators_info)) {
            Session::flash('Warning', "Please select contest(s) and  add coordinator's information to proceed");
            return redirect()->route('contestSelectionView');
        } elseif (!empty($student_info)) {
            return view('dashboard', compact('student_info', 'activated_contest', 'coordinators_info', 'payment_info'));
        } else {
            return redirect()->route('ContestStudentStrength.index');
        }


    }

    public function create_contest_students_form()
    {


        $activated_contest = Contest::select('*')->where(['status' => 'Active'])->get()->toArray();
        $result = array(
            'classes_strength' => DB::table('cat_wise_contest_student_strength')->
            join('contest_classes', 'cat_wise_contest_student_strength.class_id', '=', 'contest_classes.contest_class_id')
                ->select('cat_wise_contest_student_strength.*', 'contest_classes.contest_class_name')
                ->where(['fk_user_id' => Auth::user()->user_id,
                    'cat_wise_contest_student_strength.contest_date' => $activated_contest[0]['contest_registration_end_date']])
                ->where('cat_wise_contest_student_strength.total_student_strength',"!=","null")
                ->groupBy(['cat_wise_contest_student_strength.fk_contest_cat_id', 'cat_wise_contest_student_strength.class_id'])
                ->get()
                ->toArray()
        );
        //dd($result);
        $count_classes_index = count($result['classes_strength']);
        for ($i = 0; $i < $count_classes_index; $i++) {

            $result_student_info = DB::table('contest_student_info')->select('*')
                ->where(['contest_student_info.fk_user_id' => Auth::user()->user_id,
                    'contest_student_info.fk_cat_contest_std_st_id' =>
                        $result['classes_strength'][$i]->cat_contest_std_st_id])
                ->get()->toArray();
           // dd($result_student_info);
            if ($result['classes_strength'][$i]->total_student_strength != count($result_student_info)) {
                if ($result['classes_strength'][$i]->total_student_strength > count($result_student_info) && !empty($result_student_info)) {
                    $updated_students_counts = $result['classes_strength'][$i]->total_student_strength - count($result_student_info);
                    $student_strength = $result['classes_strength'][$i];
                    return view('contest_information.student_information.updated_strength_add_student_form', compact('student_strength', 'updated_students_counts', 'activated_contest'));
                    break;
                } else {
                    $student_strength = $result['classes_strength'][$i];
                    return view('contest_information.student_information.add_student_form', compact('student_strength', 'activated_contest'));
                    break;
                }
            } elseif ($i == $count_classes_index - 1) {
                $success_msg = "Student(s) registration has been completed successfully,
                                           if you want to register more students, please go to student info tab or click confirm registration button at the bottom of this page to complete the registration.";
                //$click_btn="<a href='".route('ContestStudentStrength.index')."'" ." class='btn btn-success'>Click Here</a>";
                Session::flash('Success', $success_msg);
                return redirect()->route('dashboardCurrStudentInfo');
            } else {
                continue;
            }
        }


    }


    public function store_contest_students_info(Request $request)
    {


        $this->validate($request, [
            'student_name.*' => 'required',
//            'student_father_name.*' => 'required',
//            'student_father_cell_no.*' => 'required',
        ], [

            'student_name.*.required' => 'Field is required',
//            'student_father_name.*.required' => 'Field is required',
//            'student_father_cell_no.*.required' => 'Field is required',

        ]);
        $class_strength = $request->input('total_student_strength');
        $contest_class_strength_id[] = $request->input('contest_cat_student_strength_id');
        $contest_class_name_id[] = $request->input('contest_class_id');
        $student_name[] = $request->input('student_name');
        $student_father_name[] = $request->input('student_father_name');
        $student_father_mobile_no[] = $request->input('student_father_cell_no');
        $contest_registration_last_date[] = $request->input('registration_last_date');
        for ($i = 0; $i < $class_strength; $i++) {
            $class_wise_student_info = array(
                'fk_user_id' => Auth::user()->user_id,
                'fk_cat_contest_std_st_id' => $contest_class_strength_id[0][$i],
                'fk_class_id' => $contest_class_name_id[0][$i],
                'student_name' => strtoupper($student_name[0][$i]),
                'father_name' => strtoupper($student_father_name[0][$i]),
                'fathers_mobile' => $student_father_mobile_no[0][$i],
                'registration_status' => 'pending',
                'status' => 'active',
                'registration_last_date' => $contest_registration_last_date[0][$i],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            );

           DB::table('contest_student_info')->insert($class_wise_student_info);
        }
        return redirect()->route('addStudentInfoForm');

    }

    public function edit_student_info($id)
    {

        $student_info = DB::table('contest_student_info')->select('*')->where('contest_student_info_id', $id)->get()->toArray();
        if (!empty($student_info)) {
            return view('contest_information.student_information.edit_student_information', compact('student_info'));
        } else {
            return redirect()->route('dashboardCurrStudentInfo');
        }
    }

    public function update_student_info(Request $request, $id)
    {
        $this->validate($request, [
            'edit_student_name' => 'required',
            'edit_father_name' => 'required',
            'edit_father_cell_no' => 'required',
        ],
            [
                'edit_student_name.required' => 'Student  Name is required',
                'edit_father_name.required' => 'Father Name is required',
                'edit_father_cell_no.required' => ' Father Mobile No is required',

            ]
        );
        $update_info = array(
            'student_name' => strtoupper($request->input('edit_student_name')),
            'father_name' => strtoupper($request->input('edit_father_name')),
            'fathers_mobile' => $request->input('edit_father_cell_no'),
            'updated_at' => Carbon::now()->toDateTimeString()

        );
        $update_response = DB::table('contest_student_info')->where('contest_student_info_id', $id)->update($update_info);
        if ($update_response == 1) {

            Session::flash('Success', 'Student info  updated successfully');
            return redirect()->intended(route('dashboardCurrStudentInfo'));


        } else {
            Session::flash('Error', 'No data updated , please try again');
            return redirect()->intended(route('dashboardCurrStudentInfo'));
        }


    }

    public function edit_inst_info_form()
    {
        $provinces = DB::table('provinces')->select('*')->get();
        $get_inst_info = DB::table('users')->select('*')->where('user_id', Auth::user()->user_id)->get()->toArray();
        return view('contest_information.instituteInfo.view_institute_information', compact('get_inst_info', 'provinces'));
    }

    public function update_inst_form(Request $request)
    {
        $this->validate($request, [
            'institute_name' => 'required|max:255',
            'institute_province' => 'required',
            'institute_city' => 'required|alpha|max:255',
            'institute_phone' => 'required|numeric',
            'institute_address' => 'required|string|max:1022',
            'institute_email' => 'required|email|max:255',
            'user_name' => 'required|max:255',
            'head_job_title' => 'required|alpha|max:255',
            'head_mobile_no' => 'required|numeric',
            'head_land_line_no' => 'required|numeric',
        ], [
                'required' => 'field is required',
                'alpha' => 'field must have alphabetical letters without WhiteSpaces',
                'numeric' => 'field must have numbers',

            ]
        );

        $update_info = array(

            'institute_name' => strtoupper($request->input('institute_name')),
            'institute_province' => $request->input('institute_province'),
            'institute_city' => strtoupper($request->input('institute_city')),
            'institute_phone' => $request->input('institute_phone'),
            'institute_address' => strtoupper($request->input('institute_address')),
            'institute_email' => $request->input('institute_email'),
            'inst_official_bank_ac_no' => strtoupper($request->input('institute_off_account_no')),
            'institute_head' => $request->input('user_name'),
            'inst_head_job_title' => strtoupper($request->input('head_job_title')),
            'inst_head_mobile_no' => $request->input('head_mobile_no'),
            'inst_head_landline_no' => $request->input('head_land_line_no'),
            'updated_at' => Carbon::now()
        );
        $update_response = DB::table('users')->where('user_id', Auth::user()->user_id)->update($update_info);
        if ($update_response == 1) {
            Session::flash('Success', "Institution's information has been updated successfully");
            return redirect()->route('editInstInfo');
        } else {
            Session::flash('Error', "Institution's information has not been updated successfully, Try Again");
            return redirect()->route('editInstInfo');
        }


    }
    //End Student Information Method

    //Methods for Registration Confirmation And Payment

    public function update_registration_status(Request $request)
    {
        $contest_std_id[] = $request->input('contest_std_no');
        $contest_std_status[] = $request->input('contest_std_status');

        if (!empty($contest_std_id[0])) {
            $contest_1 = $this->contest_1;
            $contest_2 = $this->contest_2;
            $contest_year = $this->contest_reg_las_date;
            for ($i = 0; $i < count($contest_std_id[0]); $i++) {
                $confirm_status = array(
                    'registration_status' => $contest_std_status[0][$i],
                    'updated_at' => Carbon::now()
                );
                $response = DB::table('contest_student_info')->where('contest_student_info_id', $contest_std_id[0][$i])->update($confirm_status);
            }
            if ($response == true) {

                $total_students = count($contest_std_id[0]);
                Mail::send('email.send', ['total_students' => $total_students, 'contest_1' => $contest_1, 'contest_2' => $contest_2, 'contest_year' => $contest_year], function ($message) {
                    $message->subject('International Cats Contests Registration Confirmation');
                    $message->from('info@catscontests.org', 'International Cats Contests');
                    $message->to(Auth::user()->email);
                });

                Session::flash('Success', "Registration has been confirmed successfully. A confirmation e-mail has been sent at your login email address");
                return redirect()->route('dashboardCurrStudentInfo');
//                //for testing mail on live server
//
//                $total_students = 4;
//                $contest_year=2019;
//                $contest_1='contest1';
//                $contest_2='contest2';
//                Mail::send('email.send', ['total_students' => $total_students,'contest_1'=>$contest_1,'contest_2'=>$contest_2,'contest_year'=>$contest_year], function ($message) {
//                    $message->subject('International Cats Contests Registration Confirmation');
//                    $message->from('info@catscontests.org', 'International Cats Contests');
//                    $message->to('tahaahmad1947@gmail.com');
//                });
//
//                Session::flash('Success', "Registration have been confirmed successfully.Please check your institution's/head's email");
//                return redirect()->route('dashboardCurrStudentInfo');
            }
        } else {
            Session::flash('Warning', 'Current student registrations  have been already confirmed');
            return redirect()->route('dashboardCurrStudentInfo');
        }
    }

    public function upload_and_store_payment_file(Request $request)
    {

        $this->validate($request, [
            'payment_date' => 'required|date',
            'payment_file' => 'required|mimes:jpeg,jpg,png|max:1000'

        ], [
                'payment_file.max' => 'File Should be less than or equal to 1MB',
                'payment_file.required' => 'Field is required',
                'payment_file.mimes' => 'File Extenstion should be Jpeg,jpg or png',
                'payment_date.required' => 'Field is required',
                'payment_date.date' => 'Payment date should be in date format'
            ]
        );
        if ($request->hasFile('payment_file')) {
            $image = $request->file('payment_file');
            $filename = time() . "_" . $image->getClientOriginalName();
            $path = public_path() . '/paymentFiles/';
            $image->move($path, $filename);
            $add_payment_info = array(
                'fk_user_id' => Auth::user()->user_id,
                'payment_date' => date('Y-m-d"', strtotime($request->input('payment_date'))),
                'payment_file_path' => $filename,
                'contest_reg_end_date' => $this->contest_reg_las_date,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            );
            DB::table('contest_payment')->insert($add_payment_info);
            Session::flash('Success', 'File has been uploaded successfully');
            return redirect()->route('dashboardCurrStudentInfo');
        } else {
            Session::flash('Error', 'File has not been uploaded!Please try again');
            return redirect()->route('dashboardCurrStudentInfo');
        }


    }

}
