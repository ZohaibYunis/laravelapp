<?php

namespace App\Http\Controllers\Coordinators;

use App\Contest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AddtionalCoordinatorsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'revalidate']);


    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activated_contest = Contest::select('*')->where(['status' => 'Active'])->get()->toArray();
        return view('contest_coordinators.additionalCoordinators.add_additional_coordinators', compact('activated_contest'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->fk_role_id == 2) {

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
                'fk_user_id' => Auth::user()->user_id,
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
            return redirect()->route('ContestCoordinators.index');
        } else {
            Session::flash('Error', 'Request UnAthourized');
            return redirect()->intended(route('home'));
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
        $activated_contest = Contest::select('*')->where(['status' => 'Active'])->get()->toArray();
        $inst_id=$id;
        return view('contest_coordinators.additionalCoordinators.add_additional_coordinators', compact('activated_contest','inst_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->fk_role_id == 2 ) {

            $contest_coordinators = DB::table('addtional_coordinators')->where(['add_coordinator_id' => $id, 'fk_user_id' => Auth::user()->user_id])->first();
            if (!empty((array)$contest_coordinators)) {
                $activated_contest = Contest::select('*')->where(['status' => 'Active'])->get()->toArray();
                return view('contest_coordinators.additionalCoordinators.edit_addi_coordinators_info', compact('contest_coordinators','activated_contest'));
            } else {
                Session::flash('Error', 'No Information Found');
                return redirect()->route('ContestCoordinators.index');
            }
        } else {
            Session::flash('Error', 'Request UnAuthorized');
            return redirect()->route('dashboardCurrStudentInfo');
        }




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
            return redirect()->intended(route('ContestCoordinators.index'));
        } else {
            Session::flash('Error', 'No data Updated ,Please Try Again');
            return redirect()->intended(route('ContestCoordinators.index'));
        }

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
