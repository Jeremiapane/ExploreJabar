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
                    <li class="breadcrumb-item active">Staff Marketing</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="good-morning-blk">
        <div class="row">
            <div class="col-md-6">
                <div class="morning-user">
                    <h2>Hi, <span>Staff marketing</span></h2>
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
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <div class="dash-boxs comman-flex-center">
                    <img src="{{ 'assets/travel/' }}img/icons/Paket1.svg" alt="">
                </div>
                <div class="dash-content dash-count">
                    <h4>Jumlah Paket Wisata</h4>
                    <h2><span class="counter-up">{{ $paket->count() }}</span></h2>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
