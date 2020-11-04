<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Kelas;
use App\Paket;

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
        $kelas = Kelas::getKelasCount();
        $mahasiswa = Kelas::getKelasMahasiswaCount();
        $paket = Paket::getPaket();
        return view('dosen.index', compact('kelas', 'mahasiswa', 'paket'));
    }

    public function mahasiswa()
    {
        $data = Kelas::getKelasByDosen();
        return view('dosen.mahasiswa', compact('data'));
    }
}
