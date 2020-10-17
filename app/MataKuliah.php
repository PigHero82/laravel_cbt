<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $fillable = ['nama', 'status'];

    protected $table = 'mata_kuliah';

    static function getMataKuliah()
    {
        return MataKuliah::all();
    }

    static function firstMataKuliahNama($nama)
    {
        return MataKuliah::firstWhere('nama', $nama);
    }

    static function firstMataKuliah($id)
    {
        return MataKuliah::findOrFail($id);
    }
    
    static function storeMataKuliah($request)
    {
        MataKuliah::create([
            'nama' => $request->nama
        ]);
    }
    
    static function updateMataKuliah($request, $id)
    {
        MataKuliah::whereId($id)->update([
            'nama' => $request->nama
        ]);
    }
    
    static function deleteMataKuliah($id)
    {
        MataKuliah::whereId($id)->delete();
    }
}
