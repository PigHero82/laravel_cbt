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
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $mahasiswa = count(Mahasiswa::getMahasiswa());
        $dosen = count(Dosen::getDosen());
        $kelas = count(Kelas::getKelas());
        $mataKuliah = count(MataKuliah::getMataKuliah());

        return view('index', compact('mahasiswa', 'dosen', 'kelas', 'mataKuliah'));
    }
}
