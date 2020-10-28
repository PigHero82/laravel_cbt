<?php

namespace App\Http\Controllers\Admin\Portal;

use App\Http\Controllers\Controller;
use App\DataDiri;
use App\User;
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
        $data = User::getDosen();
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
        $data = User::firstUsername($request->nidn, $request->id);
        if (isset($data->username)) {
            return redirect()->back()->with('danger', 'Data dengan NIDN '. $data->username .' telah terdaftar atas nama '. $data->name);
        }
        else {
            User::storeDosen($request);
            $data = User::firstUsername($request->nidn, 0);
            DataDiri::storeDataDiri($request, $data->id);
            return redirect()->back()->with('success', 'Input Data '. $request->nama .' Berhasil');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::firstUser($id);
        $info = DataDiri::firstDataDiri($id);
        return view('admin.dosen.show', compact('data', 'info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dosen  $dosen
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
     * @param  \App\Dosen  $dosen
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
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataDiri $dataDiri)
    {
        //
    }
}
