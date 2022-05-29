<?php

namespace App\Imports;

use App\Models\ElectionDetails;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Mail;
use Auth;
class importElectiontable implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $circunData =  $row['circunscripcion'];
        return new ElectionDetails([
            'provincia'          => $row['provincia'],
            'canton'             => $row['canton'],
            'parroquia'          => $row['parroquia'],
            'circun'             => $circunData,
            'zona'               => $row['zona'],
            'junta_no'           => $row['junta_no'],
            'voters'             => $row['voters'],
            'added_by'           => Auth::user()->id,
            'status'             => 'active',
            'election_id'        => session()->get('electionId'),
        ]);
        
        
    }

}
