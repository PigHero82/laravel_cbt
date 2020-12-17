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

    <!-- account setting page start -->
    <section id="page-account-settings">
        <div class="row">
            <!-- left menu section -->
            <div class="col-md-3 mb-2 mb-md-0">
                <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                    <li class="nav-item">
                        <a class="nav-link d-flex py-75 active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                            <i class="feather icon-user mr-50 font-medium-3"></i>
                            Biodata
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex py-75" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                            <i class="feather icon-calendar mr-50 font-medium-3"></i>
                            Role
                        </a>
                    </li>
                </ul>
            </div>
            <!-- right content section -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                    <div class="media">
                                        <a href="javascript: void(0);">
                                            <img src="{{ asset('assets/images/profile/'.$data->gambar) }}" class="rounded mr-75" alt="profile image" height="64">
                                        </a>
                                        <div class="media-body mt-75">
                                            <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                <button class="btn btn-sm btn-primary ml-50"><i class="feather icon-camera"></i> Unggah Foto Profil</button>
                                            </div>
                                            <p class="text-muted ml-75 mt-50"><small>Format JPG, GIF atau PNG. Ukuran Maksimal 800kB</small></p>
                                        </div>
                                        <div class="float-right">
                                            <form action="{{ route('admin.portal.user.update', $data->id) }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="password" value="{{ $data->username }}">
                                                <button type="submit" class="btn btn-danger">Reset Password</button>
                                            </form>
                                        </div>
                                    </div>
                                    <hr>
                                    <p class="font-weight-bold">{{ $data->name }} <br>{{ $data->username }}</p>
                                    <form id="form" action="{{ route('admin.portal.user.update', $info->idUser) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="jenis-kelamin">Jenis Kelamin</label>
                                                        <select class="form-control" name="jeniskelamin">
                                                            <option value="1"
                                                                @if ($info->jeniskelamin == 1)
                                                                    selected
                                                                @endif
                                                            >Laki-laki</option>
                                                            <option value="0"
                                                                @if ($info->jeniskelamin == 0)
                                                                    selected
                                                                @endif
                                                            >Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" name="email" placeholder="Email User" value="{{ $info->email }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="hp">No. HP</label>
                                                        <input type="text" class="form-control" pattern="[0-9]+" name="hp" placeholder="No HP User (Maksimal diisi 13 digit | Diisi dengan angka)" value="{{ $info->hp }}" maxlength="13">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="alamat">Alamat</label>
                                                        <textarea class="form-control" name="alamat" cols="30" rows="3" placeholder="Alamat User">{{ $info->alamat }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    

                                        <div class="row">
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                <button type="submit" class="btn btn-primary">Ubah Data</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade " id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                    <p class="font-weight-bold">Role</p>

                                    <form action="{{ route('admin.portal.user.role', $info->idUser) }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="user_id" id="user_id" value="{{ $info->idUser }}">
                                            @forelse ($roles as $item)
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <fieldset>
                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                <input type="checkbox" id="{{ $item->name }}-cek" name="role[]" value="{{ $item->id }}">
                                                                <span class="vs-checkbox">
                                                                    <span class="vs-checkbox--check">
                                                                        <i class="vs-icon feather icon-check"></i>
                                                                    </span>
                                                                </span>
                                                                <span class="">{{ $item->description }}</span>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            @empty
                                                
                                            @endforelse
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Ubah Role</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- account setting page end -->
@endsection

@section('js')
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('.zero-configuration').DataTable();

            var id = $('#user_id').val();
            $.get( "/admin/portal/user/role/" + id, function( data ) {
                console.log(JSON.parse(data));
                var d = JSON.parse(data);
                console.log(d.roles.length);
                for (var i = 0; i < d.roles.length; i++) {
                    if ($('#admin-cek').val()==d.roles[i].role_id) {
                        $('#admin-cek').attr( "checked","checked" );
                    }
                
                    if ($('#pengampu-cek').val()==d.roles[i].role_id) {
                        $('#pengampu-cek').attr( "checked","checked" );
                    }
            
                    if ($('#peserta-cek').val()==d.roles[i].role_id) {
                        $('#peserta-cek').attr( "checked","checked" );
                    }       
                }
            });
        } );
    </script>
@endsection