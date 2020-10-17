<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = ['nim', 'nama', 'jeniskelamin', 'email', 'hp', 'alamat', 'alamatasal', 'status'];

    protected $table = 'mahasiswa';
    
    static function firstMahasiswaNIM($nim)
    {
        return Mahasiswa::firstWhere('nim', $nim);
    }

    static function firstMahasiswa($id)
    {
        return Mahasiswa::findOrFail($id);
    }

    static function storeMahasiswa($request)
    {
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

    static function updateMahasiswa($request, $id)
    {
        Mahasiswa::whereId($id)->update([
            'nim'           => $request->nim,
            'nama'          => $request->nama,
            'jeniskelamin'  => $request->jeniskelamin,
            'email'         => $request->email,
            'hp'            => $request->hp,
            'status'        => $request->status,
            'alamat'        => $request->alamat,
            'alamatasal'    => $request->alamatasal
        ]);
    }

    static function getMahasiswa()
    {
        return Mahasiswa::all();
    }

    static function deleteMahasiswa($id)
    {
        Mahasiswa::whereId($id)->delete();
    }
}
