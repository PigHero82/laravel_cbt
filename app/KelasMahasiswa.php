<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelasMahasiswa extends Model
{
    protected $fillable = ['idKelas', 'nim'];

    protected $table = 'kelas_mahasiswa';
}
