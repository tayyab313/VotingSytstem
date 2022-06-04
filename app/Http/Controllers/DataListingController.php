<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Files;
use App\Models\ElectionDetails;
use App\Models\Electionsinformation;
use App\Models\Position;
use App\Models\ElectionCandidate;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator; 
use DB;

class DataListingController extends Controller
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
    public function DataListing(Request $request)
    {
        // dd($request->all());
        $positons = Position::all();
        $getSTatVal = Electionsinformation::select(\DB::raw("DISTINCT(state_name)"))->get();
        $request->validate([
            'position' => 'required',
            'provincia' => 'required',
            'canton' => 'required',
            'circun' => 'required',
            'parroquia' => 'required',
            'zona' => 'required',
            'junta_no' => 'required',
        ]);
        // get valid votes 
        // get null votes
        // get blank votes
        // get total votes


        // \DB::enableQueryLog(); // Enable query log
        $matchThese = ['provincia' => $request->provincia, 'canton' => $request->canton,'parroquia' => $request->parroquia,'circun' => $request->circun,'zona' => $request->zona,'junta_no' => $request->junta_no ];
        $voting_data = Document::select(\DB::raw("SUM(valid_votes) as valid_votes,SUM(total_votes) as total_votes,SUM(blank_votes) as blank_votes,SUM(null_votes) as null_votes"))->where($matchThese)->get();
        // dd(\DB::getQueryLog()); // Show results of log
        // dd($voting_data);
        foreach($voting_data as $vote)
        {
           $blank_votes = $vote->blank_votes;
           $valid_votes = $vote->valid_votes;
           $total_votes = intval($vote->total_votes);
           $null_votes  = $vote->null_votes;
        }
        // get count of document
        // get ids of document than sort them on the basis of votes all the users
        $document_ids = Document::select(\DB::raw("id"))->where($matchThese)->get();
        $doc_ids_Arr = array();
        foreach($document_ids as $doc_id)
        {
            $doc_ids_Arr[] = $doc_id->id;
        }
        $doc_ids_ArrStr = implode(',', $doc_ids_Arr);
        $all_document_candidate = ElectionCandidate::whereIn('document_id', $doc_ids_Arr)->leftJoin('system_election_candidates', 'system_election_candidates.id', '=', 'electioncandidate.candidate_id')->orderByRaw(DB::raw("candidate_votes"))->get();
        // dd($all_document_candidate);
        $doc_canidates_Arr = array();
        $doc_canidates_votes_Arr = array();

        foreach($all_document_candidate as $doc)
        {
            $doc_canidates_Arr[] = $doc->candidate_name;
            $doc_canidates_votes_Arr[] = $doc->candidate_votes;
        }
        $graph_candidates_name_array = implode(',', $doc_canidates_Arr);
        $graph_candidates_votes_array = implode(',', $doc_canidates_votes_Arr);
        // $graph_candidates_name_array2 = sprintf( implode("', '", $doc_canidates_Arr));
        $graph_candidates_name_array2 = array('usama','adik','sdsada'.'asdas');
        // dd($graph_candidates_name_array2);
     // Get Invalid docs
     $docs_invalid = Document::select(\DB::raw("count(*) as invalid,(valid_votes+null_votes+blank_votes) as votes,total_votes"))->whereIn('document.id', $doc_ids_Arr)->whereRaw("1=1 having votes > total_votes")->get();
     $invalid_docs = empty($docs_invalid[0]->invalid) ? 0 : $docs_invalid[0]->invalid;
    //  dd($invalid_docs);
     // Get Valid docs
    //    \DB::enableQueryLog(); // Enable query log
     $docs_valid = Document::select(\DB::raw("count(*) as valid,(valid_votes+null_votes+blank_votes) as votes,total_votes"))->whereIn('document.id', $doc_ids_Arr)->whereRaw("1=1 having votes <= total_votes")->get();
     $valid_docs = empty($docs_valid[0]->valid) ? 0 : $docs_valid[0]->valid;
    //  dd(\DB::getQueryLog()); // Show results of log
    //  dd($valid_docs);


        // highcharts
        $color_array = ['#f0ae19','#e68a00','#690f0f','#9e1d1c','#bb2423','#e12d2c'];
        $graphData = array();
        foreach($all_document_candidate as $doc)
        {
            array_push($graphData, array('name'=>$doc->candidate_name, 'data'=> array((int)$doc->candidate_votes)));
        }
        // dd($graphData);
        $request = $request->all();

        return view('Candidate.DataListing',compact('valid_docs','invalid_docs','doc_ids_Arr','request','graphData','doc_canidates_votes_Arr','doc_canidates_Arr','graph_candidates_name_array','graph_candidates_name_array2','graph_candidates_votes_array','blank_votes','total_votes','null_votes','valid_votes','all_document_candidate','getSTatVal','positons'));
    }

    public function DataListingold(Request $request)
    {
        
        $request->validate([
            'position' => 'required',
            'provincia' => 'required',
            'canton' => 'required',
            'circun' => 'required',
            'parroquia' => 'required',
            'zona' => 'required',
            'junta_no' => 'required',
        ]);
        // get valid votes 
        // get null votes
        // get blank votes
        // get total votes

        $matchThese = ['provincia' => $request->provincia, 'canton' => $request->canton,'parroquia' => $request->parroquia,'circun' => $request->circun,'zona' => $request->zona,'junta_no' => $request->junta_no ];
        $voting_data = Document::select(\DB::raw("SUM(valid_votes) as valid_votes,SUM(total_votes) as total_votes,SUM(blank_votes) as blank_votes,SUM(null_votes) as null_votes"))->where($matchThese)->get();
        // dd($results);
        foreach($voting_data as $vote)
        {
           $blank_votes = $vote->blank_votes;
           $valid_votes = $vote->valid_votes;
           $total_votes = $vote->total_votes;
           $null_votes  = $vote->null_votes;
        }
        // get count of document
        // get ids of document than sort them on the basis of votes all the users
        $document_ids = Document::select(\DB::raw("id"))->where($matchThese)->get();
        $doc_ids_Arr = array();
        foreach($document_ids as $doc_id)
        {
            $doc_ids_Arr[] = $doc_id->id;
        }
        $all_document_candidate = ElectionCandidate::whereIn('document_id', $doc_ids_Arr)->orderBy('candidate_votes', 'desc')->get();

   
        // --------------------------------------------------------------------------
        // dd($all_document_candidate);
        $doc_canidates_Arr = array();
        $doc_canidates_votes_Arr = array();

        foreach($all_document_candidate as $doc)
        {
            $doc_canidates_Arr[] = $doc->candidate_name;
            $doc_canidates_votes_Arr[] = $doc->candidate_votes;
        }
        $graph_candidates_name_array = implode(',', $doc_canidates_Arr);
        $graph_candidates_votes_array = implode(',', $doc_canidates_votes_Arr);
        // $graph_candidates_name_array2 = sprintf( implode("', '", $doc_canidates_Arr));
        $graph_candidates_name_array2 = array('usama','adik','sdsada'.'asdas');
        // dd($graph_candidates_name_array2);
        return view('Candidate.DataListing',compact('doc_canidates_votes_Arr','doc_canidates_Arr','graph_candidates_name_array','graph_candidates_name_array2','graph_candidates_votes_array','blank_votes','total_votes','null_votes','valid_votes','all_document_candidate'));
    }

    public function uploadDocument()
    {
        return view('Staff.uploadDocument');
    }
    public function documentWithID(Request $request)
    {
        $doc_ids = $request->doc_id;
        $type = $request->Document;
        // dd($doc_ids);

        
        $doc_ids_Arr = array();
        foreach($doc_ids as $doc_id)
        {
            $doc_ids_Arr[] = $doc_id;
        }

        if($type == 'Disturbances')
        {
            $docs = Document::whereIn('id', $doc_ids_Arr)->WhereNull('report_disturbance')->latest()->get();
          
        }elseif($type == 'beginningOfElection'){

            $docs = Document::whereIn('document.id', $doc_ids_Arr)->leftJoin('elections', 'elections.id', '=', 'document.election')->whereRaw('time(document.doc_start_time) > time(elections.start_time)')->orderByRaw(DB::raw("document.created_at"))->get();

        }elseif($type == 'endingElection'){

            $docs = Document::whereIn('document.id', $doc_ids_Arr)->leftJoin('elections', 'elections.id', '=', 'document.election')->whereRaw('time(document.doc_end_time) > time(elections.end_time)')->orderByRaw(DB::raw("document.created_at"))->get();

        }elseif($type == 'TableError'){
            $docs = Document::select(\DB::raw("*,(valid_votes+null_votes+blank_votes) as votes,total_votes"))->whereIn('document.id', $doc_ids_Arr)->whereRaw("1=1 having votes > total_votes")->get();
        }else{

            $docs = Document::whereIn('id', $doc_ids_Arr)->latest()->get();
        }
        
      

        

        return view('Staff.homeStaff',compact('docs'));
    }
    
}
