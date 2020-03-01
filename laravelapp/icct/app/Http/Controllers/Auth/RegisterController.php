<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Contest;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /* Show the application registration form.
    *
    * @return \Illuminate\Http\Response
    */
    public function showRegistrationForm()
    {
        $provinces=DB::table('provinces')->select('*')->get();
        $contest_activation=Contest::where('status',"=","Active")->get()->toArray();
        return view('auth.register',compact('provinces','contest_activation'));
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'institute_name' => 'required|max:255',
            'institute_province' => 'required',
            'institute_city' => 'required|alpha|max:255',
            'institute_phone' => 'required|numeric',
            'institute_address' => 'required|string|max:1022',
            'institute_email' => 'required|email|max:255',
            'institute_off_account_no'=>'required|max:255',
            'user_name' => 'required|max:255',
            'head_job_title'=>'required|alpha|max:255',
            'head_mobile_no'=>'required|numeric',
            'head_land_line_no'=>'required|numeric',
            'email' => 'required|string|email|max:255|unique:users',
            'register_password' => 'required|string|min:8',
        ], [
            'required' => 'field is required',
            'alpha' => 'field must have alphabetical letters without WhiteSpaces',
            'numeric' => 'field must have numbers',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'institute_head' => strtoupper($data['user_name']),
            'inst_head_job_title'=>strtoupper($data['head_job_title']),
            'inst_head_mobile_no'=>$data['head_mobile_no'],
            'inst_head_landline_no'=>$data['head_land_line_no'],
            'email' => $data['email'],
            'password' => bcrypt($data['register_password']),
            'fk_role_id' => 2,
            'institute_name' => strtoupper($data['institute_name']),
            'institute_province' =>$data['institute_province'],
            'institute_city' => strtoupper($data['institute_city']),
            'institute_phone' => $data['institute_phone'],
            'institute_address' => $data['institute_address'],
            'institute_email'=>strtolower($data['institute_email']),
            'users_status'=>1,
            'inst_official_bank_ac_no'=>strtoupper($data['institute_off_account_no']),
        ]);
    }

     public function get_province_to_input($id){
        $result_query=DB::table('provinces')->select('province_name')->where('province_id',$id)->get();
        $result_query=$result_query->toArray();
         if(!empty($result_query)){
             return Response::json(array('result_province'=>$result_query));
         }else{
             return Response::json(array('result_province'=>'Nothing to show'));
         }

     }
    public function all_cities($id)
    {
        $result_province=DB::table('provinces')->select('province_name')->where('province_id',$id)->get();
        $result_query=DB::table('cities')->select('*')->where('fk_province_id',$id)->get();
        $result_query=$result_query->toArray();
        if(!empty($result_query)){
            return Response::json(array('result_province'=>$result_province,'result_cities'=>$result_query));
        }else{
            return Response::json(array('result_province'=>'empty'));
        }
    }
}
