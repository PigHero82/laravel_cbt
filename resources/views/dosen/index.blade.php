@extends('layout')

@section('indexactive')
    active
@endsection

@section('judul')
    Dashboard
@endsection

@section('content')
    @if(session()->get('success'))
        <div class ="alert alert-success">
            {{ session()->get('success') }}  
        </div><br />
    @endif

    <div class="row">
        <div class="col-xl-3 col-md-4 col-sm-6">
            <a href="{{ route('dosen.mahasiswa') }}">
                <div class="card text-center">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="avatar bg-rgba-success p-50 m-0 mb-1">
                                <div class="avatar-content">
                                    <i class="feather icon-user text-success font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700">{{ $mahasiswa }}</h2>
                            <p class="mb-0 line-ellipsis text-dark">Jumlah Mahasiswa</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <a href="{{ route('dosen.mahasiswa') }}">
                <div class="card text-center">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="avatar bg-rgba-info p-50 m-0 mb-1">
                                <div class="avatar-content">
                                    <i class="feather icon-home text-info font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700">{{ $kelas }}</h2>
                            <p class="mb-0 line-ellipsis text-dark">Jumlah Kelas</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <a href="{{ route('dosen.paket.index') }}">
                <div class="card text-center">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="avatar bg-rgba-warning p-50 m-0 mb-1">
                                <div class="avatar-content">
                                    <i class="feather icon-file-text text-warning font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700">{{ count($paket) }}</h2>
                            <p class="mb-0 line-ellipsis text-dark">Jumlah Paket Soal</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">            
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Paket Soal</h4>
                </div>

                <div class="card-content">
                    <div class="card-body">
                        @if (count($paket) > 0)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Jumlah Soal</th>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Durasi</th>
                                        <th>Aktif</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paket as $item)
                                        <tr>
                                            <td><a href="{{ route('dosen.soal.show', $item->id) }}">{{ $item->nama }}</a></td>
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
                                            @if ( $item->status == 1)
                                                <td class="text-center"><i class="feather icon-check text-success"></i></td>
                                            @else
                                                <td class="text-center"><i class="feather icon-slash text-danger"></i></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="error-template text-center">
                                <h1><i class="feather icon-slash"></i></h1>
                                <h2>Tidak Ada Paket Soal</h2>
                            </div> 
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="feather icon-calendar"></i> Jadwal Ujian Terdekat</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection