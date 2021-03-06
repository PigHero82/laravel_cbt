<?php

namespace App\Http\Controllers\Admin\Portal;

use App\AnggotaGrupPeserta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnggotaGrupPesertaController extends Controller
{
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
        $i = 0;
        foreach ($request['data'] as $key => $value) {
            $data = AnggotaGrupPeserta::firstAnggotaGrupPeserta($value, $request->id);
            if (!(isset($data->idPeserta))) {
                AnggotaGrupPeserta::storeAnggotaGrupPeserta($value, $request->id);
                $i++;
            }
        }

        if ($i > 0) {
            return back()->with('success', 'Peserta Berhasil ditambah');
        } else {
            return back()->with('danger', 'Semua Peserta telah ada pada Grup');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AnggotaGrupPeserta  $anggotaGrupPeserta
     * @return \Illuminate\Http\Response
     */
    public function show($detail)
    {
        $data = AnggotaGrupPeserta::getAnggotaGrupPeserta($detail);
        if (count($data['peserta']) > 0) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }

        return json_encode($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AnggotaGrupPeserta  $anggotaGrupPeserta
     * @return \Illuminate\Http\Response
     */
    public function edit(AnggotaGrupPeserta $anggotaGrupPeserta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AnggotaGrupPeserta  $anggotaGrupPeserta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnggotaGrupPeserta $anggotaGrupPeserta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AnggotaGrupPeserta  $anggotaGrupPeserta
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnggotaGrupPeserta $detail)
    {
        AnggotaGrupPeserta::deleteAnggotaGrupPeserta($detail->id);

        return back()->with('success', 'Data Berhasil dihapus');
    }
}
