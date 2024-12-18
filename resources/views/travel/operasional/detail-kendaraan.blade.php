@extends('travel.layouts.master')
@section('content')

<div class="content">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/operasional">Dashboard </a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item"><a href="/operasional/kendaraan">Kendaraan </a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item active">Detail Kendaraan</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="personal-list-out my-5">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Foto Kendaraan</h2>
                                    <h3><img src="{{ asset($kendaraan->attachment->path) }}"
                                            alt="{{ $kendaraan->attachment->name }}" style="width: 100px;"></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Jenis Kendaraan</h2>
                                    <h3>{{ $kendaraan->jenis }}</h3>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Merk Kendaraan </h2>
                                    <h3>{{ $kendaraan->merk }}</h3>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>No. Plat Kendaraan</h2>
                                    <h3>{{ $kendaraan->no_plat }}</h3>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Status Kendaraan</h2>
                                    <h3>{{ $kendaraan->status_kendaraan }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out mt-5">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Tahun Pembuatan</h2>
                                    <h3>{{ $kendaraan->tahun_pembuatan }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Warna Kendaraan</h2>
                                    <h3>{{ $kendaraan->warna }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Kapasitas Minimum</h2>
                                    <h3>{{ $kendaraan->kapasitas_minimum }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Kapasitas Maximum</h2>
                                    <h3>{{ $kendaraan->kapasitas_maximum }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Fasilitas Kendaraan</h2>
                                    <h3>{{ $kendaraan->fitur }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Catatan</h2>
                                    <h3>{{ $kendaraan->catatan }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Status</h2>
                                    <h3>{{ $kendaraan->status_verifikasi }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('operasional.kendaraan.update-status', $kendaraan->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @if (Auth::user()->id_level == 2)
                        <div class="col-12 ">
                            <div class="input-block local-forms">
                                <label>Status Verifikasi <span class="login-danger">*</span></label>
                                <div class="pt-3">
                                    <input type="radio" name="status_verifikasi" value="aktif"> Aktif
                                    <input type="radio" name="status_verifikasi" value="tidak aktif"> Tidak Aktif
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-block local-forms">
                                <label>Catatan <span class="login-danger">*</span></label>
                                <div class="pt-3">
                                    <textarea class="form-control" name="catatan"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="doctor-submit ">
                                <button type="submit" class="btn btn-primary submit-form me-2">Submit</button>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop