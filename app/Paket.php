<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

class Paket extends Model
{
    protected $table = 'paket';

    protected $fillable = ['idKelas', 'nama', 'tanggal_awal', 'tanggal_akhir', 'waktu_awal', 'waktu_akhir', 'durasi', 'deskripsi', 'bobot_benar', 'bobot_salah', 'status'];

    static function storePaket($request)
    {
        return Paket::create([
            'idKelas'       => $request->idKelas,
            'nama'          => $request->nama,
            'durasi'        => $request->durasi,
            'tanggal_awal'  => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'waktu_awal'    => $request->waktu_awal,
            'waktu_akhir'   => $request->waktu_akhir,
            'bobot_benar'   => $request->bobot_benar,
            'bobot_salah'   => $request->bobot_salah,
            'deskripsi'     => $request->deskripsi
        ]);
    }

    static function updatePaket($id, $request)
    {
        Paket::whereId($id)->update([
            'idKelas'       => $request->idKelas,
            'nama'          => $request->nama,
            'durasi'        => $request->durasi,
            'tanggal_awal'  => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'waktu_awal'    => $request->waktu_awal,
            'waktu_akhir'   => $request->waktu_akhir,
            'bobot_benar'   => $request->bobot_benar,
            'bobot_salah'   => $request->bobot_salah,
            'deskripsi'     => $request->deskripsi
        ]);
    }

    static function updatePaketStatus($id, $status)
    {
        Paket::whereId($id)->update([
            'status'     => $status
        ]);
    }

    static function getPaket()
    {
        return Paket::join('kelas', 'paket.idKelas', 'kelas.id')
                    ->leftJoin('grup', 'paket.id', 'grup.idPaket')
                    ->leftJoin('soal', 'grup.id', 'soal.idGrup')
                    ->select('paket.id', 'paket.nama', 'durasi', 'paket.tanggal_awal', 'paket.tanggal_akhir', 'waktu_awal', 'waktu_akhir', 'paket.status')
                    ->selectRaw('COUNT(soal.id) as jumlah')
                    ->groupBy('paket.id')
                    ->where('kelas.idDosen', Auth::id())
                    ->get();
    }

    static function getDataUjianPaket($id)
    {
        return Paket::join('kelas', 'paket.idKelas', 'kelas.id')
                    ->join('kelas_mahasiswa', 'kelas.id', 'kelas_mahasiswa.idKelas')
                    ->join('users', 'kelas.idDosen', 'users.id')
                    ->select('paket.id', 'paket.nama', 'paket.deskripsi', 'kelas.kode', 'users.name', 'paket.tanggal_awal', 'paket.tanggal_akhir', 'paket.waktu_awal', 'paket.waktu_akhir', 'paket.durasi')
                    ->where('idMahasiswa', $id)
                    ->where('paket.status', 1)
                    ->get();
    }

    static function singlePaket($id)
    {
        return Paket::join('kelas', 'paket.idKelas', 'kelas.id')
                    ->select('paket.*', 'kelas.kode')
                    ->where('paket.id', $id)
                    ->first();
    }

    static function cekPaketbyDosen($id)
    {
        return Paket::join('kelas', 'paket.idKelas', 'kelas.id')
                    ->select('paket.id', 'kelas.idDosen')
                    ->where('paket.id', $id)
                    ->where('kelas.idDosen', Auth::id())
                    ->first();
    }

    static function deletePaket($id)
    {
        Paket::whereId($id)->delete();
    }
}
