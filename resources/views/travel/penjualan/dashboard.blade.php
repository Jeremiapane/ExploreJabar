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
                    <li class="breadcrumb-item active">Staff Penjualan</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="good-morning-blk">
        <div class="row">
            <div class="col-md-6">
                <div class="morning-user">
                    <h2>Hi, Staff Penjualan<span></span></h2>
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
                    <img src="{{ 'assets/travel/' }}img/icons/BookingSelesai.svg" alt="">
                </div>
                <div class="dash-content dash-count">
                    <h4>Jumlah Booking Wisatawan</h4>
                    <h2><span class="counter-up">{{ $list_booking->count() }}</span></h2>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <div class="dash-boxs comman-flex-center">
                    <img src="{{ 'assets/travel/' }}img/icons/BookingTerima.svg" alt="">
                </div>
                <div class="dash-content dash-count">
                    <h4>Jumlah Booking Diterima</h4>
                    <h2><span class="counter-up">{{ $list_booking->where('status', 'diterima')->count(); }}</span></h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <div class="dash-boxs comman-flex-center">
                    <img src="{{ 'assets/travel/' }}img/icons/Selesai.svg" alt="">
                </div>
                <div class="dash-content dash-count">
                    <h4>Jumlah Booking Selesai</h4>
                    <h2><span class="counter-up">{{ $list_booking->where('status', 'selesai')->count(); }}</span></h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <div class="dash-boxs comman-flex-center">
                    <img src="{{ 'assets/travel/' }}img/icons/BookingDitolak.svg" alt="">
                </div>
                <div class="dash-content dash-count">
                    <h4>Jumlah Booking Ditolak</h4>
                    <h2><span class="counter-up">{{ $list_booking->where('status', 'ditolak')->count(); }}</span></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h4 class="card-title d-inline-block">Daftar Booking Wisatawan </h4>
                </div>
                <div class="card-block table-dash">
                    <div class="table-responsive">
                        <table class="table mb-0 border-0 datatable custom-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Wisatawan</th>
                                    <th>Paket</th>
                                    <th>Tanggal Keberangkatan</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_booking as $booking)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="table-image">
                                        <h2>{{ $booking->wisatawan->nama }}</h2>
                                    </td>
                                    <td>{{ $booking->paket->nama }}</td>
                                    <td>{{ $booking->tanggal }}</td>
                                    <td>{{ $booking->review_paket?->rating }}</td>
                                    <td>
                                        <button class="custom-badge
                                            @if($booking->status == 'diproses') status-orange
                                            @elseif($booking->status == 'ditolak') status-red
                                            @elseif($booking->status == 'diterima' || $booking->status == 'selesai') status-green
                                            @endif">
                                            {{ $booking->status }}
                                        </button>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="/penjualan/detail/{{ $booking->id }}"><i
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

@stop
