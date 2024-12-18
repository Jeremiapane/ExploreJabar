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
                    <li class="breadcrumb-item"><a>Manager Operasional </a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item active">Detail Tanggapan</li>
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
                                    <h2>Tanggal Informasi</h2>
                                    <h3>{{ $informasi->created_at->format('F d, Y') }}</h3>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-4">
                                <div class="detail-personal">
                                    <h2>Tanggal Tanggapan</h2>
                                    <h3>{{ $tanggapan->created_at->format('F d, Y') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out mt-5">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Perihal Informasi</h2>
                                    <h3>{{ $informasi->perihal }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Deskripsi Informasi</h2>
                                    <h3>{{ $informasi->isi }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Lampiran Informasi</h2>
                                    <a href="{{ Storage::url($informasi->lampiran) }}" target="_blank">{{
                                        $informasi->lampiran }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out mt-5">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Perihal Tanggapan</h2>
                                    <h3>{{ $tanggapan->perihal }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Isi Tanggapan</h2>
                                    <h3>{{ $tanggapan->isi }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Lampiran Tanggapan</h2>
                                    <a href="{{ Storage::url($tanggapan->lampiran) }}" target="_blank">{{
                                        $tanggapan->lampiran }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop