@extends('travel.layouts.master')
@section('content')

<div class="content">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard </a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item active">Manager Operasional</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="good-morning-blk">
        <div class="row">
            <div class="col-md-6">
                <div class="morning-user">
                    <h2>Hi, <span>Manager Operasional</span></h2>
                    <p>Have a nice day at work</p>
                </div>
            </div>
            <div class="col-md-6 position-blk">
                <div class="morning-img">
                    <img src="{{ 'assets/travel/' }}img/morning-img-01.png" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <div class="dash-boxs comman-flex-center">
                    <img src="{{ 'assets/travel/' }}img/icons/Kendaraan1.svg" alt="">
                </div>
                <div class="dash-content dash-count">
                    <h4>Jumlah Kendaraan</h4>
                    <h2><span class="counter-up">{{ $list_kendaraan->count() }}</span></h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <div class="dash-boxs comman-flex-center">
                    <img src="{{ 'assets/travel/' }}img/icons/Pemandu1.svg" alt="">
                </div>
                <div class="dash-content dash-count">
                    <h4>Jumlah Pemandu Wisata</h4>
                    <h2><span class="counter-up">{{ $pemandu_wisata->count() }}</span></h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <div class="dash-boxs comman-flex-center">
                    <img src="{{ 'assets/travel/' }}img/icons/History.svg" alt="">
                </div>
                <div class="dash-content dash-count">
                    <h4>Jumlah Booking History</h4>
                    <h2><span class="counter-up">{{ $totalBooking }}</span></h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <div class="dash-boxs comman-flex-center">
                    <img src="{{ 'assets/travel/' }}img/icons/Rating.svg" alt="">
                </div>
                <div class="dash-content dash-count">
                    <h4>Rating Agen Travel</h4>
                    <h2><span class="counter-up">{{ $averageRating }}</span></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12 col-xl-4">
            <div class="card top-departments">
                <div class="card-header">
                    <h4 class="card-title mb-0">Kategori Paket Wisata</h4>
                </div>
                <div class="card-body">
                    @foreach ($list_kategori as $kategori)
                    @php
                    $paket_kategori = \App\Models\Paket::where('created_by',
                    session('id_operasional'))->where('id_kategori_paket', $kategori->id)->count();
                    @endphp
                    <div class="activity-top">
                        <div class="activity-boxs comman-flex-center">
                            <img src="{{ 'assets/travel/' }}img/icons/Adventure.svg" alt="">
                        </div>
                        <div class="departments-list">
                            <h4>{{ $kategori->nama }}</h4>
                            <span>{{ $paket_kategori }} Paket</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h4 class="card-title d-inline-block">Permintaan Kendaraan </h4>
                </div>
                <div class="card-block table-dash">
                    <div class="table-responsive">
                        <table class="table border-0 custom-table comman-table datatable mb-0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Foto Kendaraan</th>
                                    <th>Jenis Kendaraan</th>
                                    <th>Merk Kendaraan</th>
                                    <th>No Plat</th>
                                    <th>Tahun Pembuatan</th>
                                    <th>Warna</th>
                                    <th>Status Kendaraan</th>
                                    <th>Status Verifikasi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_kendaraan as $kendaraan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($kendaraan->attachment)
                                        <img src="{{ asset($kendaraan->attachment->path) }}"
                                            alt="{{ $kendaraan->attachment->name }}" style="width: 100px;">
                                        @else
                                        <span>Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td>{{ $kendaraan->jenis }}</td>
                                    <td>{{ $kendaraan->merk }}</td>
                                    <td>{{ $kendaraan->no_plat }}</td>
                                    <td>{{ $kendaraan->tahun_pembuatan }}</td>
                                    <td>{{ $kendaraan->warna }}</td>
                                    <td>
                                        @if ($kendaraan->status_kendaraan == 'tidak tersedia' ||
                                        $kendaraan->status_kendaraan == 'digunakan')
                                        <button class="custom-badge status-red">{{ $kendaraan->status_kendaraan
                                            }}</button>
                                        @elseif($kendaraan->status_kendaraan == 'tersedia')
                                        <button class="custom-badge status-green">{{ $kendaraan->status_kendaraan
                                            }}</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($kendaraan->status_verifikasi == 'tidak aktif')
                                        <button class="custom-badge status-red">{{ $kendaraan->status_verifikasi
                                            }}</button>
                                        @elseif($kendaraan->status_verifikasi == 'diproses')
                                        <button class="custom-badge status-orange">{{ $kendaraan->status_verifikasi
                                            }}</button>
                                        @elseif($kendaraan->status_verifikasi == 'aktif')
                                        <button class="custom-badge status-green">{{ $kendaraan->status_verifikasi
                                            }}</button>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item"
                                                    href="{{ route('operasional.kendaraan.show', $kendaraan->id) }}"><i
                                                        class="fa-solid fa-pen-to-square m-r-5"></i> Edit</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h4 class="card-title d-inline-block">Pemandu Wisata </h4>
                </div>
                <div class="card-block table-dash">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table border-0 custom-table comman-table datatable mb-0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Foto</th>
                                        <th>Nama Pemandu Wisata</th>
                                        <th>No Lisensi</th>
                                        <th>No Telp</th>
                                        <th>Alamat</th>
                                        <th>Status Pemandu</th>
                                        <th>Status Verifikasi</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pemandu_wisata as $index => $pemandu)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($pemandu->attachment)
                                            <img src="{{ asset($pemandu->attachment->path) }}"
                                                alt="{{ $pemandu->attachment->name }}" style="width: 100px;">
                                            @else
                                            <span>Tidak ada foto</span>
                                            @endif
                                        </td>
                                        <td>{{ $pemandu->user->nama }}</td>
                                        <td>{{ $pemandu->sertifikasi }}</td>
                                        <td>{{ $pemandu->user->no_telp }}</td>
                                        <td>{{ $pemandu->user->alamat }}</td>
                                        <td>
                                            @if ($pemandu->status_pemandu == 'tidak tersedia')
                                            <button class="custom-badge status-red">{{ $pemandu->status_pemandu
                                                }}</button>
                                            @elseif($pemandu->status_pemandu == 'tersedia')
                                            <button class="custom-badge status-green">{{ $pemandu->status_pemandu
                                                }}</button>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($pemandu->status_verifikasi == 'tidak aktif')
                                            <button class="custom-badge status-red">{{ $pemandu->status_verifikasi
                                                }}</button>
                                            @elseif($pemandu->status_verifikasi == 'diproses')
                                            <button class="custom-badge status-orange">{{ $pemandu->status_verifikasi
                                                }}</button>
                                            @elseif($pemandu->status_verifikasi == 'aktif')
                                            <button class="custom-badge status-green">{{ $pemandu->status_verifikasi
                                                }}</button>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item"
                                                        href="{{ route('operasional.pemandu-wisata.show', $pemandu->id) }}"><i
                                                            class="fa-solid fa-pen-to-square m-r-5"></i> Edit</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
