<?php

namespace App\Imports;

use App\Models\SystemElectionCandidate;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;

use Mail;
use Auth;
class ElectionCandidateImport implements ToModel, WithHeadingRow, WithValidation,
SkipsOnFailure
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        // $this->mailToCandiddate($row['email'],$row['name']);
        return new SystemElectionCandidate([
            'name'          => $row['name'],
            'email'         => $row['email'], 
            'phone'         => $row['phone'], 
            'position'      => $row['position'], 
            'state'         => $row['provincia'], 
            'city'          => $row['canton'], 
            'parroquia'     => $row['parroquia'], 
            'political_party'     => $row['political_party'], 
            // 'img_pol_party' => $row['image_political_party'], 
            'password'      => '123123123',
            'election_id'   => session()->get('electionId'),
        ]);
        
        
    }
    public function mailToCandiddate($email='',$name='')
    {
        $maildata = [
            'name' => $name,
            'email' => $email,
            'password' => '123123123',
            'click' =>'Login by using this email and password',
            'data' => 'You are added In Our Voting System by this '.$email . ' email address',
        ];
        $user['to'] = $name;
        Mail::send('mail',$maildata,function($messages) use ($email)
        {
            $messages->to($email);
            $messages->subject('Dear Candidate Welcome to our Voto Control system');
        });
    }
    public function rules():array
    {
        return [
            '*.email' => ['email', 'unique:system_election_candidates,email']
        ];
    }
    public function onFailure(Failure ...$failures)
    {
        
    }
}
