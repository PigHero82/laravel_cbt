@extends('layout')

@section('judul')
    Tes Bahasa Indonesia
@endsection

@section('content')
    @if(session()->get('success'))
        <div class ="alert alert-success">
            {{ session()->get('success') }}  
        </div><br />
    @endif

    <div class="sidebar-shop" id="ecommerce-sidebar-toggler">
        <div class="row">
            <div class="col-md-4">
                <h6 class="filter-heading d-none d-lg-block">Detail Tes</h6>
                <div class="card">
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-lg-3">Nama</dt>
                            <dd class="col-lg-9" id="name-text">Tes Bahasa Indonesia</dd>                          
                            
                            <dt class="col-lg-3">Kelas</dt>
                            <dd class="col-lg-9" id="code-text">DA</dd>                          
                            
                            <dt class="col-lg-3">Tanggal</dt>
                            <dd class="col-lg-9" id="address-text">23 Agustus 2020</dd>                          
                            
                            <dt class="col-lg-3">Waktu</dt>
                            <dd class="col-lg-9" id="bank-text">15:00 - 17:00</dd> 

                            <dt class="col-lg-3">Durasi</dt>
                            <dd class="col-lg-9" id="bank-text">120 Menit</dd>
                            
                            <hr>
                            <div class="container">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas expedita, fugiat reiciendis libero, neque totam rerum vel, alias aliquid pariatur eius cum nam deserunt nesciunt sint ducimus reprehenderit assumenda laboriosam!</p>
                            </div>

                            <dt class="col-lg-3">Status</dt>
                            <dd class="badge badge-danger" id="bank-text">Tidak Aktif</dd>

                        </dl>

                        <div class="float-right">
                            <button type="button" class="btn btn-success">Tampilkan Soal</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <h6 class="filter-heading d-none d-lg-block">Soal-soal</h6>
                <div class="card">
                    <div class="card-header">
                        <h3 class="d-inline">Daftar Soal</h3>
                        <div class="float-right d-inline">
                            <button type="button" class="btn btn-success"><i class="feather icon-plus"></i> Tambah</button>
                            <button type="button" class="btn btn-primary"><i class="feather icon-upload"></i> Import Excel</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>Soal</th>
                                        <th>Jenis</th>
                                        <th>Jawaban</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Apa yang dimaksud dengan karnivora?</td>
                                        <td class="text-center">Pilihan Ganda</td>
                                        <td class="text-center">E</td>
                                        <td class="text-center">
                                            <button class="btn badge badge-lg badge-warning"><i class="feather icon-edit-1"></i></button>
                                            <button class="btn badge badge-lg badge-danger"><i class="feather icon-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Apa arti dari kata halusinasi?</td>
                                        <td class="text-center">Esai</td>
                                        <td class="text-center"></td>
                                        <td class="text-center">
                                            <button class="btn badge badge-lg badge-warning"><i class="feather icon-edit-1"></i></button>
                                            <button class="btn badge badge-lg badge-danger"><i class="feather icon-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="text-center">
                                        <th>Soal</th>
                                        <th>Jenis</th>
                                        <th>Jawaban</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </div> --}}
@endsection