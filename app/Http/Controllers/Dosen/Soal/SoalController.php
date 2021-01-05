<?php

namespace App\Http\Controllers\Dosen\Soal;

use App\Http\Controllers\Controller;
use App\Imports\SoalImport;
use App\Grup;
use App\ImportSoal;
use App\KelasMahasiswa;
use App\Jawaban;
use App\Paket;
use App\Pilihan;
use App\Soal;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;


class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dosen.soal.single');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->storeGrup == 1) {
            Grup::storeGrupNama($request);

            return back()->with('success', 'Grup Soal berhasil ditambah');
        }

        $soal = Soal::storeSoal($request);

        if ($request->file('gambar') !== NULL) {
            $image = $request->file('gambar');
            $gambar = rand() . '.' . $image->getClientOriginalExtension();
            $image->move('assets/images/soal/', $gambar);

            Soal::updateSoalGambar($soal->id, $gambar);
        }

        if ($request->modelSoal == 1) {
            $jawaban = $request->jawaban;
        }
        if ($request->modelSoal == 2) {
            $jawaban = $request->sebabakibat;
        }
        if ($request->modelSoal == 3) {
            $jawaban = $request->benarsalah;
        }

        if ($request->benar != null) {
            $request->benar = 0;
        }

        if ($request->modelSoal != 4) {
            foreach ($jawaban as $key => $value) {
                if ($value !== NULL) {
                    $data = Pilihan::storePilihan($soal->id, $value);
        
                    if ($key == $request->benar) {
                        Soal::updateSoalJawaban($soal->id, $data->id);
                    }
                }
            }
        }

        return back()->with('success', 'Soal berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function show($soal)
    {
        $data = Paket::singlePaket($soal);
        $cek = Paket::cekPaketbyDosen($soal);

        if ($cek == NULL) {
            return back()->with('danger', 'Data Paket Tidak Ditemukan');
        }
        if ($data->tanggal_awal.' '.$data->waktu_awal <= date('Y-m-d H:i:s') && $data->tanggal_akhir.' '.$data->waktu_akhir >= date('Y-m-d-H:i:s') && $data->status == 1) {
            return redirect()->route('dosen.laporan.show', $data->id)->with('danger', 'Ujian sedang berlangsung, soal tidak dapat diubah');
        } else {
            $grup = Grup::getGrup($soal);

            return view('dosen.soal.show', compact('data', 'grup', 'soal'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function edit($soal)
    {
        $data = Soal::singleSoal($soal);
        $cek = Soal::cekMediaSoal($soal);
        $pilihan = Pilihan::getPilihan($soal);
        
        return view('dosen.soal.single', compact('data', 'cek', 'pilihan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Grup::updateGrup($request);

        return back()->with('success', 'Data grup berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function destroy($soal)
    {
        Grup::deleteGrup($soal);

        return back();
    }

    public function data_soal($id)
    {
        $data = Soal::singleSoal($id)[0];
        
        return view('dosen.soal.single', compact('data'));
    }

    public function data_soal_update(Request $request, $id)
    {
        if ($request->file('gambar') !== NULL) {
            $image = $request->file('gambar');
            $gambar = rand() . '.' . $image->getClientOriginalExtension();
            $image->move('assets/images/soal/', $gambar);

            Soal::updateGambarSoal($soal->id, $gambar);
        }

        Soal::updateSoal($request, $id);

        if ($request->modelSoal != 4) {
            Pilihan::deletePilihan($id);
            
            foreach ($request->jawaban as $key => $value) {
                if ($value !== NULL) {
                    $data = Pilihan::storePilihan($id, $value);
        
                    if ($key == $request->benar) {
                        Soal::updateSoalJawaban($id, $data->id);
                    }
                }
            }
        }

        return back()->with('success', 'Soal berhasil diubah');
    }

    public function data_soal_delete($id)
    {
        Soal::deleteSoal($id);

        return back();
    }

    public function import(Request $request)
    {
        ImportSoal::truncate();

        // menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('assets/import/soal/',$nama_file);
 
		// import data
		Excel::import(new SoalImport, public_path('/assets/import/soal/'.$nama_file));
        
        $data = ImportSoal::getImportSoal();

        if ($data[0]->jenis != "Grup") {
            $deskripsi = "Tes Soal";
            $grup = Grup::importGrupNama($request->id, $deskripsi);
        }

        foreach ($data as $key => $value) {
            if ($value->jenis == "Grup") {
                $grup = Grup::importGrupNama($request->id, $value->deskripsi);
            } elseif ($value->jenis == "Soal") {
                if ($value->modelSoal == NULL || $value->modelSoal == "Pilihan Ganda") {
                    $value->modelSoal = 1;
                } else {
                    $value->modelSoal = 4;
                }

                $soal = Soal::importSoal($grup->id, $value->modelSoal, $value->deskripsi);
            } else {
                if ($soal->id == NULL) {
                    $value->modelSoal = 1;
                    $value->deskripsi = "[Tanpa Soal]";
                    $soal = Soal::importSoal($grup->id, $value->modelSoal, $value->deskripsi);
                }

                $pilihan = Pilihan::storePilihan($soal->id, $value->deskripsi);

                if ($value->hasil == "Benar") {
                    Soal::updateSoalJawaban($soal->id, $pilihan->id);
                }
            }
        }

        return back()->with('success', 'Soal berhasil diupload');
    }

    public function laporan_index()
    {
        $data = Paket::getPaketAktif();

        return view('dosen.laporan.index', compact('data'));
    }

    public function laporan_show($id)
    {
        $data = Paket::singlePaket($id);
        $cek = Paket::cekPaketbyDosen($id);
        $total = Paket::sumNilai($id)->jumlah * Paket::sumNilai($id)->bobot_benar;
        $mahasiswa = KelasMahasiswa::getKelasMahasiswaLaporan($id, $data->idKelas);

        if ($cek == NULL) {
            return back()->with('danger', 'Data Paket Tidak Ditemukan');
        }

        return view('dosen.laporan.show', compact('data', 'mahasiswa', 'total', 'cek'));
    }

    public function laporanjawaban_show($id)
    {
        $data = Jawaban::getJawaban($id);
        $soal = count(Soal::getSoalOnly($id));

        return view('dosen.laporan.jawaban', compact('data', 'soal'));
    }

    public function data_jawaban($id, $user)
    {
        return json_encode(Jawaban::getJawabanOrderByPaket($id, $user));
    }

    public function data_jawaban_store(Request $request)
    {
        $data = Soal::cekBobot($request['data']);

        foreach ($request['data'] as $key => $value) {
            if ($value != NULL) {
                $hasil = explode("/", $value);
                if ($hasil[1] == 1) {
                    Jawaban::updateRekapanJawaban($hasil[0], $hasil[1], $data->bobot_benar);
                } else {
                    Jawaban::updateRekapanJawaban($hasil[0], $hasil[1], $data->bobot_salah);
                }
            }
        }

        return back()->with('success', 'Koreksi hasil jawaban berhasil diubah');
    }
}
