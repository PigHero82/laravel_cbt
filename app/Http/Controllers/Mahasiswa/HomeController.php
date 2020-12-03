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
use App\Soal;

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
            return back()->with('danger', 'Anda tidak terdaftar dalam ujian');
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
        
        $data_ujian = MulaiUjian::singleMulaiUjian($id);
        if ($data_ujian->waktu < date('Y-m-d H:i:s')) {
            return back()->with('danger', 'Waktu telah habis, anda tidak dapat melanjutkan ujian');
        }

        $grup = Grup::getGrupId($id);
        foreach ($grup as $key => $value) {
            $id = $value->id;

            $data[$key] = Grup::firstGrupId($id);
            $data[$key]['soal'] = Jawaban::getDataSoal($id);
        }
        $no = 1;

        return view('front.soal', compact('data', 'no', 'data_ujian'));
    }

    public function data_soal($id)
    {
        return json_encode(Soal::singleSoalJawab($id)[0]);
    }

    public function jawab(Request $request)
    {
        if ($request->jawaban_esai != null) {
            Jawaban::updateJawabanEsai($request->jawaban_esai, $request->id);
        } else {
            $data = explode("/", $request->jawaban);
            $hasil = Soal::cekJawaban($data[0], $data[1]);
            Jawaban::updateJawaban($data[0], $data[1], $hasil);
        }
    }
}
