<?php

namespace App\Http\Controllers\Dosen\Soal;

use App\Http\Controllers\Controller;
use App\Soal;
use Illuminate\Http\Request;

use App\Paket;
use App\Pilihan;
use App\Grup;

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
        if ($request->storeGrup == 1) {
            Grup::storeGrupNama($request);

            return back()->with('success', 'Grup Soal berhasil ditambah');
        }

        $soal = Soal::storeSoal($request);

        if ($request->file('gambar') !== NULL) {
            $image = $request->file('gambar');
            $gambar = rand() . '.' . $image->getClientOriginalExtension();
            $image->move('assets/images/soal/', $gambar);

            Soal::updateSoalGambar($soal->id, $gambar);
        }

        if ($request->modelSoal == 1) {
            $jawaban = $request->jawaban;
        }
        if ($request->modelSoal == 2) {
            $jawaban = $request->sebabakibat;
        }
        if ($request->modelSoal == 3) {
            $jawaban = $request->benarsalah;
        }

        if ($request->benar != null) {
            $request->benar = 0;
        }

        if ($request->modelSoal !== 4) {
            foreach ($jawaban as $key => $value) {
                if ($value !== NULL) {
                    $data = Pilihan::storePilihan($soal->id, $value);
        
                    if ($key == $request->benar) {
                        Soal::updateSoalJawaban($soal->id, $data->id);
                    }
                }
            }
        }

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
        $grup = Grup::getGrup($soal);

        if ($cek == NULL) {
            return redirect()->back()->with('danger', 'Data Paket Tidak Ditemukan');
        }
        return view('dosen.soal.show', compact('data', 'grup'));
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
        $pilihan = Pilihan::getPilihan($soal);
        
        return view('dosen.soal.single', compact('data', 'cek', 'pilihan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Grup::updateGrup($request);

        return back()->with('success', 'Data grup berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function destroy($soal)
    {
        Grup::deleteGrup($soal);

        return back();
    }

    public function data_soal($id)
    {
        $data = Soal::singleSoal($id)[0];
        
        return view('dosen.soal.single', compact('data'));
    }

    public function data_soal_update(Request $request, $id)
    {
        if ($request->file('gambar') !== NULL) {
            $image = $request->file('gambar');
            $gambar = rand() . '.' . $image->getClientOriginalExtension();
            $image->move('assets/images/soal/', $gambar);

            Soal::updateGambarSoal($soal->id, $gambar);
        }

        Soal::updateSoal($request, $id);

        if ($request->modelSoal !== 4) {
            Pilihan::deletePilihan($id);
            
            foreach ($request->jawaban as $key => $value) {
                if ($value !== NULL) {
                    $data = Pilihan::storePilihan($id, $value);
        
                    if ($key == $request->benar) {
                        Soal::updateSoalJawaban($id, $data->id);
                    }
                }
            }
        }

        return back()->with('success', 'Soal berhasil diubah');
    }

    public function data_soal_delete($id)
    {
        Soal::deleteSoal($id);

        return back();
    }
}
