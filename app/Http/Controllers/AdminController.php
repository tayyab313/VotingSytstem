<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ElectionDetails;
use App\Models\PoliticalParty;
use App\Models\User;
use App\Models\SystemElectionCandidate;
use App\Models\Election;
use App\Models\Position;
use App\Models\Electionsinformation;

use App\Exports\ElectionDetailsExport;
use App\Imports\ElectionDetailsImport;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Imports\importElectiontable;
use App\Imports\StaffUsersImport;
use App\Exports\ElectionCandidateExport;
use App\Exports\ElectionPoliticalPartyExport;
use App\Exports\exportStaffMember;
use App\Imports\ElectionCandidateImport;
use App\Imports\importElectionPPoliticalParty;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Mail;
use Validator;
use DB;


class AdminController extends Controller
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
    public function index()
    {
        return view('Admin.homeAdmin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function electionDetails(Request $request)
    {

        $search =  $request->input('q');
        if($search!=""){
            $electionDetails = ElectionDetails::where(function ($query) use ($search){
                $query->where('provincia', 'like', '%'.$search.'%')
                    ->orWhere('canton', 'like', '%'.$search.'%');
            })
            ->paginate(10);
            $electionDetails->appends(['q' => $search]);
        }
        else{
        $electionDetails = ElectionDetails::latest()->paginate(10);
        $PoliticalParty = PoliticalParty::all();
        }
        return view('Admin.electionDetails')->with(['electionDetails' => $electionDetails,  'PoliticalParty' => $PoliticalParty]);
    }

    public function export() 
    {
        return Excel::download(new ElectionDetailsExport, 'ElectionData.xlsx');
    }

    public function importElectionDetails() 
    {
        // dd("here");
        Excel::import(new ElectionDetailsImport,request()->file('file'));
             
        return back();
    }


    

    public function systemCandidates(Request $request, $param='')
    {
        $query ='1=1';
        $positons = Position::all();
        $getSTatVal = Electionsinformation::select(\DB::raw("DISTINCT(state_name)"))->get();
        // dd($request->all());
        if($param == '1')
        {
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
            }
            else{
            $query ='';
            // dd($request->all());
            if($request->has('Position'))
            {
                $query .=" and position = '$request->Position'";
            }
            if($request->has('provincia'))
            {
                $query .=" and state =  '$request->provincia'";
            }
            if($request->has('canton'))
            {
                $query .=" and city =  '$request->canton'";
            }
            if($request->has('parroquia'))
            {
                $query .=" and parroquia =  '$request->parroquia'";
                $query .=" and role =  'candidate'";
            }
           
            $systemCandidates = DB::select('select * from users where 1=1 '.$query);
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

        }
        else
        {

        $systemCandidates = DB::table('users')
                ->whereRaw($query)
                ->where('role','candidate')
                ->get();
        }
        return view('Admin.systemCandidates',compact('systemCandidates','positons','getSTatVal'));
    }


    public function saveCandidate(Request $request)
    {
        $data = $request->all();
        // $candidate_name = '';
        // $pol_name = '';
        if($request->pol_party_logo){
            $file = $request->pol_party_logo;
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $firstextension = $file->getClientOriginalExtension();
            $pol_name = $filename.'_'.time().rand(1,100).'.'.$firstextension;
            $request->pol_party_logo->move(public_path('avatars'), $pol_name);
        }
        if($request->drag_drop_file){
            $file = $request->drag_drop_file;
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $firstextension = $file->getClientOriginalExtension();
            $candidate_name = $filename.'_'.time().rand(1,100).'.'.$firstextension;
            $request->drag_drop_file->move(public_path('avatars'), $candidate_name);
        }
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'position' => 'required',
            'state' => 'required',
            'city' => 'required',
            'parroquia' => 'required',

        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
      
        // dd($candidate_name,$pol_name);

        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'password'      => '$2y$10$cvYnUuEw4IDGUvWzX4pmw.nJPpiL66smo.J.HUByLbjN1.AphCpL2',
            'position'      => $request->position,
            'state'         => $request->state,
            'city'          => $request->city,
            'parroquia'     => $request->parroquia,
            'pol_party'     => $request->pol_party,
            'role'          => 'Candidate',
            'candidate_img' => isset($candidate_name) ? $candidate_name : null,
            'img_pol_party' => isset($pol_name) ? $pol_name : null,
        ]);
        // $maildata = [
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => '123123123',
        //     'click' =>'Login by using this email and password',
        //     'data' => 'You are added In Our Voting System by this '.$request->email . ' email address',
        // ];
        // $user['to'] = $data['email'];
        // Mail::send('mail',$maildata,function($messages) use ($request)
        // {
        //     $messages->to($request->email);
        //     $messages->subject('Dear Candidate Welcome to our Voto Control system');
        // });
        return response()->json(['success'=>'Candidate is successfully added']);

    }
    public function saveUploadDocCandidate(Request $request)
    {
        $data = $request->all();
        $validator = \Validator::make($data, [
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:system_election_candidates',
            'getSelectedOptionPosition' => 'required',
            'getSelectedOptionProvincia' => 'required',
            'getSelectedOptionCanton' => 'required',
            'getSelectedOptionParroquia' => 'required',
            'getSelectedOptionZona' => 'required',
            'getSelectedOptionCircun' => 'required',
            'getSelectedOptionJunta_no' => 'required',

        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
      
        // dd($candidate_name,$pol_name);
        $getElectiondetail = Election::where('status', 'in-process')
            ->latest('updated_at')
            ->first();
            $getId = $getElectiondetail->id;
        $CreateCandidate = SystemElectionCandidate::create([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'election_id'   => $getId,
            'password'      => '$2y$10$cvYnUuEw4IDGUvWzX4pmw.nJPpiL66smo.J.HUByLbjN1.AphCpL2',
            // 'position'      => $request->position,
            'state'         => $data['getSelectedOptionProvincia'],
            'city'          => $data['getSelectedOptionCanton'],
            'parroquia'     => $data['getSelectedOptionParroquia'],
            'role'          => 'Candidate',
            ]);
            // dd($CreateCandidate);
            $getNewCreatedCandidateId  = DB::table('system_election_candidates')->max('id');
            // $getNewCreatedCandidate  = DB::table('system_election_candidates')->select('name')->max('id');
            // dd($getNewCreatedCandidate);

        // dd($all_candi);
        return response()->json([
            // 'total_voters' => $results->voters,
            'getNewCreatedCandidateId' => $getNewCreatedCandidateId,

        ]);
        // $maildata = [
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => '123123123',
        //     'click' =>'Login by using this email and password',
        //     'data' => 'You are added In Our Voting System by this '.$request->email . ' email address',
        // ];
        // $user['to'] = $data['email'];
        // Mail::send('mail',$maildata,function($messages) use ($request)
        // {
        //     $messages->to($request->email);
        //     $messages->subject('Dear Candidate Welcome to our Voto Control system');
        // });
        return response()->json(['success'=>'Candidate is successfully added']);

    }
    public function saveUploadEditDocCandidate(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $validator = \Validator::make($data, [
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:system_election_candidates',
            'getSelectedOptionPosition' => 'required',
            'getSelectedOptionProvincia' => 'required',
            'getSelectedOptionCanton' => 'required',
            'getSelectedOptionParroquia' => 'required',
            'getSelectedOptionZona' => 'required',
            'getSelectedOptionCircun' => 'required',
            'getSelectedOptionJunta_no' => 'required',

        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
      
        // dd($candidate_name,$pol_name);
        $getElectiondetail = Election::where('status', 'in-process')
            ->latest('updated_at')
            ->first();
            $getId = $getElectiondetail->id;
        $CreateCandidate = SystemElectionCandidate::create([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'election_id'   => $getId,
            'password'      => '$2y$10$cvYnUuEw4IDGUvWzX4pmw.nJPpiL66smo.J.HUByLbjN1.AphCpL2',
            // 'position'      => $request->position,
            'state'         => $data['getSelectedOptionProvincia'],
            'city'          => $data['getSelectedOptionCanton'],
            'parroquia'     => $data['getSelectedOptionParroquia'],
            'role'          => 'Candidate',
            ]);
            // dd($CreateCandidate);
            $getNewCreatedCandidateId  = DB::table('system_election_candidates')->max('id');
            // $getNewCreatedCandidate  = DB::table('system_election_candidates')->select('name')->max('id');
            // dd($getNewCreatedCandidate);

        // dd($all_candi);
        return response()->json([
            // 'total_voters' => $results->voters,
            'getNewCreatedCandidateId' => $getNewCreatedCandidateId,

        ]);
        // $maildata = [
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => '123123123',
        //     'click' =>'Login by using this email and password',
        //     'data' => 'You are added In Our Voting System by this '.$request->email . ' email address',
        // ];
        // $user['to'] = $data['email'];
        // Mail::send('mail',$maildata,function($messages) use ($request)
        // {
        //     $messages->to($request->email);
        //     $messages->subject('Dear Candidate Welcome to our Voto Control system');
        // });
        return response()->json(['success'=>'Candidate is successfully added']);

    }
    public function getCandidate(Request $request)
    {
        // dd($request->all());
        $checkCandidateImg = '';
    	$User = User::find($request->id);
    	$positons = Position::all();
        $getSTatVal = Electionsinformation::select(\DB::raw("DISTINCT(state_name)"))->get();
        // dd($User->candidate_img);
        if($User->candidate_img == null)
        {
            // dd('soip');
            $checkCandidateImg = 'false';
        }
	    return response()->json([
	      'data' => $User,
	      'positons' => $positons,
	      'getSTatVal' => $getSTatVal,
	      'checkCandidateImg' => $checkCandidateImg,

	    ]);
    }



    public function updateCandidate(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $news = User::findOrFail($data['update_id']);
        $candidate_name = $news->candidate_img;
        $edit_pol_party_name = $news->img_pol_party;
        if(!empty($news->candidate_img) && $request->hasFile('edit_drag_drop_field'))
        {
            $path = public_path()."/avatars/".$news->candidate_img;
            unlink($path);
        }
        if(!empty($news->img_pol_party) && $request->hasFile('edit_pol_party'))
        {
            $path = public_path()."/avatars/".$news->img_pol_party;
            unlink($path);
        }
        if($request->hasFile('edit_pol_party')){
            
            $file = $request->edit_pol_party;
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $firstextension = $file->getClientOriginalExtension();
            $edit_pol_party_name = $filename.'_'.time().rand(1,100).'.'.$firstextension;
            $request->edit_pol_party->move(public_path('avatars'), $edit_pol_party_name);

        }
        if($request->hasFile('edit_drag_drop_field')){
            $file = $request->edit_drag_drop_field;
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $firstextension = $file->getClientOriginalExtension();
            $candidate_name = $filename.'_'.time().rand(1,100).'.'.$firstextension;
            $request->edit_drag_drop_field->move(public_path('avatars'), $candidate_name);
        }
        
        
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'edit_position' => 'required',
            'edit_state' => 'required',
            'edit_city' => 'required',
            'edit_parroquia' => 'required',
            'pol_party' => 'required',
 
        ]);
        
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
      
        // dd($request->all());
        User::where('id',$request->update_id)->update([
            'name' => $request->name,
            // 'email' => $request->email,
            'phone' => $request->phone,
            'position' => $request->edit_position,
            'state' => $request->edit_state,
            'city' => $request->edit_city,
            'parroquia' => $request->edit_parroquia,
            'pol_party' => $request->pol_party,
            // 'pol_party' => $request->pol_party,
            'candidate_img' => !empty($candidate_name) ? $candidate_name : null,
            'img_pol_party' => !empty($edit_pol_party_name) ? $edit_pol_party_name : null,
        ]);
        return response()->json(['success'=>'Candidate is Updated added']);

    }

    public function exportCandidate() 
    {
        return Excel::download(new UsersExport, 'Candidate.xlsx');
    }
    public function exportElectionCandidates() 
    {
        return Excel::download(new ElectionCandidateExport, 'Election Candidate.xlsx');
    }
    public function exportElectionPPoliticalParty() 
    {
        return Excel::download(new ElectionPoliticalPartyExport, 'Election Political Party.xlsx');
    }
    public function exportStaffMemberfunction() 
    {
        return Excel::download(new exportStaffMember, 'Election StaffMember.xlsx');
    }

    public function importCandidate(Request $request) 
    {
        // dd("here");
        $validator = \Validator::make($request->all(), [
            'file'          => 'required|file|mimes:xls,xlsx',
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        Excel::import(new UsersImport,request()->file('file'));
             
        return back();
    }
    public function importElectiontable(Request $request) 
    {
        $validator = \Validator::make($request->all(), [
            'file'          => 'required|file|mimes:xls,xlsx',
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        Excel::import(new importElectiontable,request()->file('file'));
             
        return back();
    }
    public function importStaff(Request $request) 
    {
        // dd("here");
        $validator = \Validator::make($request->all(), [
            'file'          => 'required|file|mimes:xls,xlsx',
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        Excel::import(new StaffUsersImport,request()->file('file'));
             
        return back();
    }
    public function importElectionCandidate(Request $request) 
    {
        
        $validator = \Validator::make($request->all(), [
        'file'          => 'required|file|mimes:xls,xlsx',
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        Excel::import(new ElectionCandidateImport,request()->file('file'));
             
        return back();
    }
    public function importElectionPPoliticalParty(Request $request) 
    {
        $validator = \Validator::make($request->all(), [
            'file'          => 'required|file|mimes:xls,xlsx',
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        Excel::import(new importElectionPPoliticalParty,request()->file('file'));
             
        return back();
    }

    public function deleteCandidate(Request $request) 
    {
        
        User::where('id',$request->delete_id)->delete();
        return response()->json(['success'=>'Candidate is Deleted Successfully']);
    }
    public function bulkDeleteStaff(Request $request) 
    {
        
        User::whereIn('id',$request->id)->delete();
        return response()->json(['success'=>'Satff is Deleted Successfully']);
    }
    public function bulkDelete(Request $request) 
    {
        // dd($request->all());
        $bulk_delete_data_in_array = $request->id;
        $delete = User::whereIn('id',$bulk_delete_data_in_array)->delete();
        return response()->json(['success'=>'Users is Deleted Successfully']);
    }
    public function bulkDeleteTable(Request $request) 
    {
        // dd($request->all());
        $bulk_delete_data_in_array = $request->id;
        $delete = ElectionDetails::whereIn('id',$bulk_delete_data_in_array)->delete();
        return response()->json(['success'=>'Table is Deleted Successfully']);
    }
    public function bulkDeleteElectCan(Request $request) 
    {
        // dd($request->all());
        $bulk_delete_data_in_array = $request->id;
        $delete = SystemElectionCandidate::whereIn('id',$bulk_delete_data_in_array)->delete();
        return response()->json(['success'=>'Candidates is Deleted Successfully']);
    }
    public function bulkDeleteElectPolticalParty(Request $request) 
    {
        // dd($request->all());
        $bulk_delete_data_in_array = $request->id;
        $delete = PoliticalParty::whereIn('id',$bulk_delete_data_in_array)->delete();
        return response()->json(['success'=>'Candidates is Deleted Successfully']);
    }
    public function ListData()
    {
        return view('Admin.listingData');
    }
    public function documentDownload()
    {
        return view('Admin.documentDownload');
    }
  
}
