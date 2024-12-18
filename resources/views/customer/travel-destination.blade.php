@extends('customer.layouts.master')
@section('content')
<style>
    .active-button {
        background-color: #007bff;
        /* Warna background saat tombol aktif */
        color: #fff;
        /* Warna teks saat tombol aktif */
    }
</style>
<section class="section-bg pt-40 pb-40 relative z-5 text-center" style="height: 253px">
    <div class="section-bg__item col-12">
        <img src="{{ asset('images/header-wisata.jpeg') }}" alt="image" class="w-full h-full object-cover">
    </div>

    <div class="container h-100 d-flex align-items-center justify-content-center">
        <div class="row w-100">
            <div class="col-12">
                <div class="text-center mt-60">
                    <h1 class="text-30 fw-600 text-white">{{ $agen->nama_perusahaan }}</h1>
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
                        <h5 class="text-18 fw-500 mb-10">Cari Paket</h5>
                        <form action="{{ route('wisatawan.travel-destination', ['id' => $id]) }}" method="GET">
                            <div class="single-field relative d-flex items-center py-10">
                                <input name="search" class="pl-50 border-light text-dark-1 h-50 rounded-8" type="text"
                                    placeholder="Nama wisata..." value="{{ request()->input('search') }}">
                                <button type="submit" class="absolute d-flex items-center h-full">
                                    <i class="icon-search text-20 px-15 text-dark-1"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="sidebar__item">
                        <h5 class="text-18 fw-500 mb-10">Star Rating</h5>
                        <div class="row x-gap-10 y-gap-10 pt-10">

                            @for ($i = 1; $i <= 5; $i++) <div class="col-auto">
                                <a href="{{ route('wisatawan.travel-destination', ['id' => $id]) }}?rating={{ $i }}"
                                    class="button -blue-1 bg-blue-1-05 text-blue-1 py-5 px-20 rounded-100 {{ request('rating') == $i ? 'active-button' : '' }}">
                                    {{ $i }}
                                </a>
                        </div>
                        @endfor

                    </div>

                </aside>
            </div>

            <div class="col-xl-9 col-lg-8">
                <div class="row y-gap-10 items-center justify-between">
                    <div class="col-auto">
                        <div class="text-18"><span class="fw-500">{{ $count_paket }} Paket</span> Tersedia</div>
                    </div>
                </div>

                <div class="mt-30"></div>

                <div class="row y-gap-30">
                    @foreach($pakets as $paket)
                    @php
                    $averageRating = $paket->review->avg('rating');
                    $formattedRating = number_format($averageRating, 1);
                    $fullStars = floor($averageRating);
                    $halfStar = ($averageRating - $fullStars) >= 0.5 ? true : false;
                    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                    @endphp

                    <div class="col-12">

                        <div class="border-top-light pt-30">
                            <div class="row x-gap-20 y-gap-20">
                                <div class="col-md-auto">

                                    <div class="cardImage ratio ratio-1:1 w-250 md:w-1/1 rounded-4">
                                        <div class="cardImage__content">

                                            @if ($paket->attachment)
                                            <img class="rounded-4 col-12" src="{{ asset($paket->attachment->path) }}"
                                                alt="image">
                                            @endif

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md">
                                    <div class="row x-gap-10 y-gap-10 items-center pt-10">

                                        <div class="col-auto">
                                            <p class="text-18 lh-16 fw-500">{{ $paket->nama }}</p>
                                            <div class="rating mt-5">
                                                @for($i = 0; $i < $fullStars; $i++) <i
                                                    class="icon-star text-10 text-yellow-2"></i> <!-- Full star -->
                                                    @endfor

                                                    @if($halfStar)
                                                    <i class="icon-star-half text-10 text-yellow-2"></i>
                                                    <!-- Half star -->
                                                    @endif

                                                    @for($i = 0; $i < $emptyStars; $i++) <i
                                                        class="icon-star text-10 text-light-3"></i> <!-- Empty star -->
                                                        @endfor
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-14 lh-15 mt-20">
                                        <div class="text-light-1">{{ $paket->wisata->nama }}, {{
                                            $paket->wisata->daerah->provinsi }}</div>
                                    </div>

                                    <div class="text-14 text-light-1 lh-15 mt-10">
                                        {{  \Str::limit($paket->deskripsi, 300, '...') }}
                                    </div>
                                </div>

                                <div class="col-md-auto text-right md:text-left">
                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                        <div class="col-auto">
                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                            <div class="text-14 lh-14 text-light-1">{{ $paket->review ?
                                                $paket->review->count() : 0 }} reviews
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div
                                                class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">
                                                {{ $formattedRating }}</div>
                                        </div>
                                    </div>

                                    <div class="">
                                        <div class="text-14 text-light-1 mt-50 md:mt-20 hidden"></div>
                                        <div class="text-22 lh-12 fw-600 mt-5">Rp. {{ $paket->harga }}</div>
                                        <div class="text-14 text-light-1 mt-5 hidden"></div>



                                        <a href="{{ Auth::check() ? url('destination-detail/' . $paket->id) : '#' }}"
                                            class="button -md -dark-1 bg-blue-1 text-white mt-24"
                                            onclick="event.preventDefault(); {{ Auth::check() ? 'window.location.href=\'' . url('destination-detail/' . $paket->id) . '\';' : 'showLoginAlert();' }}">
                                            Lihat Detail Paket
                                        </a>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>

                <div class="border-top-light mt-30 pt-30">
                    <div class="row x-gap-10 y-gap-20 justify-between md:justify-center">
                        <!-- Previous Page Link -->
                        @if ($pakets->onFirstPage())
                        <div class="col-auto md:order-1">
                            <button class="button -blue-1 size-40 rounded-full border-light" disabled>
                                <i class="icon-chevron-left text-12"></i>
                            </button>
                        </div>
                        @else
                        <div class="col-auto md:order-1">
                            <a href="{{ $pakets->previousPageUrl() }}"
                                class="button -blue-1 size-40 rounded-full border-light">
                                <i class="icon-chevron-left text-12"></i>
                            </a>
                        </div>
                        @endif

                        <div class="col-md-auto md:order-3">
                            <div class="row x-gap-20 y-gap-20 items-center md:d-none">
                                <!-- Page Numbers -->
                                @foreach ($pakets->getUrlRange(1, $pakets->lastPage()) as $page => $url)
                                <div class="col-auto">
                                    <a href="{{ $url }}"
                                        class="size-40 flex-center rounded-full {{ $page == $pakets->currentPage() ? 'bg-dark-1 text-white' : '' }}">
                                        {{ $page }}
                                    </a>
                                </div>
                                @endforeach

                                <!-- Ellipsis -->
                                @if ($pakets->lastPage() > 5)
                                <div class="col-auto">
                                    <div class="size-40 flex-center rounded-full">...</div>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ $pakets->url($pakets->lastPage()) }}"
                                        class="size-40 flex-center rounded-full">
                                        {{ $pakets->lastPage() }}
                                    </a>
                                </div>
                                @endif
                            </div>

                            <!-- Mobile Pagination -->
                            <div class="row x-gap-10 y-gap-20 justify-center items-center d-none md:d-flex">
                                @foreach ($pakets->getUrlRange(1, min(3, $pakets->lastPage())) as $page => $url)
                                <div class="col-auto">
                                    <a href="{{ $url }}"
                                        class="size-40 flex-center rounded-full {{ $page == $pakets->currentPage() ? 'bg-dark-1 text-white' : '' }}">
                                        {{ $page }}
                                    </a>
                                </div>
                                @endforeach
                            </div>

                            <div class="text-center mt-30 md:mt-10">
                                <div class="text-14 text-light-1">
                                    {{ $pakets->firstItem() }} – {{ $pakets->lastItem() }} of {{ $pakets->total() }}
                                    wisata ditemukan
                                </div>
                            </div>
                        </div>

                        <!-- Next Page Link -->
                        @if ($pakets->hasMorePages())
                        <div class="col-auto md:order-2">
                            <a href="{{ $pakets->nextPageUrl() }}"
                                class="button -blue-1 size-40 rounded-full border-light">
                                <i class="icon-chevron-right text-12"></i>
                            </a>
                        </div>
                        @else
                        <div class="col-auto md:order-2">
                            <button class="button -blue-1 size-40 rounded-full border-light" disabled>
                                <i class="icon-chevron-right text-12"></i>
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function showLoginAlert() {
        Swal.fire({
            icon: 'warning',
            title: 'Maaf',
            text: 'Anda harus login terlebih dahulu',
            confirmButtonText: 'OK'
        });
    }
</script>
@stop
