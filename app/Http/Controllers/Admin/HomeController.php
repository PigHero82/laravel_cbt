<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Kelas;
use App\MataKuliah;
use App\Pengaturan;
use App\ListRole;

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
        $user = ListRole::countByRole();
        $kelas = count(Kelas::getKelas());
        $mataKuliah = count(MataKuliah::getMataKuliah());

        return view('index', compact('user', 'kelas', 'mataKuliah'));
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
