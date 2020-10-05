@extends('layout')

@section('indexactive')
    active
@endsection

@section('judul')
    Cetak Hasil
@endsection

@section('content')
    @if(session()->get('success'))
        <div class ="alert alert-success">
            {{ session()->get('success') }}  
        </div><br />
    @endif

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Hasil Tes</h4>
            <div class="float-right">
                <a href="#" class="btn btn-success"><i class="feather icon-plus"></i> Tambah</a>
            </div>
        </div>

        <div class="card-content">
            <div class="card-body">
                <table class="table table-striped">
                    <tr class="text-center">
                        <th>Nama</th>
                        <th>Jumlah Soal</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Durasi</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td><a href="#">Tes Bahasa Indonesia</a></td>
                        <td>10 Soal</td>
                        <td>8 Agustus 2020</td>
                        <td>15:00 - 16:00</td>
                        <td class="text-center"><div class="badge badge-md badge-danger">60 Menit</div></td>
                        <td class="text-center"><div class="badge badge-md badge-success">Tuntas</div></td>
                        <td class="text-center">
                            <button class="btn badge badge-lg badge-success"><i class="feather icon-printer"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#">Tes Fisika</a></td>
                        <td>15 Soal</td>
                        <td>9 Agustus 2020</td>
                        <td>13:00 - 15:00</td>
                        <td class="text-center"><div disabled class="badge badge-md badge-danger">120 Menit</div></td>
                        <td class="text-center"><div class="badge badge-md badge-success">Tuntas</div></td>
                        <td class="text-center">
                            <button class="btn badge badge-lg badge-success"><i class="feather icon-printer"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#">Tes Matematika</a></td>
                        <td>25 Soal</td>
                        <td>9 Agustus 2020</td>
                        <td>17:00 - 19:00</td>
                        <td class="text-center"><div disabled class="badge badge-md badge-danger">120 Menit</div></td>
                        <td class="text-center"><div class="badge badge-md badge-danger">Belum Tuntas</div></td>
                        <td class="text-center">
                            <button class="btn badge badge-lg badge-danger"><i class="feather icon-slash"></i></button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection