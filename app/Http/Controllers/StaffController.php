<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Electionsinformation;
use App\Models\Position;
use Validator;
use Mail;
use DB;

class StaffController extends Controller
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
        return view('Staff.StaffDocument');
    }

    public function uploadDocument()
    {
        $getSTatVal = Electionsinformation::select(\DB::raw("DISTINCT(state_name)"))->get();
        $positons = Position::all();
        return view('Staff.uploadDocument',compact('getSTatVal','positons'));
    }
    public function StaffMember(Request $request,$param='')
    {
        $query ='1=1';
        $positons = Position::all();
        $getSTatVal = Electionsinformation::select(\DB::raw("DISTINCT(state_name)"))->get();
        // dd($request->all());
        if($param == '1')
        {
            $data = $request->all();
            $validator = Validator::make($data, [
                'Position'         => 'required',
                'Canton'            => 'required',
                'provincia'             => 'required',
                'parroquia'        => 'required',
    
            ]);
            if ($validator->fails()) {
                // dd('stop');
                return response()->json(['errors' => $validator->errors()->all()]);
            }
            else{
                
            // dd($param);
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
            if($request->has('Canton'))
            {
                $query .=" and city =  '$request->Canton'";
            }
            if($request->has('parroquia'))
            {
                $query .=" and parroquia =  '$request->parroquia'";
            }
            // dd($query);
            $staffmember = DB::select('select * from users where 1=1 '.$query);
            if(empty($staffmember))
            {
                return response()->json([
                    'result' => 'fail',
                    'msg' => 'No Staff Member Found'
                  ]);
            }
                return response()->json([
                    'data' => $staffmember
                  ]);
            }

        }
        else
        {
            $User = User::where('role', '=', 'Staff')->get();
        }
        return view('admin.StaffMember',compact('User','getSTatVal','positons'));
    }
    public function addStaffMember(Request $request)
    {
        $data = $request->all();
        // dd($data);
        if($request->staff_logo){
            $file = $request->staff_logo;
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $firstextension = $file->getClientOriginalExtension();
            $staff_name = $filename.'_'.time().rand(1,100).'.'.$firstextension;
            $request->staff_logo->move(public_path('avatars'), $staff_name);
        }
        if($data['position']=='null')
        {
            $data['position'] = null;
        }
        if($data['state']=='null')
        {
            $data['state'] = null;
        }
        if($data['City']=='null')
        {
            $data['City'] = null;
        }
        if($data['Parroquias']=='null')
        {
            $data['Parroquias'] = null;
        }

        $validator = Validator::make($data, [
            'name'         => 'required',
            'phone'        => 'required',
            'email'        => 'required',
            'position'     => 'required',
            'state'        => 'required',
            'City'         => 'required',
            'Parroquias'   => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        else{
            $election = User::create([
                'name'          => $data['name'],
                'email'         => $data['email'],
                'phone'         => $data['phone'],
                'position'      => $data['position'],
                'state'         => $data['state'],
                'city'          => $data['City'],
                'parroquia'     => $data['Parroquias'],
                'role'          => 'Staff',
                'password'      => '$2y$10$cvYnUuEw4IDGUvWzX4pmw.nJPpiL66smo.J.HUByLbjN1.AphCpL2',
                'candidate_img' => isset($staff_name) ? $staff_name : null,
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
            //     $messages->subject('Dear Staff Welcome to our Voto Control system');
            // });
            // $election->save();
            return response()->json(['success' => 'success', 200]);
        }
    }
    public function deleteStaff(Request $request)
    {
        User::where('id',$request->get_id)->delete();
        return response()->json(['success'=>'Staff Member is Deleted Successfully']);
    }
    public function editStaffMember(Request $request)
    {
        $data = $request->all();
        $checkCandidateImg = '';
        $User = User::where('id', '=', $data['id'])->first();
        $positons = Position::all();
        $getSTatVal = Electionsinformation::select(\DB::raw("DISTINCT(state_name)"))->get();
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
    public function UpdateStaffMemberProfile(Request $request)
    {
        $data = $request->all();
        $news = User::findOrFail($data['StaffId']);
        $candidate_name = $news->candidate_img;
        $edit_pol_party_name = $news->candidate_img;
        if(!empty($news->candidate_img) && $request->hasFile('edit_pol_party'))
        {
            $path = public_path()."/avatars/".$news->candidate_img;
            unlink($path);
        }

        if($request->hasFile('edit_pol_party')){
            // dd($request->hasFile('edit_pol_party'));
            
            $file = $request->edit_pol_party;
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $firstextension = $file->getClientOriginalExtension();
            $edit_pol_party_name = $filename.'_'.time().rand(1,100).'.'.$firstextension;
            $request->edit_pol_party->move(public_path('avatars'), $edit_pol_party_name);

        }
        // dd($data,$candidate_name,$news->candidate_img);

        if($data['updated_name']=='null')
        {
            $data['updated_name'] = null;
        }
        if($data['updated_phone']=='null')
        {
            $data['updated_phone'] = null;
        }
        if($data['updated_Position']=='null')
        {
            $data['updated_Position'] = null;
        }
        if($data['updated_State']=='null')
        {
            $data['updated_State'] = null;
        }
        if($data['updated_City']=='null')
        {
            $data['updated_City'] = null;
        }
        if($data['updated_Parroquias']=='null')
        {
            $data['updated_Parroquias'] = null;
        }
        $validator = \Validator::make($data, [
            'updated_name' => 'required',
            'updated_phone' => 'required',
            'updated_Position' => 'required',
            'updated_State' => 'required',
            'updated_City' => 'required',
            'updated_Parroquias' => 'required',
 
        ]);
        
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        // dd($data);
        User::where('id', $data['StaffId'])->update([
            'name'      => $data['updated_name'],
            // 'email'     => $data['updated_email'],
            'position'  => $data['updated_Position'],
            'state'     => $data['updated_State'],
            'city'      => $data['updated_City'],
            'parroquia' => $data['updated_Parroquias'],
            'phone'     => $data['updated_phone'],
            'candidate_img' => $edit_pol_party_name,

        ]);
        return response()->json(['success' => 'success', 'status' => 200]);
    }
}
