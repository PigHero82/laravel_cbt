@extends('layout')

@section('judul')
    Ubah Soal
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')
    @if(session()->get('success'))
        <div class ="alert alert-success">
            {{ session()->get('success') }} | <a href="{{ route('dosen.soal.show', $data->idPaket) }}">Kembali ke paket soal</a>
        </div><br />
    @endif

    <!-- account setting page start -->
    <section id="page-account-settings">
        <div class="row">
            <!-- left menu section -->
            <div class="col-md-3 mb-2 mb-md-0">
                <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                    <li class="nav-item">
                        <a class="nav-link d-flex py-75 active" href="{{ route('dosen.soal.show', $data->idPaket) }}" aria-expanded="true">
                            <i class="feather icon-chevron-left mr-50 font-medium-3"></i>
                            Kembali ke Paket
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
                                    <form class="form form-horizontal" method="POST" action="{{ route('dosen.edit-soal.update', $data->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="modelSoal" value="{{ $data->modelSoal }}">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-3">
                                                            <span>Atribut</span>
                                                        </div>
                                                        <div class="col-md-9">
                                                            @if ($data->media !== null)
                                                                <img src="{{ asset('assets/images/soal/'.$data->media) }}" class="img-thumbnail" style="height: 400px">
                                                            @else
                                                                Tidak ada gambar
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-3">
                                                            <span>Ubah Atribut</span>
                                                        </div>
                                                        <div class="col-md-9">
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
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-3">
                                                            <span>Jenis Soal</span>
                                                        </div>
                                                        <div class="col-md-9">
                                                            @if ($data->modelSoal == 1)
                                                                Pilihan Ganda
                                                            @elseif ($data->modelSoal == 2)
                                                                Sebab Akibat
                                                            @elseif ($data->modelSoal == 3)
                                                                Benar Salah
                                                            @else
                                                                Esai
                                                            @endif
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
                                                                <textarea class="form-control summernote" rows="3" placeholder="Pertanyaan" name="pertanyaan" required>{!! $data->pertanyaan !!}</textarea>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if ($data->modelSoal != 4)
                                                    @foreach ($data->pilihan as $key => $item)
                                                        <div class="col-12">
                                                            <div class="pertanyaan">
                                                                <div class="form-group row">
                                                                    <div class="col-md-3">
                                                                        <span>Jawaban {{ $key+1 }}</span>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <fieldset class="form-group">
                                                                            <textarea class="form-control summernote" rows="3" placeholder="Deskripsi Jawaban" name="jawaban[{{ $key }}]" required>{!! $item->deskripsi !!}</textarea>
                                                                            <div class="vs-radio-con">
                                                                                <input type="radio" name="benar" value="{{ $key }}" {{ $data->idPilihan == $item->id ? 'checked' : '' }}>
                                                                                <span class="vs-radio">
                                                                                    <span class="vs-radio--border"></span>
                                                                                    <span class="vs-radio--circle"></span>
                                                                                </span>
                                                                                <span class="">Jawaban Benar</span>
                                                                            </div>
                                                                        </fieldset>
                                                                    </div>
                                                                </div>

                                                                @if ($data->modelSoal == 1)
                                                                    @if ($loop->last)
                                                                        <div class="form-group row">
                                                                            <div class="col-md-3">
                                                                            </div>
                                                                            <div class="col-md-9">
                                                                                <button type="button" class="btn btn-success tambah-pertanyaan"><i class="feather icon-plus"></i> Tambah Opsi</button>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif

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
@endsection

@section('js')
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('.zero-configuration').DataTable();
        } );
    </script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200
            });
        });
    </script>
    @if ($data->modelSoal != 4)
        <script>
            var digit = {{ $key+1 }};
            var no = {{ $key+2 }};
            $(document).ready(function() {
                $(document).on('click', '.tambah-pertanyaan', function(e) {
                    $('.pertanyaan').append(`<div class="form-group row">
                                                <div class="col-md-3">
                                                    <span>Jawaban  ` + no + `</span>
                                                </div>
                                                <div class="col-md-9">
                                                    <fieldset class="form-group">
                                                        <textarea class="form-control pertanyaan`+ digit +`" rows="3" placeholder="Deskripsi Jawaban" name="jawaban[` + digit `]" required></textarea>
                                                        <div class="vs-radio-con">
                                                            <input type="radio" name="benar" value="` + digit `">
                                                            <span class="vs-radio">
                                                                <span class="vs-radio--border"></span>
                                                                <span class="vs-radio--circle"></span>
                                                            </span>
                                                            <span class="">Jawaban Benar</span>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>`);

                    digit++;
                    no++;
                });
            });
        </script>
    @endif
@endsection