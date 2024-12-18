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
                        <li class="breadcrumb-item active">Edit Kendaraan</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('operasional.kendaraan.update', $kendaraan->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-heading">
                                        <h4>Edit Kendaraan</h4>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-block local-forms">
                                        <label>Foto Kendaraan</label>
                                        <input class="form-control" type="file" name="foto_kendaraan">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-block local-forms">
                                        <label>Nama Jenis Kendaraan <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" name="jenis" value="{{ $kendaraan->jenis }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-block local-forms">
                                        <label>Merk Kendaraan <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" name="merk" value="{{ $kendaraan->merk }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-block local-forms">
                                        <label>No. Plat Kendaraan <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" name="no_plat" value="{{ $kendaraan->no_plat }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-block local-forms cal-icon">
                                        <label>Tahun Pembuatan <span class="login-danger">*</span></label>
                                        <input class="form-control datetimepicker" type="text" name="tahun_pembuatan" value="{{ $kendaraan->tahun_pembuatan }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-block local-forms">
                                        <label>Warna Kendaraan <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" name="warna" value="{{ $kendaraan->warna }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-block local-forms">
                                        <label>Kapasitas Minimum <span class="login-danger">*</span></label>
                                        <input class="form-control" type="number" name="kapasitas_minimum" value="{{ $kendaraan->kapasitas_minimum }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-block local-forms">
                                        <label>Kapasitas Maximum <span class="login-danger">*</span></label>
                                        <input class="form-control" type="number" name="kapasitas_maximum" value="{{ $kendaraan->kapasitas_maximum }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-block local-forms">
                                        <label>Fitur kendaraan <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" name="fitur" value="{{ $kendaraan->fitur }}" required>
                                    </div>
                                </div>
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
                                @endif
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
