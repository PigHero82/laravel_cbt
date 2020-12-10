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

    static function getKelasMahasiswaLaporan($id, $idKelas)
    {
        $students = KelasMahasiswa::select('users.id as id')
                                    ->join('users', 'kelas_mahasiswa.idMahasiswa', 'users.id')
                                    ->join('kelas', 'kelas_mahasiswa.idKelas', 'kelas.id')
                                    ->join('paket', 'kelas.id', 'paket.idKelas')
                                    ->where('kelas_mahasiswa.idKelas', $idKelas)
                                    ->where('paket.id', $id)
                                    ->get();

        if ($students->isNotEmpty()) {
            foreach ($students as $key => $value) {
                $data[$key] = KelasMahasiswa::join('users', 'kelas_mahasiswa.idMahasiswa', 'users.id')
                                            ->select('idKelas', 'users.id as id', 'users.username as nim', 'users.name as nama', 'users.gambar', 'kelas_mahasiswa.id as iddata')
                                            ->where('users.id', $value->id)
                                            ->first();
                $data[$key]['nilai'] = Jawaban::getNilai($id, $value->id);
            }

            return $data;
        }

        return $students;
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
