@extends('layout')

{{-- @section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
@endsection --}}

@section('judul')
    Data Soal
@endsection

@section('content')
    @if(session()->get('success'))
        <div class ="alert alert-success">
            {{ session()->get('success') }}  
        </div><br />
    @endif

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Paket Soal</h4>
            <div class="float-right">
                <a href="#" class="btn btn-success"><i class="feather icon-plus"></i> Tambah</a>
                <a href="#" class="btn btn-primary"><i class="feather icon-upload"></i> Import Excel</a>
            </div>
        </div>

        <div class="card-content">
            <div class="card-body">
                <table class="table table-striped">
                    <tr class="text-center">
                        <th>Nama</th>
                        <th>Jumlah Soal</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Durasi</th>
                        <th>Aktif</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td><a href="#">Tes Bahasa Indonesia</a></td>
                        <td>10 Soal</td>
                        <td>8 Agustus 2020</td>
                        <td>15:00 - 16:00</td>
                        <td><div disabled class="badge badge-md badge-danger">60 Menit</div></td>
                        <td class="text-center"><i class="feather icon-slash text-danger"></i></td>
                        <td>
                            <button class="btn badge badge-lg badge-warning"><i class="feather icon-edit-1"></i></button>
                            <button class="btn badge badge-lg badge-danger"><i class="feather icon-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#">Tes Fisika</a></td>
                        <td>15 Soal</td>
                        <td>9 Agustus 2020</td>
                        <td>13:00 - 15:00</td>
                        <td><div disabled class="badge badge-md badge-danger">120 Menit</div></td>
                        <td class="text-center"><i class="feather icon-check text-success"></i></td>
                        <td>
                            <button class="btn badge badge-lg badge-warning"><i class="feather icon-edit-1"></i></button>
                            <button class="btn badge badge-lg badge-danger"><i class="feather icon-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#">Tes Matematika</a></td>
                        <td>25 Soal</td>
                        <td>9 Agustus 2020</td>
                        <td>17:00 - 19:00</td>
                        <td><div disabled class="badge badge-md badge-danger">120 Menit</div></td>
                        <td class="text-center"><i class="feather icon-check text-success"></i></td>
                        <td>
                            <button class="btn badge badge-lg badge-warning"><i class="feather icon-edit-1"></i></button>
                            <button class="btn badge badge-lg badge-danger"><i class="feather icon-trash"></i></button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection

{{-- @section('js')
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('.table-striped').DataTable();
        } );
    </script>
@endsection --}}