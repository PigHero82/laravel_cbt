@extends('layout')

@section('judul')
    Data User
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
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
                <h3>Daftar User</h3>
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
                                <th>NIM</th>
                                <th>Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->nim }}</td>
                                    <td><a href="{{ route('admin.portal.mahasiswa.show', $item->id) }}">{{ $item->name }}</a></td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form action="{{ route('admin.portal.mahasiswa.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Mahasiswa" required>
                        </div>
    
                        <div class="form-group">
                            <label>NIM</label>
                            <input type="text" name="nim" class="form-control" maxlength="12" placeholder="NIM Mahasiswa" required>
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
                            <input type="email" name="email" class="form-control" placeholder="Email Mahasiswa (input dengan email yang valid)">
                        </div>
    
                        <div class="form-group">
                            <label>No HP</label>
                            <input type="number" name="hp" class="form-control" pattern="[0-9]+" maxlength="13" placeholder="No HP Mahasiswa (Maksimal diisi 13 digit | Diisi dengan angka)">
                        </div>
    
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" cols="30" rows="10" class="form-control" placeholder="Alamat Mahasiswa"></textarea>
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
    <div class="modal fade" id="modalExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>File Excel</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>

                    <hr>
                    <p>Sebelum mengunggah pastikan file yang akan anda unggah sudah dalam bentuk Ms. Excel 97-2003 Workbook (.xls) dan format penulisan harus sesuai dengan yang telah ditentukan.</p>
                    <label>Ketentuan Data</label>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>nim</th>
                                    <th>nama</th>
                                    <th>jeniskelamin</th>
                                    <th>email</th>
                                    <th>hp</th>
                                    <th>alamat</th>
                                    <th>alamatasal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Wajib diisi</td>
                                    <td>Wajib diisi</td>
                                    <td>Hanya diisi dengan angka 1 & 0 (1 = Laki-laki & 2 = Perempuan) | Wajib diisi</td>
                                    <td>Tidak Wajib diisi</td>
                                    <td>Dibatasi hingga 13 digit angka | Tidak wajib diisi</td>
                                    <td>Tidak wajib diisi</td>
                                    <td>Tidak wajib diisi</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <a href="#" class="btn btn-success">Download Format</a>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('.zero-configuration').DataTable();

            $('form').submit(function() {
                $(this).find("button[type='submit']").prop('disabled', true);
            });
        } );
    </script>
@endsection