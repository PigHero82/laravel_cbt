<?php

namespace App\Imports;

use App\ImportSoal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SoalImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ImportSoal([
            'jenis'     => $row['jenis'],
            'deskripsi' => $row['deskripsi'], 
            'modelSoal' => $row['modelsoal'], 
            'hasil'     => $row['hasil'], 
        ]);
    }
}
