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
                        <li class="breadcrumb-item active">Tambah Kendaraan</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('kendaraan.store') }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-heading">
                                        <h4>Tambah Kendaraan</h4>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-block local-forms">
                                        <label>Foto Kendaraan <span class="login-danger">*</span></label>
                                        <input class="form-control @error('foto_kendaraan') is-invalid @enderror" type="file" name="foto_kendaraan">
                                        @error('foto_kendaraan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-block local-forms">
                                        <label>Nama Jenis Kendaraan <span class="login-danger">*</span></label>
                                        <input class="form-control @error('jenis') is-invalid @enderror" type="text" name="jenis" value="{{ old('jenis') }}">
                                        @error('jenis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-block local-forms">
                                        <label>Merk Kendaraan <span class="login-danger">*</span></label>
                                        <input class="form-control @error('merk') is-invalid @enderror" type="text" name="merk" value="{{ old('merk') }}">
                                        @error('merk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-block local-forms">
                                        <label>No. Plat Kendaraan <span class="login-danger">*</span></label>
                                        <input class="form-control @error('no_plat') is-invalid @enderror" type="text" name="no_plat" value="{{ old('no_plat') }}">
                                        @error('no_plat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-block local-forms cal-icon">
                                        <label>Tahun Pembuatan <span class="login-danger">*</span></label>
                                        <input class="form-control datetimepicker @error('tahun_pembuatan') is-invalid @enderror" type="text" name="tahun_pembuatan" value="{{ old('tahun_pembuatan') }}">
                                        @error('tahun_pembuatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-block local-forms">
                                        <label>Warna Kendaraan <span class="login-danger">*</span></label>
                                        <input class="form-control @error('warna') is-invalid @enderror" type="text" name="warna" value="{{ old('warna') }}">
                                        @error('warna')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-block local-forms">
                                        <label>Kapasitas Minimum <span class="login-danger">*</span></label>
                                        <input class="form-control @error('kapasitas_minimum') is-invalid @enderror" type="number" name="kapasitas_minimum" value="{{ old('kapasitas_minimum') }}">
                                        @error('kapasitas_minimum')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-block local-forms">
                                        <label>Kapasitas Maximum <span class="login-danger">*</span></label>
                                        <input class="form-control @error('kapasitas_maximum') is-invalid @enderror" type="number" name="kapasitas_maximum" value="{{ old('kapasitas_maximum') }}">
                                        @error('kapasitas_maximum')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-block local-forms">
                                        <label>Fitur Kendaraan <span class="login-danger">*</span></label>
                                        <input class="form-control @error('fitur') is-invalid @enderror" type="text" name="fitur" value="{{ old('fitur') }}">
                                        @error('fitur')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="doctor-submit text-end">
                                        <button type="submit" class="btn btn-primary submit-form me-2">Submit</button>
                                        <button type="reset" class="btn btn-primary cancel-form">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
