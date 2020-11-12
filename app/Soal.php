<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $table = 'soal';

    protected $fillable = ['idPaket', 'modelSoal', 'media', 'pertanyaan', 'jawaban', 'skor', 'status'];

    static function storeSoal($request)
    {
        Soal::create([
            'idPaket'    => $request->idPaket,
            'modelSoal'  => $request->modelSoal,
            'media'      => $request->media,
            'pertanyaan' => $request->pertanyaan
        ]);
    }

    static function getSoal($id)
    {
        return Soal::where('idPaket', $id)->get();
    }

    static function cekMediaSoal($id)
    {
        return Soal::where('media', 'like', 'http'.'%')->count();
    }

    static function singleSoal($id)
    {
        return Soal::where('soal.id', $id)
                    ->join('paket', 'soal.idPaket', 'paket.id')
                    ->join('kelas', 'paket.idKelas', 'kelas.id')
                    ->select('soal.id', 'paket.nama', 'kelas.kode', 'soal.media', 'soal.modelSoal', 'soal.pertanyaan')
                    ->first();
    }
}
