<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ContestController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','revalidate']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if(Auth::user()->fk_role_id==1){
            $result=Contest::all();
            return view('contestadmin.view_contest_category',compact('result'));
       }else{
          Session::flash('Error','UnAuthorized Request');
          return redirect()->route('home');
      }

  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->fk_role_id==1) {
            $contest_id[] = $request->input('contest_id');
            $contest_reg_start_date[] = $request->input('contest_registartion_start_date');
            $contest_reg_end_date[] = $request->input('contest_registartion_end_date');
            $contest_date[] = $request->input('contest_date');
            $contest_status[] = $request->input('contest_status');
            $this->validate($request, [
                'contest_registartion_start_date.*' => 'required|date|before:contest_registartion_end_date.*',
                'contest_registartion_end_date.*' => 'required|date|after:contest_registartion_start_date.*',
                'contest_date.*' => 'required|date|after:contest_registartion_end_date.*',
                'contest_status.*' => 'required'
            ], [

                'contest_registartion_start_date.*.required' => 'Contest Reg date field is required',
                'contest_registartion_end_date.*.required' => 'Contest Reg date field is required',
                'contest_date.*.required' => 'Contest Reg date field is required',
                'contest_registartion_start_date.*.date' => 'Contest Reg date should be like 12-Aug-1990',
                'contest_registartion_end_date.*.date' => 'Contest Reg date should be like 12-Aug-1990',
                'contest_date.*.date' => 'Contest Reg date should be like 12-Aug-1990',
                'contest_registartion_start_date.*.before' => 'Contest Reg Start Date must be before Contest Reg End Date',
                'contest_registartion_end_date.*.after' => 'Contest Reg Start Date must be after Contest Reg End Date',
                'contest_date.*.after' => 'Contest Date must be after than Contest Reg End Date',
                'contest_status.*' => 'Contest status field Required'
            ]);

            for ($i = 1; $i <= 4; $i++) {
                $change_status = array(
                    'contest_registration_start_date' => date('Y-m-d', strtotime($contest_reg_start_date[0][$i])),
                    'contest_registration_end_date' => date('Y-m-d', strtotime($contest_reg_end_date[0][$i])),
                    'contest_date' => date('Y-m-d', strtotime($contest_date[0][$i])),
                    'status' => $contest_status[0][$i],


                );


                $open_registrations = new Contest();
                $response = $open_registrations->find($contest_id[0][$i])->update($change_status);
            }
            if ($response == true) {
                Session::flash('Success', ' Contest(s) are successfully live');
                return redirect()->route('home');
            }
        }else{
            Session::flash('Error','UnAuthorized Request');
            return redirect()->route('home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
