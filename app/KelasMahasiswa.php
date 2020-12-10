<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelasMahasiswa extends Model
{
    protected $fillable = ['idKelas', 'idMahasiswa'];

    protected $table = 'kelas_mahasiswa';

    static function getKelasMahasiswa($idKelas)
    {
        return KelasMahasiswa::join('users', 'kelas_mahasiswa.idMahasiswa', 'users.id')
                            ->select('idKelas', 'users.id as id', 'users.username as nim', 'users.name as nama', 'users.gambar', 'kelas_mahasiswa.id as iddata')
                            ->where('idKelas', $idKelas)
                            ->get();
    }

    static function getKelasMahasiswaLaporan($idKelas)
    {
        $mahasiswa = KelasMahasiswa::join('users', 'kelas_mahasiswa.idMahasiswa', 'users.id')
                            ->select('idKelas', 'users.id as id', 'users.username as nim', 'users.name as nama', 'users.gambar', 'kelas_mahasiswa.id as iddata')
                            ->where('idKelas', $idKelas)
                            ->get();

        foreach ($mahasiswa as $key => $value) {
            $idKelas = $value->idKelas;
            $id = $value->id;

            $data = KelasMahasiswa::join('users', 'kelas_mahasiswa.idMahasiswa', 'users.id')
                            ->select('idKelas', 'users.id as id', 'users.username as nim', 'users.name as nama', 'users.gambar', 'kelas_mahasiswa.id as iddata')
                            ->where('idKelas', $idKelas)
                            ->where('idMahasiswa', $id)
                            ->get();
            $data['ujian'] = KelasMahasiswa::join('mulai_ujian', 'kelas_mahasiswa.idMahasiswa', 'mulai_ujian.id');
        }

        return $data;
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
