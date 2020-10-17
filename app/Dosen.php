<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $fillable = ['nidn', 'nama', 'jeniskelamin', 'email', 'ktp', 'hp', 'telepon', 'alamat', 'alamatasal', 'status'];

    protected $table = 'dosen';

    static function getDosen()
    {
        return Dosen::all();
    }

    static function getDosenNama()
    {
        return Dosen::select('id', 'nama')->get();
    }

    static function storeDosen($request)
    {
        Dosen::create([
            'nidn'          => $request->nidn,
            'nama'          => $request->nama,
            'jeniskelamin'  => $request->jeniskelamin,
            'email'         => $request->email,
            'ktp'           => $request->ktp,
            'hp'            => $request->hp,
            'telepon'       => $request->telepon,
            'alamat'        => $request->alamat,
            'alamatasal'    => $request->alamatasal
        ]);
    }

    static function updateDosen($request, $id)
    {
        Dosen::whereId($id)->update([
            'nidn'          => $request->nidn,
            'nama'          => $request->nama,
            'jeniskelamin'  => $request->jeniskelamin,
            'email'         => $request->email,
            'ktp'           => $request->ktp,
            'hp'            => $request->hp,
            'telepon'       => $request->telepon,
            'alamat'        => $request->alamat,
            'alamatasal'    => $request->alamatasal,
            'status'        => $request->status
        ]);
    }

    static function firstDosenNIDN($nidn)
    {
        return Dosen::firstWhere('nidn', $nidn);
    }

    static function firstDosen($id)
    {
        return Dosen::findOrFail($id);
    }
    
    static function deleteDosen($id)
    {
        Dosen::whereId($id)->delete();
    }
}
