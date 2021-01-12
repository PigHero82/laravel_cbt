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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
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
                    <input type="hidden" id="waktu" value="{{ $data_ujian->waktu }}">
                    <div class="float-right">
                        <h5 class="d-inline">Waktu Tersisa : </h5>
                        <p class="d-inline text-danger" id="demo"></p>
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
                            <div id="jawaban-esai"></div>
                            <hr>
                            <div id="jawaban"></div>
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
                                <button type="button" class="alert @if($soal->idPilihan == null && $soal->jawaban_esai == null) alert-primary @else alert-success @endif px-0 navigasi" @if ($loop->first) id="awal" @endif @if ($loop->last) id="akhir" @endif style="border-radius: 0; width: 35px" data-value="{{ $soal->idSoal }}" data-id="{{ $soal->id }}">{{ $no }}</button>
                                @php $no++ @endphp
                                @php $nourut = $soal->id @endphp
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <form action="{{ route('index') }}" method="get">
                    <button type="button" class="btn btn-block btn-success keluar"><i class="feather icon-check"></i> Selesai</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            var data = $('#awal').attr('data-id');
            var awal = $('#awal').attr('data-id');
            var akhir = {{ $nourut }};
            var getData = "{{ url('peserta/data-soal') }}";
            $.get(getData + "/" + data, function( data ) {
                var d = JSON.parse(data);
                
                $('#pertanyaan').html(d.pertanyaan);

                if (d.media != null) {
                    $('#gambar').html('<img src="{{ url('/assets/images/soal') }}/'+ d.media +'" class="img-fluid mb-1" style="height: 400px;" id="gambar">');
                }

                if (d.modelSoal != 4) { 
                    $('#jawaban ul').remove();        
                    for (var i = 0; i < d['pilihan'].length; i++) {
                        var cek = "";
                        if (d.idPilihan == d['pilihan'][i].id) {
                            cek = "checked"
                        }
                        $('#jawaban').append(`<ul class="list-unstyled mb-0">
                                                <li class="mr-2">
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
                                                </li>
                                            </ul>`);
                    }
                } else {
                    $('#jawaban-esai div').remove();
                    if (d.jawaban_esai != null) {
                        $('#jawaban-esai').html(`<div>
                                                    <h5>Jawaban :</h5>
                                                    `+ d.jawaban_esai +`
                                                </div>`);
                    }                 

                    $('#jawaban form').remove();
                    $('#jawaban').append(`<form id="jawab-soal">
                                            <input type="hidden" name="id" id="data" value="`+ d.abc +`">
                                            <div class="form-group">
                                                <label for="jawaban">Jawaban</label>
                                                <label class="text-danger">(Jawaban yang telah diisi sebelumnya dapat diubah dengan mengisi ulang kolom jawaban)</label>
                                                <textarea id="esai" class="form-control" name="jawaban" rows="3"></textarea>
                                                <button type="button" class="btn btn-success mt-1"><i class="feather icon-check"></i> Submit</button>
                                            </div>
                                        </form>`);
                    $('textarea').summernote({
                        height: 200,
                        toolbar: []
                    });
                }

                var next = parseInt(awal) + 1;
                $('#selanjutnya').html('<button type="button" class="btn btn-primary navigasi" data-id="'+ next +'"><i class="feather icon-arrow-right"></i> Selanjutnya</button>');
            });

            $(document).on('click', '.navigasi', function(e) {
                var no = $(this).attr('data-id');
                $.get(getData + "/" + no, function( data ) {
                    var d = JSON.parse(data);
                    
                    $('#pertanyaan').html(d.pertanyaan);

                    $('#jawaban form').hide();
                    $('#jawaban ul').hide();
                    $('#gambar img').remove();
                    $('#gambar').hide();
                    if (d.media != null) {
                        $('#gambar').show();
                        $('#gambar').html('<img src="/assets/images/soal/'+ d.media +'" class="img-fluid mb-1" style="height: 400px;" id="gambar"><br><br>');
                    }

                    if (d.modelSoal != 4) {         
                        $('#jawaban ul').remove();
                        $('#jawaban-esai div').remove();
                        for (var i = 0; i < d['pilihan'].length; i++) {
                            var cek = "";
                            if (d.idPilihan == d['pilihan'][i].id) {
                                cek = "checked"
                            }
                            $('#jawaban').append(`<ul class="list-unstyled mb-0">
                                                    <li class="mr-2">
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
                                                    </li>
                                                </ul>`);
                        }
                    } else {
                        if (d.jawaban_esai != null) {
                            $('#jawaban-esai').html(`<div class="mt-1">
                                                        <h5>Jawaban :</h5>
                                                        `+ d.jawaban_esai +`
                                                    </div>`);
                        } else {
                            $('#jawaban-esai').html(``);
                        }

                        $('#jawaban form').remove();
                        $('#jawaban').append(`<form id="jawab-soal">
                                                <input type="hidden" name="id" id="data" value="`+ d.abc +`">
                                                <div class="form-group">
                                                    <label for="jawaban">Jawaban</label>
                                                    <label class="text-danger">(Jawaban yang telah diisi sebelumnya dapat diubah dengan mengisi ulang kolom jawaban)</label>
                                                    <textarea id="esai" class="form-control" name="jawaban" rows="3"></textarea>
                                                    <button type="button" class="btn btn-success mt-1"><i class="feather icon-check"></i> Submit</button>
                                                </div>
                                            </form>`);
                        $('textarea').summernote({
                            height: 200,
                            toolbar: []
                        });
                    }

                    var next = parseInt(no) + 1;
                    var previous = parseInt(no) - 1;
                    $('#sebelumnya button').remove();
                    $('#sebelumnya').hide();
                    $('#selanjutnya button').remove();
                    $('#selanjutnya').hide();
                    if (no == awal) {
                        $('#selanjutnya').show();
                        $('#selanjutnya').html('<button type="button" class="btn btn-primary navigasi" data-id="'+ next +'"><i class="feather icon-arrow-right"></i> Selanjutnya</button>');
                    } else if (no == akhir) {
                        $('#sebelumnya').show();
                        $('#sebelumnya').html('<button type="button" class="btn btn-primary navigasi" data-id="'+ previous +'"><i class="feather icon-arrow-left"></i> Sebelumnya</button>');
                    } else {
                        $('#sebelumnya').show();
                        $('#sebelumnya').html('<button type="button" class="btn btn-primary navigasi" data-id="'+ previous +'"><i class="feather icon-arrow-left"></i> Sebelumnya</button>');
                        $('#selanjutnya').show();
                        $('#selanjutnya').html('<button type="button" class="btn btn-primary navigasi" data-id="'+ next +'"><i class="feather icon-arrow-right"></i> Selanjutnya</button>');
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.keluar', function () {
                id = $(this).parent('form');
                Swal.fire({
                    title: 'Yakin ingin keluar dari tes?',
                    text: "Anda masih dapat menjawab tes apabila masih ada waktu tersisa",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    confirmButtonClass: 'btn btn-primary',
                    cancelButtonText: 'Tidak',
                    cancelButtonClass: 'btn btn-danger ml-1',
                    buttonsStyling: false,
                }).then(function (result) {
                    if (result.value) {
                        id.submit();
                    }
                })
            });

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

            $(document).on('click', '#jawab-soal button', function() {
                var jawaban_esai = $('#esai').val();
                var id = $('#data').val();
                console.log(id);

                $('.navigasi[data-id = '+ id +']').removeClass('alert-primary');
                $('.navigasi[data-id = '+ id +']').addClass('alert-success');

                $.ajax({
                    url: "{{ route('jawab') }}",
                    type: "POST",
                    data: {
                        jawaban_esai: jawaban_esai,
                        id: id
                    },
                });
                
                $('#jawaban-esai div').remove();
                $('#jawaban-esai').html(`<div>
                                            <h5>Jawaban :</h5>
                                            `+ jawaban_esai +`
                                        </div>`);

                $('textarea').summernote('destroy');
                $('textarea').val('');
                $('textarea').summernote({
                    height: 200,
                    toolbar: []
                });
            });
        });
    </script>
    <script>
        var waktu = $('#waktu').val();
        console.log(waktu);
        var countDownDate = new Date(waktu).getTime();
        
        var x = setInterval(function() {
        
          var now = new Date().getTime();
            
          var distance = countDownDate - now;
            
          var hours = Math.floor(distance / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
          document.getElementById("demo").innerHTML = hours + ":"
          + minutes + ":" + seconds;
            
          if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "WAKTU HABIS";
            $('.keluar').parent('form').submit();
          }
        }, 1000);
        </script>
@endsection