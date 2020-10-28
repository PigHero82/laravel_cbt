<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataDiri extends Model
{
    protected $table = 'data_diri';

    protected $fillable = ['idUser', 'jeniskelamin', 'email', 'hp', 'alamat'];

    static function storeDataDiri($request, $id)
    {
        DataDiri::create([
            'idUser'        => $id,
            'jeniskelamin'  => $request->jeniskelamin,
            'email'         => $request->email,
            'hp'            => $request->hp,
            'alamat'        => $request->alamat,
        ]);
    }

    static function firstDataDiri($id)
    {
        return DataDiri::where('idUser', $id)->first();
    }

    static function updateDataDiri($request, $id)
    {
        DataDiri::where('idUser', $id)->update([
            'jeniskelamin'  => $request->jeniskelamin,
            'email'         => $request->email,
            'hp'            => $request->hp,
            'alamat'        => $request->alamat
        ]);
    }
}
