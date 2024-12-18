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
                        <li class="breadcrumb-item"><a href="/operasional/pemandu-wisata">Pemandu Wisata </a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Tambah Pemandu Wisata</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('pemandu-wisata.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-heading">
                                        <h4>Tambah Pemandu Wisata</h4>
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <div class="input-block local-forms">
                                        <label>Foto Pemandu Wisata <span class="login-danger">*</span></label>
                                        <input class="form-control @error('foto') is-invalid @enderror" type="file" name="foto">
                                        @error('foto')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <div class="input-block local-forms">
                                        <label>Nama Pemandu Wisata <span class="login-danger">*</span></label>
                                        <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama" value="{{ old('nama') }}">
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <div class="input-block local-forms">
                                        <label>Email <span class="login-danger">*</span></label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <div class="input-block local-forms">
                                        <label>No. Lisensi Sertifikasi <span class="login-danger">*</span></label>
                                        <input class="form-control @error('sertifikasi') is-invalid @enderror" type="text" name="sertifikasi" value="{{ old('sertifikasi') }}">
                                        @error('sertifikasi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <div class="input-block local-forms">
                                        <label>Kategori Pemandu <span class="login-danger">*</span></label>
                                        <select class="form-control @error('kategori_paket_id') is-invalid @enderror" name="kategori_paket_id">
                                            <option>-- Select --</option>
                                            @foreach ($kategoriPaket as $kategori)
                                                <option value="{{ $kategori->id }}" {{ old('kategori_paket_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori_paket_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <div class="input-block local-forms">
                                        <label>Deskripsi <span class="login-danger">*</span></label>
                                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" rows="3" name="deskripsi">{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <div class="input-block local-forms">
                                        <label>No. Telp <span class="login-danger">*</span></label>
                                        <input class="form-control @error('no_telp') is-invalid @enderror" type="text" name="no_telp" value="{{ old('no_telp') }}">
                                        @error('no_telp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <div class="input-block local-forms">
                                        <label>Alamat <span class="login-danger">*</span></label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" rows="3" name="alamat">{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <div class="input-block local-forms">
                                        <label>Keahlian Khusus <span class="login-danger">*</span></label>
                                        <textarea class="form-control @error('keahlian') is-invalid @enderror" rows="3" name="keahlian">{{ old('keahlian') }}</textarea>
                                        @error('keahlian')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="doctor-submit text-end">
                                        <button type="submit" class="btn btn-primary submit-form me-2">Submit</button>
                                        <button type="button" class="btn btn-primary cancel-form">Cancel</button>
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
