<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable =['nim', 'nama', 'jeniskelamin', 'email', 'hp', 'alamat', 'alamatasal', 'status'];

    static function cekMahasiswaNIM($nim){
        return Mahasiswa::firstWhere('nim', $nim);
    }
    static function storeMahasiswa($request){
        Mahasiswa::create([
            'nim'           => $request->nim,
            'nama'          => $request->nama,
            'jeniskelamin'  => $request->jeniskelamin,
            'email'         => $request->email,
            'hp'            => $request->hp,
            'alamat'        => $request->alamat,
            'alamatasal'    => $request->alamatasal
        ]);
    }
}
