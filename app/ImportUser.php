<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportUser extends Model
{
    protected $fillable = ['no_induk', 'nama', 'jenis_kelamin', 'email', 'hp', 'alamat'];

    static function getImportUser()
    {
        return ImportUser::all();
    }
}
