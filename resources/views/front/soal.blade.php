@extends('front.layout')

@section('judul')
    Tes Bahasa Indonesia
@endsection

@section('css')
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
                            <ul class="list-unstyled mb-0" id="jawaban">
                                {{-- <li class=" mr-2">
                                    <fieldset>
                                        <div class="vs-radio-con">
                                            <input type="radio" name="vueradio">
                                            <span class="vs-radio">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <span class="">A. Sebagai alat pemersatu</span>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class=" mr-2">
                                    <fieldset>
                                        <div class="vs-radio-con">
                                            <input type="radio" name="vueradio">
                                            <span class="vs-radio">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <span class="">B. Sebagai kerangka acuan</span>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class=" mr-2">
                                    <fieldset>
                                        <div class="vs-radio-con">
                                            <input type="radio" name="vueradio">
                                            <span class="vs-radio">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <span class="">C. Sebagai pemecah bangsa</span>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class=" mr-2">
                                    <fieldset>
                                        <div class="vs-radio-con">
                                            <input type="radio" name="vueradio">
                                            <span class="vs-radio">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <span class="">D. Sebagai ciri khas suatu bangsa</span>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class=" mr-2">
                                    <fieldset>
                                        <div class="vs-radio-con">
                                            <input type="radio" name="vueradio">
                                            <span class="vs-radio">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <span class="">E. Sebagai dasar negara</span>
                                        </div>
                                    </fieldset>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <button type="button" class="btn btn-primary"><i class="feather icon-arrow-right"></i> Selanjutnya</button>
                        </div>
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
                            @foreach ($item['soal'] as $soal)
                                <button type="button" class="alert alert-primary px-0 navigasi" @if ($loop->first) id="awal" @endif style="border-radius: 0; width: 35px" data-value="{{ $soal->idSoal }}">{{ $no }}</button>
                                @php $no++ @endphp
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
            var data = $('#awal').attr('data-value');
            $.get( "/mahasiswa/data-soal/" + data, function( data ) {
                console.log(JSON.parse(data));
                var d = JSON.parse(data);
                
                $('#pertanyaan').html(d.pertanyaan);
                if (d.media != null) {
                    $('#gambar').html('<img src="/assets/images/soal/'+ d.media +'" class="img-fluid" id="gambar">');
                }
                for (var i = 0; i < d['pilihan'].length; i++) {
                    $('#jawaban').append(`<li class="mr-2">
                                            <fieldset>
                                                <div class="vs-radio-con">
                                                    <input type="radio" name="vueradio">
                                                    <span class="vs-radio">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="deskripsi">`+ d['pilihan'][i].deskripsi +`</span>
                                                </div>
                                            </fieldset>
                                        </li>`);
                }
            });

            $(document).on('click', '.navigasi', function(e) {
                var id = $(this).attr('data-value');
                console.log(id);
                $.get( "/mahasiswa/data-soal/" + id, function( data ) {
                    console.log(JSON.parse(data));
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
                        $('#jawaban').append(`<li class="mr-2">
                                                <fieldset>
                                                    <div class="vs-radio-con">
                                                        <input type="radio" name="vueradio">
                                                        <span class="vs-radio">
                                                            <span class="vs-radio--border"></span>
                                                            <span class="vs-radio--circle"></span>
                                                        </span>
                                                        <span class="deskripsi">`+ d['pilihan'][i].deskripsi +`</span>
                                                    </div>
                                                </fieldset>
                                            </li>`);
                    }
                });
            });
        });
    </script>
@endsection