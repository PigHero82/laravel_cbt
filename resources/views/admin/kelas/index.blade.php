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
                                <th>Prodi</th>
                                <th>Jumlah Mahasiswa</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td><a href="#modalKelasMahasiswa" data-toggle="modal" data-kelas="{{ $item->id }}">{{ $item->kode }} | {{ $item->nama }}</a></td>
                                    <td>{{ $item->dosen }}</td>
                                    <td>{{ $item->prodi }}</td>
                                    <td>{{ $item->jumlah }} Orang</td>
                                    <td>
                                        <form action="{{ route('admin.portal.kelas.destroy', $item->id) }}" id="form-{{ $item->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" data-toggle="modal" data-target="#modalUbah" data-value="{{ $item->id }}" class="btn btn-warning px-1"><i class="feather icon-edit-1"></i></button>
                                            <button type="button" class="btn btn-danger px-1 hapus" data-value="{{ $item->id }}"><i class="feather icon-trash-2"></i></button>
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
                        @if (count($matakuliah) == 0)
                            <div class="error-template text-center">
                                <h1><i class="feather icon-slash"></i></h1>
                                <h2>Tidak ada Mata Kuliah</h2>
                            </div> 
                        @elseif(count($dosen) == 0)
                            <div class="error-template text-center">
                                <h1><i class="feather icon-slash"></i></h1>
                                <h2>Tidak Ada Pengampu</h2>
                            </div>
                        @elseif(count($prodi) == 0)
                            <div class="error-template text-center">
                                <h1><i class="feather icon-slash"></i></h1>
                                <h2>Tidak Ada Prodi</h2>
                            </div>
                        @else
                            <div class="form-group">
                                <label>Kode</label>
                                <input type="text" name="kode" maxlength="3" class="form-control" placeholder="Kode Kelas (Contoh : A, B, DB, dsb.)" required>
                            </div>
        
                            <div class="form-group">
                                <label>Program Studi</label>
                                <select name="idProdi" class="form-control idProdi" id="idProdi">
                                    <option value="" hidden>-- Pilih Prodi --</option>
                                    @foreach ($prodi as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
        
                            <div class="form-group">
                                <label>Mata Kuliah</label>
                                <select name="idMataKuliah" class="form-control idMataKuliah" required></select>
                            </div>
        
                            <div class="form-group">
                                <label>Pengampu</label>
                                <select name="idDosen" class="form-control select">
                                    @foreach ($dosen as $item)
                                        <option value="{{ $item->id }}">{{ $item->username }} | {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
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
                            <label>Program Studi</label>
                            <select name="idProdi" class="form-control idProdi">
                                <option value="" hidden>-- Pilih Prodi --</option>
                                @foreach ($prodi as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="form-group">
                            <label>Mata Kuliah</label>
                            <select name="idMataKuliah" id="idMataKuliah" class="form-control idMataKuliah" required></select>
                        </div>
    
                        <div class="form-group">
                            <label>Pengampu</label>
                            <select name="idDosen" id="idDosen" class="form-control select">
                                @foreach ($dosen as $item)
                                    <option value="{{ $item->id }}">{{ $item->username }} | {{ $item->name }}</option>
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
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judulKelasModal">Detail Kelas | </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 border-right">
                            <p id="dosen">Pengampu :</p>

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

                        <div class="col-md-4">
                            <form action="{{ route('admin.portal.detail.store') }}" method="post" class="mb-2">
                                @csrf
                                <input type="hidden" name="idKelas" class="idKelas">
                                
                                <div class="form-group">
                                    <label for="peserta">Tambah Peserta</label>
                                    <select class="js-data-example-ajax form-control" name="idMahasiswa" required></select>
                                </div>
        
                                <button type="submit" class="btn btn-success"><i class="feather icon-check"></i> Tambah</button>
                            </form>

                            @if (count($grup) > 0)
                                <form action="{{ route('admin.portal.detail.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="idKelas" class="idKelas">
                                    
                                    <div class="form-group">
                                        <label>Tambah Peserta Berdasarkan Grup</label>
                                        <select name="idGrup" class="select form-control" required>
                                            @foreach ($grup as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
            
                                    <button type="submit" class="btn btn-success"><i class="feather icon-check"></i> Tambah Dengan Grup</button>
                                </form>
                            @endif
                        </div>
                    </div>
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
            
            $(document).on('click', '#myTable tbody tr td button', function(e) {
                var id = $(this).attr('data-value');
                $.get( "kelas/" + id, function( data ) {
                    var d = JSON.parse(data);
                    $('#judulModal').text("Ubah Kelas | "+ d.kode +"-"+ d.nama);
                    $('#id').val(d.id);
                    $('#kode').val(d.kode);
                    $('.idProdi').val(d.idProdi);
                    $('#idMataKuliah option').remove();
                    for (let i = 0; i < d['mata_kuliah'].length; i++) {                        
                        $('#idMataKuliah').append('<option value="'+ d['mata_kuliah'][i].id +'">'+ d['mata_kuliah'][i].nama +'</option>');
                    }
                    $('#idMataKuliah').val(d.idMataKuliah);
                    $('#idDosen').select2().val(d.idDosen).trigger('change');
                });
            });
            
            $(document).on('click', '#myTable tbody tr td a', function(e) {
                var id = $(this).attr('data-kelas');
                $.get( "kelas/" + id, function( data ) {
                    var d = JSON.parse(data);
                    $('#judulKelasModal').text("Detail Kelas | "+ d.kode +"-"+ d.nama);
                    $('#dosen').text('Pengampu : ' + d.dosen);
                    $('.idKelas').val(id);
                    $('#button').html('<a href="kelas/detail/'+ d.id +'" class="btn btn-primary">Lihat Detail</a>');
                });
                $.get( "kelas/detail/" + id +"/edit", function( data ) {
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
            
            $(document).on('change', '.idProdi', function(e) {
                var id = $(this).val();
                $.get("{{ url('admin/portal/data/mata-kuliah') }}/" + id, function( data ) {
                    var d = JSON.parse(data);
                    $('.idMataKuliah option').remove();
                    if (d.status > 0) {
                        for (let i = 0; i < d['mata_kuliah'].length; i++) {
                            $('.idMataKuliah').append('<option value="'+ d['mata_kuliah'][i].id +'">'+ d['mata_kuliah'][i].nama +'</option>');
                        }
                    }
                });
            });
            
            $(document).on('click', '.hapus', function () {
                const id = $(this).attr('data-value');
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
                        $('#form-' + id).submit();
                    }
                })
            });
        } );
    </script>
@endsection