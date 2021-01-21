<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi';

    protected $fillable = ['nama'];

    protected $hidden = ['created_at', 'updated_at'];

    static function getProdi()
    {
        return Prodi::all();
    }

    static function firstProdi($id)
    {
        return Prodi::findOrFail($id);
    }

    static function firstProdiNama($nama, $id)
    {
        return Prodi::where('nama', $nama)
                    ->where('id', '!=', $id)
                    ->first();
    }
    
    static function storeProdi($request)
    {
        Prodi::create([
            'nama'      => $request->nama,
        ]);
    }
    
    static function updateProdi($request, $id)
    {
        Prodi::whereId($id)->update([
            'nama'      => $request->nama,
        ]);
    }
    
    static function deleteProdi($id)
    {
        Prodi::whereId($id)->delete();
    }
}
