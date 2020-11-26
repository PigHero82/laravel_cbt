<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pilihan extends Model
{
    protected $table = 'pilihan';

    protected $fillable = ['idSoal', 'deskripsi'];

    static function getPilihan($id)
    {
        return Pilihan::whereId($id)->get();
    }

    static function deletePilihan($id)
    {
        Pilihan::where('idSoal', $id)->delete();
    }

    static function storePilihan($idSoal, $pilihan)
    {
        return Pilihan::create([
            'idSoal'    => $idSoal,
            'deskripsi' => $pilihan
        ]);
    }
}
