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
                            <div class="avatar bg-rgba-info p-50 m-0 mb-1">
                                <div class="avatar-content">
                                    <i class="feather icon-file-text text-info font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700">279</h2>
                            <p class="mb-0 line-ellipsis text-dark">Ujian Dilaksanakan</p>
                            <p class="mb-0 line-ellipsis text-dark">Tahun 2020</p>
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
                            <div class="avatar bg-rgba-success p-50 m-0 mb-1">
                                <div class="avatar-content">
                                    <i class="feather icon-user text-success font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700">4%</h2>
                            <p class="mb-0 line-ellipsis text-dark">Peserta Lulus</p>
                            <p class="mb-0 line-ellipsis text-dark">Tahun 2020</p>
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
                                    <i class="feather icon-award text-warning font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700">1.54</h2>
                            <p class="mb-0 line-ellipsis text-dark">Rata-rata Skor</p>
                            <p class="mb-0 line-ellipsis text-dark">Tahun 2020</p>
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
                            <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                <div class="avatar-content">
                                    <i class="feather icon-info text-danger font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700">90%</h2>
                            <p class="mb-0 line-ellipsis text-dark">Skor 0</p>
                            <p class="mb-0 line-ellipsis text-dark">Tahun 2020</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body py-1">
                    <form action="#" method="post">
                        <div class="d-flex justify-content-between mx-5">
                            <div class="d-inline">
                                <label for="">Periode</label>
                                <select name="" class="form-control">
                                    <option value="">2019/2020 Genap - Mandiri</option>
                                </select>
                            </div>

                            <div class="d-inline">
                                <label for="">Jenis Ujian</label>
                                <select name="" class="form-control">
                                    <option value="">-- Semua --</option>
                                </select>
                            </div>

                            <div class="d-inline">
                                <label for="" class="text-white">-</label>
                                <button type="button" class="btn btn-primary form-control">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Line Chart</h4>
                </div>
                <div class="card-content">
                    <div class="card-body pl-0">
                        <div class="height-300">
                            <canvas id="line-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="feather icon-calendar"></i> Jadwal Ujian Terdekat</h4>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">[Nama Paket]</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="firstName1">Nama Paket</label>
                        <input type="text" class="form-control" value="Tes Bahasa Indonesia" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="" id="" cols="30" rows="5" class="form-control" disabled>Paket ini digunakan untuk mengetahui apa saja</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Jenis</label>
                        <select name="" id="" class="form-control" disabled="disabled">
                            <option value="">Soal Tes</option>
                            <option value="">Soal Latihan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="firstName1">KKM</label>
                        <input type="text" class="form-control" value="80" disabled>
                    </div>
                    <div class="form-group">
                        <label for="firstName1">Waktu</label>
                        <input type="text" class="form-control" value="100 Menit" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="" id="" class="form-control" disabled="disabled">
                            <option value="">Tampil</option>
                            <option value="">Tidak Tampil</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Ubah</button>
                    <button type="button" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('app-assets/vendors/js/charts/chart.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/charts/chart-chartjs.js') }}"></script>
@endsection