@extends('travel.layouts.master')
@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Manager Operasional </a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item active">Detail Profile</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <!-- Lightbox -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Profile</h4>
                </div>
                <div class="card-body">
                    <div class="wizard">
                        <div class="tab-content" id="myTabContent">
                            <form method="POST" action="{{ route('operasional.update-profile', $operasional->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Nama Perusahaan -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-block local-forms">
                                            <label>Nama Perusahaan <span class="login-danger">*</span></label>
                                            <input class="form-control" type="text" name="nama_perusahaan"
                                                value="{{ $operasional->nama_perusahaan }}">
                                        </div>
                                    </div>

                                    <!-- No Telp -->
                                    <div class="col-12">
                                        <div class="input-block local-forms">
                                            <label>No Telp <span class="login-danger">*</span></label>
                                            <input class="form-control" type="number" name="no_telp"
                                                value="{{ $operasional->no_telp_perusahaan }}">
                                        </div>
                                    </div>

                                    <!-- Email Perusahaan -->
                                    <div class="col-12">
                                        <div class="input-block local-forms">
                                            <label>Email Perusahaan <span class="login-danger">*</span></label>
                                            <input class="form-control" type="email" name="email_perusahaan"
                                                value="{{ $operasional->user->email }}">
                                        </div>
                                    </div>

                                    <!-- Alamat Perusahaan -->
                                    <div class="col-12">
                                        <div class="input-block local-forms">
                                            <label>Alamat Perusahaan <span class="login-danger">*</span></label>
                                            <input class="form-control" type="text" name="alamat_perusahaan"
                                                value="{{ $operasional->alamat_perusahaan }}">
                                        </div>
                                    </div>

                                    <!-- Dokumen Akte Pendirian -->
                                    <div class="col-12">
                                        <div class="input-block local-forms">
                                            <label>Upload Dokumen Akte Pendirian <span
                                                    class="login-danger">*</span></label>
                                            <input class="form-control" type="file" name="dokumen_akte">
                                            @if($operasional->dokumenAkte->first())
                                            <a href="{{ asset($operasional->dokumenAkte->first()->path) }}"
                                                target="_blank">Lihat Dokumen Akte Pendirian</a>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Dokumen SK Kemenkumham -->
                                    <div class="col-12">
                                        <div class="input-block local-forms">
                                            <label>Upload Dokumen SK Kemenkumham <span
                                                    class="login-danger">*</span></label>
                                            <input class="form-control" type="file" name="dokumen_sk">
                                            @if($operasional->dokumenSK->first())
                                            <a href="{{ asset($operasional->dokumenSK->first()->path) }}"
                                                target="_blank">Lihat Dokumen SK Kemenkumham</a>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Dokumen NPWP -->
                                    <div class="col-12">
                                        <div class="input-block local-forms">
                                            <label>Upload Dokumen NPWP <span class="login-danger">*</span></label>
                                            <input class="form-control" type="file" name="dokumen_npwp">
                                            @if($operasional->dokumenNPWP->first())
                                            <a href="{{ asset($operasional->dokumenNPWP->first()->path) }}"
                                                target="_blank">Lihat Dokumen NPWP</a>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Dokumen NIB -->
                                    <div class="col-12">
                                        <div class="input-block local-forms">
                                            <label>Upload Dokumen NIB <span class="login-danger">*</span></label>
                                            <input class="form-control" type="file" name="dokumen_nib">
                                            @if($operasional->dokumenNIB->first())
                                            <a href="{{ asset($operasional->dokumenNIB->first()->path) }}"
                                                target="_blank">Lihat Dokumen NIB</a>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Dokumen Sertifikasi Usaha -->
                                    <div class="col-12">
                                        <div class="input-block local-forms">
                                            <label>Upload Dokumen Sertifikasi Usaha <span
                                                    class="login-danger">*</span></label>
                                            <input class="form-control" type="file" name="dokumen_sertifikasi">
                                            @if($operasional->dokumenSertifikasi->first())
                                            <a href="{{ asset($operasional->dokumenSertifikasi->first()->path) }}"
                                                target="_blank">Lihat Dokumen Sertifikasi Usaha</a>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Dokumen KTP Pemilik Agen Travel -->
                                    <div class="col-12">
                                        <div class="input-block local-forms">
                                            <label>Upload KTP Pemilik Agen Travel <span
                                                    class="login-danger">*</span></label>
                                            <input class="form-control" type="file" name="dokumen_ktp">
                                            @if($operasional->dokumenKTP->first())
                                            <a href="{{ asset($operasional->dokumenKTP->first()->path) }}"
                                                target="_blank">Lihat KTP Pemilik Agen Travel</a>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Status Verifikasi -->
                                    <div class="col-12">
                                        <div class="input-block local-forms">
                                            <label>Status Verifikasi</label>
                                            <input class="form-control" type="text" disabled
                                                value="{{ $operasional->status_verifikasi }}">
                                        </div>
                                    </div>

                                    <!-- Catatan -->
                                    <div class="col-12">
                                        <div class="input-block local-forms">
                                            <label>Catatan</label>
                                            <input class="form-control" type="text" disabled
                                                value="{{ $operasional->catatan }}">
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="input-block login-btn">
                                        <button class="btn btn-primary btn-block" type="submit">Update</button>
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

@stop