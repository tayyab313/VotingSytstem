<?php

namespace App\Imports;

use App\Models\PoliticalParty;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Mail;
use Auth;

use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
class importElectionPPoliticalParty implements ToModel, 
WithHeadingRow
// WithValidation,
// SkipsOnFailure
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        $useData  = PoliticalParty::where(['party_name'=>$row['name_of_political_party'],'election_id'=>session()->get('electionId')])->first();
        // dd($useData);
        if($useData ==null || empty($useData))
        {
        return new PoliticalParty([
            'party_name'    => $row['name_of_political_party'], 
            'party_level'    => $row['level'], 
            'election_id'        => session()->get('electionId'),
            
        ]);
        }
        
    }
    // public function rules():array
    // {
    //     return [
    //         '*.party_name' => ['party_name', 'unique:political_party,party_name']
    //     ];
    // }
    // public function onFailure(Failure ...$failures)
    // {
       
    // }
}