<?php

namespace App\Http\Controllers\Admin\Portal;

use App\Http\Controllers\Controller;
use App\Kelas;
use Illuminate\Http\Request;

use App\MataKuliah;
use App\User;
use App\GrupPeserta;

class KelasController extends Controller
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
        $data = Kelas::getKelas();
        $matakuliah = MataKuliah::getMataKuliah();
        $dosen = User::getUserRole(2);
        $peserta = User::getUserRole(3);
        $grup = GrupPeserta::getGrupPeserta();

        return view('admin.kelas.index', compact('data', 'matakuliah', 'dosen', 'peserta', 'grup'));
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
        $data = Kelas::firstKelasKodeMataKuliah($request->kode, $request->idMataKuliah, $request->id);
        if (isset($data->kode)) {
            return redirect()->back()->with('danger', 'Data Kelas telah terdaftar');
        }
        else {
            Kelas::storeKelas($request);
            return redirect()->back()->with('success', 'Input Data Kelas Berhasil');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show($kelas)
    {
        return json_encode(Kelas::firstKelas($kelas));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kelas)
    {
        $data = Kelas::firstKelasKodeMataKuliah($request->kode, $request->idMataKuliah, $request->id);
        if (isset($data->id)) {
            return redirect()->back()->with('danger', 'Data kelas telah terdaftar');
        }
        Kelas::updateKelas($request);
        return redirect()->back()->with('success', 'Data Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($kelas)
    {
        Kelas::deleteKelas($kelas);
        
        return redirect()->back();
    }

    public function data_peserta(Request $request)
    {
        $data = (User::getUserRoleLoad(3, $request->search));
        foreach ($data as $key => $value) {
            $abc['results'][$key]['id'] = $value->id;
            $abc['results'][$key]['text'] = $value->username . " | " . $value->name;
        }

        if ($data->nextPageUrl() != NULL) {
            $abc['pagination'] = ['more' => true];
        } else {
            $abc['pagination'] = ['more' => false];
        }

        return $abc;
    }
}
