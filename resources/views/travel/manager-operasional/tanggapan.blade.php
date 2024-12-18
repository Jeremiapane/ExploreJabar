@extends('travel.layouts.master')
@section('content')

<div class="content">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/manager-operasional">Dashboard </a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item active">Tambah Tanggapan</li>
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
                                    <h2>Deskripsi Pemberitahuan</h2>
                                    <h3>{{ $informasi->isi }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Lampiran Pemberitahuan</h2>
                                    <a href="{{ Storage::url($informasi->lampiran) }}" target="_blank">{{
                                        $informasi->lampiran }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('manager-operasional.tanggapan.store') }}" autocomplete="off" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_pemberitahuan" value="{{ $informasi->id }}">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-block local-forms">
                                    <label>Lampiran Tanggapan <span class="login-danger">*</span></label>
                                    <input class="form-control @error('lampiran') is-invalid @enderror" type="file"
                                        name="lampiran">
                                    @error('lampiran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-block local-forms">
                                    <label>Perihal <span class="login-danger">*</span></label>
                                    <input class="form-control @error('perihal') is-invalid @enderror" type="text"
                                        name="perihal" value="{{ old('perihal') }}">
                                    @error('perihal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-block local-forms">
                                    <label>Isi Tanggapan <span class="login-danger">*</span></label>
                                    <textarea class="form-control" name="isi"></textarea>
                                    @error('isi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="doctor-submit">
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