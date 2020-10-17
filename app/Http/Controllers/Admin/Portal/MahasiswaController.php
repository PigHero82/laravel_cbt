<?php

namespace App\Http\Controllers\Admin\Portal;

use App\Http\Controllers\Controller;
use App\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Mahasiswa::getMahasiswa();
        return view('admin.mahasiswa.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Mahasiswa::firstMahasiswaNIM($request->nim);
        if (isset($data->nim)) {
            return redirect()->back()->with('danger', 'Data dengan NIM '. $data->nim .' telah terdaftar atas nama '. $data->nama);
        }
        else {
            Mahasiswa::storeMahasiswa($request);
            return redirect()->back()->with('success', 'Input Data '. $request->nama .' Berhasil');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        $data = Mahasiswa::firstMahasiswa($mahasiswa->id);
        return view('admin.mahasiswa.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $data = Mahasiswa::firstMahasiswaNIM($request->nim);
        if (isset($data->nim) && $mahasiswa->nim != $data->nim) {
            return redirect()->back()->with('danger', 'Data dengan NIM '. $data->nim .' Telah Terdaftar atas nama '. $data->nama);
        }
        Mahasiswa::updateMahasiswa($request, $mahasiswa->id);
        return redirect()->back()->with('success', 'Data Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        Mahasiswa::deleteMahasiswa($mahasiswa->id);
        return redirect()->back();
    }
}
