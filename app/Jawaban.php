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

    static function updateRekapanJawaban($id, $benar, $skor)
    {
        Jawaban::whereId($id)->update([
            'benar'     => $benar,
            'skor'      => $skor
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

    static function getJawaban($id)
    {
        $jawaban = Jawaban::join('soal', 'jawaban.idSoal', 'soal.id')
                        ->join('grup', 'soal.idGrup', 'grup.id')
                        ->select('jawaban.idUser')
                        ->groupBy('jawaban.idUser')
                        ->where('grup.idPaket', $id)
                        ->get();

        if ($jawaban->isNotEmpty()) {
            foreach ($jawaban as $key => $value) {
                $id = $value->idUser;

                $data[$key] = Jawaban::join('soal', 'jawaban.idSoal', 'soal.id')
                                    ->join('grup', 'soal.idGrup', 'grup.id')
                                    ->join('users', 'jawaban.idUser', 'users.id')
                                    ->select('jawaban.idUser as id', 'users.name', 'users.username')
                                    ->groupBy('jawaban.idUser')
                                    ->where('jawaban.idUser', $id)
                                    ->first();
                
                $data[$key]['jawaban'] = Jawaban::join('soal', 'jawaban.idSoal', 'soal.id')
                                                ->select('skor')
                                                ->orderBy('soal.idGrup')
                                                ->orderBy('idSoal')
                                                ->get();
            }
            return $data;
        }
    }

    static function getJawabanOrderByPaket($id, $user)
    {
        return Jawaban::join('soal', 'jawaban.idSoal', 'soal.id')
                        ->join('grup', 'soal.idGrup', 'grup.id')
                        ->leftJoin('pilihan', 'jawaban.idPilihan', 'pilihan.id')
                        ->select('jawaban.id', 'soal.pertanyaan', 'jawaban.idSoal', 'soal.modelSoal', 'jawaban.idPilihan', 'jawaban_esai', 'pilihan.deskripsi')
                        ->selectRaw('(CASE benar WHEN 1 THEN "Benar" WHEN 0 THEN "Salah" END) as benar')
                        ->where('grup.idPaket', $id)
                        ->where('jawaban.idUser', $user)
                        ->orderBy('grup.id')
                        ->orderBy('idSoal')
                        ->get();
    }
}
