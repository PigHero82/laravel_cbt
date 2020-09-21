@extends('layout')

@section('indexactive')
    active
@endsection

@section('judul')
    SITASI
@endsection

@section('content')
    @if(session()->get('success'))
        <div class ="alert alert-success">
            {{ session()->get('success') }}  
        </div><br />
    @endif

    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Usulan yang Dapat Diajukan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="myTable" class="table zero-configuration table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Skema</th>
                            <th>Jenis Usulan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>PDP</td>
                            <td>Penelitian Dosen Pemula</td>
                            <td>Penelitian</td>
                        </tr>
                        <tr>
                            <td>PPDS Batch 1</td>
                            <td>Penelitian Pengembangan Dosen STIKI</td>
                            <td>Penelitian</td>
                        </tr>
                        <tr>
                            <td>PKM STIKI Peduli (Tahunan) Batch 1</td>
                            <td>Pengabdian Kepada Masyarakat</td>
                            <td>Pengabdian</td>
                        </tr>
                        <tr>
                            <td>PKM STIKI Peduli (Insidental) Batch 1</td>
                            <td>Pengabdian Kepada Masyarakat</td>
                            <td>Pengabdian</td>
                        </tr>
                        <tr>
                            <td>PPDS Batch 2</td>
                            <td>Penelitian Pengembangan Dosen STIKI Batch 2</td>
                            <td>Penelitian</td>
                        </tr>
                        <tr>
                            <td>PKM STIKI Peduli (Tahunan) Batch 2</td>
                            <td>Pengabdian Kepada Masyarakat STIKI Peduli (Tahunan) Batch 2</td>
                            <td>Pengabdian</td>
                        </tr>
                        <tr>
                            <td>PKM STIKI Peduli (Insidental) Batch 2</td>
                            <td>Pengabdian Kepada Masyarakat STIKI Peduli (Insidental) Batch 2</td>
                            <td>Pengabdian</td>
                        </tr>
                        <tr>
                            <td>PPDS</td>
                            <td>Penelitian Pengembangan Dosen STIKI</td>
                            <td>Penelitian</td>
                        </tr>
                        <tr>
                            <td>PDM</td>
                            <td>Penelitian Dosen Mahasiswa</td>
                            <td>Penelitian</td>
                        </tr>
                        <tr>
                            <td>SSE</td>
                            <td>STIKI Social Engagement</td>
                            <td>Pengabdian</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!--/.col (left) -->

        <div class="col-md-6">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Informasi Pribadi</h3>
        
                      <div class="card-tools">
                        <a href="#" class="btn btn-success">Ubah Profil</a>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="card-text">
                            <dl class="row">
                                <dt class="col-sm-3 text-right">Foto Profil</dt>
                                <dd class="col-sm-9">
                                    <div class="row">
                                        <div class="col-12">
                                            <img src="{{ asset('app-assets/images/portrait/small/avatar-s-11.jpg') }}" alt="Profile picture">
                                        </div>
                                        <div class="col-12">
                                            <form action="#" method="post">
                                                <fieldset class="form-group">
                                                    <label for="basicInputFile"><strong>Ubah Foto</strong> *Maksimal Ukuran Foto 250Kb</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="inputGroupFile01">
                                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>
                                        <div class="col-12">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Unggah</button>
                                        </div>
                                    </div>
                                </dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-3 text-right">Nama</dt>
                                <dd class="col-sm-9">John Doe</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-3 text-right">NIDN</dt>
                                <dd class="col-sm-9">0843098017</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-3 text-right">Email</dt>
                                <dd class="col-sm-9">john@example.com</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-3 text-right">Link Google Scholar</dt>
                                <dd class="col-sm-9"><a href="#" class="text-danger">Ubah Biodata Untuk Setting Link Google Scholar</a></dd>
                            </dl>
                        </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!--/.col (left) -->
              </div>
              <!-- /.row -->
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-content">
                    <div class="card-body">
                        <div class="avatar bg-rgba-info p-50 m-0 mb-1">
                            <div class="avatar-content">
                                <i class="feather icon-bar-chart-2 text-info font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700">279</h2>
                        <p class="mb-0 line-ellipsis">Total Penelitian Internal</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-content">
                    <div class="card-body">
                        <div class="avatar bg-rgba-warning p-50 m-0 mb-1">
                            <div class="avatar-content">
                                <i class="feather icon-pie-chart text-warning font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700">0</h2>
                        <p class="mb-0 line-ellipsis">Total Penelitian Eksternal</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-content">
                    <div class="card-body">
                        <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                            <div class="avatar-content">
                                <i class="feather icon-globe text-danger font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700">90</h2>
                        <p class="mb-0 line-ellipsis">Total Pengabdian Internal</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-content">
                    <div class="card-body">
                        <div class="avatar bg-rgba-primary p-50 m-0 mb-1">
                            <div class="avatar-content">
                                <i class="feather icon-users text-primary font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700">0</h2>
                        <p class="mb-0 line-ellipsis">Total Pengabdian Eksternal</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title mb-0">Riwayat Penelitian & Pengabdian</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">

            <!-- skema penelitian -->
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Penelitian</h3>

                <div class="card-tools">
                    <a href="#" class="btn btn-outline-success">
                        Lihat Semua
                    </a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-content collapse show">
                  <div class="card-body">
                    <table id="myTable" class="table zero-configuration table-striped table-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 60%">Judul</th>
                                <th>Skema Usulan</th>
                                <th>Tahun Pelaksanaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="#modalPenelitian" data-toggle="modal">Implementasi Komik Interaktif Cerita Rakyat Cupak Grantang dengan Bahasa Isyarat berbasis Mobile</a></td>
                                <td>2020 - Penelitian 1</td>
                                <td>2020</td>
                            </tr>
                            <tr>
                                <td><a href="#modalPenelitian" data-toggle="modal">Penerapan Extreme Programming pada Sistem Pengarsipan Lembaga Penelitian dan Pengabdian Masyarakat STMIK STIKOM Indonesia</a></td>
                                <td>2020 - Penelitian 1</td>
                                <td>2020</td>
                            </tr>
                            <tr>
                                <td><a href="#modalPenelitian" data-toggle="modal">Analisa Prosodi Lirik Pupuh Pucung pada Software Speech Synthesis Mbrola</a></td>
                                <td>2020 - Penelitian 1</td>
                                <td>2020</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Judul</th>
                                <th>Skema Usulan</th>
                                <th>Tahun Pelaksanaan</th>
                            </tr>
                        </tfoot>
                    </table>
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  
            <!-- skema pengabdian -->
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Pengabdian</h3>

                <div class="card-tools">
                    <a href="#" class="btn btn-outline-success">
                        Lihat Semua
                    </a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-content collapse show">
                  <div class="card-body">
                    <table id="myTable" class="table zero-configuration table-striped table-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 60%">Judul</th>
                                <th>Skema Usulan</th>
                                <th>Tahun Pelaksanaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="#modalPengabdian" data-toggle="modal">Pelatihan Teknologi Komputer Dasar DI Taman Belajar Anak Br Pedahan Kaja Desa Tianyar Tengah, Kecamatan Kubu, Karangasem</a></td>
                                <td>2020 - Pengabdian 1</td>
                                <td>2020</td>
                            </tr>
                            <tr>
                                <td><a href="#modalPengabdian" data-toggle="modal">Implementasi dan Pengelolaan Mobile Based E-complaint System Bagi Masyarakat Desa Kukuh Kecamatan Kerambitan Kabupaten Tabanan</a></td>
                                <td>2020 - Pengabdian 1</td>
                                <td>2020</td>
                            </tr>
                            <tr>
                                <td><a href="#modalPengabdian" data-toggle="modal">Pelatihan Media Pembelajaran Guru SD 1 Pesaban berbasis daring</a></td>
                                <td>2020 - Pengabdian 1</td>
                                <td>2020</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Judul</th>
                                <th>Skema Usulan</th>
                                <th>Tahun Pelaksanaan</th>
                            </tr>
                        </tfoot>
                    </table>
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->

        
        <!-- modal penelitian -->
        <div class="modal fade text-left" id="modalPenelitian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Detail Penelitian</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-text">
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Judul</dt>
                                <dd class="col-sm-8">Implementasi Komik Interaktif Cerita Rakyat Cupak Grantang dengan Bahasa Isyarat berbasis Mobile</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Tim Peneliti</dt>
                                <dd class="col-sm-8">
                                    <dl class="row">
                                        <dt class="col-sm-3 text-md-right">Ketua</dt>
                                        <dd class="col-sm-9">Airi Satou</dd>
                                    </dl>
                                    <dl class="row">
                                        <dt class="col-sm-3 text-md-right">Anggota</dt>
                                        <dd class="col-sm-9">
                                            <ul class="list-unstyled">
                                                <li>Ashton Cox</li>
                                                <li class="mt-1">Cedric Kelly</li>
                                                <li class="mt-1">Garrett Winters</li>
                                                <li class="mt-1">Tiger Nixon</li>
                                            </ul>
                                        </dd>
                                    </dl>
                                </dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Skema</dt>
                                <dd class="col-sm-8">PPDS Batch 1</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Tahun Usulan</dt>
                                <dd class="col-sm-8">2020</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Tahun Penelitian</dt>
                                <dd class="col-sm-8">2020</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Jenis Usulan</dt>
                                <dd class="col-sm-8">Penelitian</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Proposal</dt>
                                <dd class="col-sm-8"><a href="#">Berkas Proposal</a></dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Laporan Kemajuan</dt>
                                <dd class="col-sm-8">-</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Laporan Akhir</dt>
                                <dd class="col-sm-8">-</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Laporan Anggaran</dt>
                                <dd class="col-sm-8">-</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Laporan Belanja</dt>
                                <dd class="col-sm-8">-</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Laporan Publikasi</dt>
                                <dd class="col-sm-8">-</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Link Publikasi/Google Scholar</dt>
                                <dd class="col-sm-8">-</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal pengabdian -->
        <div class="modal fade text-left" id="modalPengabdian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Detail Usulan Pengabdian</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-text">
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Judul</dt>
                                <dd class="col-sm-8">Pelatihan Teknologi Komputer Dasar DI Taman Belajar Anak Br Pedahan Kaja Desa Tianyar Tengah, Kecamatan Kubu, Karangasem</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Tim Peneliti</dt>
                                <dd class="col-sm-8">
                                    <dl class="row">
                                        <dt class="col-sm-3 text-md-right">Ketua</dt>
                                        <dd class="col-sm-9">Airi Satou</dd>
                                    </dl>
                                    <dl class="row">
                                        <dt class="col-sm-3 text-md-right">Anggota</dt>
                                        <dd class="col-sm-9">
                                            <ul class="list-unstyled">
                                                <li>Ashton Cox</li>
                                                <li class="mt-1">Cedric Kelly</li>
                                                <li class="mt-1">Garrett Winters</li>
                                                <li class="mt-1">Tiger Nixon</li>
                                            </ul>
                                        </dd>
                                    </dl>
                                </dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Skema</dt>
                                <dd class="col-sm-8">PKM STIKI Peduli (Tahunan) Batch 1</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Tahun Usulan</dt>
                                <dd class="col-sm-8">2020</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Tahun Penelitian</dt>
                                <dd class="col-sm-8">2020</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Jenis Usulan</dt>
                                <dd class="col-sm-8">Pengabdian</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Proposal</dt>
                                <dd class="col-sm-8"><a href="#">Berkas Proposal</a></dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Laporan Kemajuan</dt>
                                <dd class="col-sm-8">-</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Laporan Akhir</dt>
                                <dd class="col-sm-8">-</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Laporan Anggaran</dt>
                                <dd class="col-sm-8">-</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Laporan Belanja</dt>
                                <dd class="col-sm-8">-</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Laporan Publikasi</dt>
                                <dd class="col-sm-8">-</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-md-right">Link Publikasi/Google Scholar</dt>
                                <dd class="col-sm-8">-</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/cards/card-statistics.js') }}"></script>
    <!-- END: Page JS-->
@endsection