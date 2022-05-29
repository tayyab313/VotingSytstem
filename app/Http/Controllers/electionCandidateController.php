<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemElectionCandidate;

class electionCandidateController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function electionCandidateDelete(Request $request)
    {
        $data = $request->all();
        // dd($data);
        SystemElectionCandidate::where('id',$data['id'])->delete();
        return response()->json(['success'=>'Election Candidate is Deleted Successfully']);
    }

}
