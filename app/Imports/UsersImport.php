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
        if ($row['jenis_kelamin'] == "Laki-laki") {
            $jenis_kelamin = 1;
        } else {
            $jenis_kelamin = 0;
        }

        if ($row['admin'] == "Ya") {
            $admin = 1;
        } else {
            $admin = 0;
        }
        
        if ($row['pengampu'] == "Ya") {
            $pengampu = 1;
        } else {
            $pengampu = 0;
        }
        
        if ($row['peserta'] == "Ya") {
            $peserta = 1;
        } else {
            $peserta = 0;
        }

        return new ImportUser([
            'no_induk'      => $row['no_induk'],
            'nama'          => $row['nama'],
            'jenis_kelamin' => $jenis_kelamin,
            'email'         => $row['email'],
            'hp'            => $row['hp'],
            'alamat'        => $row['alamat'],
            'admin'         => $admin,
            'pengampu'      => $pengampu,
            'peserta'       => $peserta,
        ]);
    }
}
