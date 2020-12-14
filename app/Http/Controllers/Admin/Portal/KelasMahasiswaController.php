<?php

namespace App\Http\Controllers\Admin\Portal;

use App\Http\Controllers\Controller;
use App\KelasMahasiswa;
use App\Kelas;
use App\User;
use Illuminate\Http\Request;

class KelasMahasiswaController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = KelasMahasiswa::firstKelasMahasiswaidKelasidMahasiswa($request->idKelas, $request->idMahasiswa);
        if (isset($data->id)) {
            return back()->with('danger', 'Data Peserta telah terdaftar');
        }
        else {
            KelasMahasiswa::storeKelasMahasiswa($request);
            return back()->with('success', 'Data Peserta berhasil ditambah');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KelasMahasiswa  $kelasMahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show($kelasMahasiswa)
    {
        $info = Kelas::firstKelas($kelasMahasiswa);
        $data = KelasMahasiswa::getKelasMahasiswa($kelasMahasiswa);
        $mahasiswa = User::getListPeserta($info->idDosen);

        return view('admin.kelas.show', compact('info', 'data', 'mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KelasMahasiswa  $kelasMahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit($kelasMahasiswa)
    {
        if (count(KelasMahasiswa::getKelasMahasiswa($kelasMahasiswa)) > 0) {
            return json_encode(KelasMahasiswa::getKelasMahasiswa($kelasMahasiswa));
        } else {
            return json_encode(KelasMahasiswa::getKelasMahasiswaKosong($kelasMahasiswa));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KelasMahasiswa  $kelasMahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KelasMahasiswa $kelasMahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KelasMahasiswa  $kelasMahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($kelasMahasiswa)
    {
        KelasMahasiswa::deleteKelasMahasiswa($kelasMahasiswa);

        return redirect()->back();
    }
}
