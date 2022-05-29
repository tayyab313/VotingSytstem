<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class exportStaffMember implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return User::all();
        // User::where('role','candidate');
        return User::where('role','Staff')->get()->makeHidden(['candidate_img','updated_at','created_at','role','id','status','email_verified_at','password']);

    }
    public function headings(): array
    {
        return ["Name", "Email", "Position","Provincia","Canton","Parroquia","Phone"];
    }
}
