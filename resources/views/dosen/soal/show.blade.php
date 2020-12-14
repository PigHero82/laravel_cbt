@extends('layout')

@section('judul')
    Tes Bahasa Indonesia
@endsection

@section('css')
    <style>
        td p {
            margin-bottom: 0%;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
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
                            <dd class="col-lg-9" id="address-text">
                                @if ($data->tanggal_awal == $data->tanggal_akhir)
                                    {{ Carbon\Carbon::parse($data->tanggal_awal)->formatLocalized('%d %B %Y') }}
                                @else
                                    {{ Carbon\Carbon::parse($data->tanggal_awal)->formatLocalized('%d %B %Y') }} - {{ Carbon\Carbon::parse($data->tanggal_akhir)->formatLocalized('%d %B %Y') }}
                                @endif
                            </dd>                          
                            
                            @if ($data->waktu_awal !== '00:00:00' && $data->waktu_akhir !== '23:59:00')
                                <dt class="col-lg-3">Waktu</dt>
                                <dd class="col-lg-9" id="bank-text">
                                    {{ Carbon\Carbon::parse($data->waktu_awal)->formatLocalized('%H:%M') }} - {{ Carbon\Carbon::parse($data->waktu_akhir)->formatLocalized('%H:%M') }}
                                </dd>
                            @endif

                            <dt class="col-lg-3">Durasi</dt>
                            <dd class="col-lg-9" id="bank-text">{{ $data->durasi }} Menit</dd>
                        </dl>
                        
                        @if ($data->deskripsi != NULL)
                            <hr>
                            
                            <dl class="row mb-0">
                                <div class="container">
                                    <p class="mb-0">{{ $data->deskripsi }}</p>
                                </div>
                            </dl>
                        @endif
                        
                        <hr>
                        
                        <dl class="row">
                            <dt class="col-lg-3">Status</dt>
                            <dd class="col-lg-9" id="bank-text"><div class="badge {{ $data->status == 1 ? 'badge-success' : 'badge-danger' }}">{{ $data->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</div></dd>
                        </dl>

                        <div class="float-right">
                            <form action="{{ route('dosen.paket.update', $data->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                @if ($data->status == 1)
                                    <input type="hidden" name="status" value="0">
                                    <button type="submit" class="btn btn-danger">Sembunyikan Soal</button>
                                @else
                                    <input type="hidden" name="status" value="1">
                                    <button type="submit" class="btn btn-success">Tampilkan Soal</button>
                                @endif
                            </form>
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
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambahGrup"><i class="feather icon-plus"></i> Tambah Grup</button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExcel"><i class="feather icon-upload"></i> Upload Excel</button>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (count($grup) > 0)
                            <div class="accordion" id="accordionExample" data-toggle-hover="true">
                                @foreach ($grup as $item)
                                    <div class="collapse-margin">
                                        <div class="card-header" id="heading{{ $item->id }}" data-toggle="collapse" role="button" data-target="#collapse{{ $item->id }}">
                                            <span class="lead collapse-title @if ($loop->first) collapsed @endif">
                                                {{ $item->nama }}
                                            </span>
                                            <div class="float-right">
                                                <form action="{{ route('dosen.soal.destroy', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-success modalSoal" data-toggle="modal" data-target="#modalTambah" data-value="{{ $item->id }}">
                                                        <i class="feather icon-plus" data-toggle="tooltip" data-placement="top" title="Tambah Soal"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-warning modalUbahGrup" data-toggle="modal" data-target="#modalUbahGrup" data-value="{{ $item->id }}" data-nama="{{ $item->nama }}">
                                                        <i class="feather icon-edit-1" data-toggle="tooltip" data-placement="top" title="Ubah Grup"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger hapus">
                                                        <i class="feather icon-trash-2" data-toggle="tooltip" data-placement="top" title="Hapus Grup"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <div id="collapse{{ $item->id }}" class="collapse @if ($loop->first) show @endif" data-parent="#accordionExample">
                                            <div class="card-body">
                                                @if (count($item['soal']) > 0)
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
                                                                @foreach ($item['soal'] as $soal)
                                                                    <tr>
                                                                        <td>{!! $soal->pertanyaan !!}</td>
                                                                        <td class="text-center">
                                                                            @if ($soal->modelSoal == 1)
                                                                                Pilihan Ganda
                                                                            @elseif ($soal->modelSoal == 2)
                                                                                Sebab Akibat
                                                                            @elseif ($soal->modelSoal == 3)
                                                                                Benar Salah
                                                                            @elseif ($soal->modelSoal == 4)
                                                                                Esai
                                                                            @endif
                                                                        </td>
                                                                        <td class="text-center">{!! $soal->deskripsi !!}</td>
                                                                        <td class="text-center">
                                                                            <form action="{{ route('dosen.edit-soal.destroy', $soal->id) }}" method="post">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="hidden" name="hapus_soal" value="1">
                                                                                <a href="{{ route('dosen.edit-soal', $soal->id) }}" class="btn btn-warning px-1 modalUbahSoal">
                                                                                    <i class="feather icon-edit-1" data-toggle="tooltip" data-placement="top" title="Ubah Soal"></i>
                                                                                </a>
                                                                                <button type="button" class="btn btn-danger px-1 hapus">
                                                                                    <i class="feather icon-trash" data-toggle="tooltip" data-placement="top" title="Hapus Soal"></i>
                                                                                </button>
                                                                            </form>
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
                                                @else
                                                    <div class="error-template text-center">
                                                        <h1><i class="feather icon-slash"></i></h1>
                                                        <h2>Tidak Ada Soal</h2>
                                                        <button type="button" class="btn btn-success modalSoal" data-toggle="modal" data-target="#modalTambah" data-value="{{ $item->id }}"><i class="feather icon-plus"></i> Tambah Soal</button>
                                                    </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="error-template text-center">
                                <h1><i class="feather icon-slash"></i></h1>
                                <h2>Tidak Ada Grup</h2>
                            </div>
                        @endif
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
                                                    <form class="form form-horizontal" action="{{ route('dosen.soal.store') }}" id="storeData" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="idGrup" id="idGrup">
                                                        <div class="form-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group row">
                                                                        <div class="col-md-3">
                                                                            <span>Atribut</span>
                                                                        </div>
                                                                        <div class="col-md-9">
                                                                            <div class="form-group">
                                                                                <fieldset class="form-group mb-0">
                                                                                    <label for="basicInputFile">Gambar</label>
                                                                                    <div class="custom-file">
                                                                                        <input type="file" class="custom-file-input" accept="image/*" id="gambar" name="gambar">
                                                                                        <label class="custom-file-label" id="inputGroupFile01">Pilih Gambar</label>
                                                                                    </div>
                                                                                </fieldset>
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
                                                                                <textarea class="form-control pertanyaansoal" rows="3" placeholder="Pertanyaan" name="pertanyaan" required></textarea>
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div id="data-jawaban">
                                                                        <div class="form-group row">
                                                                            <div class="col-md-3">
                                                                                <span>Jawaban</span>
                                                                            </div>
                                                                            <div class="col-md-9">
                                                                                <div class="pertanyaan">
                                                                                    <fieldset class="form-group">
                                                                                        <label>Jawaban 1</label>
                                                                                        <textarea class="form-control jawaban" rows="3" placeholder="Deskripsi Jawaban" name="jawaban[0]"></textarea>
                                                                                        <div class="vs-radio-con">
                                                                                            <input type="radio" name="benar" value="0">
                                                                                            <span class="vs-radio">
                                                                                                <span class="vs-radio--border"></span>
                                                                                                <span class="vs-radio--circle"></span>
                                                                                            </span>
                                                                                            <span class="">Jawaban Benar</span>
                                                                                        </div>
                                                                                    </fieldset>
                                                                                </div>
                                                                                <button type="button" class="btn btn-success tambah-pertanyaan"><i class="feather icon-plus"></i> Tambah Opsi</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="benar-salah">
                                                                        <div class="form-group row">
                                                                            <div class="col-md-3">
                                                                                <span>Jawaban</span>
                                                                            </div>
                                                                            <div class="col-md-9">
                                                                                <div class="pertanyaan">
                                                                                    <fieldset class="form-group">
                                                                                        <label>Jawaban 1</label>
                                                                                        <textarea class="form-control jawaban" rows="3" placeholder="Deskripsi Jawaban" name="benarsalah[1]">Benar</textarea>
                                                                                        <div class="vs-radio-con">
                                                                                            <input type="radio" name="benar" value="1">
                                                                                            <span class="vs-radio">
                                                                                                <span class="vs-radio--border"></span>
                                                                                                <span class="vs-radio--circle"></span>
                                                                                            </span>
                                                                                            <span class="">Jawaban Benar</span>
                                                                                        </div>
                                                                                    </fieldset>
                                                                                    <fieldset class="form-group">
                                                                                        <label>Jawaban 2</label>
                                                                                        <textarea class="form-control jawaban" rows="3" placeholder="Deskripsi Jawaban" name="benarsalah[0]">Salah</textarea>
                                                                                        <div class="vs-radio-con">
                                                                                            <input type="radio" name="benar" value="0">
                                                                                            <span class="vs-radio">
                                                                                                <span class="vs-radio--border"></span>
                                                                                                <span class="vs-radio--circle"></span>
                                                                                            </span>
                                                                                            <span class="">Jawaban Benar</span>
                                                                                        </div>
                                                                                    </fieldset>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="sebab-akibat">
                                                                        <div class="form-group row">
                                                                            <div class="col-md-3">
                                                                                <span>Jawaban</span>
                                                                            </div>
                                                                            <div class="col-md-9">
                                                                                <div class="pertanyaan">
                                                                                    <fieldset class="form-group">
                                                                                        <label>Jawaban 1</label>
                                                                                        <textarea class="form-control jawaban" rows="3" placeholder="Deskripsi Jawaban" name="sebabakibat[0]">Pernyataan (1) adalah penyebab dan pernyataan (2) adalah akibat</textarea>
                                                                                        <div class="vs-radio-con">
                                                                                            <input type="radio" name="benar" value="0">
                                                                                            <span class="vs-radio">
                                                                                                <span class="vs-radio--border"></span>
                                                                                                <span class="vs-radio--circle"></span>
                                                                                            </span>
                                                                                            <span class="">Jawaban Benar</span>
                                                                                        </div>
                                                                                    </fieldset>
                                                                                    <fieldset class="form-group">
                                                                                        <label>Jawaban 2</label>
                                                                                        <textarea class="form-control jawaban" rows="3" placeholder="Deskripsi Jawaban" name="sebabakibat[1]">Pernyataan (2) adalah penyebab dan pernyataan (1) adalah akibat</textarea>
                                                                                        <div class="vs-radio-con">
                                                                                            <input type="radio" name="benar" value="1">
                                                                                            <span class="vs-radio">
                                                                                                <span class="vs-radio--border"></span>
                                                                                                <span class="vs-radio--circle"></span>
                                                                                            </span>
                                                                                            <span class="">Jawaban Benar</span>
                                                                                        </div>
                                                                                    </fieldset>
                                                                                    <fieldset class="form-group">
                                                                                        <label>Jawaban 3</label>
                                                                                        <textarea class="form-control jawaban" rows="3" placeholder="Deskripsi Jawaban" name="sebabakibat[2]">Pernyataan (1) dan (2) adalah penyebab, namun tidak saling berhubungan</textarea>
                                                                                        <div class="vs-radio-con">
                                                                                            <input type="radio" name="benar" value="2">
                                                                                            <span class="vs-radio">
                                                                                                <span class="vs-radio--border"></span>
                                                                                                <span class="vs-radio--circle"></span>
                                                                                            </span>
                                                                                            <span class="">Jawaban Benar</span>
                                                                                        </div>
                                                                                    </fieldset>
                                                                                    <fieldset class="form-group">
                                                                                        <label>Jawaban 4</label>
                                                                                        <textarea class="form-control jawaban" rows="3" placeholder="Deskripsi Jawaban" name="sebabakibat[3]">Pernyataan (1) dan (2) adalah akibat dari dua penyebab yang tidak saling berhubungan</textarea>
                                                                                        <div class="vs-radio-con">
                                                                                            <input type="radio" name="benar" value="3">
                                                                                            <span class="vs-radio">
                                                                                                <span class="vs-radio--border"></span>
                                                                                                <span class="vs-radio--circle"></span>
                                                                                            </span>
                                                                                            <span class="">Jawaban Benar</span>
                                                                                        </div>
                                                                                    </fieldset>
                                                                                    <fieldset class="form-group">
                                                                                        <label>Jawaban 5</label>
                                                                                        <textarea class="form-control jawaban" rows="3" placeholder="Deskripsi Jawaban" name="sebabakibat[4]">Pernyataan (1) dan (2) adalah akibat dari suatu penyebab yang sama</textarea>
                                                                                        <div class="vs-radio-con">
                                                                                            <input type="radio" name="benar" value="4">
                                                                                            <span class="vs-radio">
                                                                                                <span class="vs-radio--border"></span>
                                                                                                <span class="vs-radio--circle"></span>
                                                                                            </span>
                                                                                            <span class="">Jawaban Benar</span>
                                                                                        </div>
                                                                                    </fieldset>
                                                                                </div>
                                                                            </div>
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

    <!-- Modal -->
    <div class="modal fade" id="modalTambahGrup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Grup Soal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('dosen.soal.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="storeGrup" value="1">
                    <input type="hidden" name="idPaket" value="{{ $data->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                          <label for="nama">Nama</label>
                          <input type="text" name="nama" class="form-control" placeholder="Nama Grup Soal" autofocus>
                        </div>
                        <div class="form-group float-right">
                            <button type="submit" class="btn btn-success"><i class="feather icon-check"></i> Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalUbahGrup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judul-modal-grup">Ubah Grup Soal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('dosen.soal.update', 1) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" id="id">
                    <div class="modal-body">
                        <div class="form-group">
                          <label for="nama">Nama</label>
                          <input type="text" name="nama" id="nama-grup" class="form-control" placeholder="Nama Grup Soal" autofocus>
                        </div>
                        <div class="form-group float-right">
                            <button type="submit" class="btn btn-success"><i class="feather icon-check"></i> Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('dosen.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>File Excel</label>
                            <input type="file" name="file" class="form-control">
                            <input type="hidden" name="id" value="{{ $soal }}">
                        </div>

                        <hr>
                        
                        <p>Sebelum mengunggah pastikan file yang akan anda unggah sudah dalam bentuk Ms. Excel dan format penulisan harus sesuai dengan yang telah ditentukan.</p>
                        <strong>Grup wajib diisi sebelum memulai menulis soal</strong><br>
                        <strong>Soal wajib diisi sebelum memulai menulis deskripsi jawaban</strong><br>
                        <strong>Jawaban dapat diisi lebih dari 1 dan disertai dengan hasil Benar atau Salah</strong><br><br>
                        
                        <label>Ketentuan Data</label>
                        
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>jenis</th>
                                        <th>deskripsi</th>
                                        <th>modelSoal</th>
                                        <th>hasil</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Wajib diisi | Mengikuti format list yang telah ditentukan (Grup, Soal, Jawaban)</td>
                                        <td>Wajib diisi | Nama Grup / Nama Soal / Deskripsi Opsi Jawaban</td>
                                        <td>Wajib diisi | Hanya untuk soal (Pilihan Ganda/Esai)</td>
                                        <td>Wajib diisi (Hanya pilihan ganda) | Hanya diisi pada Tipe Jawaban (Benar/Salah)</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <a href="#" class="btn btn-success">Download Format</a>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.pertanyaansoal').summernote({
                height: 200
            });
            $('.jawaban').summernote({
                height: 100
            });

            $('#benar-salah').hide();
            $('#sebab-akibat').hide();
            $('#data-jawaban').hide();
            if ($('input[name="modelSoal"]:checked').val() == 1) {
                $('#data-jawaban').show();
            }
            if ($('input[name="modelSoal"]:checked').val() == 2) {
                $('#sebab-akibat').show();
            }
            if ($('input[name="modelSoal"]:checked').val() == 3) {
                $('#benar-salah').show();
            }
        });

        $(document).ready(function() {
            $(document).on('click', 'input[name="modelSoal"]:checked', function() {
                var id = $(this).val();
                $('#data-jawaban').hide();
                $('#benar-salah').hide();
                $('#sebab-akibat').hide();
                if (id == 1) {
                    $('#data-jawaban').show();
                }
                if (id == 2) {
                    $('#sebab-akibat').show();
                }
                if (id == 3) {
                    $('#benar-salah').show();
                }
            });
        });

        $(document).on('click', '.modalSoal', function(e) {
            var id = $(this).attr('data-value');
            $('#idGrup').val(id);
        });

        var digit = 1;
        var no = 2;
        $(document).on('click', '.tambah-pertanyaan', function(e) {
            $('.pertanyaan').append(`<fieldset class="form-group">
                                        <label>Jawaban `+ no +`</label>
                                        <textarea class="form-control pertanyaan`+ digit +`" rows="3" placeholder="Deskripsi Jawaban" name="jawaban[`+ digit +`]"></textarea>
                                        <div class="vs-radio-con">
                                            <input type="radio" name="benar" value="`+ digit +`">
                                            <span class="vs-radio">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <span class="">Jawaban Benar</span>
                                        </div>
                                    </fieldset>`);

            $('.pertanyaan'+ digit).summernote({
                height: 100
            });

            digit++;
            no++;
        });

        $(document).on('click', '.modalUbahGrup', function(e) {
            var id = $(this).attr('data-value');
            var nama = $(this).attr('data-nama');
            $('#nama-grup').val(nama);
            $('#id').val(id);
        });

        $(document).on('click', '.hapus', function () {
            id = $(this).parent('form');
            Swal.fire({
                title: 'Yakin ingin hapus?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                confirmButtonClass: 'btn btn-primary',
                cancelButtonText: 'Tidak',
                cancelButtonClass: 'btn btn-danger ml-1',
                buttonsStyling: false,
            }).then(function (result) {
                if (result.value) {
                    Swal.fire({
                        type: "success",
                        title: 'Terhapus!',
                        text: 'Data telah dihapus.',
                        timer: 1000,
                        showConfirmButton: false
                    });
                    id.submit();
                }
            })
        });

        $(document).on('change', '#gambar', function(event) {
            if (document.getElementById("gambar").files.length == 0) {
                $('#inputGroupFile01').text('Pilih Gambar');
            } else {
                var FileSize = document.getElementById("gambar").files[0].size / 1024 / 1024;
                if (FileSize > 2) {
                    Swal.fire({
                        type: "error",
                        title: 'Gagal!',
                        text: 'Gambar tidak boleh lebih dari 2 MB',
                        timer: 1000,
                        showConfirmButton: false
                    });
                    $('#inputGroupFile01').text('Pilih Gambar');
                }
            }
        });
    </script>
@endsection