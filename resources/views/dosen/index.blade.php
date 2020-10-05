@extends('layout')

@section('indexactive')
    active
@endsection

@section('judul')
    Dashboard
@endsection

@section('content')
    @if(session()->get('success'))
        <div class ="alert alert-success">
            {{ session()->get('success') }}  
        </div><br />
    @endif

    <div class="row">
        <div class="col-xl-3 col-md-4 col-sm-6">
            <a href="#">
                <div class="card text-center">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="avatar bg-rgba-success p-50 m-0 mb-1">
                                <div class="avatar-content">
                                    <i class="feather icon-user text-success font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700">34</h2>
                            <p class="mb-0 line-ellipsis text-dark">Jumlah Mahasiswa</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <a href="#">
                <div class="card text-center">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="avatar bg-rgba-info p-50 m-0 mb-1">
                                <div class="avatar-content">
                                    <i class="feather icon-home text-info font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700">2</h2>
                            <p class="mb-0 line-ellipsis text-dark">Jumlah Kelas</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <a href="#">
                <div class="card text-center">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="avatar bg-rgba-warning p-50 m-0 mb-1">
                                <div class="avatar-content">
                                    <i class="feather icon-file-text text-warning font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700">3</h2>
                            <p class="mb-0 line-ellipsis text-dark">Jumlah Soal</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">            
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Paket Soal</h4>
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
                                <th>Aktif</th>
                            </tr>
                            <tr>
                                <td>Tes Bahasa Indonesia</td>
                                <td>10 Soal</td>
                                <td>8 Agustus 2020</td>
                                <td>15:00 - 16:00</td>
                                <td><div disabled class="badge badge-md badge-danger">60 Menit</div></td>
                                <td class="text-center"><i class="feather icon-slash text-danger"></i></td>
                            </tr>
                            <tr>
                                <td>Tes Fisika</td>
                                <td>15 Soal</td>
                                <td>9 Agustus 2020</td>
                                <td>13:00 - 15:00</td>
                                <td><div disabled class="badge badge-md badge-danger">120 Menit</div></td>
                                <td class="text-center"><i class="feather icon-check text-success"></i></td>
                            </tr>
                            <tr>
                                <td>Tes Matematika</td>
                                <td>25 Soal</td>
                                <td>9 Agustus 2020</td>
                                <td>17:00 - 19:00</td>
                                <td><div disabled class="badge badge-md badge-danger">120 Menit</div></td>
                                <td class="text-center"><i class="feather icon-check text-success"></i></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="feather icon-calendar"></i> Jadwal Ujian Terdekat</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection