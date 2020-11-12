@extends('layout')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paket as $item)
                                <tr>
                                    <td><a href="{{ route('dosen.paket.show', $item->id) }}">{{ $item->nama }}</a></td>
                                    <td>{{ $item->jumlah }} Soal</td>
                                    <td>{{ Carbon\Carbon::parse($item->tanggal)->formatLocalized('%d %B %Y') }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->waktuAwal)->formatLocalized('%H:%M') }} - {{ Carbon\Carbon::parse($item->waktuAkhir)->formatLocalized('%H:%M') }}</td>
                                    <td><div disabled class="badge badge-md badge-danger">{{ $item->durasi }} Menit</div></td>
                                    @if ( $item->status == 1)
                                        <td class="text-center"><i class="feather icon-check text-success"></i></td>
                                    @else
                                        <td class="text-center"><i class="feather icon-slash text-danger"></i></td>
                                    @endif
                                    <td>
                                        <form action="{{ route('dosen.soal.destroy', $item->id) }}" class="form" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn badge badge-lg badge-warning" data-toggle="modal" data-target="#modalUbah" data-value="{{ $item->id }}"><i class="feather icon-edit-1"></i></button>
                                            <button type="button" class="btn badge badge-lg badge-danger hapus"><i class="feather icon-trash-2"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="error-template text-center">
                        <h1><i class="feather icon-slash"></i></h1>
                        <h2>Tidak Ada Data</h2>
                    </div> 
                @endif
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Paket Soal</h5>
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
                                        <textarea class="form-control" name="deskripsi" cols="30" rows="10" placeholder="Deskripsi Tes"></textarea>
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
    
    <!-- Modal -->
    <div class="modal fade" id="modalUbah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Paket Soal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form action="{{ route('dosen.soal.update', 1) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="text" id="id" name="id" hidden>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="">Nama</label>
                                        <input type="text" class="form-control" placeholder="Nama Tes" name="nama" id="nama" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="">Kelas</label>
                                        <select name="idKelas" id="idKelas" class="form-control select" required>
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
                                        <input type="number" class="form-control" placeholder="Hitungan menit" name="durasi" id="durasi" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="">Tanggal</label>
                                        <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="">Waktu Awal</label>
                                        <input type="time" class="form-control" name="waktuAwal" id="waktuAwal" value="00:00" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="">Waktu Akhir</label>
                                        <input type="time" class="form-control" name="waktuAkhir" id="waktuAkhir" value="23:59" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="">Deskripsi</label>
                                        <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10" id="deskripsi" placeholder="Deskripsi Tes"></textarea>
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
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('.table-striped').DataTable();
            
            $(".select").select2({
                dropdownAutoWidth: true,
                width: '100%'
            });

            $(document).on('click', '.table-striped tbody tr td button', function(e) {
                var id = $(this).attr('data-value');
                console.log(id);
                $.get( "/dosen/soal/" + id, function( data ) {
                    console.log(JSON.parse(data));
                    var d = JSON.parse(data);
                    $('#exampleModalLabel').text("Ubah Paket Soal | "+ d.nama);
                    $('#id').val(d.id);
                    $('#nama').val(d.nama);
                    $('#durasi').val(d.durasi);
                    $('#tanggal').val(d.tanggal);
                    $('#waktuAwal').val(d.waktuAwal);
                    $('#waktuAkhir').val(d.waktuAkhir);
                    $('#idKelas').select2().val(d.idKelas).trigger('change');
                });
            });

            $('form').submit(function() {
                $(this).find("button[type='submit']").prop('disabled', true);
            });

            $(document).on('click', '.hapus', function () {
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
                        $('.form').submit();
                    }
                })
            });
        } );
    </script>
@endsection