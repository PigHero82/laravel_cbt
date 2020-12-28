<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

class Soal extends Model
{
    protected $table = 'soal';

    protected $fillable = ['idGrup', 'modelSoal', 'media', 'pertanyaan', 'idPilihan'];

    static function storeSoal($request)
    {
        return Soal::create([
            'idGrup'     => $request->idGrup,
            'modelSoal'  => $request->modelSoal,
            'pertanyaan' => $request->pertanyaan
        ]);
    }

    static function importSoal($idGrup, $modelSoal, $pertanyaan)
    {
        return Soal::create([
            'idGrup'     => $idGrup,
            'modelSoal'  => $modelSoal,
            'pertanyaan' => $pertanyaan
        ]);
    }

    static function updateSoal($request, $id)
    {
        Soal::whereId($id)->update([
            'pertanyaan' => $request->pertanyaan
        ]);
    }

    static function updateSoalJawaban($id, $idPilihan)
    {
        return Soal::whereId($id)->update([
            'idPilihan'     => $idPilihan
        ]);
    }

    static function updateSoalGambar($id, $gambar)
    {
        return Soal::whereId($id)->update([
            'media'     => $gambar
        ]);
    }

    static function getSoal($id)
    {
        return Soal::join('grup', 'soal.idGrup', 'grup.id')
                    ->join('paket', 'grup.idPaket', 'paket.id')
                    ->leftJoin('pilihan', 'soal.idPilihan', 'pilihan.id')
                    ->where('idGrup', $id)
                    ->get();
    }

    static function deleteSoal($id)
    {
        Soal::whereId($id)->delete();
    }

    static function singleSoal($id)
    {
        $soal = Soal::leftJoin('pilihan', 'soal.idPilihan', 'pilihan.id')
                    ->select('soal.id')
                    ->where('soal.id', $id)
                    ->get();

        if ($soal->isNotEmpty()) {
            foreach ($soal as $key => $value) {
                $id = $value->id;

                $data[$key] = Soal::join('grup', 'soal.idGrup', 'grup.id')
                                    ->join('paket', 'grup.idPaket', 'paket.id')
                                    ->join('kelas', 'paket.idKelas', 'kelas.id')
                                    ->select('soal.*', 'paket.nama', 'kelas.kode', 'paket.id as idPaket')
                                    ->where('soal.id', $id)
                                    ->first();
                $data[$key]['pilihan'] = Soal::join('pilihan', 'soal.id', 'pilihan.idSoal')
                                        ->select('pilihan.deskripsi', 'pilihan.id')
                                        ->where('pilihan.idSoal', $id)
                                        ->get();
            }
            return $data;
        }
    }

    static function singleSoalJawab($id)
    {
        $soal = Soal::leftJoin('pilihan', 'soal.idPilihan', 'pilihan.id')
                    ->join('jawaban', 'soal.id', 'jawaban.idSoal')
                    ->select('jawaban.id as abc', 'soal.id', 'soal.modelSoal')
                    ->where('jawaban.id', $id)
                    ->get();

        if ($soal->isNotEmpty()) {
            foreach ($soal as $key => $value) {
                $id = $value->abc;
                $data[$key] = Soal::select('soal.id', 'soal.pertanyaan', 'soal.media', 'soal.modelSoal', 'jawaban.idPilihan', 'jawaban.jawaban_esai', 'jawaban.id as abc')
                                    ->join('jawaban', 'soal.id', 'jawaban.idSoal')
                                    ->where('jawaban.id', $id)
                                    ->where('jawaban.idUser', Auth::id())
                                    ->first();
                if ($value->modelSoal !=4) {
                    $data[$key]['pilihan'] = Soal::join('pilihan', 'soal.id', 'pilihan.idSoal')
                                            ->join('jawaban', 'soal.id', 'jawaban.idSoal')
                                            ->select('jawaban.id', 'pilihan.deskripsi', 'pilihan.id')
                                            ->where('jawaban.id', $id)
                                            ->orderByRaw('RAND()')
                                            ->get();
                }
            }
            return $data;
        }
    }

    static function cekJawaban($idSoal, $idPilihan)
    {
        $data = Soal::join('grup', 'soal.idGrup', 'grup.id')
                    ->join('paket', 'grup.idPaket', 'paket.id')
                    ->select('soal.id', 'soal.idPilihan', 'paket.bobot_benar', 'paket.bobot_salah')
                    ->where('soal.id', $idSoal)
                    ->first();

        if ($data->idPilihan == $idPilihan) {
            $hasil['data'] = 1;
            $hasil['skor'] = $data->bobot_benar;
        } else {
            $hasil['data'] = 0;
            $hasil['skor'] = $data->bobot_salah;
        }

        return $hasil;        
    }

    static function getSoalOnly($id)
    {
        return Soal::join('grup', 'soal.idGrup', 'grup.id')
                    ->select('soal.id')
                    ->where('grup.idPaket', $id)
                    ->get();
    }
}
