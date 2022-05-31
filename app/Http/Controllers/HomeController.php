<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Position;
use App\Models\Election;
use App\Models\Document;
use App\Models\User;
use App\Models\Electionsinformation;
use DB;
class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        session()->put('LoginUserId', Auth::user()->id);
        if(Auth::user()->role == 'Candidate')
        {
            $getSTatVal = Electionsinformation::select(\DB::raw("DISTINCT(state_name)"))->get();
            $positons = Position::all();
            $user = User::where('id',Auth::user()->id)->first();
            $getUserPosition = $user->position;
            // dd($position);
            // $getSTatVal = DB::table('')
            return view('Candidate.homeCandidate',compact('getSTatVal','positons','getUserPosition'));

        }else if(Auth::user()->role == 'Staff')
        {
            $docs = Document::where('added_by',Auth::user()->id)->latest()->get();
            // foreach($docs as $docVAl){
            //     dd($docVAl['valid_votes']);
            // }
            // dd($docs);
            return view('Staff.homeStaff',compact('docs'));

        }else{
            dd("dsfds");
                $position = Position::all();
                $Election = Election::latest('created_at')->get();
                return view('Admin..homeAdmin',compact('position','Election'));

        }

    }
    public function crateElection()
    {
        $position = Position::all();
        return view('Admin.createElectionform',compact('position'));
    }
}
