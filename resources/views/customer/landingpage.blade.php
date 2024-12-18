@extends('customer.layouts.master')
@section('content')

    <section data-anim-wrap class="masthead -type-6">
        <div data-anim-child="fade" class="masthead__bg bg-dark-3">
            <img src="{{ 'assets/customer/' }}img/backgrounds/bg-home.png" alt="image">
        </div>

        <div class="container">
            <div class="row justify-center">
                <div class="col-xl-9">
                    <div class="text-center">
                        <h1 data-anim-child="slide-up delay-4" class="text-60 lg:text-40 md:text-30 text-white">Explore West
                            Java</h1>
                        <p data-anim-child="slide-up delay-5" class="mt-5 text-white">Jelajahi jawa barat bersama kami, kami
                            siap membantu anda</p>
                    </div>

                    {{-- <div data-anim-child="slide-up delay-6"
                    class="mainSearch -w-900 bg-white px-10 py-10 lg:px-20 lg:pt-5 lg:pb-20 rounded-100 mt-40">
                    <div class="button-grid items-center">

                        <div class="searchMenu-loc px-30 lg:py-20 lg:px-0 js-form-dd js-liverSearch">

                            <div data-x-dd-click="searchMenu-loc">
                                <h4 class="text-15 fw-500 ls-2 lh-16">Lokasi </h4>

                                <div class="text-15 text-light-1 ls-2 lh-16">
                                    <input autocomplete="off" type="search" placeholder="-"
                                        class="js-search js-dd-focus" />
                                </div>
                            </div>

                            <div class="searchMenu-loc__field shadow-2 js-popup-window" data-x-dd="searchMenu-loc"
                                data-x-dd-toggle="-is-active">
                                <div class="bg-white px-30 py-30 sm:px-0 sm:py-15 rounded-4">
                                    <div class="y-gap-5 js-results">

                                        <div>
                                            <button
                                                class="-link d-block col-12 text-left rounded-4 px-20 py-15 js-search-option">
                                                <div class="d-flex">
                                                    <div class="icon-location-2 text-light-1 text-20 pt-4"></div>
                                                    <div class="ml-10">
                                                        <div class="text-15 lh-12 fw-500 js-search-option-target">London
                                                        </div>
                                                        <div class="text-14 lh-12 text-light-1 mt-5">Greater London,
                                                            United Kingdom</div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>

                                        <div>
                                            <button
                                                class="-link d-block col-12 text-left rounded-4 px-20 py-15 js-search-option">
                                                <div class="d-flex">
                                                    <div class="icon-location-2 text-light-1 text-20 pt-4"></div>
                                                    <div class="ml-10">
                                                        <div class="text-15 lh-12 fw-500 js-search-option-target">New
                                                            York</div>
                                                        <div class="text-14 lh-12 text-light-1 mt-5">New York State,
                                                            United States</div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>

                                        <div>
                                            <button
                                                class="-link d-block col-12 text-left rounded-4 px-20 py-15 js-search-option">
                                                <div class="d-flex">
                                                    <div class="icon-location-2 text-light-1 text-20 pt-4"></div>
                                                    <div class="ml-10">
                                                        <div class="text-15 lh-12 fw-500 js-search-option-target">Paris
                                                        </div>
                                                        <div class="text-14 lh-12 text-light-1 mt-5">France</div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>

                                        <div>
                                            <button
                                                class="-link d-block col-12 text-left rounded-4 px-20 py-15 js-search-option">
                                                <div class="d-flex">
                                                    <div class="icon-location-2 text-light-1 text-20 pt-4"></div>
                                                    <div class="ml-10">
                                                        <div class="text-15 lh-12 fw-500 js-search-option-target">Madrid
                                                        </div>
                                                        <div class="text-14 lh-12 text-light-1 mt-5">Spain</div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>

                                        <div>
                                            <button
                                                class="-link d-block col-12 text-left rounded-4 px-20 py-15 js-search-option">
                                                <div class="d-flex">
                                                    <div class="icon-location-2 text-light-1 text-20 pt-4"></div>
                                                    <div class="ml-10">
                                                        <div class="text-15 lh-12 fw-500 js-search-option-target">
                                                            Santorini</div>
                                                        <div class="text-14 lh-12 text-light-1 mt-5">Greece</div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="searchMenu-date px-30 lg:py-20 lg:px-0 js-form-dd js-calendar js-calendar-el">

                            <div data-x-dd-click="searchMenu-date">
                                <h4 class="text-15 fw-500 ls-2 lh-16">Tanggal</h4>

                                <div class="capitalize text-15 text-light-1 ls-2 lh-16">
                                    <span class="js-first-date">Wed 2 Mar</span>
                                </div>
                            </div>

                            <div class="searchMenu-date__field shadow-2" data-x-dd="searchMenu-date"
                                data-x-dd-toggle="-is-active">
                                <div class="bg-white px-30 py-30 rounded-4">
                                    <div class="elCalendar js-calendar-el-calendar"></div>
                                </div>
                            </div>
                        </div>

                        <div class="searchMenu-guests px-30 lg:py-20 lg:px-0 js-form-dd js-form-counters">

                            <div data-x-dd-click="searchMenu-guests">
                                <h4 class="text-15 fw-500 ls-2 lh-16">Jumlah Anggota</h4>

                                <div class="text-15 text-light-1 ls-2 lh-16">
                                    <span class="js-count-adult">2</span> Anggota
                                </div>
                            </div>

                            <div class="searchMenu-guests__field shadow-2" data-x-dd="searchMenu-guests"
                                data-x-dd-toggle="-is-active">
                                <div class="bg-white px-30 py-30 rounded-4">
                                    <div class="row y-gap-10 justify-between items-center">
                                        <div class="col-auto">
                                            <div class="text-15 fw-500">Anggota</div>
                                        </div>

                                        <div class="col-auto">
                                            <div class="d-flex items-center js-counter"
                                                data-value-change=".js-count-adult">
                                                <button
                                                    class="button -outline-blue-1 text-blue-1 size-38 rounded-4 js-down">
                                                    <i class="icon-minus text-12"></i>
                                                </button>

                                                <div class="flex-center size-20 ml-15 mr-15">
                                                    <div class="text-15 js-count">2</div>
                                                </div>

                                                <button
                                                    class="button -outline-blue-1 text-blue-1 size-38 rounded-4 js-up">
                                                    <i class="icon-plus text-12"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="button-item">
                            <button
                                class="mainSearch__submit button -dark-1 py-15 px-40 col-12 rounded-100 bg-blue-1 text-white">
                                <i class="icon-search text-20 mr-10"></i>
                                Search
                            </button>
                        </div>
                    </div>
                </div> --}}
                </div>
            </div>
        </div>
    </section>

    <section class="layout-pt-lg layout-pb-md">
        <div data-anim-wrap class="container">
            <div data-anim-child="slide-up delay-1" class="row justify-center text-center">
                <div class="col-auto">
                    <div class="sectionTitle -md">
                        <h2 class="sectionTitle__title">Daftar Artikel</h2>
                        <p class="sectionTitle__text mt-5 sm:mt-0">Temukan Cara Terbaik Untuk Menikmati Wisata</p>
                    </div>
                </div>
            </div>

            <div class="row y-gap-20 pt-40">
                @foreach ($list_artikel as $artikel)
                    <div data-anim-child="slide-up delay-2" class="col-lg-4 col-sm-6">
                        <a href="/blog/{{ $artikel->slug }}">

                            <div class="ctaCard -type-1 rounded-4 -no-overlay">
                                <div class="ctaCard__image ratio ratio-41:35">
                                    <img class="img-ratio js-lazy" src="#"
                                        data-src="{{ Storage::url($artikel->foto_sampul) }}" alt="image">
                                </div>

                                <div class="ctaCard__content py-50 px-50 xl:py-30 xl:px-30">
                                    <h4 class="text-30 xl:text-24 text-white">{{ $artikel->judul }}</h4>
                                </div>
                            </div>

                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Daftar Objek Wisata --}}
    <section class="layout-pt-md layout-pb-lg">
        <div data-anim-wrap class="container">
            <div data-anim-child="slide-up delay-1" class="row y-gap-20 items-end justify-between">
                <div class="col-auto">
                    <div class="sectionTitle -md">
                        <h2 class="sectionTitle__title">Daftar Objek Wisata</h2>
                        <p class="sectionTitle__text mt-5 sm:mt-0">Temukan objek wisata terbaik untuk bepergian di Jawa
                            Barat!</p>
                    </div>
                </div>

                <div class="col-auto">
                    <a href="/destination" class="button -blue-1 -md bg-blue-1-05 text-blue-1">
                        Lihat Selengkapnya
                        <i class="icon-arrow-top-right ml-10"></i>
                    </a>
                </div>
            </div>

            <div data-anim-child="slide-up delay-2" class="js-section-slider pt-40 sm:pt-20" data-gap="30" data-scrollbar
                data-slider-cols="xl-4 lg-3 md-2 sm-2 base-1">
                <div class="swiper-wrapper">
                    @foreach ($wisata as $val)
                        <div class="swiper-slide">

                            <a href="/destination/{{ $val->id }}" class="citiesCard -type-1 d-block rounded-4">
                                <div class="citiesCard__image ratio ratio-3:4">
                                    @if (count($val->images) > 0)
                                        <img src="#" data-src="{{ Storage::url($val->images[0]->path) }}"
                                            alt="image" class="js-lazy">
                                    @endif
                                </div>
                            </a>
                            <div class="activityCard__content mt-10">
                                <h4 class="activityCard__title lh-16 fw-500 text-dark-1 text-18">
                                    <span>{{ $val->nama }}</span>
                                </h4>

                                <p class="text-light-1 text-14 lh-14 mt-5">
                                    {{ $val->daerah->provinsi . ', ' . $val->daerah->kecamatan }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="slider-scrollbar bg-light-2 sm:d-none js-scrollbar mt-40"></div>
            </div>
        </div>
    </section>

    {{-- Daftar Wilayah --}}
    <section class="layout-pt-md layout-pb-lg">
        <div data-anim-wrap class="container">
            <div data-anim-child="slide-up delay-1" class="row y-gap-20 items-end justify-between">
                <div class="col-auto">
                    <div class="sectionTitle -md">
                        <h2 class="sectionTitle__title">Cari Agen Perjalanan</h2>
                        <p class="sectionTitle__text mt-5 sm:mt-0">Nikmati Keindahan Alam Dengan Agen Perjalanan</p>
                    </div>
                </div>

                <div class="col-auto">
                    <a href="/travel" class="button -blue-1 -md bg-blue-1-05 text-blue-1">
                        Lihat Selengkapnya
                        <i class="icon-arrow-top-right ml-10"></i>
                    </a>
                </div>
            </div>

            <div data-anim-child="slide-up delay-2" class="js-section-slider pt-40 sm:pt-20" data-gap="30" data-scrollbar
                data-slider-cols="xl-4 lg-3 md-2 sm-2 base-1">
                <div class="swiper-wrapper">
                    @foreach ($operasional as $val)
                        <div class="swiper-slide">

                            <a href="/travel-destination/{{ $val->id }}" class="citiesCard -type-1 d-block rounded-4">
                                <div class="citiesCard__image ratio ratio-3:4">
                                    @if ($val->foto_profile && $val->foto_profile->isNotEmpty())
                                        <img src="#" data-src="{{ asset($val->foto_profile->first()->path) }}"
                                            alt="image" class="js-lazy">
                                    @endif
                                </div>

                                <div
                                    class="citiesCard__content d-flex flex-column pt-30 justify-between px-20 pb-20 text-center">
                                    <div class="citiesCard__bg"></div>

                                    <div class="citiesCard__top">
                                        <div class="text-14 text-white"></div>
                                    </div>

                                    <div class="citiesCard__bottom">
                                        <h4 class="text-26 md:text-20 lh-13 mb-20 text-white">{{ $val->nama_perusahaan }}
                                        </h4>
                                        <button class="button col-12 -blue-1 text-dark-1 h-60 bg-white">Detail</button>
                                    </div>
                                </div>
                            </a>

                        </div>
                    @endforeach
                </div>
                <div class="slider-scrollbar bg-light-2 sm:d-none js-scrollbar mt-40"></div>
            </div>
        </div>
    </section>


    @auth
        <section class="layout-pt-md layout-pb-lg">
            <div class="container">
                <div class="row y-gap-30 items-center justify-between">
                    <div class="col-xl-6">
                        <img src="{{ 'assets/customer/' }}img/app/2.svg" alt="image">
                    </div>

                    <div class="col-xl-5">
                        <h2 class="text-30 lh-15">Akses Website Dimanapun Anda Berada</h2>
                        <p class="text-dark-1 mt-15 pr-40 sm:mt-5 lg:pr-0">Book in advance or last-minute with GoTrip. Receive
                            instant confirmation. Access your booking info offline.</p>

                        <div class="row pt-30 items-center sm:pt-10">
                            <div class="col-auto">
                                <div class="d-flex rounded-8 border-white-15 items-center px-20 py-10 text-black">
                                    <div class="ml-20">
                                        <div class="text-14">www.explorejabar.com</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="layout-pt-md layout-pb-lg">
            <div class="container">
                <div class="row y-gap-30 items-center justify-center">
                    <div class="col-xl-6 ps-15">
                        <img src="{{ 'assets/customer/' }}img/app/3.svg" alt="image">
                    </div>

                    <div class="col-xl-5">
                        <h2 class="text-30 lh-15">Bergabunglah Dengan kami Dan Perluas Bisnis Travel Anda</h2>
                        <p class="text-dark-1 mt-15 pr-40 sm:mt-5 lg:pr-0">Jangan lewatkan kesempatan untuk membuat bisnis Anda
                            lebih efisien dan menguntungkan. Bergabunglah dengan kami hari ini dan rasakan manfaatnya!</p>

                        <div class="row pt-30 items-center sm:pt-10">
                            <div class="col-auto">
                                <div class="d-flex rounded-8 border-white-15 items-center py-10 text-black">

                                    <a href="{{ route('operasional.register') }}"
                                        class="button -dark-1 bg-blue-1 px-10 py-20 text-white">
                                        Gabung sekarang
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endauth

@stop
