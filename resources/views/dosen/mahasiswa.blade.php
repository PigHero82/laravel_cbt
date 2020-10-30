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

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Mahasiswa Menurut Kelas</h4>
                </div>
        
                <div class="card-content">
                    <div class="card-body">
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach ($data as $item)
                                <li class="nav-item">
                                    <a class="nav-link @if ($loop->first) active @endif" id="{{ $item->id }}-tab" data-toggle="tab" href="#{{ $item->id }}" aria-controls="{{ $item->id }}" role="tab" aria-selected="@if ($loop->first) true @else false @endif">{{ $item->kode }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach ($data as $item)
                                <div class="tab-pane @if ($loop->first) active @endif" id="{{ $item->id }}" aria-labelledby="{{ $item->id }}-tab" role="tabpanel">
                                    {{ $item->kode }} | {{ $item->nama }}
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="text-center">
                                                <th></th>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($item['peserta'] as $abc)
                                                <tr>
                                                    <td class="text-center"><img src="{{ asset('/assets/images/profile/'.$abc->gambar) }}" class="rounded mr-75" alt="profile image" height="64"></td>
                                                    <td>{{ $abc->nim }}</td>
                                                    <td>{{ $abc->nama }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection