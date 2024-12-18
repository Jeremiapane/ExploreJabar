@extends('travel.layouts.master')
@section('content')

<div class="content">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard </a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item active">Operasional</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="good-morning-blk">
        <div class="row">
            <div class="col-md-6">
                <div class="morning-user">
                    <h2>Hi, <span>Staff Operasional</span></h2>
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

                    <img src="{{ asset('assets/travel/img/icons/Kendaraan1.svg')}}"alt="">

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
                    <img src="{{ asset('assets/travel/img/icons/Pemandu1.svg')}}"alt="">
                </div>
                <div class="dash-content dash-count">
                    <h4>Jumlah Pemandu Wisata</h4>
                    <h2><span class="counter-up">{{ $pemandu_wisata->count() }}</span></h2>
                </div>
            </div>
        </div>

    </div>

</div>

@stop
