@extends('layout')

@section('judul')
    Data Dosen
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
                            Kelas
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
                                            <img src="../../../app-assets/images/profile/blank.png" class="rounded mr-75" alt="profile image" height="64">
                                        </a>
                                        <div class="media-body mt-75">
                                            <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                <button class="btn btn-sm btn-primary ml-50"><i class="feather icon-camera"></i> Unggah Foto Profil</button>
                                            </div>
                                            <p class="text-muted ml-75 mt-50"><small>Format JPG, GIF atau PNG. Ukuran Maksimal 800kB</small></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <form action="{{ route('admin.portal.dosen.update', $data->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>NIDN</label>
                                                    <input type="text" name="nidn" class="form-control" pattern="[0-9]+" maxlength="10" placeholder="NIDN Dosen (Diisi dengan angka)" value="{{ $data->nidn }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="text" name="nama" class="form-control" placeholder="Nama Dosen" value="{{ $data->nama }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="email" class="form-control" placeholder="Email Dosen (input dengan email yang valid)" value="{{ $data->email }}" required>
                                                </div>
                            
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="jenis-kelamin">Jenis Kelamin</label>
                                                        <select class="form-control" name="jeniskelamin">
                                                            <option value="1"
                                                                @if ($data->jeniskelamin == 1)
                                                                    selected
                                                                @endif
                                                            >Laki-laki</option>
                                                            <option value="0"
                                                                @if ($data->jeniskelamin == 0)
                                                                    selected
                                                                @endif
                                                            >Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <textarea name="alamat" cols="30" rows="3" class="form-control" placeholder="Alamat Dosen" required>{{ $data->alamat }}</textarea>
                                                </div>                            
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>No KTP</label>
                                                    <input type="text" name="ktp" class="form-control" pattern="[0-9]+" maxlength="16" placeholder="No KTP Dosen (Diisi dengan angka)" value="{{ $data->ktp }}" required>
                                                </div>
                            
                                                <div class="form-group">
                                                    <label>No Telepon</label>
                                                    <input type="text" name="telepon" class="form-control" pattern="[0-9]+" maxlength="12" placeholder="No Telepon Dosen (Maksimal diisi 12 digit | Tidak wajib | Diisi dengan angka)" value="{{ $data->telepon }}">
                                                </div>
                            
                                                <div class="form-group">
                                                    <label>No HP</label>
                                                    <input type="text" name="hp" class="form-control" pattern="[0-9]+" maxlength="13" placeholder="No HP Dosen (Maksimal diisi 13 digit | Diisi dengan angka)" value="{{ $data->hp }}" required>
                                                </div>
                            
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-username">Status</label>
                                                        <select class="form-control" name="status">
                                                            <option value="1"
                                                                @if ($data->status == 1)
                                                                    selected
                                                                @endif
                                                            >Aktif</option>
                                                            <option value="0"
                                                                @if ($data->status == 0)
                                                                    selected
                                                                @endif
                                                            >Tidak aktif</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="asal">Wilayah Asal</label>
                                                        <textarea class="form-control" name="alamatasal" cols="30" rows="3" placeholder="Wilayah Asal Dosen" required>{{ $data->alamatasal }}</textarea>
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
                                    <form novalidate>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-old-password">Old Password</label>
                                                        <input type="password" class="form-control" id="account-old-password" required placeholder="Old Password" data-validation-required-message="This old password field is required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-new-password">New Password</label>
                                                        <input type="password" name="password" id="account-new-password" class="form-control" placeholder="New Password" required data-validation-required-message="The password field is required" minlength="6">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-retype-new-password">Retype New
                                                            Password</label>
                                                        <input type="password" name="con-password" class="form-control" required id="account-retype-new-password" data-validation-match-match="password" placeholder="New Password" data-validation-required-message="The Confirm password field is required" minlength="6">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                    changes</button>
                                                <button type="reset" class="btn btn-outline-warning">Cancel</button>
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
        } );
    </script>
@endsection