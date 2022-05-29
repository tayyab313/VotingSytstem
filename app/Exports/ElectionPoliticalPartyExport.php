<?php

namespace App\Exports;

use App\Models\PoliticalParty;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ElectionPoliticalPartyExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return User::all();
        // User::where('role','candidate');
        return PoliticalParty::where('election_id',session()->get('electionId'))->get()->makeHidden(["party_logo", 'updated_at','created_at','id','election_id']);

    }
    public function headings(): array
    {
        return ["Name of Political Party", "Level"];
    }
}
