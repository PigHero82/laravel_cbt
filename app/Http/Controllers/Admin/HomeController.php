<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Kelas;
use App\MataKuliah;
use App\Pengaturan;

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
        $mahasiswa = count(User::getMahasiswa());
        $dosen = count(User::getDosen());
        $kelas = count(Kelas::getKelas());
        $mataKuliah = count(MataKuliah::getMataKuliah());

        return view('index', compact('mahasiswa', 'dosen', 'kelas', 'mataKuliah'));
    }

    public function pengaturan()
    {
        $data = Pengaturan::singlePengaturan();

        return view('admin.pengaturan', compact('data'));
    }

    public function store_pengaturan(Request $request)
    {
        if ($request->file('logo') !== NULL) {
            $image = $request->file('logo');
            $gambar = rand() . '.' . $image->getClientOriginalExtension();
            $image->move('assets/images/profile/', $gambar);

            Pengaturan::updateGambar($gambar);
        }

        if ($request->nama !== NULL) {
            Pengaturan::updateNama($request->nama);
        }

        if ($request->deskripsi !== NULL) {
            Pengaturan::updateDeskripsi($request->deskripsi);
        }

        return back();
    }
}
