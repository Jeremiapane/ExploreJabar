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
                    <li class="breadcrumb-item"><a href="/operasional/pemandu-wisata">Pemandu </a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item active">Detail Pemandu</li>
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
                                    <h2>Foto Pemandu</h2>
                                    <h3><img src="{{ asset($pemandu->attachment->path) }}"
                                            alt="{{ $pemandu->attachment->name }}" style="width: 100px;"></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Nama Pemandu</h2>
                                    <h3>{{ $pemandu->user->nama }}</h3>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>No. Lisensi Sertifikasi </h2>
                                    <h3>{{ $pemandu->sertifikasi }}</h3>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Kategori</h2>
                                    <h3>{{ $pemandu->kategoriPaket->nama }}</h3>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Status pemandu</h2>
                                    <h3>{{ $pemandu->status_pemandu }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out mt-5">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Deskripsi</h2>
                                    <h3>{{ $pemandu->deskripsi }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>No. Telpon</h2>
                                    <h3>{{ $pemandu->user->no_telp }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Alamat</h2>
                                    <h3>{{ $pemandu->user->alamat }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Keahlian Khusus</h2>
                                    <h3>{{ $pemandu->keahlian }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Catatan</h2>
                                    <h3>{{ $pemandu->catatan }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Status</h2>
                                    <h3>{{ $pemandu->status_verifikasi }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <div class="detail-personal">
                                    <h2>Riwayat Perjalanan</h2>
                                    <div class="table-responsive">
                                        <table class="table border-0 custom-table mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal Perjalanan</th>
                                                    <th>Nama Wisatawan</th>
                                                    <th>No Telp</th>
                                                    <th>Nama Paket</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pemandu->paket as $paket)
                                                @foreach ($paket->booking as $booking)
                                                <tr>
                                                    <td>{{ $booking->tanggal }}</td>
                                                    <td>{{ $booking->wisatawan->nama }}</td>
                                                    <td>{{ $booking->wisatawan->no_telp }}</td>
                                                    <td>{{ $paket->nama }}</td>
                                                </tr>
                                                @endforeach
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('operasional.pemandu-wisata.update-status', $pemandu->id) }}" method="POST"
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