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

    static function getPaket()
    {
        return Paket::join('kelas', 'paket.idKelas', 'kelas.id')
                    ->select('paket.id', 'paket.nama', 'durasi', 'paket.tanggal', 'waktuAwal', 'waktuAkhir', 'paket.status')
                    ->where('kelas.idDosen', Auth::id())
                    ->get();
    }
}
