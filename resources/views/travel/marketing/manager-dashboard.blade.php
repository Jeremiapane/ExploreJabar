@extends('travel.layouts.master')
@section('content')

<div class="content">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard </a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="good-morning-blk">
        <div class="row">
            <div class="col-md-6">
                <div class="morning-user">
                    <h2>Hi, <span>Manager Marketing</span></h2>
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
                    <img src="{{ 'assets/travel/' }}img/icons/Paket1.svg" alt="">
                </div>
                <div class="dash-content dash-count">
                    <h4>Jumlah Paket Wisata</h4>
                    <h2><span class="counter-up">{{ $paketWisata->count() }}</span></h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <div class="dash-boxs comman-flex-center">
                    <img src="{{ 'assets/travel/' }}img/icons/Diproses.svg" alt="">
                </div>
                <div class="dash-content dash-count">
                    <h4>Jumlah Diproses</h4>
                    <h2><span class="counter-up">{{ $diproses->count() }}</span></h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <div class="dash-boxs comman-flex-center">
                    <img src="{{ 'assets/travel/' }}img/icons/Diterima.svg" alt="">
                </div>
                <div class="dash-content dash-count">
                    <h4>Jumlah Diterima</h4>
                    <h2><span class="counter-up">{{ $diterima->count() }}</span></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12  col-xl-4">
            <div class="card top-departments">
                <div class="card-header">
                    <h4 class="card-title mb-0">Kategori Paket Wisata </h4>
                </div>
                <div class="card-body">
                    @foreach ($list_kategori as $kategori)
                    @php
                    $paket_kategori = \App\Models\Paket::where('created_by',
                    session('id_operasional'))->where('id_kategori_paket', $kategori->id)->count();
                    @endphp
                    <div class="activity-top">
                        <div class="activity-boxs comman-flex-center">
                            <img src="{{ 'assets/travel/' }}img/icons/adventure.svg" alt="">
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
        <div class="col-12 col-md-12  col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block">Paket Wisata Terjual</h4>
                </div>
                <div class="card-body p-0 table-dash">
                    <div class="table-responsive">
                        <table class="table mb-0 border-0 datatable custom-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Paket</th>
                                    <th>Jumlah Paket Terjual</th>
                                    <th>Rating Paket</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paketFavorit as $paket)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $paket->nama }}</td>
                                    <td>{{ $paket->booking_count }}
                                    </td>
                                    <td>{{ number_format($paket->reviews_avg_rating, 2) }}
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item"
                                                    href="{{ route('marketing.paket.show', $paket->id) }}"><i
                                                        class="fa-solid fa-eye m-r-5"></i> Detail</a>
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
                    <h4 class="card-title d-inline-block">Daftar Paket Wisata </h4>
                </div>
                <div class="card-block table-dash">
                    <div class="table-responsive">
                        <table class="table border-0 custom-table comman-table datatable mb-0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Paket</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Lokasi</th>
                                    <th>Status Paket</th>
                                    <th>Status Verifikasi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paketWisata as $paket)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $paket->nama }}</td>
                                    <td>{{ $paket->kategoriPaket->nama }}</td>
                                    <td>{{ Str::limit($paket->deskripsi, 50, '...') }}</td>
                                    <td>{{ $paket->wisata->nama }}</td>
                                    <td>
                                        @if ($paket->status_paket == 'tidak tersedia')
                                        <button class="custom-badge status-red">{{ $paket->status_paket }}</button>
                                        @elseif($paket->status_paket == 'tersedia')
                                        <button class="custom-badge status-green">{{ $paket->status_paket }}</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($paket->status_verifikasi == 'tidak aktif')
                                        <button class="custom-badge status-red">{{ $paket->status_verifikasi }}</button>
                                        @elseif($paket->status_verifikasi == 'diproses')
                                        <button class="custom-badge status-orange">{{ $paket->status_verifikasi
                                            }}</button>
                                        @elseif($paket->status_verifikasi == 'aktif')
                                        <button class="custom-badge status-green">{{ $paket->status_verifikasi
                                            }}</button>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item"
                                                    href="{{ route('marketing.paket.show', $paket->id) }}"><i
                                                        class="fa-solid fa-eye m-r-5"></i> Detail</a>
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
@stop
