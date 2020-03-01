<?php

namespace App\Http\Controllers\Coordinators;

use App\Contest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Array_;

class ContestCoordinatorsController extends Controller
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
        $activated_contest = Contest::select('*')->where(['status' => 'Active'])->get()->toArray();
        $contest_coordinators = DB::table('coordinators')->select('coordinators.*', 'contest_categories.contest_category_name')
            ->join('contest_categories', 'contest_categories.contest_category_id', '=', 'coordinators.fk_contest_category_id')->where(['coordinators.fk_user_id' => Auth::user()->user_id, 'coordinators.contest_date'=>$activated_contest[0]['contest_registration_end_date']])->get();
        $contest__add_coordinators = DB::table('addtional_coordinators')->select('addtional_coordinators.*', 'contest_categories.contest_category_name')
            ->join('contest_categories', 'contest_categories.contest_category_id', '=', 'addtional_coordinators.fk_contest_category_id')->where(['addtional_coordinators.fk_user_id' => Auth::user()->user_id, 'addtional_coordinators.contest_date' => $activated_contest[0]['contest_registration_end_date']])->get()->toArray();
            return view('contest_coordinators.view_coordinators', compact('contest_coordinators', 'contest__add_coordinators'));
    }


    public function select_contest_participate_view()
    {

        $contest_activation = Contest::select('contest_category_id', 'contest_category_name', 'contest_registration_end_date')->where(['status' => 'Active'])->get()->toArray();
        $coordinators = DB::table('coordinators')->where('fk_user_id', Auth::user()->user_id)->where('contest_date', $contest_activation[0]['contest_registration_end_date'])
            ->get()->toArray();
        if (count($coordinators) != 2) {
            Session::flash('Warning','Select contest(s) to proceed');
            return view('contest_selection.select_contest', compact('contest_activation', 'coordinators'));
        } else {
            Session::flash('Error', 'Coordinator information already added, you can only  edit coordinators information');
            return redirect()->route('ContestCoordinators.index');
        }

    }

    public function show_single_coordinator_view()
    {
        $contest_activation = Contest::select('contest_category_id', 'contest_category_name', 'contest_registration_end_date')->where(['status' => 'Active'])->get()->toArray();
        return view('contest_coordinators.add_single_coordinator', compact('contest_activation'));

    }

    public function show_single_second_coord_view()
    {
        $contest_activation = Contest::select('contest_category_id', 'contest_category_name', 'contest_registration_end_date')->where(['status' => 'Active'])->get()->toArray();
        return view('contest_coordinators.add_single_coordinator_2', compact('contest_activation'));
    }

    public function select_contest_participate(Request $request)
    {
        // $contest_activation = Contest::select('contest_category_id', 'contest_category_name', 'contest_registration_end_date')->where(['status' => 'Active'])->get()->toArray();
        if ($request->input('select_contest') == 1) {
            return redirect()->route('ContestCoordinators.create');
        } elseif ($request->input('select_contest') == 2) {
            return redirect()->route('AddSingleCoordinator1');
        } elseif ($request->input('select_contest') == 3) {
            return redirect()->route('AddSingleCoordinator2');
        } else {
            Session::flash('Error', 'Please select minimum one contest to proceed');
            return redirect()->route('contestSelectionView');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->fk_role_id == 2) {

            $contest_activation = Contest::select('contest_category_id', 'contest_category_name', 'contest_registration_end_date')->where(['status' => 'Active'])->get()->toArray();
            $coordinators = DB::table('coordinators')->where('fk_user_id', Auth::user()->user_id)->where('contest_date', $contest_activation[0]['contest_registration_end_date'])
                ->get()->toArray();
            if (empty($coordinators) || count($coordinators) != 2) {
                //$contest_activation = Contest::select('contest_category_id', 'contest_category_name')->where(['status' => 'Active'])->get()->toArray();
                return view('contest_coordinators.add_coordinators', compact('contest_activation', 'coordinators'));
            } else {
                Session::flash('Error', 'Coordinator information already exist,you can only  edit coordinators information');
                return redirect()->route('ContestCoordinators.index');
            }
        } else {
            Session::flash('Error', 'Request UnAthourized');
            return redirect()->intended(route('dashboardCurrStudentInfo'));
        }
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


            $contest_category_id[] = $request->input('contest_category_id');
            $coordinators_names[] = $request->input('coordinator_name');
            $coordinators_job_title[] = $request->input('coordinator_job_title');
            $coordinators_mobile_no[] = $request->input('coordinator_mobile_no');
            $coordinators_landline[] = $request->input('coordinator_landline');
            $coordinators_email[] = $request->input('coordinator_email');
            $contest_date = $request->input('contest_date');

            $this->validate($request, [
                'coordinator_name.*' => 'required',
                'coordinator_job_title.*' => 'required',
                'coordinator_mobile_no.*' => 'required|numeric',
                'coordinator_landline.*' => 'required|numeric',
                'coordinator_email.*' => 'required|email',

            ], [
                'coordinator_name.*' => "Coordinator Name is required",
                'coordinator_job_title.*' => "Coordinator Job Title is required",
                'coordinator_mobile_no.*.required' => 'Coordinator Mobile No is required',
                'coordinator_landline.*.required' => 'Coordinator Landline is required',
                'coordinator_email.*' => 'Coordinator Email is required',
                'coordinator_mobile_no.*.numeric' => 'Field must be numeric',
                'coordinator_landline.*.numeric' => 'Field must be numeric',


            ]);


            for ($i = 0; $i <= 1; $i++) {
                $store_coordinators_info = array(
                    'fk_user_id' => Auth::user()->user_id,
                    'fk_contest_category_id' => $contest_category_id[0][$i],
                    'coordinator_name' => $coordinators_names[0][$i],
                    'coordinator_job_title' => $coordinators_job_title[0][$i],
                    'coordinator_mobile' => $coordinators_mobile_no[0][$i],
                    'coordinator_landline' => $coordinators_landline[0][$i],
                    'coordinator_email' => $coordinators_email[0][$i],
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                    'contest_date' => $contest_date
                );

                DB::table('coordinators')->insert($store_coordinators_info);
            }

            Session::flash('Success', 'Coordinators information has been added successfully');
            return redirect()->route('ContestStudentStrength.index');
        } else {
            Session::flash('Error', 'Request UnAuthorized');
            return redirect()->intended(route('dashboardCurrStudentInfo'));
        }


    }

    public function add_single_coordinator(Request $request)
    {
        $contest_category_id = $request->input('contest_category_id');
        $coordinators_name = $request->input('coordinator_name');
        $coordinators_job_title = $request->input('coordinator_job_title');
        $coordinators_mobile_no = $request->input('coordinator_mobile_no');
        $coordinators_landline = $request->input('coordinator_landline');
        $coordinators_email = $request->input('coordinator_email');
        $contest_date = $request->input('contest_category_date');
        $this->validate($request, [
            'coordinator_name' => 'required',
            'coordinator_job_title' => 'required',
            'coordinator_mobile_no' => 'required|numeric',
            'coordinator_landline' => 'required|numeric',
            'coordinator_email' => 'required|email',

        ], [
            'coordinator_name.required' => "Coordinator Name is required",
            'coordinator_job_title.required' => "Coordinator Job Title is required",
            'coordinator_mobile_no.required' => 'Coordinator Mobile No is required',
            'coordinator_landline.required' => 'Coordinator Landline is required',
            'coordinator_email.required' => 'Coordinator Email is required',
            'coordinator_mobile_no.numeric' => 'Field must be numeric',
            'coordinator_landline.numeric' => 'Field must be numeric',


        ]);
        $store_coordinators_info = array(
            'fk_user_id' => Auth::user()->user_id,
            'fk_contest_category_id' => $contest_category_id,
            'coordinator_name' => $coordinators_name,
            'coordinator_job_title' => $coordinators_job_title,
            'coordinator_mobile' => $coordinators_mobile_no,
            'coordinator_landline' => $coordinators_landline,
            'coordinator_email' => $coordinators_email,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
            'contest_date' => $contest_date
        );
        $contest_activation = Contest::select('contest_category_id', 'contest_category_name', 'contest_registration_end_date')->where(['status' => 'Active'])->get()->toArray();

        $check_coordinator = DB::table('coordinators')->select('*')->
        where('fk_user_id', Auth::user()->user_id)->
        where('fk_contest_category_id', $contest_category_id)
            ->where('contest_date', $contest_activation[0]['contest_registration_end_date'])->get()->toArray();
        if (empty($check_coordinator)) {
            DB::table('coordinators')->insert($store_coordinators_info);
            Session::flash('Success', 'Coordinators information has been added successfully');
            return redirect()->route('ContestStudentStrength.index');
        } else {
            Session::flash('Error', 'Coordinator information already exist');
            return redirect()->route('ContestCoordinators.index');

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->fk_role_id == 2) {
            $contest_coordinators = DB::table('coordinators')->where(['coordinator_id' => $id, 'fk_user_id' => Auth::user()->user_id])->first();
            if (!empty((array)$contest_coordinators)) {
                return view('contest_coordinators.edit_coordinators_info', compact('contest_coordinators'));
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
            Session::flash('Success', 'Coordinator information updated successfully');
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
