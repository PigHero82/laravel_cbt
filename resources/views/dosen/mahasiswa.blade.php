@extends('layout')

@section('indexactive')
    active
@endsection

@section('judul')
    Data Mahasiswa
@endsection

@section('content')
    @if(session()->get('success'))
        <div class ="alert alert-success">
            {{ session()->get('success') }}  
        </div><br />
    @endif

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Mahasiswa Menurut Kelas</h4>
        </div>

        <div class="card-content">
            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" aria-controls="home" role="tab" aria-selected="true">DA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="false">C</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="home" aria-labelledby="home-tab" role="tabpanel">
                        DA | Pemrograman Web
                        <table class="table table-striped">
                            <tr class="text-center">
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No HP</th>
                            </tr>
                            <tr>
                                <td>17101280</td>
                                <td>Ida Bagus Kadek Darma Wiryatama</td>
                                <td>idabagus@gmail.com</td>
                                <td>082345678901</td>
                            </tr>
                            <tr>
                                <td>17101306</td>
                                <td>Andy Felicio Prianta</td>
                                <td>andyfel@gmail.com</td>
                                <td>082345678901</td>
                            </tr>
                        </table>
                    </div>
                    <div class="tab-pane" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                        C | Bahasa Indonesia
                        <table class="table table-striped">
                            <tr class="text-center">
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No HP</th>
                            </tr>
                            <tr>
                                <td>17101281</td>
                                <td>Ida Bagus Komang Darma Wiryanata</td>
                                <td>darmawirya@gmail.com</td>
                                <td>082345678901</td>
                            </tr>
                            <tr>
                                <td>17101717</td>
                                <td>Ratih Pradnya Dewi</td>
                                <td>ratihpradnya@gmail.com</td>
                                <td>082345678901</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection