<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupPeserta extends Model
{
    protected $table = 'grup_peserta';

    protected $fillable = ['nama'];

    static function getGrupPeserta()
    {
        return GrupPeserta::all();
    }

    static function storeGrupPeserta($request)
    {
        GrupPeserta::create([
            'nama' => $request->nama
        ]);
    }

    static function updateGrupPeserta($request, $id)
    {
        GrupPeserta::whereId($id)->update([
            'nama' => $request->nama
        ]);
    }

    static function deleteGrupPeserta($id)
    {
        GrupPeserta::whereId($id)->delete();
    }
}
