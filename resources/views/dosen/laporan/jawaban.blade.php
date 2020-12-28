@extends('layout')

@section('judul')
    Detail Hasil Tes
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
@endsection

@section('content')
    <div class="sidebar-shop">
        <div class="card">
            <div class="card-header">
                <h3 class="d-inline">Detail Hasil Tes</h3>
                <div class="float-right">
                    {{-- <a class="btn btn-primary" href="{{ route('dosen.laporan.jawaban.show', $data->id) }}"><i class="feather icon-file-text"></i> Lihat Jawaban Peserta</a> --}}
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table zero-configuration">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                @for ($i = 1; $i <= $soal; $i++)
                                    <th>{{ $i }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item['username'] }}</td>
                                    <td>{{ $item['name'] }}</td>
                                    @foreach ($item['jawaban'] as $jawaban)
                                        <td>{{ $jawaban['skor'] }}</td>
                                    @endforeach
                                </tr>                                        
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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