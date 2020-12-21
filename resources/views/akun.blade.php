@extends('auth.layout')

@section('title')
    Pengaturan
@endsection

@section('content')
    <div class="m-5">
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
                            <i class="feather icon-lock mr-50 font-medium-3"></i>
                            Ubah Password
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex py-75" href="/" aria-expanded="false">
                            <i class="feather icon-chevron-left mr-50 font-medium-3"></i>
                            Menu Utama
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
                                    <h3 class="font-weight-bold">Biodata</h3>
                                    <hr>
                                    
                                    <form action="{{ route('akun.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="jenis-kelamin">Jenis Kelamin</label>
                                                        <select class="form-control" name="jeniskelamin">
                                                            <option value="1" {{ $data->jeniskelamin == 1 ? "selected" : ""}}>Laki-laki</option>
                                                            <option value="2" {{ $data->jeniskelamin == 2 ? "selected" : ""}}>Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" name="email" placeholder="Email User" value="{{ $data->email }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="hp">No. HP</label>
                                                        <input type="text" class="form-control" pattern="[0-9]+" name="hp" placeholder="No HP User (Maksimal diisi 13 digit | Diisi dengan angka)" value="{{ $data->hp }}" maxlength="13">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="alamat">Alamat</label>
                                                        <textarea class="form-control" name="alamat" cols="30" rows="3" placeholder="Alamat User">{{ $data->email }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                <button type="submit" class="btn btn-primary">Ubah Biodata</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade " id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                    <h3 class="font-weight-bold">Ubah Password</h3>
                                    <hr>

                                    <form action="{{ route('akun.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="password-baru">Password Baru</label>
                                                <input type="password" class="form-control" name="password_baru" placeholder="********" minlength="8">
                                                <small id="helpId" class="text-muted">Password minimal 8 karakter</small>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="konfirmasi-password-baru">Konfirmasi Password Baru</label>
                                                <input type="password" class="form-control" name="konfirmasi_password_baru" placeholder="********" minlength="8">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                <button type="submit" class="btn btn-primary">Ubah Password</button>
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
    </div>
@endsection