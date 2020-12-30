@extends('layout')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
@endsection

@section('judul')
    Data Paket Soal
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
            </div>
        </div>

        <div class="card-content">
            <div class="card-body">
                @if (count($paket) > 0)
                    <div class="table-responsive">
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
                                        <td>
                                            @if ($item->tanggal_awal.' '.$item->waktu_awal < date('Y-m-d H:i:s') && $item->tanggal_akhir.' '.$item->waktu_akhir > date('Y-m-d H:i:s') && $item->status == 1)
                                                <h5><span class="badge badge-success">Ujian sedang berlangsung</span></h5>
                                            @else
                                                <form action="{{ route('dosen.paket.destroy', $item->id) }}" class="form" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn badge badge-lg badge-warning" data-toggle="modal" data-target="#modalUbah" data-value="{{ $item->id }}"><i class="feather icon-edit-1"></i></button>
                                                    <button type="button" class="btn badge badge-lg badge-danger hapus"><i class="feather icon-trash-2"></i></button>
                                                </form>
                                            @endif
                                        </td>
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
                    @if (count($data) > 0)
                        <form action="{{ route('dosen.paket.store') }}" method="POST">
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
                                            <label for="">Tanggal Awal</label>
                                            <input type="date" class="form-control tanggal_awal" name="tanggal_awal" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label for="">Tanggal Akhir</label>
                                            <input type="date" class="form-control tanggal_akhir" name="tanggal_akhir" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label for="">Waktu Awal</label>
                                            <input type="time" class="form-control waktu_awal" name="waktu_awal" value="00:00" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label for="">Waktu Akhir</label>
                                            <input type="time" class="form-control waktu_akhir" name="waktu_akhir" value="23:59" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label for="">Bobot Nilai Benar</label>
                                            <input type="number" class="form-control" name="bobot_benar" placeholder="1, 2, 3, dsb" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label for="">Bobot Nilai Salah</label>
                                            <input type="number" class="form-control" name="bobot_salah" placeholder="0, -1, -2, dsb" required>
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
                    @else
                        <div class="error-template text-center">
                            <h1><i class="feather icon-slash"></i></h1>
                            <h2>Anda Tidak Memiliki Kelas</h2>
                        </div> 
                    @endif
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
                    <form id="update" method="POST">
                        @csrf
                        @method('PATCH')
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
                                        <label for="">Tanggal Awal</label>
                                        <input type="date" class="form-control" name="tanggal_awal" id="tanggal_awal" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="">Tanggal Akhir</label>
                                        <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="">Waktu Awal</label>
                                        <input type="time" class="form-control" name="waktu_awal" id="waktu_awal" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="">Waktu Akhir</label>
                                        <input type="time" class="form-control" name="waktu_akhir" id="waktu_akhir" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="">Bobot Nilai Benar</label>
                                        <input type="number" class="form-control" name="bobot_benar" id="bobot_benar" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="">Bobot Nilai Salah</label>
                                        <input type="number" class="form-control" name="bobot_salah" id="bobot_salah" required>
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

            $(document).on('change', '.tanggal_awal', function(e) {
                $('.tanggal_akhir').val('');
                $('.tanggal_akhir').attr('min', $('.tanggal_awal').val());
            });

            $(document).on('change', '#tanggal_awal', function(e) {
                $('#tanggal_akhir').val('');
                $('#tanggal_akhir').attr('min', $('#tanggal_awal').val());
            });

            $(document).on('change', '.waktu_awal', function(e) {
                $('.waktu_akhir').val('');
                reset_waktu();
            });
            $(document).on('change', '.waktu_akhir', function(e) {
                reset_waktu();
            });
            function reset_waktu() {
                if ($('.tanggal_awal').val() == $('.tanggal_akhir').val()) {
                    if ($('.waktu_awal').val() > $('.waktu_akhir').val()) {
                        $('.waktu_akhir').val('');
                    }
                }
            }

            $(document).on('change', '#waktu_awal', function(e) {
                $('#waktu_akhir').val('');
                reset_waktu();
            });
            $(document).on('change', '#waktu_akhir', function(e) {
                reset_waktu();
            });
            function reset_waktu() {
                if ($('#tanggal_awal').val() == $('#tanggal_akhir').val()) {
                    if ($('#waktu_awal').val() > $('#waktu_akhir').val()) {
                        $('#waktu_akhir').val('');
                    }
                }
            }

            $(document).on('click', '.table-striped tbody tr td button', function(e) {
                var id = $(this).attr('data-value');
                console.log(id);
                $.get( "/pengampu/paket/" + id, function( data ) {
                    console.log(JSON.parse(data));
                    var d = JSON.parse(data);
                    $('#storeData').attr("action", "/pengampu/soal/"+ d.id);
                    $('#exampleModalLabel').text("Ubah Paket Soal | "+ d.nama);
                    $('#id').val(d.id);
                    $('#nama').val(d.nama);
                    $('#durasi').val(d.durasi);
                    $('#tanggal_awal').val(d.tanggal_awal);
                    $('#tanggal_akhir').val(d.tanggal_akhir);
                    $('#waktu_awal').val(d.waktu_awal);
                    $('#waktu_akhir').val(d.waktu_akhir);
                    $('#bobot_benar').val(d.bobot_benar);
                    $('#bobot_salah').val(d.bobot_salah);
                    $('#deskripsi').val(d.deskripsi);
                    $('#idKelas').select2().val(d.idKelas).trigger('change');
                    $('#update').attr("action", "/pengampu/paket/"+ d.id);
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