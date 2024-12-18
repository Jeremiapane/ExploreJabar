@extends('customer.layouts.master')
@section('content')
<section class="pt-40 pb-40 bg-light-2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h1 class="text-30 fw-600">Daftar Agen </h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="layout-pt-md layout-pb-lg">
    <div class="container">
        <div class="row y-gap-30">
            <div class="col-xl-3 col-lg-4 lg:d-none">
                <aside class="sidebar y-gap-40">
                    {{-- <div class="sidebar__item -no-border">
                        <div class="flex-center ratio ratio-15:9 js-lazy"
                            data-bg="{{ 'assets/customer/' }}img/general/map.png">
                            <button class="button py-15 px-24 -blue-1 bg-white text-dark-1 absolute"
                                data-x-click="mapFilter">
                                <i class="icon-destination text-22 mr-10"></i>
                                Show on map
                            </button>
                        </div>
                    </div> --}}

                    <div class="sidebar__item -no-border">
                        <h5 class="text-18 fw-500 mb-10">Cari Travel</h5>
                        <div class="single-field relative d-flex items-center py-10">
                            <input class="pl-50 border-light text-dark-1 h-50 rounded-8" type="email"
                                placeholder="e.g. Best Western">
                            <button class="absolute d-flex items-center h-full">
                                <i class="icon-search text-20 px-15 text-dark-1"></i>
                            </button>
                        </div>
                    </div>
                    {{--
                    <div class="sidebar__item">
                        <h5 class="text-18 fw-500 mb-10">Popular Filters</h5>
                        <div class="sidebar-checkbox">

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">
                                    <div class="d-flex items-center">
                                        <div class="form-checkbox">
                                            <input type="checkbox">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>
                                        <div class="text-15 ml-10">Breakfast Included</div>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">92</div>
                                </div>
                            </div>

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">
                                    <div class="d-flex items-center">
                                        <div class="form-checkbox">
                                            <input type="checkbox">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>
                                        <div class="text-15 ml-10">Romantic</div>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">45</div>
                                </div>
                            </div>

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">
                                    <div class="d-flex items-center">
                                        <div class="form-checkbox">
                                            <input type="checkbox">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>
                                        <div class="text-15 ml-10">Airport Transfer</div>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">21</div>
                                </div>
                            </div>

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">
                                    <div class="d-flex items-center">
                                        <div class="form-checkbox">
                                            <input type="checkbox">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>
                                        <div class="text-15 ml-10">WiFi Included </div>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">78</div>
                                </div>
                            </div>

                            <div class="row y-gap-10 items-center justify-between">
                                <div class="col-auto">
                                    <div class="d-flex items-center">
                                        <div class="form-checkbox">
                                            <input type="checkbox">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>
                                        <div class="text-15 ml-10">5 Star</div>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <div class="text-15 text-light-1">679</div>
                                </div>
                            </div>

                        </div>
                    </div> --}}

                    <div class="sidebar__item">
                        <h5 class="text-18 fw-500 mb-10">Star Rating</h5>
                        <div class="row x-gap-10 y-gap-10 pt-10">

                            <div class="col-auto">
                                <a href="#" class="button -blue-1 bg-blue-1-05 text-blue-1 py-5 px-20 rounded-100">1</a>
                            </div>

                            <div class="col-auto">
                                <a href="#" class="button -blue-1 bg-blue-1-05 text-blue-1 py-5 px-20 rounded-100">2</a>
                            </div>

                            <div class="col-auto">
                                <a href="#" class="button -blue-1 bg-blue-1-05 text-blue-1 py-5 px-20 rounded-100">3</a>
                            </div>

                            <div class="col-auto">
                                <a href="#" class="button -blue-1 bg-blue-1-05 text-blue-1 py-5 px-20 rounded-100">4</a>
                            </div>

                            <div class="col-auto">
                                <a href="#" class="button -blue-1 bg-blue-1-05 text-blue-1 py-5 px-20 rounded-100">5</a>
                            </div>

                        </div>
                    </div>

                </aside>
            </div>

            <div class="col-xl-9 col-lg-8">
                <div class="row y-gap-10 items-center justify-between">
                    <div class="col-auto">
                        <div class="text-18"><span class="fw-500">{{ $count_travel }} Travel</span> Tersedia</div>
                    </div>
                </div>

                <div class="mt-30"></div>

                <div class="row y-gap-30">
                    @foreach($travels as $travel)

                    <div class="col-12">

                        <div class="border-top-light pt-30">
                            <div class="row x-gap-20 y-gap-20">
                                <div class="col-md-auto">

                                    <div class="cardImage ratio ratio-1:1 w-250 md:w-1/1 rounded-4">
                                        <div class="cardImage__content">

                                            <img class="rounded-4 col-12"
                                                src="{{ 'assets/customer/' }}img/lists/hotel/1/1.png" alt="image">

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md">
                                    <div class="row x-gap-10 y-gap-10 items-center pt-10">
                                        <div class="col-auto">
                                            <p class="text-18 lh-16 fw-500">{{ $travel->nama }}</p>
                                        </div>

                                        <div class="col-auto">
                                            <div class="d-inline-block ml-10">
                                                <i class="icon-star text-10 text-yellow-2"></i>
                                                <i class="icon-star text-10 text-yellow-2"></i>
                                                <i class="icon-star text-10 text-yellow-2"></i>
                                                <i class="icon-star text-10 text-yellow-2"></i>
                                                <i class="icon-star text-10 text-yellow-2"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-14 text-light-1 lh-15 mt-10">
                                        {{ $travel->deskripsi ?? 'Nikmati pengalaman perjalanan yang menyenangkan dengan
                                        layanan kami. Kami menawarkan paket wisata yang lengkap dengan harga yang
                                        kompetitif. Dari liburan keluarga hingga petualangan solo, kami siap membantu
                                        Anda membuat kenangan tak terlupakan. Dengan tim profesional dan berpengalaman,
                                        kami memastikan perjalanan Anda aman, nyaman, dan penuh kegembiraan.
                                        Bergabunglah dengan ribuan pelanggan puas yang telah mempercayai kami untuk
                                        mengurus semua kebutuhan perjalanan mereka.' }}
                                    </div>
                                </div>

                                <div class="col-md-auto text-right md:text-left">
                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                        <div class="col-auto">
                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                        </div>
                                        <div class="col-auto">
                                            <div
                                                class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">
                                                4.8</div>
                                        </div>
                                    </div>

                                    <div class="">
                                        <div class="text-14 text-light-1 mt-50 md:mt-20 hidden"></div>
                                        <div class="text-22 lh-12 fw-600 mt-5">tes</div>
                                        <div class="text-14 text-light-1 mt-5 hidden"></div>

                                        <a href="{{ url('travel-destination?id=' . $travel->id) }}"
                                            class="button -md -dark-1 bg-blue-1 text-white mt-24">
                                            Lihat Paket Wisata
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>

                {{-- <div class="border-top-light mt-30 pt-30">
                    <div class="row x-gap-10 y-gap-20 justify-between md:justify-center">
                        <div class="col-auto md:order-1">
                            <button class="button -blue-1 size-40 rounded-full border-light">
                                <i class="icon-chevron-left text-12"></i>
                            </button>
                        </div>

                        <div class="col-md-auto md:order-3">
                            <div class="row x-gap-20 y-gap-20 items-center md:d-none">

                                <div class="col-auto">

                                    <div class="size-40 flex-center rounded-full">1</div>

                                </div>

                                <div class="col-auto">

                                    <div class="size-40 flex-center rounded-full bg-dark-1 text-white">2</div>

                                </div>

                                <div class="col-auto">

                                    <div class="size-40 flex-center rounded-full">3</div>

                                </div>

                                <div class="col-auto">

                                    <div class="size-40 flex-center rounded-full bg-light-2">4</div>

                                </div>

                                <div class="col-auto">

                                    <div class="size-40 flex-center rounded-full">5</div>

                                </div>

                                <div class="col-auto">

                                    <div class="size-40 flex-center rounded-full">...</div>

                                </div>

                                <div class="col-auto">

                                    <div class="size-40 flex-center rounded-full">20</div>

                                </div>

                            </div>

                            <div class="row x-gap-10 y-gap-20 justify-center items-center d-none md:d-flex">

                                <div class="col-auto">

                                    <div class="size-40 flex-center rounded-full">1</div>

                                </div>

                                <div class="col-auto">

                                    <div class="size-40 flex-center rounded-full bg-dark-1 text-white">2</div>

                                </div>

                                <div class="col-auto">

                                    <div class="size-40 flex-center rounded-full">3</div>

                                </div>

                            </div>

                            <div class="text-center mt-30 md:mt-10">
                                <div class="text-14 text-light-1">1 – 20 of 300+ properties found</div>
                            </div>
                        </div>

                        <div class="col-auto md:order-2">
                            <button class="button -blue-1 size-40 rounded-full border-light">
                                <i class="icon-chevron-right text-12"></i>
                            </button>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</section>
@stop