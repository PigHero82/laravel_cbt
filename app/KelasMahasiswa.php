<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelasMahasiswa extends Model
{
    protected $fillable = ['idKelas', 'idMahasiswa'];

    protected $table = 'kelas_mahasiswa';

    static function getKelasMahasiswa($idKelas)
    {
        return KelasMahasiswa::join('mahasiswa', 'kelas_mahasiswa.idMahasiswa', 'mahasiswa.id')
                            ->select('idKelas', 'mahasiswa.id', 'mahasiswa.nim', 'mahasiswa.nama')
                            ->where('idKelas', $idKelas)
                            ->get();
    }

    static function firstKelasMahasiswaidKelasidMahasiswa($idKelas, $idMahasiswa)
    {
        return KelasMahasiswa::where('idKelas', $idKelas)
                            ->where('idMahasiswa', $idMahasiswa)
                            ->first();
    }

    static function getKelasMahasiswaKosong($idKelas)
    {
        return ([['nama' => 'Kosong']]);
    }

    static function storeKelasMahasiswa($request)
    {
        KelasMahasiswa::create([
            'idKelas'       => $request->idKelas,
            'idMahasiswa'   => $request->idMahasiswa
        ]);
    }

    static function deleteKelasMahasiswa($id)
    {
        KelasMahasiswa::whereId($id)->delete();
    }
}
