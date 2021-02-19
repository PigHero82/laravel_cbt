@extends('layout')

@section('judul')
    Langkah Terakhir
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')
    <!-- account setting page start -->
    <section id="page-account-settings">
        <div class="row">
            <!-- left menu section -->
            <div class="col-md-3 mb-2 mb-md-0">
                <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                    <li class="nav-item">
                        <a class="nav-link d-flex py-75 active" href="{{ route('dosen.soal.show', $paket->id) }}" aria-expanded="true">
                            <i class="feather icon-chevron-left mr-50 font-medium-3"></i>
                            Kembali ke Paket
                        </a>
                    </li>
                </ul>
            </div>
            <!-- right content section -->
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane active" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="true">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="card text-center">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <h2 class="text-bold-700">{{ $paket->nama }}</h2>
                                            <p class="mb-0 line-ellipsis">Paket</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="card text-center">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <h2 class="text-bold-700">{{ $grup->nama }}</h2>
                                            <p class="mb-0 line-ellipsis">Grup</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form form-horizontal" method="POST" action="{{ route('dosen.teks.store') }}">
                                        @csrf
                                        <input type="hidden" name="grup" value="{{ $grup->id }}">
                                        <input type="hidden" name="paket" value="{{ $paket->id }}">
                                        <div class="form-body">
                                            <div class="row">
                                                @for ($i = 1; $i <= count($isi); $i++)
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-3">
                                                                <span>Pertanyaan {{ $i }}</span>
                                                            </div>

                                                            <div class="col-md-9">
                                                                <fieldset class="form-group">
                                                                    <textarea class="form-control summernote" rows="3" name="soal[{{ $i-1 }}][soal]" required>{!! $isi[$i]['soal'] !!}</textarea>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @for ($a = 0; $a < count($isi[$i]['jawab']); $a++)
                                                        <div class="col-12">
                                                            <div id="data-jawaban">
                                                                <div class="form-group row">
                                                                    <div class="col-md-3">
                                                                        @if ($a == 0)
                                                                            <span>Jawaban</span>
                                                                        @endif
                                                                    </div>

                                                                    <div class="col-md-9">
                                                                        <div class="pertanyaan">
                                                                            <fieldset class="form-group">
                                                                                <label>Jawaban {{ $a+1 }}</label>
                                                                                <textarea class="form-control jawab" rows="3" name="soal[{{ $i-1 }}][jawaban][{{ $a }}]">{!! $isi[$i]['jawab'][$a] !!}</textarea>
                                                                                
                                                                                <div class="vs-radio-con">
                                                                                    <input type="radio" name="soal[{{ $i-1 }}][benar]" value="{{ $a }}">
                                                                                    <span class="vs-radio">
                                                                                        <span class="vs-radio--border"></span>
                                                                                        <span class="vs-radio--circle"></span>
                                                                                    </span>
                                                                                    <span class="">Jawaban Benar</span>
                                                                                </div>
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endfor
                                                @endfor

                                                <div class="col-12">
                                                    <div class="float-right">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- account setting page end -->
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
                toolbar: []
            });

            $('.jawab').summernote({
                height: 60,
                toolbar: []
            });
        });
    </script>
@endsection