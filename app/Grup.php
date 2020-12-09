<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grup extends Model
{
    protected $table = 'grup';

    protected $fillable = ['idPaket', 'nama'];

    static function storeGrup($id)
    {
        Grup::create([
            'idPaket'   => $id
        ]);
    }

    static function updateGrup($request)
    {
        Grup::whereId($request->id)->update([
            'nama'   => $request->nama
        ]);
    }

    static function storeGrupNama($request)
    {
        Grup::create([
            'idPaket'   => $request->idPaket,
            'nama'      => $request->nama
        ]);
    }

    static function importGrupNama($idPaket, $nama)
    {
        return Grup::create([
            'idPaket'   => $idPaket,
            'nama'      => $nama
        ]);
    }

    static function getGrupId($id)
    {
        return Grup::select('id', 'nama')
                    ->where('idPaket', $id)
                    ->get();
    }

    static function firstGrupId($id)
    {
        return Grup::select('id', 'nama')
                    ->where('id', $id)
                    ->first();
    }

    static function getGrup($id)
    {
        $grup = Grup::where('idPaket', $id)->get();

        if ($grup->isNotEmpty()) {
            foreach ($grup as $key => $value) {
                $id = $value->id;
                $idPaket = $value->idPaket;

                $data[$key] = Grup::findOrFail($id);
                $data[$key]['soal'] = Grup::join('soal', 'grup.id', 'soal.idGrup')
                                        ->leftJoin('pilihan', 'soal.idPilihan', 'pilihan.id')
                                        ->select('soal.id', 'soal.pertanyaan', 'soal.modelSoal','pilihan.deskripsi')
                                        ->where('grup.idPaket', $idPaket)
                                        ->where('grup.id', $id)
                                        ->get();
            }
            return $data;
        }
    }

    static function getSoalPeserta($id)
    {
        $grup = Grup::where('idPaket', $id)->get();

        if ($grup->isNotEmpty()) {
            foreach ($grup as $key => $value) {
                $id = $value->id;
                $idPaket = $value->idPaket;

                $data[$key] = Grup::join('soal', 'grup.id', 'soal.idGrup')
                                ->select('soal.id')
                                ->where('grup.idPaket', $idPaket)
                                ->where('grup.id', $id)
                                ->orderByRaw("RAND()")
                                ->get();
            }
            return $data;
        }
    }

    static function singlePaket($id)
    {
        return Paket::join('kelas', 'paket.idKelas', 'kelas.id')
                    ->select('paket.*', 'kelas.kode')
                    ->where('paket.id', $id)
                    ->first();
    }

    static function singleGrup($id)
    {
        return Grup::whereId($id)->first();
    }

    static function deleteGrup($id)
    {
        Grup::whereId($id)->delete();
    }
}
