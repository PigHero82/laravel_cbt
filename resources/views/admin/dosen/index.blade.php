@extends('layout')

@section('judul')
    Data Dosen
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
@endsection

@section('content')
    @if(session()->get('success'))
        <div class ="alert alert-success">
            {{ session()->get('success') }}  
        </div><br />
    @endif

    <div class="card">
        <div class="card-header">
            <div class="d-inline">
                <h3>Daftar Dosen</h3>
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
                                <th>NIDN</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No HP</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->nidn }}</td>
                                    <td><a href="{{ route('admin.portal.dosen.show', $item->id) }}">{{ $item->nama }}</a></td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->hp }}</td>
                                    <td>
                                        <form action="{{ route('admin.portal.dosen.destroy', $item->id) }}" class="form" method="post">
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form action="{{ route('admin.portal.dosen.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Dosen" required autofocus>
                        </div>
    
                        <div class="form-group">
                            <label>NIDN</label>
                            <input type="text" name="nidn" class="form-control" pattern="[0-9]+" maxlength="10" placeholder="NIDN Dosen (Diisi dengan angka)" required>
                        </div>
    
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <fieldset>
                                <div class="vs-radio-con">
                                    <input type="radio" name="jeniskelamin" checked value="1">
                                    <span class="vs-radio">
                                        <span class="vs-radio--border"></span>
                                        <span class="vs-radio--circle"></span>
                                    </span>
                                    <span class="">Laki-laki</span>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="vs-radio-con">
                                    <input type="radio" name="jeniskelamin" value="0">
                                    <span class="vs-radio">
                                        <span class="vs-radio--border"></span>
                                        <span class="vs-radio--circle"></span>
                                    </span>
                                    <span class="">Perempuan</span>
                                </div>
                            </fieldset>
                        </div>
    
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email Dosen (input dengan email yang valid)" required>
                        </div>
    
                        <div class="form-group">
                            <label>No KTP</label>
                            <input type="text" name="ktp" class="form-control" pattern="[0-9]+" maxlength="16" placeholder="No KTP Dosen (Diisi dengan angka)" required>
                        </div>
    
                        <div class="form-group">
                            <label>No HP</label>
                            <input type="text" name="hp" class="form-control" pattern="[0-9]+" maxlength="13" placeholder="No HP Dosen (Maksimal diisi 13 digit | Diisi dengan angka)" required>
                        </div>
    
                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="text" name="telepon" class="form-control" pattern="[0-9]+" maxlength="12" placeholder="No Telepon Dosen (Maksimal diisi 12 digit | Tidak wajib | Diisi dengan angka)">
                        </div>
    
                        <div class="form-group">
                            <label>Alamat Saat Ini</label>
                            <textarea name="alamat" cols="30" rows="10" class="form-control" placeholder="Alamat Dosen" required></textarea>
                        </div>
    
                        <div class="form-group">
                            <label>Alamat Asal</label>
                            <textarea name="alamatasal" cols="30" rows="10" class="form-control" placeholder="Alamat Asal Dosen" required></textarea>
                        </div>
    
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" name="gambar" class="form-control-file" placeholder="Gambar Dosen">
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Tambah</button>
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
    <script>
        $(document).ready( function () {
            $('.zero-configuration').DataTable();

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