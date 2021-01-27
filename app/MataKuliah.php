<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $fillable = ['nama', 'kode', 'idProdi', 'status'];

    protected $table = 'mata_kuliah';

    protected $hidden = ['created_at', 'updated_at'];

    static function getMataKuliah()
    {
        return MataKuliah::join('prodi', 'mata_kuliah.idProdi', 'prodi.id')
                        ->select('mata_kuliah.*', 'prodi.nama as nama_prodi')
                        ->get();
    }

    static function firstMataKuliahNamaKode($id, $nama, $kode)
    {
        return MataKuliah::where('id', '!=', $id)
                        ->where('nama', $nama)
                        ->orWhere('id', '!=', $id)
                        ->where('kode', $kode)
                        ->first();
    }

    static function firstMataKuliah($id)
    {
        return MataKuliah::join('prodi', 'mata_kuliah.idProdi', 'prodi.id')
                        ->select('mata_kuliah.*', 'prodi.nama as nama_prodi')
                        ->findOrFail($id);
    }

    static function firstMataKuliahProdi($id)
    {
        $data['mata_kuliah'] = MataKuliah::select('mata_kuliah.id', 'mata_kuliah.nama')->where('idProdi', $id)->get();

        return $data;
    }
    
    static function storeMataKuliah($request)
    {
        MataKuliah::create([
            'kode'      => $request->kode,
            'nama'      => $request->nama,
            'idProdi'   => $request->prodi
        ]);
    }
    
    static function updateMataKuliah($request, $id)
    {
        MataKuliah::whereId($id)->update([
            'kode'      => $request->kode,
            'nama'      => $request->nama,
            'idProdi'   => $request->prodi
        ]);
    }
    
    static function deleteMataKuliah($id)
    {
        MataKuliah::whereId($id)->delete();
    }
}
