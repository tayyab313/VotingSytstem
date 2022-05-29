<?php

namespace App\Exports;

use App\Models\SystemElectionCandidate;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ElectionCandidateExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return User::all();
        // User::where('role','candidate');
        return SystemElectionCandidate::where('election_id',session()->get('electionId'))->get()->makeHidden(['updated_at','created_at','id','status','election_id','password']);

    }
    public function headings(): array
    {
        // canton = city
        // provincia = state
        return ["Name", "Email", "Position","Provincia","Canton","Parroquia","Phone","Political Party"];
    }
}
