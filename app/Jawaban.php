<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Jawaban extends Model
{
    protected $table = 'jawaban';

    protected $fillable = ['idUser', 'idSoal', 'idPilihan'. 'jawaban_esai', 'skor'];

    static function storeJawaban($idSoal)
    {
        Jawaban::create([
            'idUser' => Auth::id(),
            'idSoal' => $idSoal
        ]);
    }

    static function getDataSoal($idPaket)
    {
        return $jawaban = Jawaban::join('soal', 'jawaban.idSoal', 'soal.id')
                ->join('grup', 'soal.idGrup', 'grup.id')
                ->select('jawaban.id')
                ->where('idUser', Auth::id())
                ->where('grup.id', $idPaket)
                ->orderBy('jawaban.id', 'asc')
                ->get();
    }
}
