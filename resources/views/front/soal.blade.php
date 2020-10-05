@extends('front.layout')

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
        <div class="card">
            <div class="card-body justify-content-between">
                <h4 class="align-center">Tes Bahasa Indonesia
                    <div class="float-right">
                        <h5 class="d-inline">Waktu Tersisa : </h5>
                        <div class="btn btn-danger d-inline">0:00:00</div>
                    </div>
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <h6 class="filter-heading">Pertanyaan</h6>
                <div class="card">
                    <div class="card-body">
                        <div class="overflow-auto">
                            1.
                            Dibawah ini manakah yang tidak termasuk fungsi dari bahasa Indonesia ?
                            <br>
                            <ul class="list-unstyled mb-0">
                                <li class=" mr-2">
                                    <fieldset>
                                        <div class="vs-radio-con">
                                            <input type="radio" name="vueradio" checked value="false">
                                            <span class="vs-radio">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <span class="">A. Sebagai alat pemersatu</span>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class=" mr-2">
                                    <fieldset>
                                        <div class="vs-radio-con">
                                            <input type="radio" name="vueradio" checked value="false">
                                            <span class="vs-radio">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <span class="">B. Sebagai kerangka acuan</span>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class=" mr-2">
                                    <fieldset>
                                        <div class="vs-radio-con">
                                            <input type="radio" name="vueradio" checked value="false">
                                            <span class="vs-radio">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <span class="">C. Sebagai pemecah bangsa</span>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class=" mr-2">
                                    <fieldset>
                                        <div class="vs-radio-con">
                                            <input type="radio" name="vueradio" checked value="false">
                                            <span class="vs-radio">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <span class="">D. Sebagai ciri khas suatu bangsa</span>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class=" mr-2">
                                    <fieldset>
                                        <div class="vs-radio-con">
                                            <input type="radio" name="vueradio" checked value="false">
                                            <span class="vs-radio">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <span class="">E. Sebagai dasar negara</span>
                                        </div>
                                    </fieldset>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <button type="button" class="btn btn-primary"><i class="feather icon-arrow-right"></i> Selanjutnya</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h6 class="filter-heading">Navigasi</h6>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3 mb-1">
                                <button type="button" class="btn btn-outline-primary">1</button>
                            </div>
                            <div class="col-3 mb-1">
                                <button type="button" class="btn btn-outline-primary">2</button>
                            </div>
                            <div class="col-3 mb-1">
                                <button type="button" class="btn btn-outline-primary">3</button>
                            </div>
                            <div class="col-3 mb-1">
                                <button type="button" class="btn btn-outline-primary">4</button>
                            </div>
                            <div class="col-3 mb-1">
                                <button type="button" class="btn btn-outline-primary">5</button>
                            </div>
                            <div class="col-3 mb-1">
                                <button type="button" class="btn btn-outline-primary">6</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-block btn-success"><i class="feather icon-check"></i> Selesai</button>
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