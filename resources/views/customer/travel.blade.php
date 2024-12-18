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
    <section class="section-bg z-5 relative pb-40 pt-40 text-center" style="height: 253px">
        <div class="section-bg__item col-12">
            <img src="{{ asset('images/header-wisata.jpeg') }}" alt="image" class="h-full w-full object-cover">
        </div>

        <div class="h-100 d-flex align-items-center justify-content-center container">
            <div class="row w-100">
                <div class="col-12">
                    <div class="mt-60 text-center">
                        <h1 class="text-30 fw-600 text-white">Daftar Agen Perjalanan</h1>
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

                        <div class="sidebar__item -no-border">
                            <h5 class="text-18 fw-500 mb-10">Cari Travel</h5>
                            <form action="{{ route('wisatawan.travel') }}" method="GET">
                                <div class="single-field d-flex relative items-center py-10">
                                    <input name="search" class="pl-50 border-light text-dark-1 h-50 rounded-8"
                                        type="text" placeholder="Nama wisata..."
                                        value="{{ request()->input('search') }}">
                                    <button type="submit" class="d-flex absolute h-full items-center">
                                        <i class="icon-search text-20 px-15 text-dark-1"></i>
                                    </button>
                                </div>
                            </form>
                        </div>


                        <div class="sidebar__item">
                            <h5 class="text-18 fw-500 mb-10">Star Rating</h5>
                            <div class="row x-gap-10 y-gap-10 pt-10">

                                @for ($i = 1; $i <= 5; $i++)
                                    <div class="col-auto">
                                        <a href="{{ route('wisatawan.travel', ['rating' => $i]) }}"
                                            class="button -blue-1 bg-blue-1-05 text-blue-1 rounded-100 {{ request('rating') == $i ? 'active-button' : '' }} px-20 py-5">
                                            {{ $i }}
                                        </a>
                                    </div>
                                @endfor

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
                        @foreach ($travels as $travel)
                            <div class="col-12">

                                <div class="border-top-light pt-30">
                                    <div class="row x-gap-20 y-gap-20">
                                        <div class="col-md-auto">
                                            <div class="cardImage ratio ratio-1:1 w-250 md:w-1/1 rounded-4">
                                                <div class="cardImage__content">
                                                    {{-- @if ($travel->attachment)
                                        <img class="rounded-4 col-12" src="{{ asset($travel->attachment->path) }}"
                                            alt="image">
                                        @endif --}}
                                                    @if ($travel->foto_profile && $travel->foto_profile->isNotEmpty())
                                                        <img class="rounded-4 col-12"
                                                            src="{{ asset($travel->foto_profile->first()->path) }}"
                                                            alt="image">
                                                    @endif

                                                </div>
                                            </div>
                                        </div>

                                        @php
                                            $averageRating = $travel->review->avg('rating');
                                            $formattedRating = number_format($averageRating, 1);
                                            $fullStars = floor($averageRating);
                                            $halfStar = $averageRating - $fullStars >= 0.5 ? true : false;
                                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                        @endphp


                                        <div class="col-md">
                                            <div class="row x-gap-10 y-gap-10 items-center pt-10">
                                                <div class="col-auto">
                                                    <h1 class="text-18 lh-16 fw-500">{{ $travel->nama_perusahaan }}</h1>
                                                    <div class="rating mt-5">
                                                        @for ($i = 0; $i < $fullStars; $i++)
                                                            <i class="icon-star text-10 text-yellow-2"></i>
                                                            <!-- Full star -->
                                                        @endfor

                                                        @if ($halfStar)
                                                            <i class="icon-star-half text-10 text-yellow-2"></i>
                                                            <!-- Half star -->
                                                        @endif

                                                        @for ($i = 0; $i < $emptyStars; $i++)
                                                            <i class="icon-star text-10 text-light-4"></i>
                                                            <!-- Empty star -->
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-14 text-light-1 lh-15 mt-10">
                                                @php
                                                    $cleanedText = strip_tags($travel->deskripsi);
                                                    $limitedText = \Str::limit($cleanedText, 300, '...');
                                                @endphp
                                                {{ $limitedText }}
                                            </div>
                                        </div>

                                        <div class="col-md-auto text-right md:text-left">
                                            <div class="row x-gap-10 y-gap-10 items-center justify-end md:justify-start">
                                                <div class="col-auto">
                                                    <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                    <div class="text-14 lh-14 text-light-1">
                                                        {{ $travel->review ? $travel->review->count() : 0 }}
                                                        reviews
                                                    </div>
                                                </div>
                                                <div class="col-auto">

                                                    <div
                                                        class="flex-center fw-600 text-14 size-40 rounded-4 bg-blue-1 text-white">
                                                        {{ $formattedRating }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-22 lh-12 fw-600">
                                                <a href="{{ url('travel-destination/' . $travel->id) }}"
                                                    class="button -md -dark-1 bg-blue-1 mt-24 text-white">
                                                    Lihat Paket Wisata
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
                            @if ($travels->onFirstPage())
                                <div class="col-auto md:order-1">
                                    <button class="button -blue-1 size-40 border-light rounded-full" disabled>
                                        <i class="icon-chevron-left text-12"></i>
                                    </button>
                                </div>
                            @else
                                <div class="col-auto md:order-1">
                                    <a href="{{ $travels->previousPageUrl() }}"
                                        class="button -blue-1 size-40 border-light rounded-full">
                                        <i class="icon-chevron-left text-12"></i>
                                    </a>
                                </div>
                            @endif

                            <div class="col-md-auto md:order-3">
                                <div class="row x-gap-20 y-gap-20 md:d-none items-center">
                                    <!-- Page Numbers -->
                                    @foreach ($travels->getUrlRange(1, $travels->lastPage()) as $page => $url)
                                        <div class="col-auto">
                                            <a href="{{ $url }}"
                                                class="size-40 flex-center {{ $page == $travels->currentPage() ? 'bg-dark-1 text-white' : '' }} rounded-full">
                                                {{ $page }}
                                            </a>
                                        </div>
                                    @endforeach

                                    <!-- Ellipsis -->
                                    @if ($travels->lastPage() > 5)
                                        <div class="col-auto">
                                            <div class="size-40 flex-center rounded-full">...</div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="{{ $travels->url($travels->lastPage()) }}"
                                                class="size-40 flex-center rounded-full">
                                                {{ $travels->lastPage() }}
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                <!-- Mobile Pagination -->
                                <div class="row x-gap-10 y-gap-20 d-none md:d-flex items-center justify-center">
                                    @foreach ($travels->getUrlRange(1, min(3, $travels->lastPage())) as $page => $url)
                                        <div class="col-auto">
                                            <a href="{{ $url }}"
                                                class="size-40 flex-center {{ $page == $travels->currentPage() ? 'bg-dark-1 text-white' : '' }} rounded-full">
                                                {{ $page }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-30 text-center md:mt-10">
                                    <div class="text-14 text-light-1">
                                        {{ $travels->firstItem() }} – {{ $travels->lastItem() }} of
                                        {{ $travels->total() }}
                                        wisata ditemukan
                                    </div>
                                </div>
                            </div>

                            <!-- Next Page Link -->
                            @if ($travels->hasMorePages())
                                <div class="col-auto md:order-2">
                                    <a href="{{ $travels->nextPageUrl() }}"
                                        class="button -blue-1 size-40 border-light rounded-full">
                                        <i class="icon-chevron-right text-12"></i>
                                    </a>
                                </div>
                            @else
                                <div class="col-auto md:order-2">
                                    <button class="button -blue-1 size-40 border-light rounded-full" disabled>
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

@stop
