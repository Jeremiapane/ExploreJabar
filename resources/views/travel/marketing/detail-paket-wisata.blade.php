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
                    <li class="breadcrumb-item"><a href="/marketing/paket-wisata">Paket Wisata </a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item active">Detail Paket Wisata</li>
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
                                    <h2>Foto Paket</h2>
                                    <h3><img src="{{ asset($paket->attachment->path) }}"
                                            alt="{{ $paket->attachment->name }}" style="width: 100px;"></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-2 col-md-2">
                                <div class="detail-personal">
                                    <h2>Nama paket</h2>
                                    <h3>{{ $paket->nama }}</h3>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-2">
                                <div class="detail-personal">
                                    <h2>Kategori Paket </h2>
                                    <h3>{{ $paket->kategoriPaket->nama }}</h3>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-2">
                                <div class="detail-personal">
                                    <h2>Wilayah Wisata</h2>
                                    <h3>{{ $paket->wisata->daerah->provinsi }}</h3>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-2">
                                <div class="detail-personal">
                                    <h2>Status Paket</h2>
                                    <h3>{{ $paket->status_paket }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out mt-5">
                        <div class="row">
                            <div class="col-xl-9 col-md-4">
                                <div class="detail-personal">
                                    <h2>Deskripsi Paket</h2>
                                    <h3>{{ $paket->deskripsi }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-9 col-md-4">
                                <div class="detail-personal">
                                    <h2>Yang Akan Didapatkan</h2>
                                    <h3>{{ $paket->include }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-9 col-md-4">
                                <div class="detail-personal">
                                    <h2>Yang Tidak Akan Didapatkan</h2>
                                    <h3>{{ $paket->exclude }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Tempat Wisata Yang dikunjungi</h2>
                                    <h3>{{ $paket->wisata->nama }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Jumlah Peserta</h2>
                                    <h3>{{ $paket->jumlah_peserta }} Orang</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Kendaraan</h2>
                                    <h3>{{ $paket->kendaraan->jenis }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Pemandu Wisata</h2>
                                    <h3>{{ $paket->pemanduWisata->user->nama }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Harga</h2>
                                    <h3>Rp. {{ $paket->harga }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Aktivitas</h2>
                                    @foreach ($paket->aktivitas as $aktivitas)
                                    <h3 class="mt-2">{{ $aktivitas->aktivitas }}</h3>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (Auth::user()->id_level == 4)
                    <form action="{{ route('marketing.paket.update-status') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $paket->id }}">
                        <div class="personal-list-out">
                            <div class="row">
                                <div class="col-xl-3 col-md-4">
                                    <div class="detail-personal">
                                        <div class="input-block local-forms">
                                            <h2>Status</h2>
                                            <div class="pt-3">
                                                <input type="radio" name="status_verifikasi" value="aktif" {{
                                                    $paket->status_verifikasi == 'aktif' ? 'checked' : '' }}> Aktif
                                                <input type="radio" name="status_verifikasi" value="tidak aktif" {{
                                                    $paket->status_verifikasi == 'tidak aktif' ? 'checked' : '' }}>
                                                Tidak Aktif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-4">
                                    <div class="input-block local-forms">
                                        <label>Catatan <span class="login-danger">*</span></label>
                                        <div class="pt-3">
                                            <textarea class="form-control"
                                                name="catatan">{{ $paket->catatan }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="personal-list-out">
                            <div class="row">
                                <div class="col-xl-3 col-md-4">
                                    <div class="detail-personal">
                                        <div class="doctor-submit">
                                            <button type="submit"
                                                class="btn btn-primary submit-form me-2">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @elseif (Auth::user()->id_level == 5)
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Status</h2>
                                    <h3>{{ $paket->status_verifikasi }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@stop