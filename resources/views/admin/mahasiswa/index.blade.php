@extends('layout')

@section('judul')
    Data Mahasiswa
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
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
                <h3>Daftar Mahasiswa</h3>
            </div>
            <div class="d-inline">
                <button type="button" data-toggle="modal" data-target="#modalTambah" class="btn btn-success px-1"><i class="feather icon-plus"></i> Tambah</button>
                <button type="button" data-toggle="modal" data-target="#modalExcel" class="btn btn-primary px-1"><i class="feather icon-upload"></i> Upload Excel</button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="myTable" class="table zero-configuration table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>0898841078</td>
                        <td><a href="{{ route('admin.portal.mahasiswa.show') }}">Tiger Nixon</a></td>
                        <td>mail@tiger.com</td>
                        <td>081234567890</td>
                        <td>
                            <button type="button" class="btn btn-danger px-1"><i class="feather icon-trash-2"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>0843098017</td>
                        <td><a href="{{ route('admin.portal.mahasiswa.show') }}">Garrett Winters</a></td>
                        <td>mail@garrett.com</td>
                        <td>081234567890</td>
                        <td>
                            <button type="button" class="btn btn-danger px-1"><i class="feather icon-trash-2"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" name="nim" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <fieldset>
                            <div class="vs-radio-con">
                                <input type="radio" name="vueradio" checked value="1">
                                <span class="vs-radio">
                                    <span class="vs-radio--border"></span>
                                    <span class="vs-radio--circle"></span>
                                </span>
                                <span class="">Laki-laki</span>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="vs-radio-con">
                                <input type="radio" name="vueradio" value="0">
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
                        <input type="text" name="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="hp" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Alamat Saat Ini</label>
                        <textarea name="alamat" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Alamat Asal</label>
                        <textarea name="alamatasal" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h5>
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
        } );
    </script>
@endsection