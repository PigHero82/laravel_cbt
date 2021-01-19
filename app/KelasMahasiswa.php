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
                $idValue = $value->id;

                $data[$key] = KelasMahasiswa::select('kelas_mahasiswa.idKelas', 'users.id as id', 'users.username as nim', 'users.name as nama', 'users.gambar', 'kelas_mahasiswa.id as iddata')
                                            ->join('users', 'kelas_mahasiswa.idMahasiswa', 'users.id')
                                            ->where('kelas_mahasiswa.idMahasiswa', $idValue)
                                            ->first();

                $status = KelasMahasiswa::join('jawaban', 'kelas_mahasiswa.idMahasiswa', 'jawaban.idUser')
                                        ->join('soal', 'jawaban.idSoal', 'soal.id')
                                        ->join('grup', 'soal.idGrup', 'grup.id')
                                        ->select('jawaban.id')
                                        ->groupBy('jawaban.idUser')
                                        ->where('idUser', $data[$key]->id)
                                        ->where('grup.idPaket', $id)
                                        ->get();

                if ($status->isNotEmpty()) {
                    $data[$key]['status'] = count(KelasMahasiswa::join('jawaban', 'kelas_mahasiswa.idMahasiswa', 'jawaban.idUser')
                                                                ->join('soal', 'jawaban.idSoal', 'soal.id')
                                                                ->join('grup', 'soal.idGrup', 'grup.id')
                                                                ->select('jawaban.id')
                                                                ->groupBy('jawaban.id')
                                                                ->where('idUser', $data[$key]->id)
                                                                ->where('benar', null)
                                                                ->where('grup.idPaket', $id)
                                                                ->get());
                } else {
                    $data[$key]['status'] = NULL;
                }
                
                $data[$key]['nilai'] = Jawaban::getNilai($id, $idValue);
                if ($data[$key]['nilai'] == NULL) {
                    $data[$key]['nilai'] = 0;
                }
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
