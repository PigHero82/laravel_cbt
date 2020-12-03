@extends('layout')

@section('judul')
    Pengaturan
@endsection

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
@endsection

@section('content')
    @if(session()->get('success'))
        <div class ="alert alert-success">
            {{ session()->get('success') }}  
        </div><br />
    @endif
    <div class="row">
        <div class="col-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-logo-tab" data-toggle="pill" href="#v-pills-logo" role="tab" aria-controls="v-pills-logo" aria-selected="true"><i class="feather icon-user"></i> | Profil</a>
            </div>
        </div>
        <div class="col-9">
            {{-- Logo --}}
            <div class="card">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-logo" role="tabpanel" aria-labelledby="v-pills-logo-tab">
                        <div class="card-header">
                            <h4 class="card-title">Logo Perguruan Tinggi</h4>
                        </div>
                
                        <div class="card-content">
                            <div class="card-body text-center">
                                <form action="{{ route('admin.store.pengaturan') }}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="logo"><img src="{{ asset('assets/images/profile/'. $data->gambar) }}" class="img-thumbnail" alt="Logo Perguruan Tinggi" style="height: 35%; width: 35%;"></label>
                                        <input type="file" accept="image/*" id="logo" name="logo" hidden>
                                        <small class="form-text text-muted">Klik gambar untuk mengubah logo</small>
                                        <small class="form-text text-danger">Ukuran logo tidak boleh lebih dari 2 MB</small>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Nama Sistem --}}
            <div class="card">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-logo" role="tabpanel" aria-labelledby="v-pills-logo-tab">
                        <div class="card-header">
                            <h4 class="card-title">Nama Sistem</h4>
                        </div>
                
                        <div class="card-content">
                            <div class="card-body">
                                <form id="submit-nama">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nama" id="nama" aria-describedby="nama" placeholder="Nama Sistem" value="{{ $data->nama }}">
                                        <small id="nama" class="form-text text-danger">Data tidak boleh kosong</small>
                                    </div>
                                    <button type="submit" class="btn btn-primary"><i class="feather icon-check"></i> Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Deskripsi Sistem --}}
            <div class="card">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-logo" role="tabpanel" aria-labelledby="v-pills-logo-tab">
                        <div class="card-header">
                            <h4 class="card-title">Deskripsi</h4>
                        </div>
                
                        <div class="card-content">
                            <div class="card-body">
                                <form id="submit-deskripsi">
                                    <div class="form-group">
                                      <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" placeholder="Deskripsi Sistem">{{ $data->deskripsi }}</textarea>
                                      <small id="nama" class="form-text text-danger">Data tidak boleh kosong</small>
                                    </div>
                                    <button type="submit" class="btn btn-primary"><i class="feather icon-check"></i> Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('change', '#logo', function(event) {
                id = $(this).parent().parent();
                var FileSize = document.getElementById("logo").files[0].size / 1024 / 1024;
                if (FileSize > 2) {
                    Swal.fire({
                        type: "error",
                        title: 'Gagal!',
                        text: 'Gambar tidak boleh lebih dari 2 MB',
                        timer: 1000,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        type: "success",
                        title: 'Berhasil!',
                        text: 'Data berhasil diubah',
                        timer: 1000,
                        showConfirmButton: false
                    });
                    id.submit();
                }
            });

            $(document).on('submit', '#submit-nama', function( event ) {
                var nama = $('#nama').val();

                if (nama != "") {
                    Swal.fire({
                        type: "success",
                        title: 'Berhasil!',
                        text: 'Data berhasil diubah',
                        timer: 1000,
                        showConfirmButton: false
                    });

                    $.ajax({
                        url: "{{ route('admin.store.pengaturan') }}",
                        type: "POST",
                        data: {
                            nama: nama
                        },
                    });
                } else {
                    Swal.fire({
                        type: "error",
                        title: 'Gagal!',
                        text: 'Nama tidak boleh kosong',
                        timer: 1000,
                        showConfirmButton: false
                    });
                }

                event.preventDefault();
            });

            $("textarea").keydown(function(e){
                // Enter was pressed without shift key
                if (e.keyCode == 13 && !e.shiftKey)
                {
                    // prevent default behavior
                    e.preventDefault();
                    submitDeskripsi();
                }
            });

            $(document).on('submit', '#submit-deskripsi', function( event ) {
                event.preventDefault();
                submitDeskripsi();
            });

            function submitDeskripsi() {
                var deskripsi = $('#deskripsi').val();

                if (deskripsi != "") {
                    Swal.fire({
                        type: "success",
                        title: 'Berhasil!',
                        text: 'Data berhasil diubah',
                        timer: 1000,
                        showConfirmButton: false
                    });

                    $.ajax({
                        url: "{{ route('admin.store.pengaturan') }}",
                        type: "POST",
                        data: {
                            deskripsi: deskripsi
                        },
                    });
                } else {
                    Swal.fire({
                        type: "error",
                        title: 'Gagal!',
                        text: 'Deskripsi tidak boleh kosong',
                        timer: 1000,
                        showConfirmButton: false
                    });
                }
            }
        });
    </script>
@endsection