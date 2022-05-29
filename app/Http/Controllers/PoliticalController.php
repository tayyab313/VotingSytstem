<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PoliticalParty;

class PoliticalController extends Controller
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
    
    public function savePoliticalParty(Request $request)
    {
        $data = $request->all();
        if($request->hasFile('pol_party_logo')){
            
            $file = $request->pol_party_logo;
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $firstextension = $file->getClientOriginalExtension();
            $pol_party_logo_name = $filename.'_'.time().rand(1,100).'.'.$firstextension;
            $request->pol_party_logo->move(public_path('avatars'), $pol_party_logo_name);

        }
        $validator = \Validator::make($request->all(), [
            'Political_Party' => 'required',
            'party_level' => 'required',

        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
      
        // dd($request->all());
        PoliticalParty::create([
            'party_name'  => $request->Political_Party,
            'party_level' => $request->party_level,
            'party_logo'  => isset($pol_party_logo_name) ? $pol_party_logo_name : null,
            'election_id'  => session()->get('electionId'),
        ]);
        return response()->json(['success'=>'Political Party is successfully added']);

    }
    public function deletePoliticalPparty(Request $request) 
    {
        PoliticalParty::where('id',$request->get_id)->delete();
        return response()->json(['success'=>'Candidate is Deleted Successfully']);
    }
}
