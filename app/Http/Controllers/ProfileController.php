<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use DB;
use Auth;

class ProfileController extends Controller
{
    //

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    
    public function ProfileSetting(Request $request)
    {
        session()->put('LoginUserImage', Auth::user()->candidate_img);
        // dd();
        return view('admin.ProfileSetting');

    }
    public function UpdateUserProfile(Request $request)
    {
        $data = $request->all();
        //  dd($request->all());
         $news = User::findOrFail($data['id']);
         $user_pic_name = $news->candidate_img;
         if(!empty($news->candidate_img) && $request->hasFile('user_pic'))
         {
             $path = public_path()."/avatars/".$news->candidate_img;
             unlink($path);
         }
         if($request->hasFile('user_pic')){
            
            $file = $request->user_pic;
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $firstextension = $file->getClientOriginalExtension();
            $user_pic_name = $filename.'_'.time().rand(1,100).'.'.$firstextension;
            $request->user_pic->move(public_path('avatars'), $user_pic_name);

        }
         $validator = \Validator::make($data, [
            'name'         => 'required',
            'old_password' => 'required',
            'new_password' => 'required',
            'c_password'   => 'required',
        ]);
        if($data['new_password'] != $data['c_password'])
        {
            return response()->json(['errors'=>'Password not Match.']);
        }
        if ($validator->fails())
        {
            return response()->json(['errors'=>'All Fields Required']);
        }
        else{
            $user_password = DB::table('users')->select('password')->where('id','=',$data['id'])->first();
            if (Hash::check($data['old_password'], $user_password->password)) {
                // The passwords match...
                User::where('id',$data['id'])->update([
                    'name' => $data['name'],
                    'password' => Hash::make($data['new_password']),
                    'candidate_img' => !empty($user_pic_name) ? $user_pic_name : null,
                ]);
                return response()->json(['success'=>'User Updated Successfully']);
            }
            else{
                return response()->json(['errors'=>'Old Password not Match']);
            }
        }
    }

}
