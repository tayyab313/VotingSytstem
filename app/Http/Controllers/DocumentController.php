<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Files;
use App\Models\ElectionDetails;
use App\Models\Election;

use App\Models\ElectionCandidate;
use App\Models\SystemElectionCandidate;
use Auth;
use DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class DocumentController extends Controller
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


    public function uploadDocumentsave(Request $request)
    {

        //  dd($request->all());
        //  $candi = 'candidate_2';
        //  dd($request->$candi[1]);

        $request->validate([
            'doc_name' => 'required',
            'position' => 'required',
            'provincia' => 'required',
            'canton' => 'required',
            'circun' => 'required',
            'parroquia' => 'required',
            'zona' => 'required',
            'junta_no' => 'required',
            'valid_votes' => 'required|numeric',
            'blank_votes' => 'required|numeric',
            'null_votes' => 'required|numeric',
            'doc_start_time' => 'required',
            'doc_end_time' => 'required',
            'comments' => 'required',
            'file' => 'required|mimes:pdf,xlx,csv|max:2048'
        ]);
        // mimes:csv,txt,xlx,xls,pdf
        // $request->validate([
        //     'files' => 'required',
        //     'files.*' => 'required|mimes:pdf,xlx,csv|max:2048',
        // ]);

        // $files = [];
        // if($request->hasfile('filenames'))
        //  {
        //     foreach($request->file('filenames') as $file)
        //     {
        //         $name = time().rand(1,100).'.'.$file->extension();
        //         $file->move(public_path('doc_images'), $name);  
        //         $files[] = $name;  
        //     }
        //  }

        // dd($files);
        // if ($validator->fails())
        // {
        //     return response()->json(['errors'=>$validator->errors()->all()]);
        // }


        $name = time() . rand(1, 100) . '.' . $request->file->extension();
        $request->file->move(public_path('doc_images'), $name);

        // get latest election ID
        $electionID = Election::select('id')->latest()->first();
        $doc = Document::create([
            'doc_name' => $request->doc_name,
            'position' => $request->position,
            'provincia' => $request->provincia,
            'canton' => $request->canton,
            'circun' => $request->circun,
            'parroquia' => $request->parroquia,
            'zona' => $request->zona,
            'junta_no' => $request->junta_no,
            'valid_votes' => $request->valid_votes,
            'blank_votes' => $request->blank_votes,
            'null_votes' => $request->null_votes,
            'doc_start_time' => $request->doc_start_time,
            'doc_end_time' => $request->doc_end_time,
            'report_disturbance' => $request->report_disturbance,
            'comments' => $request->comments,
            'added_by' => Auth::user()->id,
            'status' => 'active',
            'election' => empty($electionID->id)? date('Y'): $electionID->id,
            'total_votes' => $request->total_votes,
            'file' => $name
        ]);



        $doc_id = $doc->id;
        if ($request->has('total_candidates')) {
            $total_candidates = $request->total_candidates;
            for ($i = 1; $i <= $total_candidates; $i++) {
                $candi = 'candidate_' . $i;
                ElectionCandidate::create([
                    'candidate_votes' => empty($request->$candi[0]) ? 0 : $request->$candi[0],
                    'candidate_id' => $request->$candi[1],
                    'candidate_name' => $request->$candi[2],
                    'document_id' => $doc_id,
                    'status' => 'active'
                ]);
            }
        }
        // dd($doc_id);
        return redirect()->route('home')->with('message', 'Document is successfully Uploaded');
        // return view('Staff.uploadDocument');
    }


    public function uploadDocumentsave2notusing(Request $request)
    {

        dd($request->all());
        //  $candi = 'candidate_2';
        //  dd($request->$candi[1]);


        $request->validate([
            'doc_name' => 'required',
            'position' => 'required',
            'provincia' => 'required',
            'canton' => 'required',
            'circun' => 'required',
            'parroquia' => 'required',
            'zona' => 'required',
            'junta_no' => 'required',
            'valid_votes' => 'required|numeric',
            'blank_votes' => 'required|numeric',
            'null_votes' => 'required|numeric',
            'doc_start_time' => 'required',
            'doc_end_time' => 'required',
            'comments' => 'required',
            'filenames' => 'required',
            'filenames.*' => 'image'
        ]);
        // mimes:csv,txt,xlx,xls,pdf
        // $request->validate([
        //     'files' => 'required',
        //     'files.*' => 'required|mimes:pdf,xlx,csv|max:2048',
        // ]);

        $files = [];
        if ($request->hasfile('filenames')) {
            foreach ($request->file('filenames') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('doc_images'), $name);
                $files[] = $name;
            }
        }

        // dd($files);
        // if ($validator->fails())
        // {
        //     return response()->json(['errors'=>$validator->errors()->all()]);
        // }

        // dd($request->all());
        

        // dd($request->all());
        $doc = Document::create([
            'doc_name' => $request->doc_name,
            'position' => $request->position,
            'provincia' => $request->provincia,
            'canton' => $request->canton,
            'circun' => $request->circun,
            'parroquia' => $request->parroquia,
            'zona' => $request->zona,
            'junta_no' => $request->junta_no,
            'valid_votes' => $request->valid_votes,
            'blank_votes' => $request->blank_votes,
            'null_votes' => $request->null_votes,
            'doc_start_time' => $request->doc_start_time,
            'doc_end_time' => $request->doc_end_time,
            'report_disturbance' => $request->report_disturbance,
            'comments' => $request->comments,
            'added_by' => Auth::user()->id,
            'status' => 'active',
            'election' => '2022',
            'total_votes' => $request->total_votes,


        ]);

        $doc_id = $doc->id;
        foreach ($files as $file) {
            Files::create([
                'document_id' => $doc_id,
                'file_name' => $file,
            ]);
        }


        if ($request->has('total_candidates')) {
            $total_candidates = $request->total_candidates;
            for ($i = 1; $i <= $total_candidates; $i++) {
                $candi = 'candidate_' . $i;
                ElectionCandidate::create([
                    'candidate_votes' => $request->$candi[0],
                    'candidate_id' => $request->$candi[1],
                    'candidate_name' => $request->$candi[2],
                    'document_id' => $doc_id,
                    'status' => 'active'
                ]);
            }
        }
        // dd($doc_id);
        return redirect()->route('home')->with('message', 'Document is successfully Uploaded');
        // return view('Staff.uploadDocument');
    }



    public function editDocument($id)
    {
        $id_org = \Crypt::decrypt($id);
        $doc = Document::find($id_org);
        // dd($id_org);
        $files = Files::where('document_id', $id_org)->first();
        // dd($files);
        $getCandidateNameAndVOte = DB::table('electioncandidate')->where('document_id', $id_org)->get();
        // dd($doc,$files,$getCandidateNameAndVOte);
        $total_candidates = count($getCandidateNameAndVOte);
        return view('staff.editUploadDocument', compact('doc', 'files', 'getCandidateNameAndVOte','total_candidates'));
        // dd($doc);
    }


    public function getElectionCandidate(Request $request)
    {
        // dd($request->all());

        $electionID = Election::select('id')->latest()->first();
        

        // \DB::enableQueryLog(); // Enable query log
        $matchThese = ['provincia' => $request->provincia, 'canton' => $request->canton, 'parroquia' => $request->parroquia, 'circun' => $request->circun, 'zona' => $request->zona, 
                        'junta_no' => $request->junta_no,'election_id' => $electionID->id];
        $results = ElectionDetails::where($matchThese)->get()->first();
        // dd(\DB::getQueryLog()); // Show results of log
        // \DB::enableQueryLog(); // Enable query log
        $matchCandidate = ['state' =>$request->provincia, 'position' => $request->position, 'parroquia' =>  $request->parroquia, 'city' => $request->canton,'election_id'=>$electionID->id];
        $resultCandi = SystemElectionCandidate::where($matchCandidate)->get();
        // dd(\DB::getQueryLog()); // Show results of log
        // dd($resultCandi);


        $all_candi = '';
        $i = 0;
        if(!empty($resultCandi))
        {
        foreach ($resultCandi as $res) {
            $i++;
            $all_candi .= '<tr>
            <td scope="row" class="row_first">' . $i . '</td><td>' . $res->name . '</td>
            <td>
            <input placeholder="Enter Votes" type="text" class="form-control" name="candidate_' . $i . '[]"  id="candidate_' . $i . '"/>
            <input type="hidden" name="candidate_' . $i . '[]"  value="' . $res->id . '"/>
            <input type="hidden" name="candidate_' . $i . '[]"  value="' . $res->name . '"/>

            </td>
            </tr>';
        }
    }

        // dd($all_candi);
        return response()->json([
            'total_voters' => empty($results->voters) ? 0 : $results->voters,
            'candidates_name' => $all_candi,
            'total_candidates' => $i,
            'message'=> 'No record Exist for this Position Details'
        ]);
       
    }
    public function updateDocument(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $request->validate([
            'doc_name' => 'required',
            'position' => 'required',
            'provincia' => 'required',
            'canton' => 'required',
            'circun' => 'required',
            'parroquia' => 'required',
            'zona' => 'required',
            'junta_no' => 'required',
            'valid_votes' => 'required|numeric',
            'blank_votes' => 'required|numeric',
            'null_votes' => 'required|numeric',
            'doc_start_time' => 'required',
            'doc_end_time' => 'required',
            'comments' => 'required',
            // 'file' => 'required|mimes:pdf,xlx,csv|max:2048'
        ]);

        $old_doc = Document::find($request->id);
        $name = $old_doc->file;
        if($request->has('file'))
        {
            if(!empty($name))
            {
                $path = public_path()."/doc_images/".$name;
                if (file_exists($path)) { 
                    // dd($getOldFileName);
                    unlink($path);
                }
            }
           

            $name = time() . rand(1, 100) . '.' . $request->file->extension();
            $request->file->move(public_path('doc_images'), $name);
        }
      



        // $getFileName = DB::table('document')->where('document_id', $data['id'])->first();
        // $getOldFileName = isset($getFileName->file_name) ? $getFileName->file_name : null;
        // if ($request->hasfile('file')) {
        //     $path = public_path()."/doc_images/".$getOldFileName;
        //     if (file_exists($path)) { 
        //         // dd($getOldFileName);
        //         unlink($path);
        //     }
        //     // dd($data,'sss',$getOldFileName);
        //     $file = $data['file'];
        //     $filenameWithExt = $file->getClientOriginalName();
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //     $firstextension = $file->getClientOriginalExtension();
        //     $getOldFileName = $filename . '_' . time() . rand(1, 100) . '.' . $firstextension;
        //     $request->file->move(public_path('doc_images'), $getOldFileName);
        //      DB::table('documentfiles')->where('document_id', $data['id'])->update(['file_name' =>$getOldFileName]);
        // }
        // dd($data);
        $update_doc = Document::where('id', $data['id'])->update(
            [
                'doc_name' => $request->doc_name,
                'position' => $request->position,
                'provincia' => $request->provincia,
                'canton' => $request->canton,
                'circun' => $request->circun,
                'parroquia' => $request->parroquia,
                'zona' => $request->zona,
                'junta_no' => $request->junta_no,
                'valid_votes' => $request->valid_votes,
                'blank_votes' => $request->blank_votes,
                'null_votes' => $request->null_votes,
                'doc_start_time' => $request->doc_start_time,
                'doc_end_time' => $request->doc_end_time,
                'report_disturbance' => $request->report_disturbance,
                'comments' => $request->comments,
                'added_by' => Auth::user()->id,
                'status' => 'active',
                'total_votes' => $data['blank_votes'] + $data['valid_votes'] + $data['null_votes'],
                'file' => $name
            ]
        );
        // dd($update_doc);
        // $update_doc = $data['id'];
            // for ($i = 1; $i <= count($data['candidate_data']); $i++) {
                $deleted = DB::table('electioncandidate')->where('document_id', $data['id'])->delete();
                // dd($data);
                foreach($data['candidate_data'] as $CanData)
                {
                    ElectionCandidate::create([
                            'candidate_votes' => empty($CanData[0]) ? 0 : $CanData[0],
                            'candidate_id' => $CanData[1],
                            'candidate_name' => $CanData[2],
                            'document_id' => $data['id'],
                            'status' => 'active'
                        ]);
                }
        return redirect()->route('home')->with('message', 'Document is updated successfully');
        // return view('Staff.uploadDocument');
    // }
    // dd('sop');

}



    public function viewDocument($id)
    {
        $id_org = \Crypt::decrypt($id);
        $doc = Document::find($id_org);
        $files = Files::where('document_id', $id_org)->get();
        $candidates = ElectionCandidate::where('document_id', $id_org)->get();
        // dd($doc,$files,$candidate);

        return view('staff.viewDocument', compact('doc', 'files', 'candidates'));
    }
    public function DocumentDelete(Request $request)
    {
        $data = $request->all();
        Document::where('id',$data['id'])->delete();
        DB::table('documentfiles')->where('document_id', $data['id'])->delete();
        DB::table('electioncandidate')->where('document_id', $data['id'])->delete();
        return response()->json(['success'=>'Document is Deleted Successfully']);
    }
}
