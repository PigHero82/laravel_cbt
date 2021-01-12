@extends('layout')

@section('judul')
    {{ $info->kode }} | {{ $info->nama }}
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

    <!-- account setting page start -->
    <section id="page-account-settings">
        <div class="row">
            <!-- left menu section -->
            <div class="col-md-2 mb-2 mb-md-0">
                <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                    <li class="nav-item">
                        <a class="nav-link d-flex py-75 active" id="mahasiswa" data-toggle="pill" href="#mahasiswa" aria-expanded="true">
                            <i class="feather icon-user mr-50 font-medium-3"></i>
                            Mahasiswa
                        </a>
                    </li>
                </ul>
            </div>
            <!-- right content section -->
            <div class="col-md-10">
                <div class="card">
                    <div class="card-content">

                        <div class="card-body">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="mahasiswa" aria-labelledby="account-pill-general" aria-expanded="true">
                                    <div class="card-title">
                                        <div class="row justify-content-between">
                                            <h3 class="col-md-6">Daftar Mahasiswa</h3>
            
                                            <div class="col-md-6">
                                                <div class="float-md-right">
                                                    <button type="button" data-toggle="modal" data-target="#modalTambah" class="btn btn-success px-1"><i class="feather icon-plus"></i> Tambah</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if (count($data) > 0)
                                        <div class="table-responsive">
                                            <table id="myTable" class="table zero-configuration table-striped" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>NIM</th>
                                                        <th>Nama</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data as $item)
                                                        <tr>
                                                            <td class="text-center"><img src="{{ asset('/assets/images/profile/'.$item->gambar) }}" class="rounded mr-75" alt="profile image" height="64"></td>
                                                            <td>{{ $item->nim }}</td>
                                                            <td>{{ $item->nama }}</td>
                                                            <td>
                                                                <form action="{{ route('admin.portal.detail.destroy', $item->iddata) }}" class="form" method="post">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- account setting page end -->

    <!-- Modal -->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                @if (count($mahasiswa) > 0)
                    <form action="{{ route('admin.portal.detail.store') }}" method="post">
                        @csrf
                        <input type="text" name="idKelas" value="{{ $info->id }}" hidden>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Mahasiswa</label>
                                <select class="js-data-example-ajax form-control" name="idMahasiswa"></select>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                @else
                    <div class="error-template text-center">
                        <h1><i class="feather icon-slash"></i></h1>
                        <h2>Tidak Ada Data</h2>
                    </div> 
                @endif
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