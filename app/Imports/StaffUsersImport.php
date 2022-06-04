<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;

class StaffUsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // // dd($row);
        // // foreach($row as $rows) {
        //     // dd($row['email']);
        //     $data = User::find($row['email']);
        //     // dd($data);
        //     if ($data == null) {
        //        return new User([
        //         'name'     => $row['name'],
        //         'email'    => $row['email'], 
        //         'phone'    => $row['phone'], 
        //         'position'    => $row['provincia'], 
        //         'state'    => $row['state'], 
        //         'city'    => $row['city'], 
        //         'parroquia'    => $row['parroquia'], 
        //         'password' => '$2y$10$r3vu1A8SGIe0c6zunRqv4.kNcosNJVfIzSVnbq0FNT51ocCFZDMhy',
        //         'role' => 'Staff',
        //               ]);
        //     } 
        // // }
        $StaffData = User::where('email',$row['email'])->first();
        if($StaffData == null || empty($StaffData))
        {
            return new User([
                'name'     => $row['name'],
                'email'    => $row['email'], 
                'phone'    => $row['phone'], 
                'position'    => $row['position'], 
                'state'    => $row['provincia'], 
                'city'    => $row['canton'], 
                'parroquia'    => $row['parroquia'], 
                'password' => '$2y$10$r3vu1A8SGIe0c6zunRqv4.kNcosNJVfIzSVnbq0FNT51ocCFZDMhy',
                'role' => 'Staff',

            ]);
        }
        
    }
}
