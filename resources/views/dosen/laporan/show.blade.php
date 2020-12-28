@extends('layout')

@section('judul')
    Hasil Tes
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
@endsection

@section('content')
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
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <h6 class="filter-heading d-none d-lg-block">Peserta</h6>
                <div class="card">
                    <div class="card-header">
                        <h3 class="d-inline">Hasil Tes</h3>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('dosen.laporan.jawaban.show', $data->id) }}"><i class="feather icon-file-text"></i> Lihat Jawaban Peserta</a>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- @if (count($grup) > 0)
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
                        @endif --}}
                        <div class="table-responsive">
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mahasiswa as $item)
                                        <tr>
                                            <td>{{ $item->nim }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ number_format($item->nilai/$total * 100, 2) }}</td>
                                        </tr>                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('.zero-configuration').DataTable();
        } );
    </script>
@endsection