@extends('layout')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
@endsection

@section('judul')
    Data Mata Kuliah
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
                    <h3 class="card-title">Mata Kuliah</h3>
                    <div class="float-right">
                        <button type="button" data-toggle="modal" data-target="#modalTambah" class="btn btn-success px-1"><i class="feather icon-plus"></i> Tambah</button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if (count($data) > 0)
                        <table id="myTable" class="table zero-configuration table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Prodi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->kode }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->nama_prodi }}</td>
                                        <td>
                                            <form action="{{ route('admin.portal.mata-kuliah.destroy', $item->id) }}" class="form" id="form-{{ $item->id }}" method="post">
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Mata Kuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                @if (count($prodi) > 0)
                    <form action="{{ route('admin.portal.mata-kuliah.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Kode</label>
                                <input type="text" name="kode" class="form-control" placeholder="Kode Mata Kuliah" required>
                            </div>

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama Mata Kuliah" required>
                            </div>

                            <div class="form-group">
                                <label>Prodi</label>
                                <select name="prodi" class="form-control" required>
                                    <option value="" hidden>-- Pilih Prodi --</option>
                                    @foreach ($prodi as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                @else
                    <div class="modal-body">
                        <div class="error-template text-center">
                            <h1><i class="feather icon-slash"></i></h1>
                            <h2>Tidak Ada Prodi</h2>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalUbah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title judul" id="exampleModalLabel">Ubah Mata Kuliah | </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                @if (count($prodi) > 0)
                    <form id="form" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="text" name="id" id="id" hidden>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Kode</label>
                                <input type="text" name="kode" id="kode" class="form-control" placeholder="Kode Mata Kuliah" required>
                            </div>

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Mata Kuliah" required>
                            </div>

                            <div class="form-group">
                                <label>Prodi</label>
                                <select name="prodi" id="prodi" class="form-control" required>
                                    <option value="" hidden>-- Pilih Prodi --</option>
                                    @foreach ($prodi as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </form>
                @else
                    <div class="modal-body">
                        <div class="error-template text-center">
                            <h1><i class="feather icon-slash"></i></h1>
                            <h2>Tidak Ada Prodi</h2>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('form').submit(function() {
                $(this).find("button[type='submit']").prop('disabled', true);
            });

            $('table').DataTable();
            
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
                        $('#form-'+ id).submit();
                    }
                })
            });

            $(document).on('click', '#myTable tbody tr td button', function(e) {
                var id = $(this).attr('data-value');
                $.get( "mata-kuliah/" + id, function( data ) {
                    console.log(JSON.parse(data));
                    var d = JSON.parse(data);
                    $('.judul').text("Ubah Mata Kuliah | "+ d.nama);
                    $('#form').attr("action", "mata-kuliah/"+ d.id);
                    $('#id').val(d.id);
                    $('#nama').val(d.nama);
                    $('#kode').val(d.kode);
                    $('#prodi').val(d.idProdi);
                });
            });
        } );
    </script>
@endsection