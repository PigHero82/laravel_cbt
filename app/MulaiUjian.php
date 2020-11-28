<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

class MulaiUjian extends Model
{
    protected $table = 'mulai_ujian';

    protected $fillable = ['idPaket', 'idUser', 'waktu'];

    static function singleMulaiUjian($id)
    {
        return MulaiUjian::where('idPaket', $id)
                        ->where('idUser', Auth::id())
                        ->first();
    }

    static function storeMulaiUjian($id, $waktu){
        return MulaiUjian::create([
            'idPaket'   => $id,
            'idUser'    => Auth::id(),
            'waktu'     => $waktu
        ]);
    }
}
