@extends('layout')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
@endsection

@section('judul')
    Data Paket Soal
@endsection

@section('content')
    @if ($message = Session::get('danger'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert"><i class="feather icon-x"></i></button>
        {{ $message }}
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Paket Soal</h4>
        </div>

        <div class="card-content">
            <div class="card-body">
                @if (count($data) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    @if (Auth::user()->hasRole('admin'))
                                        <th>Kelas</th>
                                        <th>Pengampu</th>
                                    @endif
                                    <th>Paket</th>
                                    <th>Jumlah Soal</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Durasi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        @if (Auth::user()->hasRole('admin'))
                                            <td>{{ $item->kode }}</td>
                                            <td>{{ $item->name }}</td>
                                        @endif
                                        <td><a href="{{ route(Auth::user()->hasRole('admin') ? 'admin.laporan.show' : 'dosen.laporan.show', $item->id) }}">{{ $item->nama }}</a></td>
                                        <td>{{ $item->jumlah }} Soal</td>
                                        <td>
                                            @if ($item->tanggal_awal == $item->tanggal_akhir)
                                                {{ Carbon\Carbon::parse($item->tanggal_awal)->formatLocalized('%d %B %Y') }}
                                            @else
                                                {{ Carbon\Carbon::parse($item->tanggal_awal)->formatLocalized('%d %B %Y') }} - {{ Carbon\Carbon::parse($item->tanggal_akhir)->formatLocalized('%d %B %Y') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->waktu_awal == '00:00:00' && $item->waktu_akhir == '23:59:00')
                                                -
                                            @else
                                                {{ Carbon\Carbon::parse($item->waktu_awal)->formatLocalized('%H:%M') }} - {{ Carbon\Carbon::parse($item->waktu_akhir)->formatLocalized('%H:%M') }}
                                            @endif
                                        </td>
                                        <td><div disabled class="badge badge-md badge-danger">{{ $item->durasi }} Menit</div></td>
                                        @if ($item->tanggal_awal.' '.$item->waktu_awal < date('Y-m-d H:i:s') && $item->tanggal_akhir.' '.$item->waktu_akhir > date('Y-m-d H:i:s'))
                                            <td><h5><span class="badge badge-primary">Ujian sedang berlangsung</span></h5></td>
                                        @elseif ($item->tanggal_akhir.' '.$item->waktu_akhir < date('Y-m-d H:i:s'))
                                            <td><h5><span class="badge badge-success">Ujian telah selesai</span></h5></td>
                                        @else
                                        <td><h5><span class="badge badge-danger">Ujian belum dimulai</span></h5></td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="error-template text-center">
                        <h1><i class="feather icon-slash"></i></h1>
                        <h2>Tidak Ada Data</h2>
                    </div> 
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('.table-striped').DataTable();
        } );
    </script>
@endsection