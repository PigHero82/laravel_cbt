<?php

namespace App\Imports;

use App\ImportSoal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\ImportUser;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new ImportUser([
            'no_induk'      => $row['no_induk'],
            'nama'          => $row['nama'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'email'         => $row['email'],
            'hp'            => $row['hp'],
            'alamat'        => $row['alamat'],
        ]);
    }
}
