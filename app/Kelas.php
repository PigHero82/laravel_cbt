<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;
use App\KelasMahasiswa;

class Kelas extends Model
{
    protected $fillable = ['kode', 'idMataKuliah', 'idDosen', 'status'];

    static function getKelas()
    {
        return Kelas::join('mata_kuliah', 'kelas.idMataKuliah', 'mata_kuliah.id')
                    ->join('users', 'kelas.idDosen', 'users.id')
                    ->join('prodi', 'mata_kuliah.idProdi', 'prodi.id')
                    ->leftjoin('kelas_mahasiswa', 'kelas.id', 'kelas_mahasiswa.idKelas')
                    ->select('kelas.id', 'kelas.kode', 'mata_kuliah.nama', 'users.name as dosen', 'prodi.nama as prodi')
                    ->selectRaw('count(kelas_mahasiswa.id) as jumlah')
                    ->groupBy('kode')
                    ->groupBy('mata_kuliah.nama')
                    ->get();
    }
    
    static function getKelasCount()
    {
        return Kelas::select('id')->where('idDosen', Auth::id())->count();
    }

    static function getKelasMahasiswaCount()
    {
        return Kelas::where('idDosen', Auth::id())
                    ->join('kelas_mahasiswa', 'kelas.id', 'kelas_mahasiswa.idKelas')
                    ->select('kelas_mahasiswa.id')
                    ->count();
    }

    static function getKelasByDosen()
    {
        $kelas = Kelas::where('idDosen', Auth::id())->get();

        if ($kelas->isNotEmpty()) {
            foreach ($kelas as $key => $value) {
                $id = $value->id;

                $data[$key] = Kelas::join('mata_kuliah', 'kelas.idMataKuliah', 'mata_kuliah.id')
                                    ->join('users', 'kelas.idDosen', 'users.id')
                                    ->select('kelas.id', 'kelas.kode', 'mata_kuliah.nama', 'users.name as dosen')
                                    ->where('kelas.id', $id)
                                    ->first();

                $data[$key]['peserta'] = KelasMahasiswa::join('users', 'kelas_mahasiswa.idMahasiswa', 'users.id')
                                                        ->select('users.id as id', 'users.username as nim', 'users.name as nama', 'users.gambar')
                                                        ->where('idKelas', $id)
                                                        ->get();
            }
            return $data;
        } else {
            return $kelas;
        }
    }

    static function getKelasOnlyByDosen()
    {
        return Kelas::join('mata_kuliah', 'kelas.idMataKuliah', 'mata_kuliah.id')
                    ->join('users', 'kelas.idDosen', 'users.id')
                    ->select('kelas.id', 'kelas.kode', 'mata_kuliah.nama', 'users.name as dosen')
                    ->where('idDosen', Auth::id())
                    ->get();
    }

    static function firstKelasKodeMataKuliah($kode, $idMataKuliah, $id)
    {
        return Kelas::where('kode', $kode)
                    ->where('idMataKuliah', $idMataKuliah)
                    ->where('id', '!=', $id)
                    ->first();
    }

    static function storeKelas($request)
    {
        Kelas::create([
            'kode'          => $request->kode,
            'idMataKuliah'  => $request->idMataKuliah,
            'idDosen'       => $request->idDosen
        ]);
    }

    static function updateKelas($request)
    {
        Kelas::whereId($request->id)->update([
            'kode'          => $request->kode,
            'idMataKuliah'  => $request->idMataKuliah,
            'idDosen'       => $request->idDosen
        ]);
    }

    static function firstKelas($id)
    {
        $data = Kelas::join('mata_kuliah', 'kelas.idMataKuliah', 'mata_kuliah.id')
                    ->join('users', 'kelas.idDosen', 'users.id')
                    ->select('kelas.id', 'idDosen', 'idMataKuliah', 'kelas.kode', 'mata_kuliah.nama', 'users.name as dosen', 'mata_kuliah.idProdi')
                    ->findOrFail($id);

        foreach ($data as $key => $value) {
            $data['mata_kuliah'] = MataKuliah::select('id', 'nama')
                                            ->where('idProdi', $data->idProdi)
                                            ->get();
        }

        return $data;
    }

    static function deleteKelas($id)
    {
        Kelas::whereId($id)->delete();
    }
}
