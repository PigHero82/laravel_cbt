<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturan';

    protected $fillable = ['gambar', 'nama', 'deskripsi'];

    static function singlePengaturan()
    {
        return Pengaturan::whereId(1)->first();
    }

    static function updateGambar($gambar)
    {
        Pengaturan::whereId(1)->update([
            'gambar' => $gambar
        ]);
    }

    static function updateNama($nama)
    {
        Pengaturan::whereId(1)->update([
            'nama' => $nama
        ]);
    }

    static function updateDeskripsi($deskripsi)
    {
        Pengaturan::whereId(1)->update([
            'deskripsi' => $deskripsi
        ]);
    }
}
