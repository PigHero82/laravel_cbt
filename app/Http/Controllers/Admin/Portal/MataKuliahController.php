<?php

namespace App\Http\Controllers\Admin\Portal;

use App\Http\Controllers\Controller;
use App\MataKuliah;
use Illuminate\Http\Request;

use App\Prodi;

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
        $prodi = Prodi::getProdi();

        return view('mata-kuliah', compact('data', 'prodi'));
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
        $data = MataKuliah::firstMataKuliahKode(0, strtolower($request->kode));
        if (isset($data->kode)) {
            return redirect()->back()->with('danger', 'Mata Kuliah dengan kode '. $request->kode .' sudah ada');
        }
        else {
            MataKuliah::storeMataKuliah($request);

            return redirect()->back()->with('success', 'Mata Kuliah Berhasil ditambah');
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
        $data = MataKuliah::firstMataKuliahKode($mataKuliah->id, strtolower($request->kode));
        if (isset($data->kode)) {
            return redirect()->back()->with('danger', 'Mata Kuliah dengan kode '. $data->kode .' sudah ada');
        }
        MataKuliah::updateMataKuliah($request, $mataKuliah->id);

        return redirect()->back()->with('success', 'Mata Kuliah Berhasil diubah');
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

    public function data($id)
    {
        $data = (MataKuliah::firstMataKuliahProdi($id));

        if (count($data['mata_kuliah']) > 0) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }

        return json_encode($data);
    }
}
