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
                    <li class="breadcrumb-item"><a href="/operasional/pemandu-wisata">Penjualan </a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item active">Detail Booking</li>
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
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Nama Wisatawan</h2>
                                    <h3>{{ $detail->wisatawan->nama }}</h3>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>No Telp </h2>
                                    <h3>{{ $detail->wisatawan->no_telp }}</h3>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Jumlah Peserta</h2>
                                    <h3>{{ $detail->jumlah_peserta }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out mt-5">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Paket Yang Dipilih</h2>
                                    <h3>{{ $detail->paket->nama }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Tanggal keberangakatan</h2>
                                    <h3>{{ $detail->tanggal }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Kendaraan Yang Digunakan</h2>
                                    <h3>{{ $detail->paket->kendaraan->jenis }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Nama Pemandu Wisata</h2>
                                    <h3>{{ $detail->paket->pemanduWisata->user->nama }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>No Lisensi Sertifikasi</h2>
                                    <h3>{{ $detail->paket->pemanduWisata->sertifikasi }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>No Telp</h2>
                                    <h3>{{ $detail->paket->pemanduWisata->user->no_telp }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Catatan Tambahan</h2>
                                    <h3>{{ $detail->catatan }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Rating</h2>
                                    <h3>-</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2></h2>Catatan Agen
                                    <h3>{{ $detail->catatan_agen }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-list-out">
                        <div class="row">
                            <div class="col-xl-3 col-md-4">
                                <div class="detail-personal">
                                    <h2>Status booking</h2>
                                    <h3>{{ $detail->status }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                    use Carbon\Carbon;

                    $currentDate = Carbon::now();
                    $packageDate = Carbon::parse($detail->tanggal);
                    @endphp

                    <form action="{{ route('penjualan.booking.update-status') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $detail->id }}">
                        @if ($detail->status == "diproses")
                        <div class="personal-list-out">
                            <div class="row">
                                <div class="col-xl-12 col-md-4">
                                    <div class="detail-personal">
                                        <div class="input-block local-forms">
                                            <h2>Status</h2>
                                            <div class="pt-3">
                                                <input type="radio" name="status" value="ditolak"> Ditolak
                                                <input type="radio" name="status" value="diterima"> Diterima
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-block local-forms">
                                        <label>Catatan <span class="login-danger">*</span></label>
                                        <div class="pt-3">
                                            <textarea class="form-control" name="catatan_agen"></textarea>
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
                        @elseif($currentDate->gt($packageDate->addDay()) && $detail->status == "diterima")
                        <div class="personal-list-out">
                            <div class="row">
                                <div class="col-xl-3 col-md-4">
                                    <div class="detail-personal">
                                        <div class="input-block local-forms">
                                            <h2>Status</h2>
                                            <div class="pt-3">
                                                <input type="radio" name="status" value="selesai"> Selesai
                                            </div>
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
                        @endif
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@stop