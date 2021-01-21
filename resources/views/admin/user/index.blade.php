@extends('layout')

@section('judul')
    Data User
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
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
    @php
        $i = 0;
        foreach ($data as $key => $item) {
            if ($item->status == 0) {
                $i++;
            }
        }
    @endphp

    <div class="card">
        <div class="card-header">
            <div class="d-inline">
                <h3>Daftar User</h3>
            </div>
            <div class="d-inline">
                <button type="button" data-toggle="modal" data-target="#modalTambah" class="btn btn-success px-1"><i class="feather icon-plus"></i> Tambah</button>
                <button type="button" data-toggle="modal" data-target="#modalExcel" class="btn btn-primary px-1"><i class="feather icon-upload"></i> Upload Excel</button>
                @if ($i > 0)
                    <button type="button" data-toggle="modal" data-target="#modalRequest" class="btn btn-outline-primary px-1"><span class="badge badge-danger">{{ $i }}</span> Request</button>
                @endif
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if (count($data) > 0)
                <div class="table-responsive">
                    <table id="myTable" class="table zero-configuration table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>NIM/NIDN</th>
                                <th>Nama</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                @if ($item->status == 1)
                                    <tr>
                                        <td>{{ $item->username }}</td>
                                        <td><a href="{{ route('admin.portal.user.show', $item->id) }}">{{ $item->name }}</a></td>
                                        <td>
                                            <ul class="list-group">
                                                @foreach ($item['roles'] as $role)
                                                    <li class="list-group-item">{{ $role['description'] }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.portal.user.destroy', $item->id) }}" class="form" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" data-toggle="modal" data-target="#modalUbah" data-value="{{ $item->id }}" class="btn btn-warning px-1"><i class="feather icon-edit-1"></i></button>
                                                <button type="button" class="btn btn-danger px-1 hapus"><i class="feather icon-trash-2"></i></button>
                                            </form>
                                        </td>
                                   </tr>
                                @endif
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
                
                <form action="{{ route('admin.portal.user.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama User" required>
                        </div>
    
                        <div class="form-group">
                            <label>NIM/NIDN</label>
                            <input type="text" name="nim" class="form-control" maxlength="12" placeholder="NIM/NIDN User" required>
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
                            <input type="email" name="email" class="form-control" placeholder="Email User (input dengan email yang valid)">
                        </div>
    
                        <div class="form-group">
                            <label>No HP</label>
                            <input type="number" name="hp" class="form-control" pattern="[0-9]+" maxlength="13" placeholder="No HP User (Maksimal diisi 13 digit | Diisi dengan angka)">
                        </div>
    
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" cols="30" rows="10" class="form-control" placeholder="Alamat User"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            
                            @forelse ($roles as $item)
                                <fieldset>
                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                        <input type="checkbox" id="{{ $item->name }}-cek" name="role[]" value="{{ $item->id }}" {{ $item->id == 3 ? 'checked' : '' }}>
                                        <span class="vs-checkbox">
                                            <span class="vs-checkbox--check">
                                                <i class="vs-icon feather icon-check"></i>
                                            </span>
                                        </span>
                                        <span class="">{{ $item->description }}</span>
                                    </div>
                                </fieldset>
                            @empty
                                
                            @endforelse
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
    <div class="modal fade" id="modalRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Request User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>NIM/NIDN</th>
                                    <th>Nama</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    @if ($item->status == 0)
                                    <tr>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="d-inline">
                                                    <form action="{{ route('admin.portal.user.update', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="1">
                                                        <input type="hidden" name="username" value="{{ $item->username }}">
                                                        <button type="submit" style="padding: 0; border: none; background: none;" class="text-success"><i class="feather icon-check"></i></button>
                                                    </form>
                                                </div>
                                                <div class="d-inline ml-2">
                                                    <form action="{{ route('admin.portal.user.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="padding: 0; border: none; background: none;" class="text-danger"><i class="feather icon-trash"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    @endif
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalUbah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judul">Ubah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="form" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="username">NIM/NIDN</label>
                            <input type="number" name="username" id="username" class="form-control" placeholder="NIM/NIDN User" required>
                        </div>

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nama User" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Ubah User</button>
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

                <form action="{{ route('admin.portal.user.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>File Excel</label>
                            <input type="file" name="file" class="form-control">
                        </div>

                        <hr>
                        
                        <p>Sebelum mengunggah pastikan file yang akan anda unggah sudah dalam bentuk Ms. Excel dan format penulisan harus sesuai dengan yang telah ditentukan.</p>

                        <label>Ketentuan Data</label>
                        
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>no_induk</th>
                                        <th>nama</th>
                                        <th>jenis_kelamin</th>
                                        <th>email</th>
                                        <th>hp</th>
                                        <th>alamat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Wajib diisi | Maksimal 12 Karakter</td>
                                        <td>Wajib diisi</td>
                                        <td>Wajib diisi | Laki-laki/Perempuan</td>
                                        <td colspan="3">Boleh Dikosongkan</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <a href="{{ asset('assets/import/format/user.xlsx') }}" class="btn btn-success">Download Format</a>
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

            $(document).on('click', '#myTable tbody tr td button', function(e) {
                var id = $(this).attr('data-value');
                console.log(id);
                $.get( "user/role/" + id, function( data ) {
                    console.log(JSON.parse(data));
                    var d = JSON.parse(data);
                    $('#judul').text("Ubah User | "+ d.name);
                    $('#form').attr("action", "user/"+ d.id);
                    $('#username').val(d.username);
                    $('#name').val(d.name);
                });
            });
        } );
    </script>
@endsection