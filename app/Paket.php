<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

class Paket extends Model
{
    protected $table = 'paket';

    protected $fillable = ['idKelas', 'nama', 'durasi', 'tanggal', 'waktuAwal', 'waktuAkhir', 'deskripsi', 'status'];

    static function storePaket($request)
    {
        Paket::create([
            'idKelas'   => $request->idKelas,
            'nama'      => $request->nama,
            'durasi'    => $request->durasi,
            'tanggal'   => $request->tanggal,
            'waktuAwal' => $request->waktuAwal,
            'waktuAkhir'=> $request->waktuAkhir,
            'deskripsi' => $request->deskripsi
        ]);
    }

    static function updatePaket($request)
    {
        Paket::whereId($request->id)->update([
            'idKelas'   => $request->idKelas,
            'nama'      => $request->nama,
            'durasi'    => $request->durasi,
            'tanggal'   => $request->tanggal,
            'waktuAwal' => $request->waktuAwal,
            'waktuAkhir'=> $request->waktuAkhir,
            'deskripsi' => $request->deskripsi
        ]);
    }

    static function getPaket()
    {
        return Paket::join('kelas', 'paket.idKelas', 'kelas.id')
                    ->leftJoin('soal', 'paket.id', 'soal.idPaket')
                    ->select('paket.id', 'paket.nama', 'durasi', 'paket.tanggal', 'waktuAwal', 'waktuAkhir', 'paket.status')
                    ->selectRaw('COUNT(soal.id) as jumlah')
                    ->where('kelas.idDosen', Auth::id())
                    ->get();
    }

    static function singlePaket($id)
    {
        return Paket::join('kelas', 'paket.idKelas', 'kelas.id')
                    ->select('idKelas', 'kelas.kode', 'paket.id', 'paket.nama', 'durasi', 'paket.tanggal', 'waktuAwal', 'waktuAkhir', 'paket.status', 'deskripsi')
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
