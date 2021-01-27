<?php

namespace App\Http\Controllers\Admin\Portal;

use App\Http\Controllers\Controller;
use App\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Prodi::getProdi();

        return view('admin.prodi', compact('data'));
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
        $data = Prodi::firstProdiNama(strtolower($request->nama), 0);
        if (isset($data->nama)) {
            return back()->with('danger', 'Data '. $request->nama .' sudah ada');
        }

        Prodi::storeProdi($request);

        return back()->with('success', 'Input Data Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function show(Prodi $prodi)
    {
        return json_encode(Prodi::firstProdi($prodi->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function edit(Prodi $prodi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prodi $prodi)
    {
        $data = Prodi::firstProdiNama(strtolower($request->nama), $prodi->id);
        if (isset($data->nama)) {
            return back()->with('danger', 'Program Studi '. $request->nama .' sudah ada');
        }

        Prodi::updateProdi($request, $prodi->id);

        return back()->with('success', 'Program Studi Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prodi $prodi)
    {
        Prodi::deleteProdi($prodi->id);

        return back();
    }
}
