@extends('travel.layouts.master')
@section('content')

<div class="content">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a>Dashboard </a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item"><a>Operasional </a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item active">Detail Pemberitahuan</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-2 col-md-4">
                                <div class="detail-personal">
                                    <h2>Nama Pengirim</h2>
                                    <h3>{{ $informasi->pengirim->nama }}</h3>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-4">
                                <div class="detail-personal">
                                    <h2>Nama Penerima </h2>
                                    <h3>{{ $informasi->penerima->nama_perusahaan }}</h3>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-4">
                                <div class="detail-personal">
                                    <h2>Tanggal Diterima</h2>
                                    <h3>{{ $informasi->created_at->format('F d, Y') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out mt-5">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Judul Pemberitahuan</h2>
                                    <h3>{{ $informasi->perihal }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Deskripsi</h2>
                                    <h3>{{ $informasi->isi }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>File</h2>
                                    <a href="{{ Storage::url($informasi->lampiran) }}" target="_blank">{{
                                        $informasi->lampiran }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="doctor-submit">
                        {{-- @dd($informasi->tanggapans) --}}
                        @if ($informasi->tanggapans->isNotEmpty())
                        <a href="{{ route('manager-operasional.tanggapan.show', $informasi->tanggapans[0]->id) }}"
                            class="btn btn-primary submit-form me-2">Lihat Tanggapan</a>
                        @else
                        <a href="{{ route('manager-operasional.tanggapan', $informasi->id) }}"
                            class="btn btn-primary submit-form me-2">Beri Tanggapan</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop