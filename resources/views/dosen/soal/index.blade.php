@extends('layout')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/forms/select/select2.min.css') }}">
@endsection

@section('judul')
    Data Soal
@endsection

@section('content')
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert"><i class="feather icon-x"></i></button>
        {{ $message }}
    </div>
    @endif

    @if ($message = Session::get('danger'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert"><i class="feather icon-x"></i></button>
        {{ $message }}
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-block">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Paket Soal</h4>
            <div class="float-right">
                <button type="button" data-toggle="modal" data-target="#modalTambah" class="btn btn-success px-1"><i class="feather icon-plus"></i> Tambah</button>
                <button type="button" data-toggle="modal" data-target="#modalExcel" class="btn btn-primary px-1"><i class="feather icon-upload"></i> Upload Excel</button>
            </div>
        </div>

        <div class="card-content">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jumlah Soal</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Durasi</th>
                            <th>Aktif</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paket as $item)
                            <tr>
                                <td><a href="{{ route('dosen.soal.show', $item->id) }}">{{ $item->nama }}</a></td>
                                <td>xx Soal</td>
                                <td>{{ Carbon\Carbon::parse($item->tanggal)->formatLocalized('%d %B %Y') }}</td>
                                <td>{{ Carbon\Carbon::parse($item->waktuAwal)->formatLocalized('%H:%M') }} - {{ Carbon\Carbon::parse($item->waktuAkhir)->formatLocalized('%H:%M') }}</td>
                                <td><div disabled class="badge badge-md badge-danger">{{ $item->durasi }} Menit</div></td>
                                <td class="text-center"><i class="feather icon-slash text-danger"></i></td>
                                <td>
                                    <button class="btn badge badge-lg badge-warning" data-toggle="modal" data-target="#modalUbah" data-value="{{ $item->id }}"><i class="feather icon-edit-1"></i></button>
                                    <button class="btn badge badge-lg badge-danger"><i class="feather icon-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form action="{{ route('dosen.soal.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="">Nama</label>
                                        <input type="text" class="form-control" placeholder="Nama Tes" name="nama" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="">Kelas</label>
                                        <select name="idKelas" id="" class="form-control select" required>
                                            @foreach ($data as $item)
                                                <option value="{{ $item->id }}">{{ $item->kode }} | {{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="">Durasi</label>
                                        <input type="number" class="form-control" placeholder="Hitungan menit" name="durasi" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="">Tanggal</label>
                                        <input type="date" class="form-control" name="tanggal" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="">Waktu Awal</label>
                                        <input type="time" class="form-control" name="waktuAwal" value="00:00" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="">Waktu Akhir</label>
                                        <input type="time" class="form-control" name="waktuAkhir" value="23:59" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="">Deskripsi</label>
                                        <textarea class="form-control" name="alur" id="deskripsi" cols="30" rows="10" placeholder="Deskripsi Tes"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('.table-striped').DataTable();
            
            $(".select").select2({
                dropdownAutoWidth: true,
                width: '100%'
            });
        } );
    </script>
@endsection