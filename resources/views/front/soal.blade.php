@extends('front.layout')

@section('judul')
    Tes Bahasa Indonesia
@endsection

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .deskripsi p{
            margin-bottom: 0%;
        }
    </style>
@endsection

@section('content')
    @if(session()->get('success'))
        <div class ="alert alert-success">
            {{ session()->get('success') }}  
        </div><br />
    @endif

    <div class="sidebar-shop" id="ecommerce-sidebar-toggler">
        <div class="card">
            <div class="card-body justify-content-between">
                <h4 class="align-center">Tes Bahasa Indonesia
                    <div class="float-right">
                        <h5 class="d-inline">Waktu Tersisa : </h5>
                        <div class="btn btn-danger d-inline">0:00:00</div>
                    </div>
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <h6 class="filter-heading">Pertanyaan</h6>
                <div class="card">
                    <div class="card-body">
                        <div class="overflow-auto">
                            <div id="gambar"></div>
                            <div id="pertanyaan"></div>
                            <ul class="list-unstyled mb-0" id="jawaban"></ul>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-left" id="sebelumnya"></div>
                        <div class="float-right" id="selanjutnya"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h6 class="filter-heading">Navigasi</h6>
                <div class="card">
                    @foreach ($data as $item)
                    @if ($loop->first) @else <hr class="m-0"> @endif
                        <div class="card-header">
                            {{ $item->nama }}
                        </div>
                        <div class="card-body @if ($loop->last) @else pb-0 @endif" style="padding-left: 1rem; padding-right: 0.8rem">
                            @php $nourut = "" @endphp
                            @foreach ($item['soal'] as $soal)
                                <button type="button" class="alert @if($soal->idPilihan == null) alert-primary @else alert-success @endif px-0 navigasi" @if ($loop->first) id="awal" @endif @if ($loop->last) id="akhir" @endif style="border-radius: 0; width: 35px" data-value="{{ $soal->idSoal }}" data-id="{{ $soal->id }}">{{ $no }}</button>
                                @php $no++ @endphp
                                @php $nourut = $soal->id @endphp
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <button class="btn btn-block btn-success"><i class="feather icon-check"></i> Selesai</button>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready( function () {
            var data = $('#awal').attr('data-id');
            var awal = $('#awal').attr('data-id');
            var akhir = {{ $nourut }};
            console.log(data);
            console.log(akhir);
            $.get( "/mahasiswa/data-soal/" + data, function( data ) {
                var d = JSON.parse(data);
                
                $('#pertanyaan').html(d.pertanyaan);
                if (d.media != null) {
                    $('#gambar').html('<img src="/assets/images/soal/'+ d.media +'" class="img-fluid" id="gambar">');
                }
                for (var i = 0; i < d['pilihan'].length; i++) {
                    var cek = "";
                    if (d.idPilihan == d['pilihan'][i].id) {
                        cek = "checked"
                    }
                    $('#jawaban').append(`<li class="mr-2">
                                            <fieldset>
                                                <div class="vs-radio-con">
                                                    <input type="radio" name="vueradio" class="data-jawaban" value="`+ d.id +`/`+ d['pilihan'][i].id +`" `+ cek +`>
                                                    <span class="vs-radio">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="deskripsi">`+ d['pilihan'][i].deskripsi +`</span>
                                                </div>
                                            </fieldset>
                                        </li>`);
                }

                var next = parseInt(awal) + 1;
                $('#selanjutnya').html('<button type="button" class="btn btn-primary" data-value="'+ next +'"><i class="feather icon-arrow-right"></i> Selanjutnya</button>');
            });

            $(document).on('click', '.navigasi', function(e) {
                var id = $(this).attr('data-value');
                var no = $(this).attr('data-id');
                $.get( "/mahasiswa/data-soal/" + id, function( data ) {
                    var d = JSON.parse(data);
                    
                    $('#pertanyaan').html(d.pertanyaan);

                    $('#gambar img').remove();
                    $('#gambar').hide();
                    if (d.media != null) {
                        $('#gambar').show();
                        $('#gambar').html('<img src="/assets/images/soal/'+ d.media +'" class="img-fluid" style="height: 400px;" id="gambar"><br><br>');
                    }

                    $('#jawaban li').remove();
                    for (var i = 0; i < d['pilihan'].length; i++) {
                        var cek = "";
                        if (d.idPilihan == d['pilihan'][i].id) {
                            cek = "checked"
                        }
                        $('#jawaban').append(`<li class="mr-2">
                                                <fieldset>
                                                    <div class="vs-radio-con">
                                                        <input type="radio" name="vueradio" class="data-jawaban" value="`+ d.id +`/`+ d['pilihan'][i].id +`" `+ cek +` data-value="`+ d.id +`">
                                                        <span class="vs-radio">
                                                            <span class="vs-radio--border"></span>
                                                            <span class="vs-radio--circle"></span>
                                                        </span>
                                                        <span class="deskripsi">`+ d['pilihan'][i].deskripsi +`</span>
                                                    </div>
                                                </fieldset>
                                            </li>`);
                    }

                    var next = parseInt(no) + 1;
                    var previous = parseInt(no) + 1;
                    $('#sebelumnya button').remove();
                    $('#sebelumnya').hide();
                    $('#selanjutnya button').remove();
                    $('#selanjutnya').hide();
                    if (no == awal) {
                        $('#selanjutnya').show();
                        $('#selanjutnya').html('<button type="button" class="btn btn-primary" data-value="'+ next +'"><i class="feather icon-arrow-right"></i> Selanjutnya</button>');
                    } else if (no == akhir) {
                        $('#sebelumnya').show();
                        $('#sebelumnya').html('<button type="button" class="btn btn-primary" data-value="'+ previous +'"><i class="feather icon-arrow-left"></i> Sebelumnya</button>');
                    } else {
                        $('#sebelumnya').show();
                        $('#sebelumnya').html('<button type="button" class="btn btn-primary" data-value="'+ previous +'"><i class="feather icon-arrow-left"></i> Sebelumnya</button>');
                        $('#selanjutnya').show();
                        $('#selanjutnya').html('<button type="button" class="btn btn-primary" data-value="'+ next +'"><i class="feather icon-arrow-right"></i> Selanjutnya</button>');
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.data-jawaban', function() {
                var jawaban = $(this).val();
                var id = $(this).attr('data-value');

                $('.navigasi[data-value = '+ id +']').removeClass('alert-primary');
                $('.navigasi[data-value = '+ id +']').addClass('alert-success');

                $.ajax({
                    url: "{{ route('jawab') }}",
                    type: "POST",
                    data: {
                        jawaban: jawaban
                    },
                });
            });
        });
    </script>
@endsection