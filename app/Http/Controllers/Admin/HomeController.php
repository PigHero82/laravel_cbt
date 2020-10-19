<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Mahasiswa;
use App\Dosen;
use App\Kelas;
use App\MataKuliah;

class HomeController extends Controller
{
    public function index()
    {
        $mahasiswa = count(Mahasiswa::getMahasiswa());
        $dosen = count(Dosen::getDosen());
        $kelas = count(Kelas::getKelas());
        $mataKuliah = count(MataKuliah::getMataKuliah());

        return view('index', compact('mahasiswa', 'dosen', 'kelas', 'mataKuliah'));
    }
}
