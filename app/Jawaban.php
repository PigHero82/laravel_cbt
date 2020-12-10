<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Jawaban extends Model
{
    protected $table = 'jawaban';

    protected $fillable = ['idUser', 'idSoal', 'idPilihan'. 'jawaban_esai', 'benar', 'skor'];

    static function storeJawaban($idSoal)
    {
        Jawaban::create([
            'idUser' => Auth::id(),
            'idSoal' => $idSoal
        ]);
    }

    static function updateJawaban($idSoal, $idPilihan, $hasil)
    {
        Jawaban::where('idUser', Auth::id())->where('idSoal', $idSoal)->update([
            'idPilihan' => $idPilihan,
            'benar'     => $hasil['data'],
            'skor'      => $hasil['skor']
        ]);
    }

    static function updateJawabanEsai($jawaban, $id)
    {
        Jawaban::whereId($id)->update([
            'jawaban_esai' => $jawaban
        ]);
    }

    static function getDataSoal($idPaket)
    {
        return Jawaban::join('soal', 'jawaban.idSoal', 'soal.id')
                        ->join('grup', 'soal.idGrup', 'grup.id')
                        ->select('jawaban.id', 'jawaban.idSoal', 'jawaban.idPilihan', 'jawaban.jawaban_esai')
                        ->where('idUser', Auth::id())
                        ->where('grup.id', $idPaket)
                        ->orderBy('jawaban.id', 'asc')
                        ->get();
    }

    static function getNilai($id, $idUser)
    {
        return Jawaban::selectRaw('SUM(jawaban.skor) as jumlah_skor')
                        ->join('soal', 'jawaban.idSoal', 'soal.id')
                        ->join('grup', 'soal.idGrup', 'grup.id')
                        ->join('paket', 'grup.idPaket', 'paket.id')
                        ->where('paket.id', $id)
                        ->where('jawaban.idUser', $idUser)
                        ->pluck('jumlah_skor')
                        ->first();
    }
}
