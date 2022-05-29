<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Auth;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;

class UsersImport implements 
    ToModel,
    WithHeadingRow, 
    WithValidation,
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
        return new User([
            'name'     => $row['name'],
            'email'    => $row['email'], 
            'phone'    => $row['phone'], 
            'position'    => $row['position'], 
            'state'    => $row['provincia'], 
            'city'    => $row['canton'], 
            'parroquia'    => $row['parroquia'], 
            'pol_party'    => $row['political_party'], 
            // 'img_pol_party'    => $row['image_political_party'], 
            'password' => '123123123',
            'role' => 'Candidate',

        ]);
    }
     public function rules():array
    {
        return [
            '*.email' => ['email', 'unique:users,email']
        ];
    }
    public function onFailure(Failure ...$failures)
    {
        
    }
}
