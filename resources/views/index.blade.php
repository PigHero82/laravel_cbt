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
                                    <i class="feather icon-users text-info font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700">279</h2>
                            <p class="mb-0 line-ellipsis">Jumlah Siswa</p>
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
                                    <i class="feather icon-user text-warning font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700">0</h2>
                            <p class="mb-0 line-ellipsis">Jumlah Guru</p>
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
                                    <i class="feather icon-file-text text-danger font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700">90</h2>
                            <p class="mb-0 line-ellipsis">Jumlah Paket Soal</p>
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
                            <div class="avatar bg-rgba-primary p-50 m-0 mb-1">
                                <div class="avatar-content">
                                    <i class="feather icon-book text-primary font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700">0</h2>
                            <p class="mb-0 line-ellipsis">Jumlah Materi</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- general form elements -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Paket Soal</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <p>Paket Soal yang telah dibuat</p>
            <table id="myTable" class="table zero-configuration table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama Paket</th>
                        <th>Kelas</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#exampleModal">
                                PDP
                            </a>
                        </td>
                        <td>I</td>
                        <td>
                            <a href="#" class="badge badge-success">Tampil</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#exampleModal">
                                PPDS Batch 1
                            </a>
                        </td>
                        <td>II</td>
                        <td>
                            <a href="#" class="badge badge-success">Tampil</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#exampleModal">
                                PKM STIKI Peduli (Tahunan) Batch 1
                            </a>
                        </td>
                        <td>III</td>
                        <td>
                            <a href="#" class="badge badge-danger">Tidak Tampil</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

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
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/cards/card-statistics.js') }}"></script>
    <!-- END: Page JS-->
@endsection