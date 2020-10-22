<?php

namespace App\Http\Controllers\Admin\Portal;

use App\Http\Controllers\Controller;
use App\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
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
        $data = MataKuliah::getMataKuliah();
        return view('mata-kuliah', compact('data'));
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
        $data = MataKuliah::firstMataKuliahNama(strtolower($request->nama));
        if (isset($data->nama)) {
            return redirect()->back()->with('danger', 'Data '. $request->nama .' sudah ada');
        }
        else {
            MataKuliah::storeMataKuliah($request);
            return redirect()->back()->with('success', 'Input Data Berhasil');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function show(MataKuliah $mataKuliah)
    {
        return json_encode(MataKuliah::firstMataKuliah($mataKuliah->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function edit(MataKuliah $mataKuliah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MataKuliah $mataKuliah)
    {
        $data = MataKuliah::firstMataKuliahNama(strtolower($request->nama));
        if (isset($data->nama) && $mataKuliah->nama != $data->nama) {
            return redirect()->back()->with('danger', 'Data '. $request->nama .' sudah ada');
        }
        MataKuliah::updateMataKuliah($request, $mataKuliah->id);
        return redirect()->back()->with('success', 'Data Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function destroy(MataKuliah $mataKuliah)
    {
        MataKuliah::deleteMataKuliah($mataKuliah->id);
        return redirect()->back();
    }
}
