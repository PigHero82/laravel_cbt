@extends('layout')

@section('judul')
    Data Grup Peserta
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/forms/select/select2.min.css') }}">
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

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-inline">
                        <h3>Daftar Grup Peserta</h3>
                    </div>
                    <div class="d-inline">
                        <button type="button" data-toggle="modal" data-target="#modalTambah" class="btn btn-success px-1"><i class="feather icon-plus"></i> Tambah</button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if (count($data) > 0)
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $item->nama }}</td>
                                            @if ($item->status == 1)
                                                <td><h5><span class="badge badge-success">Aktif</span></h5></td>
                                            @else
                                                <td><h5><span class="badge badge-danger">Tidak Aktif</span></h5></td>
                                            @endif
                                            <td>
                                                <form action="{{ route('admin.portal.grup-peserta.destroy', $item->id) }}" class="form" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" data-toggle="modal" data-target="#modalDetail" data-value="{{ $item->id }}" class="btn btn-primary px-1 detail"><i class="feather icon-eye"></i></button>
                                                    <button type="button" data-toggle="modal" data-target="#modalUbah" data-value="{{ $item->id }}" class="btn btn-warning px-1 ubah"><i class="feather icon-edit-1"></i></button>
                                                    <button type="button" class="btn btn-danger px-1 hapus"><i class="feather icon-trash-2"></i></button>
                                                </form>
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
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Grup Peserta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form action="{{ route('admin.portal.grup-peserta.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Grup Peserta" required>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalUbah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judul">Ubah Grup Peserta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="form" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Grup Peserta" required>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Ubah Grup Peserta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judul">Detail Grup</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('admin.portal.grup-peserta.detail.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">       
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="peserta">Tambah Peserta</label>
                                            <select class="js-data-example-ajax form-control" id="idPeserta"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <br>
                                            <button type="button" id="tambah_peserta" class="btn btn-primary"><i class="feather icon-plus"></i> Tambah</button>
                                        </div>
                                    </div>
                                    <table class="table" id="tabel_peserta">
                                        <thead>
                                            <tr>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div id="kosong" hidden>
                                    <div class="error-template text-center">
                                        <h1><i class="feather icon-slash"></i></h1>
                                        <h2>Tidak Ada Data</h2>
                                    </div> 
                                </div>
            
                                <div id="isi" hidden>
                                    <label>Daftar Peserta</label>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>NIM</th>
                                                    <th>Nama</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="data">
                                                <tr>
                                                    <td>17101280</td>
                                                    <td>Ida Bagus Kadek Darma Wiryatama</td>
                                                    <td>
                                                        <form action="{{ route('admin.portal.grup-peserta.destroy', $item->id) }}" class="form" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger px-1"><i class="feather icon-trash-2"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>

    <script>
        $(document).ready( function () {
            $('.zero-configuration').DataTable();

            $('form').submit(function() {
                $(this).find("button[type='submit']").prop('disabled', true);
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

            $(document).on('click', '.ubah', function(e) {
                var id = $(this).attr('data-value');
                console.log(id);
                $.get( "grup-peserta/data/" + id, function( data ) {
                    console.log(JSON.parse(data));
                    var d = JSON.parse(data);
                    $('#judul').text("Ubah Grup Peserta | "+ d.nama);
                    $('#form').attr("action", "grup-peserta/"+ d.id);
                    $('#nama').val(d.nama);
                    $('#status').val(d.status);
                });
            });

            $(document).on('click', '.detail', function(e) {
                var id = $(this).attr('data-value');
                console.log(id);
                $.get( "grup-peserta/detail/" + id, function( data ) {
                    console.log(JSON.parse(data));
                    var d = JSON.parse(data);
                    $('#id').val(id);
                    $("#kosong").attr("hidden", true);
                    $("#isi").attr("hidden", true);
                    $('#tabel_peserta tbody tr').remove();
                    
                    if (d.status == 1) {
                        $("#data tr").remove();
                        for (let i = 0; i < d['peserta'].length; i++) {
                            $("#data").append(`<tr>
                                                <td>`+ d['peserta'][i].username +`</td>
                                                <td>`+ d['peserta'][i].name +`</td>
                                                <td>
                                                    <form action="{{ url('admin/portal/grup-peserta/detail') }}/`+ d['peserta'][i].id +`" class="form" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger px-1 hapus"><i class="feather icon-trash-2"></i></button>
                                                    </form>
                                                </td>
                                            </tr>`);                           
                        }
                        $("#isi").attr("hidden", false);
                    } else {
                        $("#kosong").attr("hidden", false);
                    }
                });
            });

            $(document).on('click', '#tambah_peserta', function() {
                const id = $('#idPeserta').val();
                $.get( "{{ url('admin/portal/user/role') }}/" + id, function( data ) {
                    var d = JSON.parse(data);
                    if (d.roles.length > 0) {
                        $('#tabel_peserta tbody').append(`<tr>
                                                            <td>`+ d.username +`</td>
                                                            <td>`+ d.name +`</td>
                                                            <td><button type="button" class="btn btn-danger px-1 hapus_peserta"><i class="feather icon-trash-2"></i></button></td>
                                                            <input type="hidden" name="data[`+ d.id +`]" value="`+ d.id +`">
                                                        </tr>`)
                    }
                });
            });

            $(document).on('click', '.hapus_peserta', function() {
                $(this).parent().parent().remove();
            });

            $('.js-data-example-ajax').select2({
                placeholder: "Pilih peserta",
                dropdownAutoWidth: true,
                width: '100%',
                ajax: {
                    url: '{{ url("/admin/portal/data/kelas") }}',
                    data: function (params) {
                        var query = {
                            search: params.term,
                            page: params.page || 1
                        }

                        return query;
                    }
                }
            });
        } );
    </script>
@endsection