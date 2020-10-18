<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = ['kode', 'idMataKuliah', 'idDosen'];

    static function getKelas()
    {
        return Kelas::join('dosen', 'kelas.idDosen', 'dosen.id')
                    ->leftjoin('kelas_mahasiswa', 'kelas.id', 'kelas_mahasiswa.idKelas')
                    ->join('mata_kuliah', 'kelas.idMataKuliah', 'mata_kuliah.id')
                    ->select('kelas.id', 'kode', 'mata_kuliah.nama', 'dosen.nama as dosen')
                    ->selectRaw('count(kelas_mahasiswa.id) as jumlah')
                    ->groupBy('kode')
                    ->groupBy('mata_kuliah.nama')
                    ->get();
    }

    static function firstKelasKodeMataKuliah($kode, $idMataKuliah, $id)
    {
        return Kelas::where('kode', $kode)
                    ->where('idMataKuliah', $idMataKuliah)
                    ->where('id', '!=', $id)
                    ->first();
    }

    static function storeKelas($request)
    {
        Kelas::create([
            'kode'          => $request->kode,
            'idMataKuliah'  => $request->idMataKuliah,
            'idDosen'       => $request->idDosen
        ]);
    }

    static function updateKelas($request)
    {
        Kelas::whereId($request->id)->update([
            'kode'          => $request->kode,
            'idMataKuliah'  => $request->idMataKuliah,
            'idDosen'       => $request->idDosen
        ]);
    }

    static function firstKelas($id)
    {
        return Kelas::join('mata_kuliah', 'kelas.idMataKuliah', 'mata_kuliah.id')
                    ->join('dosen', 'kelas.idDosen', 'dosen.id')
                    ->select('kelas.id', 'idDosen', 'idMataKuliah', 'kode', 'mata_kuliah.nama', 'dosen.nama as dosen')
                    ->findOrFail($id);
    }

    static function deleteKelas($id)
    {
        Kelas::whereId($id)->delete();
    }
}
