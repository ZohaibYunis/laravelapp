<?php

namespace App\Http\Controllers\Admin;

use App\Contest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Validator;

class ContestInformation extends Controller
{
    protected $contest_reg_last_date;
    protected $active_coord_one;
    protected $active_coord_two;

    public function __construct()
    {
        $this->middleware(['auth', 'revalidate']);
        $activated_contest = Contest::select('*')->where(['status' => 'Active'])->get()->toArray();
        $this->contest_reg_last_date = $activated_contest[0]['contest_registration_end_date'];
        $this->active_coord_one = $activated_contest[0]['contest_category_id'];
        $this->active_coord_two = $activated_contest[1]['contest_category_id'];
    }

    //View All Institution
    public function index()
    {
        if (Auth::user()->fk_role_id == 1) {
            $institutes_info = DB::table('users')->select('*')->where('fk_role_id', 2)->where('users_status',1)->orderBy('users.user_id','desc')->get()->toArray();
            //dd($institutes_info);
            return view('contestadmin.contestStudentInfo.view_all_institutes', compact('institutes_info'));
        } else {
            Session::flash('Error', 'UnAuthorized Request');
            return redirect()->route('home');
        }
    }

    public function  view_in_active_inst(){
        if (Auth::user()->fk_role_id == 1) {
            $institutes_info = DB::table('users')->select('*')->where('fk_role_id', 2)->where('users_status',0)->orderBy('users.user_id','asc')->get()->toArray();
            //dd($institutes_info);
            return view('contestadmin.contestStudentInfo.view_in_active_inst', compact('institutes_info'));
        } else {
            Session::flash('Error', 'UnAuthorized Request');
            return redirect()->route('home');
        }
    }

    // End View All Institution


    //View Cuurent and Previous Students By Inst

    public function view_all_students_info(){
        if (Auth::user()->fk_role_id == 1) {
            $activated_contest = Contest::select('*')->where(['status' => 'Active'])->get()->toArray();
            $student_info = DB::table('contest_student_info')->select('contest_student_info.*', 'contest_categories.contest_category_name', 'contest_categories.contest_category_id',
                'users.institute_name', 'contest_classes.contest_class_name', 'contest_classes.contest_class_id')->
            join('cat_wise_contest_student_strength', 'contest_student_info.fk_cat_contest_std_st_id', '=', 'cat_wise_contest_student_strength.cat_contest_std_st_id')->
            join('contest_categories', 'cat_wise_contest_student_strength.fk_contest_cat_id', '=', 'contest_categories.contest_category_id')->
            join('contest_classes', 'class_id', '=', 'contest_class_id')->
            join('users', 'user_id', '=', 'contest_student_info.fk_user_id')->
            where(['users.users_status'=>1,
                'contest_student_info.registration_last_date' =>
                    $activated_contest[0]['contest_registration_end_date'],
            ])->
            get()->toArray();
            $contest_year = $this->contest_reg_last_date;
            return view('contestadmin.contestStudentInfo.view_all_registered_student', compact('student_info', 'activated_contest','contest_year'));
        } else {
            Session::flash('Error', 'UnAuthorized Request');
            return redirect()->route('home');
        }
    }

    public function view_contest_student_info($id)
    {

        if (Auth::user()->fk_role_id == 1) {
            $activated_contest = Contest::select('*')->where(['status' => 'Active'])->get()->toArray();
            $coordinators_info = DB::table('coordinators')->select('coordinators.*','contest_categories.contest_category_name')->
            join('contest_categories', 'coordinators.fk_contest_category_id', '=', 'contest_categories.contest_category_id')
                ->where(['coordinators.fk_user_id' => $id,
                    'contest_categories.status' => 'Active'])->get()->toArray();
            $student_info = DB::table('contest_student_info')->select('contest_student_info.*', 'contest_categories.contest_category_name', 'contest_categories.contest_category_id',
                'users.institute_name', 'contest_classes.contest_class_name', 'contest_classes.contest_class_id')->
            join('cat_wise_contest_student_strength', 'contest_student_info.fk_cat_contest_std_st_id', '=', 'cat_wise_contest_student_strength.cat_contest_std_st_id')->
            join('contest_categories', 'cat_wise_contest_student_strength.fk_contest_cat_id', '=', 'contest_categories.contest_category_id')->
            join('contest_classes', 'class_id', '=', 'contest_class_id')->
            join('users', 'user_id', '=', 'contest_student_info.fk_user_id')->
            where(['contest_student_info.fk_user_id' => $id,
                'contest_student_info.registration_last_date' =>
                    $activated_contest[0]['contest_registration_end_date'],
            ])->
            get()->toArray();
            $contest_year = $this->contest_reg_last_date;
            return view('adminDashboard', compact('student_info', 'activated_contest', 'coordinators_info', 'contest_year'));
        } else {
            Session::flash('Error', 'UnAuthorized Request');
            return redirect()->route('home');
        }

    }

    public function view_previous_student_info($id)
    {
        if (Auth::user()->fk_role_id == 1) {
            $student_info = DB::table('contest_student_info')->select('contest_student_info.*', 'contest_categories.contest_category_name', 'contest_categories.contest_category_id',
                'users.institute_name', 'contest_classes.contest_class_name')->
            join('cat_wise_contest_student_strength', 'contest_student_info.fk_cat_contest_std_st_id', '=', 'cat_wise_contest_student_strength.cat_contest_std_st_id')->
            join('contest_categories', 'cat_wise_contest_student_strength.fk_contest_cat_id', '=', 'contest_categories.contest_category_id')->
            join('contest_classes', 'class_id', '=', 'contest_class_id')->
            join('users', 'user_id', '=', 'contest_student_info.fk_user_id')->
            where(['contest_student_info.fk_user_id' => $id,])->orderBy('contest_student_info.contest_student_info_id', 'desc')->
            get()->toArray();
            return view('contestadmin.contestStudentInfo.view_all_previous_students', compact('student_info'));
        } else {
            Session::flash('Error', 'UnAuthorized Request');
            return redirect()->route('home');
        }


    }

    // End View Cuurent and Previous Students By Inst

    public function view_institute_wise_payments($id)
    {
        if (Auth::user()->fk_role_id == 1) {
            $payment_file = DB::table('contest_payment')->select('*')->where(['fk_user_id' => $id, 'contest_reg_end_date' => $this->contest_reg_last_date])->get()->toArray();
            return view('contestadmin.contestStudentInfo.view_payment_file', compact('payment_file'));
        } else {
            Session::flash('Error', 'UnAuthorized Request');
            return redirect()->route('home');
        }

    }

    //Edit Student Info Insitution wise


    public function edit_student_info_form($id, $ins_id)
    {
        if (Auth::user()->fk_role_id == 1) {
            $student_info = DB::table('contest_student_info')->select('*')->where('contest_student_info_id', $id)->get()->toArray();
            if (!empty($student_info)) {
                return view('contest_information.student_information.edit_student_information', compact('student_info'));
            } else {
                return redirect()->route('viewInstStudentInfo', ['id' => $ins_id]);
            }
        } else {
            Session::flash('Error', 'UnAuthorized Request');
            return redirect()->route('home');
        }

    }

    public function update_inst_student_info(Request $request, $id, $ins_id)
    {
        if (Auth::user()->fk_role_id == 1) {
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
                if (Auth::user()->fk_role_id == 2) {
                    Session::flash('Success', 'Student Info Information Updated Successfully');
                    return redirect()->intended(route('dashboardCurrStudentInfo'));
                } else {
                    return redirect()->route('viewInstStudentInfo', ['id' => $ins_id]);
                }

            } else {
                if (Auth::user()->fk_role_id == 2) {
                    Session::flash('Error', 'No data Updated ,Please Try Again');
                    return redirect()->intended(route('dashboardCurrStudentInfo'));
                } else {
                    return redirect()->route('viewInstStudentInfo', ['id' => $ins_id]);
                }
            }
        } else {
            Session::flash('Error', 'UnAuthorized Request');
            return redirect()->route('home');
        }


    }

    //End Student Info Institution wise
    //Edit Institution Info by Admin

    public function edit_insititute_info($id)
    {
        if (Auth::user()->fk_role_id == 1) {
            $provinces = DB::table('provinces')->select('*')->get()->toArray();
            $get_inst_info = DB::table('users')->select('*')->where('user_id', $id)->get()->toArray();
            return view('contest_information.instituteInfo.view_institute_information', compact('get_inst_info', 'provinces'));
        } else {
            Session::flash('Error', 'UnAuthorized Request');
            return redirect()->route('home');
        }
    }


    public function update_insititute_info(Request $request, $id)
    {
        if (Auth::user()->fk_role_id == 1) {
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
                'email' => $request->input('email'),
                'updated_at' => Carbon::now()
            );
            $update_response = DB::table('users')->where('user_id', $id)->update($update_info);
            if ($update_response == 1) {
                Session::flash('Success', "Institution's information has been updated successfully");
                return redirect()->route('editInstInfoAdm', ["id" => $id]);
            } else {
                Session::flash('Error', "Institution's information has not been updated successfully,Try Again");
                return redirect()->route('editInstInfoAdm', ['id' => $id]);
            }
        } else {
            Session::flash('Error', 'UnAuthorized Request');
            return redirect()->route('home');
        }

    }

    public function update_insititute_status( Request $request ,$id){
        if (Auth::user()->fk_role_id == 1) {
             $update_status=array(
                 'users_status'=>0,
                 'updated_at'=>Carbon::now()
             );
             DB::table('users')->where('user_id',$request->input('id'))->update($update_status);
            Session::flash('Success','Institute deleted successfully');
            return redirect()->route('viewAllInstitutes');
        } else {
            Session::flash('Error', 'UnAuthorized Request');
            return redirect()->route('home');
        }

    }
    public function active_inst_status(Request $request,$id){
        if (Auth::user()->fk_role_id == 1) {
            $update_status=array(
                'users_status'=>1,
                'updated_at'=>Carbon::now()
            );
            DB::table('users')->where('user_id',$request->input('id'))->update($update_status);
            Session::flash('Success','Institute activated successfully');
            return redirect()->route('viewAllInstitutes');
        } else {
            Session::flash('Error', 'UnAuthorized Request');
            return redirect()->route('home');
        }
    }

    //End Update Institution Info

//Coordinators Methods
    public function view_all_coordinators_institute_wise()
    {

        if (Auth::user()->fk_role_id == 1) {

            $contest_year = $this->contest_reg_last_date;
            $coordinators_info = DB::table('coordinators')->select('coordinators.*', 'users.institute_name', 'contest_categories.contest_category_name')->join('users', 'users.user_id', '=', 'coordinators.fk_user_id')
                ->join('contest_categories', 'coordinators.fk_contest_category_id', '=', 'contest_categories.contest_category_id')
                ->where(['coordinators.contest_date'=>$contest_year,'users.users_status'=>1])->orderBy('coordinators.fk_user_id', 'asc')
                ->get()->toArray();
            // if (count($coordinators_info) > 0) {

            return view('contestadmin.contestCoordinators.view_all_coordinators', compact('coordinators_info', 'contest_year'));
            //  }

        } else {
            Session::flash('Error', 'Request UnAuthorized');
            return redirect()->route('home');
        }

    }

    public function get_all_coordinators_by_date(Request $request){
        if (Auth::user()->fk_role_id == 1) {
              $validation= Validator::make($request->all(),[
                  'date_from'=>'required',
                   'date_to'=>'required'

               ]);
              if($validation->fails()){
                // return response()->json($validation->errors()->all());
                  echo json_encode($validation->errors()->all());
              }else{
                  $contest_year = $this->contest_reg_last_date;
                  $date_from=date('Y-m-d',strtotime($request->input('date_from')));
                  $date_to=date('Y-m-d',strtotime($request->input('date_to')));
                  $coordinators_info = DB::table('coordinators')->select('coordinators.*', 'users.institute_name', 'contest_categories.contest_category_name')->join('users', 'users.user_id', '=', 'coordinators.fk_user_id')
                      ->join('contest_categories', 'coordinators.fk_contest_category_id', '=', 'contest_categories.contest_category_id')
                      ->where('coordinators.contest_date',">=",$date_from)->where('coordinators.contest_date',"<=",$date_to)->where('users.users_status',1)->orderBy('coordinators.fk_user_id', 'asc')
                      ->get()->toArray();
//           // echo json_encode($coordinators_info);
                  return response()->json($coordinators_info);
                  // return view('contestadmin.contestCoordinators.view_all_coordinators', compact('coordinators_info', 'contest_year'));
             }





        } else {
            Session::flash('Error', 'Request UnAuthorized');
            return redirect()->route('home');
        }

    }

    public function edit_coordinators_info($id)
    {
        if (Auth::user()->fk_role_id == 1) {
            $contest_coordinators = DB::table('coordinators')->where(['coordinator_id' => $id])->first();
            if (!empty((array)$contest_coordinators)) {
                return view('contest_coordinators.edit_coordinators_info', compact('contest_coordinators'));
            } else {
                Session::flash('Error', 'No Information Found');
                return redirect()->route('viewAllCoordinators');
            }
        } else {
            Session::flash('Error', 'Request UnAuthorized');
            return redirect()->route('home');
        }

    }

    public function update_coordinators_info(Request $request, $id)
    {
        $this->validate($request, [
            'coordinator_name' => 'required',
            'coordinator_job_title' => 'required',
            'coordinator_mobile_no' => 'required',
            'coordinator_landline' => 'required',
            'coordinator_email' => 'required',
        ],
            [
                'coordinator_name.required' => 'Coordinator Name is required',
                'coordinator_job_title.required' => 'Coordinator  Job Title is required',
                'coordinator_mobile_no.required' => ' Coordinator Mobile No is required',
                'coordinator_landline.required' => ' Coordinator Landline No required',
                'coordinator_email.required' => ' Coordinator Email is required',
            ]
        );
        $update_info = array(
            'coordinator_name' => $request->input('coordinator_name'),
            'coordinator_job_title' => $request->input('coordinator_job_title'),
            'coordinator_mobile' => $request->input('coordinator_mobile_no'),
            'coordinator_landline' => $request->input('coordinator_landline'),
            'coordinator_email' => $request->input('coordinator_email'),
            'updated_at' => Carbon::now()->toDateTimeString()
        );
        $update_response = DB::table('coordinators')->where('coordinator_id', $id)->update($update_info);
        if ($update_response == 1) {
            Session::flash('Success', 'Coordinator Information Updated Successfully');
            return redirect()->intended(route('viewAllCoordinators'));
        } else {
            Session::flash('Error', 'No data Updated ,Please Try Again');
            return redirect()->intended(route('viewAllCoordinators'));
        }
    }

    public function view_all_additional_coordinators()
    {

        if (Auth::user()->fk_role_id == 1) {
            $contest_date = $this->contest_reg_last_date;
            $contest_add_coordinators = DB::table('addtional_coordinators')->select('addtional_coordinators.*', 'contest_categories.contest_category_name', 'users.institute_name')->join('users', 'addtional_coordinators.fk_user_id', '=', 'users.user_id')
                ->join('contest_categories', 'contest_categories.contest_category_id', '=', 'addtional_coordinators.fk_contest_category_id')->where(['addtional_coordinators.contest_date' => $contest_date])->get()->toArray();

            $contest_year = $this->contest_reg_last_date;
            return view('contestadmin.contestCoordinators.view_all_addi_coordinators', compact('contest_add_coordinators', 'contest_year'));

        } else {
            Session::flash('Error', 'Request UnAuthorized');
            return redirect()->route('home');
        }

    }

    public function add_additional_coordinators(Request $request)
    {
        if (Auth::user()->fk_role_id == 1) {
            $this->validate($request, [
                'contest_name' => 'required',
                'coordinator_name' => 'required',
                'coordinator_job_title' => 'required',
                'coordinator_mobile_no' => 'required|numeric',
                'coordinator_landline' => 'required|numeric',
                'coordinator_email' => 'required|email',

            ], [
                'required' => 'Field is required',
                'numeric' => 'Field must be numeric',
                'email' => 'Field must have an email(e.g abc@example.com)',

            ]);
            $store_coordinators_info = array(
                'fk_user_id' => decrypt($request->input('inst_no')),
                'fk_contest_category_id' => $request->input('contest_name'),
                'add_coordinator_name' => $request->input('coordinator_name'),
                'add_coordinator_job_title' => $request->input('coordinator_job_title'),
                'add_coordinator_mobile' => $request->input('coordinator_mobile_no'),
                'add_coordinator_landline' => $request->input('coordinator_landline'),
                'add_coordinator_email' => $request->input('coordinator_email'),
                'contest_date' => $request->input('contest_date'),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            );
            DB::table('addtional_coordinators')->insert($store_coordinators_info);
            Session::flash('Success', ' Additional coordinators information has been added successfully');
            return redirect()->route('viewAllAddiCoordinators');
        } else {
            Session::flash('Error', 'Request UnAthourized');
            return redirect()->intended(route('home'));
        }


    }

    public function edit_addi_coordinators_info($id)
    {

        if (Auth::user()->fk_role_id == 1) {
            $contest_coordinators = DB::table('addtional_coordinators')->where(['add_coordinator_id' => $id])->first();
            if (!empty((array)$contest_coordinators)) {
                $activated_contest = Contest::select('*')->where(['status' => 'Active'])->get()->toArray();
                return view('contest_coordinators.additionalCoordinators.edit_addi_coordinators_info', compact('contest_coordinators', 'activated_contest'));
            } else {
                Session::flash('Error', 'No Information Found');
                return redirect()->route('viewAllAddiCoordinators');
            }
        } else {
            Session::flash('Error', 'Request UnAuthorized');
            return redirect()->route('home');
        }

    }

    public function update_addi_coordinator_info(Request $request, $id)
    {
        $this->validate($request, [
            'contest_name' => 'required',
            'coordinator_name' => 'required',
            'coordinator_job_title' => 'required',
            'coordinator_mobile_no' => 'required|numeric',
            'coordinator_landline' => 'required|numeric',
            'coordinator_email' => 'required|email',

        ], [
            'required' => 'Field is required',
            'numeric' => 'Field must be numeric',
            'email' => 'Field must have an email(e.g abc@example.com)',

        ]);
        $update_info = array(
            'fk_contest_category_id' => $request->input('contest_name'),
            'add_coordinator_name' => $request->input('coordinator_name'),
            'add_coordinator_job_title' => $request->input('coordinator_job_title'),
            'add_coordinator_mobile' => $request->input('coordinator_mobile_no'),
            'add_coordinator_landline' => $request->input('coordinator_landline'),
            'add_coordinator_email' => $request->input('coordinator_email'),
            'updated_at' => Carbon::now()->toDateTimeString()
        );
        $update_response = DB::table('addtional_coordinators')->where('add_coordinator_id', $id)->update($update_info);
        if ($update_response == 1) {
            Session::flash('Success', 'Coordinator Information Updated Successfully');
            return redirect()->intended(route('viewAllAddiCoordinators'));
        } else {
            Session::flash('Error', 'No data Updated ,Please Try Again');
            return redirect()->intended(route('viewAllAddiCoordinators'));
        }
    }
//End Coordinators Methods




}
