<?php

namespace App\Http\Controllers\Dosen\Soal;

use App\Http\Controllers\Controller;
use App\Pilihan;
use Illuminate\Http\Request;

class PilihanController extends Controller
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
        // return $request;
        foreach ($request as $key => $value) {
            return $value->opsi;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pilihan  $pilihan
     * @return \Illuminate\Http\Response
     */
    public function show(Pilihan $pilihan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pilihan  $pilihan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pilihan $pilihan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pilihan  $pilihan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pilihan $pilihan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pilihan  $pilihan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pilihan $pilihan)
    {
        //
    }
}
