@extends('front.layout')

@section('judul')
    Beranda
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
                <h6 class="filter-heading d-none d-lg-block">Detail Peserta Tes</h6>
                <div class="card">
                    <div class="card-body">
                        <img class="img-thumbnail mb-1 mx-auto d-block" src="{{ asset('app-assets/images/portrait/small/avatar-s-20.jpg') }}" alt="Card image cap">
                        <dl class="row">
                            <dt class="col-lg-3">NIM</dt>
                            <dd class="col-lg-9" id="name-text">17101280</dd>                          
                            
                            <dt class="col-lg-3">Nama</dt>
                            <dd class="col-lg-9" id="code-text">IDA BAGUS KADEK DARMA WIRYATAMA</dd>                          
                            
                            <dt class="col-lg-3">Email</dt>
                            <dd class="col-lg-9" id="address-text">idabagus@gmail.com</dd>                          
                            
                            <dt class="col-lg-3">No HP</dt>
                            <dd class="col-lg-9" id="bank-text">082345678901</dd>                     
                        </dl>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <h6 class="filter-heading d-none d-lg-block">Daftar Ujian yang Anda Ikuti</h6>
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" aria-controls="home" role="tab" aria-selected="true">Tes Saat Ini</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="false">Riwayat Tes</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="home" aria-labelledby="home-tab" role="tabpanel">
                                <div class="accordion" id="accordionExample" data-toggle-hover="true">
                                    <div class="collapse-margin">
                                        <div class="card-header" id="headingOne" data-toggle="collapse" role="button" data-target="#collapseOne">
                                            <span class="lead collapse-title collapsed">
                                                Kuis Bahasa Indonesia
                                            </span>
                                            <div class="float-right">
                                                <div class="badge badge-success">Tersedia</div>
                                            </div>
                                        </div>
        
                                        <div id="collapseOne" class="collapse" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <p>Pastry pudding cookie toffee bonbon jujubes jujubes powder topping. Jelly beans gummi bears sweet roll
                                                bonbon muffin liquorice. Wafer lollipop sesame snaps.</p>
                                                <hr>
                                                <label for="" class="font-weight-bold">Kelas</label>
                                                <p>D</p>
                                                <label for="" class="font-weight-bold">Nama Dosen</label>
                                                <p>Dosen</p>
                                                <label for="" class="font-weight-bold">Tanggal</label>
                                                <p>29 April 2020</p>
                                                <label for="" class="font-weight-bold">Waktu</label>
                                                <p>15:30 - 17:30</p>
                                                <label for="" class="font-weight-bold">Durasi</label>
                                                <p>120 Menit</p>
                                                <div class="text-right">
                                                    <button type="button" class="btn btn-success"><i class="feather icon-play-circle"></i> Mulai Ujian</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="collapse-margin">
                                        <div class="card-header" id="headingTwo" data-toggle="collapse" role="button" data-target="#collapseTwo">
                                            <span class="lead collapse-title collapsed">
                                                Ujian Hidup
                                            </span>
                                            <div class="float-right">
                                                <div class="badge badge-danger">Terlewat / Waktu Habis</div>
                                            </div>
                                        </div>
                                        <div id="collapseTwo" class="collapse" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <p>Sweet pie candy jelly. Sesame snaps biscuit sugar plum. Sweet roll topping fruitcake. Caramels
                                                liquorice biscuit ice cream fruitcake cotton candy tart.</p>
                                                <hr>
                                                <label for="" class="font-weight-bold">Kelas</label>
                                                <p>D</p>
                                                <label for="" class="font-weight-bold">Nama Dosen</label>
                                                <p>Dosen</p>
                                                <label for="" class="font-weight-bold">Tanggal</label>
                                                <p>29 April 2020</p>
                                                <label for="" class="font-weight-bold">Waktu</label>
                                                <p>15:30 - 17:30</p>
                                                <label for="" class="font-weight-bold">Durasi</label>
                                                <p>120 Menit</p>
                                                <div class="text-right">
                                                    <button disabled type="button" class="btn btn-danger"><i class="feather icon-slash"></i> Ujian Tidak Tersedia</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                                <div class="accordion" id="accordionExample2" data-toggle-hover="true">
                                    <div class="collapse-margin">
                                        <div class="card-header" id="headingOne2" data-toggle="collapse" role="button" data-target="#collapseOne2">
                                            <span class="lead collapse-title collapsed">
                                                Kuis Bahasa Indonesia
                                            </span>
                                            <div class="float-right">
                                                <div class="badge badge-success">Tersedia</div>
                                            </div>
                                        </div>
        
                                        <div id="collapseOne2" class="collapse" data-parent="#accordionExample2">
                                            <div class="card-body">
                                                <p>Pastry pudding cookie toffee bonbon jujubes jujubes powder topping. Jelly beans gummi bears sweet roll
                                                bonbon muffin liquorice. Wafer lollipop sesame snaps.</p>
                                                <hr>
                                                <label for="" class="font-weight-bold">Kelas</label>
                                                <p>D</p>
                                                <label for="" class="font-weight-bold">Nama Dosen</label>
                                                <p>Dosen</p>
                                                <label for="" class="font-weight-bold">Tanggal</label>
                                                <p>29 April 2020</p>
                                                <label for="" class="font-weight-bold">Waktu</label>
                                                <p>15:30 - 17:30</p>
                                                <label for="" class="font-weight-bold">Durasi</label>
                                                <p>120 Menit</p>
                                                <div class="text-right">
                                                    <button type="button" class="btn btn-success"><i class="feather icon-play-circle"></i> Mulai Ujian</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="collapse-margin">
                                        <div class="card-header" id="headingTwo2" data-toggle="collapse" role="button" data-target="#collapseTwo2">
                                            <span class="lead collapse-title collapsed">
                                                Ujian Hidup
                                            </span>
                                            <div class="float-right">
                                                <div class="badge badge-danger">Terlewat / Waktu Habis</div>
                                            </div>
                                        </div>
                                        <div id="collapseTwo2" class="collapse" data-parent="#accordionExample2">
                                            <div class="card-body">
                                                <p>Sweet pie candy jelly. Sesame snaps biscuit sugar plum. Sweet roll topping fruitcake. Caramels
                                                liquorice biscuit ice cream fruitcake cotton candy tart.</p>
                                                <hr>
                                                <label for="" class="font-weight-bold">Kelas</label>
                                                <p>D</p>
                                                <label for="" class="font-weight-bold">Nama Dosen</label>
                                                <p>Dosen</p>
                                                <label for="" class="font-weight-bold">Tanggal</label>
                                                <p>29 April 2020</p>
                                                <label for="" class="font-weight-bold">Waktu</label>
                                                <p>15:30 - 17:30</p>
                                                <label for="" class="font-weight-bold">Durasi</label>
                                                <p>120 Menit</p>
                                                <div class="text-right">
                                                    <button disabled type="button" class="btn btn-danger"><i class="feather icon-slash"></i> Ujian Tidak Tersedia</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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