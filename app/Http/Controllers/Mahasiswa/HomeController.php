<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\DataDiri;
use App\Paket;

class HomeController extends Controller
{
    public function index()
    {
        $data = DataDiri::firstDataDiri(Auth::id());
        $ujian = Paket::getDataUjianPaket(Auth::id());
        $jumlah = 0;

        return view('front.index', compact('data', 'ujian', 'jumlah'));
    }
}
