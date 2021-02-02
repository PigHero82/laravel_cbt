<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnggotaGrupPeserta extends Model
{
    protected $table = 'anggota_grup_peserta';

    protected $fillable = ['idPeserta', 'idGrupPeserta'];

    public $timestamps = false;

    static function getAnggotaGrupPeserta($id)
    {
        $data['peserta'] = AnggotaGrupPeserta::join('users', 'anggota_grup_peserta.idPeserta', 'users.id')
                                            ->select('anggota_grup_peserta.id', 'users.username', 'users.name')
                                            ->where('idGrupPeserta', $id)
                                            ->get();

        return $data;
    }

    static function firstAnggotaGrupPeserta($idPeserta, $id)
    {
        return AnggotaGrupPeserta::where('idPeserta', $idPeserta)
                                ->where('idGrupPeserta', $id)
                                ->first();
    }
    
    static function storeAnggotaGrupPeserta($value, $id)
    {
        AnggotaGrupPeserta::create([
            'idPeserta'     => $value,
            'idGrupPeserta' => $id
        ]);
    }
    
    static function deleteAnggotaGrupPeserta($id)
    {
        AnggotaGrupPeserta::whereId($id)->delete();
    }
}
