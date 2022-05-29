<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ElectionDetails;
use App\Models\PoliticalParty;
use App\Models\SystemElectionCandidate;
use App\Models\Electionsinformation;
use App\Models\Position;
use Session;
use DB;
use Validator;


class InviteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function tables(Request $request, $id = "", $param = '')
    {
        $query = '1=1';
        if ($request->param == '1') {
            
            $query = '';
            $data = $request->all();
            // dd($data);
            $validator = Validator::make($data, [
                'provincia'         => 'required',
                'canton'            => 'required',
                'circun'   => 'required',
                'parroquia'         => 'required',
                'zona'              => 'required',
                'junta_no'          => 'required',
                'voters'            => 'required',

            ]);
            if ($validator->fails()) {
                // dd('stop');
                return response()->json(['errors' => $validator->errors()->all()]);
            } else {

                if ($request->has('provincia')) {
                    $query .= " and provincia =  '$request->provincia'";
                }
                if ($request->has('canton')) {
                    $query .= " and canton =  '$request->canton'";
                }
                if ($request->has('parroquia')) {
                    $query .= " and parroquia =  '$request->parroquia'";
                }
                if ($request->has('circun')) {
                    $query .= " and Circun =  '$request->circun'";
                }
                if ($request->has('zona')) {
                    $query .= " and zona =  '$request->zona'";
                }
                if ($request->has('junta_no')) {
                    $query .= " and junta_no =  '$request->junta_no'";
                }
                if ($request->has('voters')) {
                    $query .= " and voters =  '$request->voters'";
                }

                $systemCandidates = DB::select('select * from electiondetails where 1=1 and  election_id = ' . session()->get('electionId') . $query);
                if (empty($systemCandidates)) {
                    return response()->json([
                        'result' => 'fail',
                        'msg' => 'No Table data Found'
                    ]);
                }

                return response()->json([
                    'data' => $systemCandidates
                ]);
            }
        } else {
            $getSTatVal = Electionsinformation::select(\DB::raw("DISTINCT(state_name)"))->get();
            if (!empty($id)) {
                $this->getElectionDetail($id);
            }
            $electionDetails = ElectionDetails::where('election_id', session()->get('electionId'))->get();

            // dd($electionDetails,session()->get('electionId'));

        }
        return view('Admin.electionTable', compact('electionDetails','getSTatVal'));
    }
    public function candidateElection(Request $request, $id = "", $param = '')
    {
        $positons = Position::all();
        $getSTatVal = Electionsinformation::select(\DB::raw("DISTINCT(state_name)"))->get();
        $query = '1=1';
        if ($request->param == '1') {
            $query = '';
            // dd($request->all());
            $data = $request->all();
            // dd($data);
            $validator = Validator::make($data, [
                'Position'         => 'required',
                'provincia'            => 'required',
                'canton'             => 'required',
                'parroquia'        => 'required',

            ]);
            if ($validator->fails()) {
                // dd('stop');
                return response()->json(['errors' => $validator->errors()->all()]);
            } else {

                if ($request->has('Position')) {
                    $query .= " and position =  '$request->Position'";
                }
                if ($request->has('provincia')) {
                    $query .= " and state =  '$request->provincia'";
                }
                if ($request->has('canton')) {
                    $query .= " and city =  '$request->canton'";
                }
                if ($request->has('parroquia')) {
                    $query .= " and parroquia =  '$request->parroquia'";
                }
                $systemCandidates = DB::select('select * from system_election_candidates where 1=1 ' . $query);
                if(empty($systemCandidates))
                {
                    return response()->json([
                        'result' => 'fail',
                        'msg' => 'No Candidate Found'
                    ]);
                }
                    return response()->json([
                        'data' => $systemCandidates
                    ]);
            }
        } else {
            if (!empty($id)) {
                $this->getElectionDetail($id);
            }
        }
        $electionDetails = SystemElectionCandidate::where('election_id', session()->get('electionId'))->get();
        return view('Admin.electionCandidate', compact('electionDetails','positons','getSTatVal'));
    }
    public function PPElection(Request $request, $id = "", $param = '')
    {
        $query = '1=1';
        if ($request->param == '1') {
            $query = '';
            $data = $request->all();
            $validator = Validator::make($data, [
                'NameOfPArty'         => 'required',
                'Level'            => 'required',
            ]);
            if ($validator->fails()) {
                // dd('stop');
                return response()->json(['errors' => $validator->errors()->all()]);
            } else {

                if ($request->has('NameOfPArty')) {
                    $query .= " and party_name =  '$request->NameOfPArty'";
                }
                if ($request->has('Level')) {
                    $query .= " and party_level =  '$request->Level'";
                }
                $political_party = DB::select('select * from political_party where 1=1 and  election_id = ' . session()->get('electionId') . $query);
                if(empty($political_party))
                {
                    return response()->json([
                        'result' => 'fail',
                        'msg' => 'No Political Party Found'
                    ]);
                }
                    return response()->json([
                        'data' => $political_party
                    ]);
            }
        } else {
            if (!empty($id)) {
                $this->getElectionDetail($id);
            }
        }
        $PoliticalParty = PoliticalParty::where('election_id', session()->get('electionId'))->get();
        // dd($PoliticalParty);
        return view('Admin.electionPolitical', compact('PoliticalParty'));
    }
    public function deleteTable(Request $request)
    {
        $data = $request->all();
        $res = ElectionDetails::where('id', $data['id'])->delete();
        return response()->json(['success' => 'success', 200]);
    }
    public function getElectionDetail($id)
    {
        $electionname = ElectionDetails::where('id', $id)->first();
        $electionname = DB::table('elections')->where('id', $id)->first();
        session()->put('electionId', $id);
        session()->put('election_name', $electionname->election_name);
        session()->put('election_status', $electionname->status);
    }
}
