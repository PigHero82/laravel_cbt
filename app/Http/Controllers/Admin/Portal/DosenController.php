<?php

namespace App\Http\Controllers\Admin\Portal;

use App\Http\Controllers\Controller;
use App\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
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
        $data = Dosen::getDosen();
        return view('admin.dosen.index', compact('data'));
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
        $data = Dosen::firstDosenNIDN($request->nidn);
        if (isset($data->nidn)) {
            return redirect()->back()->with('danger', 'Data dengan NIDN '. $data->nidn .' telah terdaftar atas nama '. $data->nama);
        }
        else {
            Dosen::storeDosen($request);
            return redirect()->back()->with('success', 'Input Data '. $request->nama .' Berhasil');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function show(Dosen $dosen)
    {
        $data = Dosen::firstDosen($dosen->id);
        return view('admin.dosen.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function edit(Dosen $dosen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dosen $dosen)
    {
        $data = Dosen::firstDosenNIDN($request->nidn);
        if (isset($data->nidn) && $dosen->nidn != $data->nidn) {
            return redirect()->back()->with('danger', 'Data dengan NIDN '. $data->nidn .' Telah Terdaftar atas nama '. $data->nama);
        }
        Dosen::updateDosen($request, $dosen->id);
        return redirect()->back()->with('success', 'Data Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dosen $dosen)
    {
        Dosen::deleteDosen($dosen->id);
        return redirect()->back();
    }
}
