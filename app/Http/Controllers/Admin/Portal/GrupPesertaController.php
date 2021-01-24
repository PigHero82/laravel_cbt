<?php

namespace App\Http\Controllers\Admin\Portal;

use App\GrupPeserta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GrupPesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = GrupPeserta::getGrupPeserta();

        return view('admin.grup-peserta', compact('data'));
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
        GrupPeserta::storeGrupPeserta($request);

        return back()->with('success', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GrupPeserta  $grupPeserta
     * @return \Illuminate\Http\Response
     */
    public function show(GrupPeserta $grup_peserta)
    {
        return json_encode($grup_peserta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GrupPeserta  $grupPeserta
     * @return \Illuminate\Http\Response
     */
    public function edit(GrupPeserta $grupPeserta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GrupPeserta  $grupPeserta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GrupPeserta $grup_pesertum)
    {
        GrupPeserta::updateGrupPeserta($request, $grup_pesertum->id);

        return back()->with('success', 'Program Studi Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GrupPeserta  $grupPeserta
     * @return \Illuminate\Http\Response
     */
    public function destroy(GrupPeserta $grup_pesertum)
    {
        GrupPeserta::deleteGrupPeserta($grup_pesertum->id);

        return back();
    }
}
