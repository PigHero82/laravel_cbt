<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportUser extends Model
{
    protected $fillable = ['no_induk', 'nama', 'jenis_kelamin', 'email', 'hp', 'alamat', 'admin', 'pengampu', 'peserta'];

    static function getImportUser()
    {
        return ImportUser::all();
    }
}
