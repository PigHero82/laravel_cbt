@extends('auth.layout')

@section('title')
    Register
@endsection

@section('content')
    <div class="content-header row">
    </div>
    <div class="content-body">
        <section class="row flexbox-container">
            <div class="col-xl-8 col-10 d-flex justify-content-center">
                <div class="card bg-authentication rounded-0 mb-0">
                    <div class="row m-0">
                        <div class="col-lg-6 d-lg-block d-none text-center align-self-center pl-0 pr-3 py-0">
                            <img src="{{ asset('app-assets/images/pages/register.jpg') }}" alt="branding logo">
                        </div>
                        <div class="col-lg-6 col-12 p-0">
                            <div class="card rounded-0 mb-0 p-2">
                                <div class="card-header pt-50 pb-1">
                                    <div class="card-title">
                                        <h4 class="mb-0">Daftar Peserta</h4>
                                    </div>
                                </div>
                                <p class="px-2">Isi form dibawah untuk membuat akun baru</p>
                                <div class="card-content">
                                    <div class="card-body pt-0">
                                        <form action="{{ route('register') }}" method="POST">
                                            @csrf
                                            <div class="form-label-group">
                                                <input id="inputName" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nama" required autocomplete="name" autofocus>

                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <label for="inputName">{{ $message }}</label>
                                                    </span>
                                                @else
                                                    <label for="inputName">Nama</label>
                                                @enderror
                                            </div>

                                            <div class="form-label-group">
                                                <input id="inputUsername" type="number" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="NIM/NIDN" required autocomplete="username">
                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <label for="inputUsername">{{ $message }}</label>
                                                    </span>
                                                @else
                                                    <label for="inputUsername">NIM/NIDN</label>
                                                @enderror
                                            </div>

                                            <div class="form-label-group">
                                                <input id="inputPassword" type="password" minlength="8" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password (Minimal 8 karakter)" required autocomplete="new-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @else
                                                    <label for="inputPassword">Password (Minimal 8 karakter)</label>
                                                @enderror
                                            </div>

                                            <div class="form-label-group">
                                                <input id="inputConfPassword" type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password" required autocomplete="new-password">
                                                <label for="inputConfPassword">Konfirmasi Password</label>
                                            </div>
                                            
                                            <a href="{{ route('login') }}" class="btn btn-outline-primary float-left btn-inline mb-50">Login</a>
                                            <button type="submit" class="btn btn-primary float-right btn-inline mb-50">Register</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
