@extends('auth.layout')

@section('title')
    Login
@endsection

@section('content')
    <section class="row flexbox-container">
        <div class="col-xl-8 col-11 d-flex justify-content-center">
            <div class="card bg-authentication rounded-0 mb-0">
                <div class="row m-0">
                    <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                        <img src="{{ asset('app-assets/images/pages/login.png') }}" alt="branding logo">
                    </div>
                    <div class="col-lg-6 col-12 p-0">
                        <div class="card rounded-0 mb-0 px-2">
                            <div class="card-header pb-1">
                                <div class="card-title">
                                    <span><img src="{{ asset('assets/images/profile/logo.jpg') }}" alt="Logo" class="img-fluid mb-1" style="width: 100px; height: auto"></span>
                                    <h4 class="mb-0">CBT Politeknik Kesehatan Denpasar</h4>
                                </div>
                            </div>
                            <p class="px-2">Masuk untuk melanjutkan</p>
                            <div class="card-content">
                                <div class="card-body pt-1">
                                    @if (session('status'))
                                        <div class="mb-4 font-medium text-sm text-green-600">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <fieldset class="form-label-group form-group position-relative has-icon-left">
                                            <input type="number" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="NIDN/NIM" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus />
                                            <div class="form-control-position">
                                                <i class="feather icon-user"></i>
                                            </div>
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @else
                                                <label for="username">NIDN/NIM</label>
                                            @enderror
                                        </fieldset>

                                        <fieldset class="form-label-group position-relative has-icon-left">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password" required autocomplete="current-password" />
                                            <div class="form-control-position">
                                                <i class="feather icon-lock"></i>
                                            </div>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @else
                                                <label for="password">Password</label>
                                            @enderror
                                        </fieldset>

                                        <div class="form-group d-flex justify-content-between align-items-center">
                                            <div class="text-left">
                                                <fieldset class="checkbox">
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                        <span class="">Tetap masuk</span>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <a href="{{ route('register') }}" class="btn btn-outline-primary float-left btn-inline mb-2">Register</a>
                                        <button type="submit" class="btn btn-primary float-right btn-inline mb-2">Login</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection