<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Customer([
            'name'     => $row[0],
            'email'    => $row[1],
            'password' => Hash::make($row[2]),
            'domain_id'    => auth()->user()->domain_id,
            'created_by'    => auth()->user()->id
        ]);
    }
}
