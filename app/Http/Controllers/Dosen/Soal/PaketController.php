<?php

namespace App\Http\Controllers\Dosen\Soal;

use App\Http\Controllers\Controller;
use App\Paket;
use Illuminate\Http\Request;

use App\Kelas;
use App\Grup;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kelas::getKelasOnlyByDosen();
        $paket = Paket::getPaket();

        return view('dosen.soal.index', compact('data', 'paket'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dosen.soal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Paket::storePaket($request);
        Grup::storeGrup($data->id);

        return redirect()->back()->with('success', 'Paket '. $request->nama .' berhasil ditambah, Paket dapat ditampilkan ke mahasiswa apabila telah mengubah status paket menjadi aktif');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return json_encode(Paket::singlePaket($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function edit(Paket $paket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paket $paket)
    {
        if ($request->status != NULL) {
            Paket::updatePaketStatus($paket->id, $request->status);

            return redirect()->back()->with('success', 'Status Paket berhasil diubah');
        }
        Paket::updatePaket($paket->id, $request);
        
        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paket $paket)
    {
        Paket::deletePaket($paket->id);

        return redirect()->back();
    }
}
