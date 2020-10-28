<?php

namespace App\Http\Controllers\Admin\Portal;

use App\Http\Controllers\Controller;
use App\DataDiri;
use App\User;
use Illuminate\Http\Request;


class MahasiswaController extends Controller
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
        $data = User::getMahasiswa();
        return view('admin.mahasiswa.index', compact('data'));
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
        $data = User::firstUsername($request->nim, $request->id);
        if (isset($data->username)) {
            return redirect()->back()->with('danger', 'Data dengan NIM '. $data->username .' telah terdaftar atas nama '. $data->name);
        }
        else {
            User::storeMahasiswa($request);
            $data = User::firstUsername($request->nim, 0);
            DataDiri::storeDataDiri($request, $data->id);
            return redirect()->back()->with('success', 'Input Data '. $request->nama .' Berhasil');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::firstUser($id);
        $info = DataDiri::firstDataDiri($id);
        return view('admin.mahasiswa.show', compact('data', 'info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(DataDiri $dataDiri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $dataDiri)
    {
        DataDiri::updateDataDiri($request, $dataDiri);
        return redirect()->back()->with('success', 'Data Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
