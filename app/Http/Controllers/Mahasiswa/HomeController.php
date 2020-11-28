<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\DataDiri;
use App\Paket;
use App\MulaiUjian;
use App\Grup;
use App\Jawaban;

class HomeController extends Controller
{
    public function index()
    {
        $data = DataDiri::firstDataDiri(Auth::id());
        $ujian = Paket::getDataUjianPaket(Auth::id());
        $jumlah = 0;

        return view('front.index', compact('data', 'ujian', 'jumlah'));
    }

    public function soal($id)
    {
        $cek = Paket::cekPaketbyPeserta($id); 
        if (!isset($cek->id)) {
            return redirect()->back()->with('danger', 'Anda tidak terdaftar dalam ujian');
        }

        $ujian = MulaiUjian::singleMulaiUjian($id);
        if (!isset($ujian->id)) {
            $paket = Paket::singlePaket($id);
            $waktu = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s')) + ($paket->durasi*60));
            $ujian = MulaiUjian::storeMulaiUjian($id, $waktu);

            $grup = Grup::getSoalPeserta($id);
            foreach ($grup as $key => $value) {
                foreach ($value as $key => $soal) {
                    Jawaban::storeJawaban($soal->id);
                }
            }
        }

        $grup = Grup::getGrupId($id);
        foreach ($grup as $key => $value) {
            $id = $value->id;

            $data[$key] = Grup::firstGrupId($id);
            $data[$key]['soal'] = Jawaban::getDataSoal($id);
        }

        return view('soal', compact('data'));
    }
}
