@extends('layout')

@section('judul')
    Hasil Tes
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <style>
        .soal p {
            margin: 0%;
        }
    </style>
@endsection

@section('content')
    <div class="sidebar-shop" id="ecommerce-sidebar-toggler">
        <div class="row">
            <div class="col-md-4">
                <h6 class="filter-heading d-none d-lg-block">Detail Tes</h6>
                <div class="card">
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-lg-4">Pengampu</dt>
                            <dd class="col-lg-8">{{ $cek->name }}</dd>                          
                            
                            <dt class="col-lg-4">No Induk</dt>
                            <dd class="col-lg-8">{{ $cek->username }}</dd>                          
                            
                            <dt class="col-lg-4">Nama Kelas</dt>
                            <dd class="col-lg-8" id="name-text">{{ $data->nama }}</dd>                          
                            
                            <dt class="col-lg-4">Kelas</dt>
                            <dd class="col-lg-8" id="code-text">{{ $data->kode }}</dd>
                            
                            <dt class="col-lg-4">Tanggal</dt>
                            <dd class="col-lg-8" id="address-text">
                                @if ($data->tanggal_awal == $data->tanggal_akhir)
                                    {{ Carbon\Carbon::parse($data->tanggal_awal)->formatLocalized('%d %B %Y') }}
                                @else
                                    {{ Carbon\Carbon::parse($data->tanggal_awal)->formatLocalized('%d %B %Y') }} - {{ Carbon\Carbon::parse($data->tanggal_akhir)->formatLocalized('%d %B %Y') }}
                                @endif
                            </dd>                          
                            
                            @if ($data->waktu_awal !== '00:00:00' && $data->waktu_akhir !== '23:59:00')
                                <dt class="col-lg-4">Waktu</dt>
                                <dd class="col-lg-8" id="bank-text">
                                    {{ Carbon\Carbon::parse($data->waktu_awal)->formatLocalized('%H:%M') }} - {{ Carbon\Carbon::parse($data->waktu_akhir)->formatLocalized('%H:%M') }}
                                </dd>
                            @endif

                            <dt class="col-lg-4">Durasi</dt>
                            <dd class="col-lg-8" id="bank-text">{{ $data->durasi }} Menit</dd>
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
                            <a class="btn btn-primary" href="{{ route(Auth::user()->hasRole('admin') ? 'admin.laporan.jawaban.show' : 'dosen.laporan.jawaban.show', $data->id) }}"><i class="feather icon-file-text"></i> Lihat Jawaban Peserta</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No Induk</th>
                                        <th>Nama</th>
                                        <th>Nilai</th>
                                        <th>Status</th>
                                        @if (Auth::user()->hasRole('pengampu'))
                                            <th></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mahasiswa as $item)
                                        <tr>
                                            <td>{{ $item->nim }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ number_format($item->nilai/$total * 100, 2) }}</td>
                                            <td>
                                                @if ($item->status > 0)
                                                    <span class="badge badge-md badge-danger">{{ $item->status }} Jawaban belum dikoreksi</span>
                                                @elseif ($item->status === 0)
                                                    <span class="badge badge-md badge-success">Jawaban telah dikoreksi</span>
                                                @elseif ($item->status == NULL)
                                                    <span class="badge badge-md badge-danger">Belum memulai ujian</span>
                                                @endif
                                            </td>
                                            @if (Auth::user()->hasRole('pengampu'))
                                                <td>
                                                    @if ($item->status !== NULL)
                                                        <button type="button" class="btn btn-primary px-1" data-toggle="tooltip" data-placement="bottom" data-original-title="Koreksi Jawaban">
                                                            <i class="feather icon-edit-2" data-toggle="modal" data-target="#modalKoreksi" data-value="{{ $item->id }}" data-id="{{ $data->id }}"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            @endif
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

    <!-- Modal -->
    <div class="modal fade" id="modalKoreksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hasil Jawaban Peserta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form action="{{ route('dosen.laporan.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Pertanyaan</th>
                                        <th>Jawaban</th>
                                        <th style="width: 20%"></th>
                                    </tr>
                                </thead>
                                <tbody id="data">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="feather icon-check"></i> Simpan</button>
                    </div>
                </form>
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

        $(document).on('click', 'table tbody tr td button i', function(e) {
            var id = $(this).attr('data-value');
            var paket = $(this).attr('data-id');
            console.log(id);
            $.get( "data/" + paket + "/" + id, function( data ) {
                console.log(JSON.parse(data));
                var d = JSON.parse(data);
                $('#data tr').remove();
                for (let i = 0; i < d.length; i++) {
                    if (d[i].modelSoal == 4) {
                        var soal = d[i].jawaban_esai;
                    } else {
                        var soal = d[i].deskripsi;
                    }

                    if (soal == null) {
                        soal = "Belum Terjawab";
                    }

                    if (d[i].benar == null) {
                        var benar = `<select name="data[`+ d[i].id +`]" class="form-control">
                                        <option value="" hidden>- Pilih Hasil -</option>
                                        <option value="`+ d[i].id +`/1">Benar</option>
                                        <option value="`+ d[i].id +`/0">Salah</option>
                                    </select>`;
                    } else {
                        var benar = `<input type="text" class="form-control" value="`+ d[i].benar +`" disabled>`;
                    }

                    $('#data').append(`<tr>
                                            <td>`+ d[i].pertanyaan +`</td>
                                            <td class="soal">`+ soal +`</td>
                                            <td>`+ benar +`</td>
                                        </tr>`);
                }
            });
        });
    </script>
    
@endsection