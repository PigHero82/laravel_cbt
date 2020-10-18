@extends('layout')

@section('judul')
    Data Kelas
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
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
            <div class="d-inline">
                <h3>Daftar Kelas</h3>
            </div>
            <div class="d-inline">
                <button type="button" data-toggle="modal" data-target="#modalTambah" class="btn btn-success px-1"><i class="feather icon-plus"></i> Tambah</button>
                <button type="button" data-toggle="modal" data-target="#modalExcel" class="btn btn-primary px-1"><i class="feather icon-upload"></i> Upload Excel</button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if (count($data) > 0)
                <div class="table-responsive">
                    <table id="myTable" class="table zero-configuration table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Kelas</th>
                                <th>Dosen</th>
                                <th>Jumlah Mahasiswa</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td><a href="#modalKelasMahasiswa" data-toggle="modal" data-kelas="{{ $item->id }}">{{ $item->kode }} | {{ $item->nama }}</a></td>
                                    <td>{{ $item->dosen }}</td>
                                    <td>{{ $item->jumlah }} Orang</td>
                                    <td>
                                        <form action="{{ route('admin.portal.detail.destroy', $item->id) }}" class="form" method="post">
                                            @csrf
                                            @method('DELETE')
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

    <!-- Modal -->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form action="{{ route('admin.portal.kelas.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" name="kode" maxlength="3" class="form-control" placeholder="Kode Kelas (Contoh : A, B, DB, dsb.)" required>
                        </div>
    
                        <div class="form-group">
                            <label>Mata Kuliah</label>
                            <select name="idMataKuliah" class="form-control select">
                                @foreach ($matakuliah as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="form-group">
                            <label>Dosen</label>
                            <select name="idDosen" class="form-control select">
                                @foreach ($dosen as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
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
                    <h5 class="modal-title" id="judulModal">Ubah Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form action="{{ route('admin.portal.kelas.update', 1) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="text" name="id" id="id" hidden>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" name="kode" id="kode" maxlength="3" class="form-control" placeholder="Kode Kelas (Contoh : A, B, DB, dsb.)" required>
                        </div>
    
                        <div class="form-group">
                            <label>Mata Kuliah</label>
                            <select name="idMataKuliah" class="form-control" id="idMataKuliah">
                                @foreach ($matakuliah as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="form-group">
                            <label>Dosen</label>
                            <select name="idDosen" class="form-control" id="idDosen">
                                @foreach ($dosen as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>    

    <!-- Modal -->
    <div class="modal fade" id="modalKelasMahasiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judulKelasModal">Detail Kelas | </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="form-group">
                        <label>Dosen</label>
                        <input readonly type="text" name="kode" id="dosen" class="form-control" placeholder="Dosen">
                    </div>

                    <table class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                            </tr>
                        </thead>
                        <tbody id="mahasiswa">
                        </tbody>
                    </table>
                </div>
                
                <div class="modal-footer" id="button">
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
            $('.zero-configuration').DataTable();
            
            $('form').submit(function() {
                $(this).find("button[type='submit']").prop('disabled', true);
            });

            $(".select").select2({
                dropdownAutoWidth: true,
                width: '100%'
            });
            
            $(document).on('click', '#myTable tbody tr td button', function(e) {
                var id = $(this).attr('data-value');
                console.log(id);
                $.get( "/admin/portal/kelas/" + id, function( data ) {
                    console.log(JSON.parse(data));
                    var d = JSON.parse(data);
                    $('#judulModal').text("Ubah Kelas | "+ d.kode +"-"+ d.nama);
                    $('#id').val(d.id);
                    $('#kode').val(d.kode);
                    $('#idMataKuliah').select2().val(d.idMataKuliah).trigger('change');
                    $('#idDosen').select2().val(d.idDosen).trigger('change');;
                });
            });
            
            $(document).on('click', '#myTable tbody tr td a', function(e) {
                var id = $(this).attr('data-kelas');
                $.get( "/admin/portal/kelas/" + id, function( data ) {
                    console.log(JSON.parse(data));
                    var d = JSON.parse(data);
                    $('#judulKelasModal').text("Detail Kelas | "+ d.kode +"-"+ d.nama);
                    $('#dosen').val(d.dosen);
                    $('#button').html('<a href="/admin/portal/kelas/detail/'+ d.id +'" class="btn btn-primary">Lihat Detail</a>');
                });
                $.get( "/admin/portal/kelas/detail/" + id +"/edit", function( data ) {
                    console.log(JSON.parse(data));
                    var d = JSON.parse(data);
                    $('#mahasiswa tr').remove();
                    for (var i = 0; i < d.length; i++) { 
                        if (d[i].nama !== "Kosong") {
                            $('#mahasiswa').append(
                                                `<tr>
                                                    <td>`+ d[i].nim +`</td>
                                                    <td>`+ d[i].nama +`</td>
                                                </tr>`);
                        }
                    }
                });
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