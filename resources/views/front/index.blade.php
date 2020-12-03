@extends('front.layout')

@section('judul')
    Beranda
@endsection

@section('content')
    @if ($message = Session::get('danger'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert"><i class="feather icon-x"></i></button>
        {{ $message }}
    </div>
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
                            <dd class="col-lg-9">{{ Auth::user()->username }}</dd>                          
                            
                            <dt class="col-lg-3">Nama</dt>
                            <dd class="col-lg-9">{{ Auth::user()->name }}</dd>                          
                            
                            <dt class="col-lg-3">Email</dt>
                            <dd class="col-lg-9">{{ $data->email == null ? '-' : $data->email }}</dd>                          
                            
                            <dt class="col-lg-3">No HP</dt>
                            <dd class="col-lg-9">{{ $data->hp == null ? '-' : $data->hp }}</dd>

                            <dt class="col-lg-3">Alamat</dt>
                            <dd class="col-lg-9">{{ $data->alamat == null ? '-' : $data->alamat }}</dd>                     
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
                                <a class="nav-link active" id="soal-tab" data-toggle="tab" href="#soal" role="tab" aria-selected="true">Tes Saat Ini</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="riwayat-tab" data-toggle="tab" href="#riwayat" aria-controls="riwayat" role="tab" aria-selected="false">Riwayat Tes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="datang-tab" data-toggle="tab" href="#datang" aria-controls="datang" role="tab" aria-selected="false">Tes Mendatang</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="soal" aria-labelledby="soal-tab" role="tabpanel">
                                <div class="accordion" id="accordion-soal" data-toggle-hover="true">
                                    @foreach ($ujian as $item)
                                        @if ($item->tanggal_awal.' '.$item->waktu_awal <= date('Y-m-d H:i:s') && $item->tanggal_akhir.' '.$item->waktu_akhir >= date('Y-m-d-H:i:s'))
                                            @php $jumlah++ @endphp
                                            <div class="collapse-margin">
                                                <div class="card-header" id="heading{{ $item->id }}" data-toggle="collapse" role="button" data-target="#collapse{{ $item->id }}">
                                                    <span class="lead collapse-title collapsed">
                                                        {{ $item->nama }}
                                                    </span>
                                                    @if ($item->waktu != null && $item->waktu < date('Y-m-d H:i:s'))
                                                        <div class="float-right">
                                                            <div class="badge badge-danger">Waktu Habis</div>
                                                        </div>
                                                    @else
                                                        <div class="float-right">
                                                            <div class="badge badge-success">Tersedia</div>
                                                        </div>
                                                    @endif
                                                </div>
                
                                                <div id="collapse{{ $item->id }}" class="collapse" data-parent="#accordion-soal">
                                                    <div class="card-body">
                                                        {!! $item->deskripsi !!}
                                                        <hr>

                                                        <label class="font-weight-bold">Kelas</label>
                                                        <p>{{ $item->kode }}</p>

                                                        <label class="font-weight-bold">Nama Dosen</label>
                                                        <p>{{ $item->name }}</p>

                                                        <label class="font-weight-bold">Tanggal</label>
                                                        <p>{{ $item->tanggal_awal == $item->tanggal_akhir ? $item->tanggal_awal : $item->tanggal_awal.' - '.$item->tanggal_akhir }}</p>

                                                        @if (!($item->waktu_awal == "00:00:00" && $item->waktu_akhir == "23:59:00"))
                                                            <label class="font-weight-bold">Waktu</label>
                                                            <p>{{ $item->waktu_awal }} - {{ $item->waktu_akhir }}</p>
                                                        @endif

                                                        @if ($item->waktu == null)
                                                            <label class="font-weight-bold">Durasi</label>
                                                            <p>{{ $item->durasi }} Menit</p>

                                                            <div class="text-right">
                                                                <a href="{{ route('soal', $item->id) }}" class="btn btn-success"><i class="feather icon-play-circle"></i> Mulai Ujian</a>
                                                            </div>
                                                        @elseif ($item->waktu > date('Y-m-d H:i:s'))
                                                            <label class="font-weight-bold">Sisa Waktu</label>
                                                            <p>{{ number_format((strtotime($item->waktu) - strtotime(date('Y-m-d H:i:s')))/60, 0) }} Menit</p>
                                                            
                                                            <div class="text-right">
                                                                <a href="{{ route('soal', $item->id) }}" class="btn btn-success"><i class="feather icon-play-circle"></i> Lanjut</a>
                                                            </div>   
                                                        @else
                                                            <div class="text-right">
                                                                <button type="button" class="btn btn-danger" disabled><i class="feather icon-slash"></i> Waktu Habis</button>
                                                            </div>   
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($jumlah == 0)
                                            <div class="error-template text-center">
                                                <h1><i class="feather icon-slash"></i></h1>
                                                <h2>Belum Ada Data Ujian</h2>
                                            </div> 
                                        @endif
                                    @endforeach
                                    @php $jumlah = 0; @endphp
                                </div>
                            </div>
                            <div class="tab-pane" id="riwayat" aria-labelledby="riwayat-tab" role="tabpanel">
                                <div class="accordion" id="accordion-riwayat" data-toggle-hover="true">
                                    @foreach ($ujian as $item)
                                        @if ($item->tanggal_awal.' '.$item->waktu_awal <= date('Y-m-d H:i:s') && $item->tanggal_akhir.' '.$item->waktu_akhir <= date('Y-m-d-H:i:s'))
                                            @php $jumlah++ @endphp
                                            <div class="collapse-margin">
                                                <div class="card-header" id="heading{{ $item->id }}" data-toggle="collapse" role="button" data-target="#collapse{{ $item->id }}">
                                                    <span class="lead collapse-title collapsed">
                                                        {{ $item->nama }}
                                                    </span>
                                                </div>
                
                                                <div id="collapse{{ $item->id }}" class="collapse" data-parent="#accordion-riwayat">
                                                    <div class="card-body">
                                                        {!! $item->deskripsi !!}
                                                        <hr>
                                                        <label class="font-weight-bold">Kelas</label>
                                                        <p>{{ $item->kode }}</p>
                                                        <label class="font-weight-bold">Nama Dosen</label>
                                                        <p>{{ $item->name }}</p>
                                                        <label class="font-weight-bold">Tanggal</label>
                                                        <p>{{ $item->tanggal_awal == $item->tanggal_akhir ? $item->tanggal_awal : $item->tanggal_awal.' - '.$item->tanggal_akhir }}</p>
                                                        @if (!($item->waktu_awal == "00:00:00" && $item->waktu_akhir == "23:59:00"))
                                                            <label class="font-weight-bold">Waktu</label>
                                                            <p>{{ $item->waktu_awal }} - {{ $item->waktu_akhir }}</p>
                                                        @endif
                                                        <label class="font-weight-bold">Durasi</label>
                                                        <p>{{ $item->durasi }} Menit</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($jumlah == 0)
                                            <div class="error-template text-center">
                                                <h1><i class="feather icon-slash"></i></h1>
                                                <h2>Belum Ada Data Ujian</h2>
                                            </div> 
                                        @endif
                                    @endforeach
                                    @php $jumlah = 0; @endphp
                                </div>
                            </div>
                            <div class="tab-pane" id="datang" aria-labelledby="datang-tab" role="tabpanel">
                                <div class="accordion" id="accordion-datang" data-toggle-hover="true">
                                    @foreach ($ujian as $item)
                                        @if ($item->tanggal_awal.' '.$item->waktu_awal >= date('Y-m-d H:i:s') && $item->tanggal_akhir.' '.$item->waktu_akhir >= date('Y-m-d-H:i:s'))
                                            @php $jumlah++ @endphp
                                            <div class="collapse-margin">
                                                <div class="card-header" id="heading{{ $item->id }}" data-toggle="collapse" role="button" data-target="#collapse{{ $item->id }}">
                                                    <span class="lead collapse-title collapsed">
                                                        {{ $item->nama }}
                                                    </span>
                                                </div>
                
                                                <div id="collapse{{ $item->id }}" class="collapse" data-parent="#accordion-datang">
                                                    <div class="card-body">
                                                        {!! $item->deskripsi !!}
                                                        <hr>
                                                        <label class="font-weight-bold">Kelas</label>
                                                        <p>{{ $item->kode }}</p>
                                                        <label class="font-weight-bold">Nama Dosen</label>
                                                        <p>{{ $item->name }}</p>
                                                        <label class="font-weight-bold">Tanggal</label>
                                                        <p>{{ $item->tanggal_awal == $item->tanggal_akhir ? $item->tanggal_awal : $item->tanggal_awal.' - '.$item->tanggal_akhir }}</p>
                                                        @if (!($item->waktu_awal == "00:00:00" && $item->waktu_akhir == "23:59:00"))
                                                            <label class="font-weight-bold">Waktu</label>
                                                            <p>{{ $item->waktu_awal }} - {{ $item->waktu_akhir }}</p>
                                                        @endif
                                                        <label class="font-weight-bold">Durasi</label>
                                                        <p>{{ $item->durasi }} Menit</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($jumlah == 0)
                                            <div class="error-template text-center">
                                                <h1><i class="feather icon-slash"></i></h1>
                                                <h2>Belum Ada Data Ujian</h2>
                                            </div> 
                                        @endif
                                    @endforeach
                                    @php $jumlah = 0; @endphp
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection