<?php

namespace App\Imports;

use App\Models\PoliticalParty;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Mail;
use Auth;
class importElectionPPoliticalParty implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new PoliticalParty([
            'party_name'    => $row['name_of_political_party'], 
            'party_level'    => $row['level'], 
            'election_id'        => session()->get('electionId'),
            
        ]);
        
        
    }
}
