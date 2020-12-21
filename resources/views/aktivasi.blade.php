@extends('auth.layout')

@section('title')
    Aktivasi
@endsection

@section('content')
<div class="row flexbox-container justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body text-center">
                <img src="{{ asset('assets/images/profile/logo.jpg') }}" alt="Logo" class="img-fluid mb-1" style="width: 100px; height: auto">
                <p>Maaf, Akun anda belum aktif</p>
                <p>Tunggu pihak admin mengkonfirmasi akun anda</p>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary"><i class="feather icon-log-out"></i> Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection