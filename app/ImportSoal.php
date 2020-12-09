<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportSoal extends Model
{
    protected $table = 'soal_import';

    protected $fillable = ['jenis', 'deskripsi', 'modelSoal', 'hasil'];

    static function getImportSoal()
    {
        return ImportSoal::all();
    }
}
