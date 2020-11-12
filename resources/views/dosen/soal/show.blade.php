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
                            <dd class="col-lg-9" id="name-text">{{ $data->nama }}</dd>                          
                            
                            <dt class="col-lg-3">Kelas</dt>
                            <dd class="col-lg-9" id="code-text">{{ $data->kode }}</dd>
                            
                            <dt class="col-lg-3">Tanggal</dt>
                            <dd class="col-lg-9" id="address-text">{{ $data->tanggal }}</dd>                          
                            
                            <dt class="col-lg-3">Waktu</dt>
                            <dd class="col-lg-9" id="bank-text">{{ $data->waktuAwal }} - {{ $data->waktuAkhir }}</dd> 

                            <dt class="col-lg-3">Durasi</dt>
                            <dd class="col-lg-9" id="bank-text">{{ $data->durasi }} Menit</dd>
                            
                            <hr>
                            <div class="container">
                                <p>{{ $data->deskripsi }}</p>
                            </div>

                            <dt class="col-lg-3">Status</dt>
                            <dd class="col-lg-9" id="bank-text"><div class="badge badge-danger">{{ $data->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</div></dd>

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
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambah"><i class="feather icon-plus"></i> Tambah</button>
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
                                    @foreach ($soal as $item)
                                        <tr>
                                            <td>{{ $item->pertanyaan }}</td>
                                            <td class="text-center">
                                                @if ($item->modelSoal == 1)
                                                    Pilihan Ganda
                                                @elseif ($item->modelSoal == 2)
                                                    Sebab Akibat
                                                @elseif ($item->modelSoal == 3)
                                                    Benar Salah
                                                @elseif ($item->modelSoal == 4)
                                                    Esai
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $item->jawaban }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('dosen.paket.edit', $item->id) }}" class="btn btn-warning px-1"><i class="feather icon-edit-1"></i></a>
                                                <button class="btn btn-danger px-1"><i class="feather icon-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
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
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Soal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- account setting page start -->
                    <section id="page-account-settings">
                        <div class="row">
                            <!-- left menu section -->
                            <div class="col-md-3 mb-2 mb-md-0">
                                <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex py-75 active" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="true">
                                            <i class="feather icon-clipboard mr-50 font-medium-3"></i>
                                            Pertanyaan
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- right content section -->
                            <div class="col-md-9">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="true">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="card text-center">
                                                    <div class="card-content">
                                                        <div class="card-body">
                                                            <h2 class="text-bold-700">{{ $data->nama }}</h2>
                                                            <p class="mb-0 line-ellipsis">Nama Paket</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="card text-center">
                                                    <div class="card-content">
                                                        <div class="card-body">
                                                            <h2 class="text-bold-700">{{ $data->kode }}</h2>
                                                            <p class="mb-0 line-ellipsis">Kelas</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <form class="form form-horizontal" method="POST" action="{{ route('dosen.paket.store') }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="idPaket" value="{{ $data->id }}">
                                                        <div class="form-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group row">
                                                                        <div class="col-md-3">
                                                                            <span>Atribut</span>
                                                                        </div>
                                                                        <div class="col-md-9">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <fieldset class="form-group mb-0">
                                                                                            <label for="basicInputFile">Gambar</label>
                                                                                            <div class="custom-file">
                                                                                                <input type="file" class="custom-file-input" accept="image/*" name="gambar">
                                                                                                <label class="custom-file-label" for="inputGroupFile01">Pilih Gambar</label>
                                                                                            </div>
                                                                                        </fieldset>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <fieldset class="form-group mb-0">
                                                                                            <label for="basicInputFile">Link</label>
                                                                                            <div class="custom-file">
                                                                                                <input type="text" class="form-control" name="media" placeholder="Link Media Soal">
                                                                                            </div>
                                                                                        </fieldset>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group row">
                                                                        <div class="col-md-3">
                                                                            <span>Jenis Soal</span>
                                                                        </div>
                                                                        <div class="col-md-9">
                                                                            <fieldset>
                                                                                <div class="vs-radio-con">
                                                                                    <input type="radio" name="modelSoal" checked value="1">
                                                                                    <span class="vs-radio">
                                                                                        <span class="vs-radio--border"></span>
                                                                                        <span class="vs-radio--circle"></span>
                                                                                    </span>
                                                                                    <span class="">Pilihan Ganda</span>
                                                                                </div>
                                                                            </fieldset>
                                                                            <fieldset>
                                                                                <div class="vs-radio-con">
                                                                                    <input type="radio" name="modelSoal" value="2">
                                                                                    <span class="vs-radio">
                                                                                        <span class="vs-radio--border"></span>
                                                                                        <span class="vs-radio--circle"></span>
                                                                                    </span>
                                                                                    <span class="">Sebab Akibat</span>
                                                                                </div>
                                                                            </fieldset>
                                                                            <fieldset>
                                                                                <div class="vs-radio-con">
                                                                                    <input type="radio" name="modelSoal" value="3">
                                                                                    <span class="vs-radio">
                                                                                        <span class="vs-radio--border"></span>
                                                                                        <span class="vs-radio--circle"></span>
                                                                                    </span>
                                                                                    <span class="">Benar Salah</span>
                                                                                </div>
                                                                            </fieldset>
                                                                            <fieldset>
                                                                                <div class="vs-radio-con">
                                                                                    <input type="radio" name="modelSoal" value="4">
                                                                                    <span class="vs-radio">
                                                                                        <span class="vs-radio--border"></span>
                                                                                        <span class="vs-radio--circle"></span>
                                                                                    </span>
                                                                                    <span class="">Esai</span>
                                                                                </div>
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group row">
                                                                        <div class="col-md-3">
                                                                            <span>Pertanyaan</span>
                                                                        </div>
                                                                        <div class="col-md-9">
                                                                            <fieldset class="form-group">
                                                                                <textarea class="form-control" rows="3" placeholder="Pertanyaan" name="pertanyaan" required></textarea>
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="float-right">
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- account setting page end -->
                </div>
            </div>
        </div>
    </div>
@endsection