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

    static function getGrup($id)
    {
        $grup = Grup::where('idPaket', $id)->get();

        if ($grup->isNotEmpty()) {
            foreach ($grup as $key => $value) {
                $id = $value->id;

                $data[$key] = Grup::findOrFail($id);
                $data[$key]['soal'] = Grup::join('soal', 'grup.id', 'soal.idGrup')
                                        ->leftJoin('pilihan', 'soal.idPilihan', 'pilihan.id')
                                        ->select('soal.id', 'soal.pertanyaan', 'soal.modelSoal','pilihan.deskripsi')
                                        ->where('grup.idPaket', $id)
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
