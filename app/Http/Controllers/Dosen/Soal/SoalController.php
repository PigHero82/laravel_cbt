<?php

namespace App\Http\Controllers\Dosen\Soal;

use App\Http\Controllers\Controller;
use App\Soal;
use Illuminate\Http\Request;

use App\Paket;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dosen.soal.single');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('gambar') !== NULL) {
            $image = $request->file('gambar');
            $gambar = rand() . '.' . $image->getClientOriginalExtension();
            $image->move('assets/images/soal/', $gambar);

            $request->media = $gambar;
            Soal::storeSoal($request);

            return back()->with('success', 'Soal berhasil ditambah');
        }

        Soal::storeSoal($request);

        return back()->with('success', 'Soal berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function show($soal)
    {
        $data = Paket::singlePaket($soal);
        $cek = Paket::cekPaketbyDosen($soal);
        $soal = Soal::getSoal($soal);

        if ($cek == NULL) {
            return redirect()->back()->with('danger', 'Data Paket Tidak Ditemukan');
        }
        return view('dosen.soal.show', compact('data', 'soal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function edit($soal)
    {
        $data = Soal::singleSoal($soal);
        $cek = Soal::cekMediaSoal($soal);
        
        
        return view('dosen.soal.single', compact('data', 'cek'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Soal $soal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Soal $soal)
    {
        //
    }
}
