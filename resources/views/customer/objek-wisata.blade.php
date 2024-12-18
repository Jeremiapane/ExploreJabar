@extends('customer.layouts.master')
@section('content')
    <section class="section-bg z-5 relative pb-40 pt-40 text-center" style="height: 253px">
        <div class="section-bg__item col-12">
            <img src="{{ asset('images/header-wisata.jpeg') }}" alt="image" class="h-full w-full object-cover">
        </div>

        <div class="h-100 d-flex align-items-center justify-content-center container">
            <div class="row w-100">
                <div class="col-12">
                    <div class="mt-60 text-center">
                        <h1 class="text-30 fw-600 text-white">Daftar objek wisata yang harus ada dalam rencana perjalanan
                            Anda</h1>
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
                            <h5 class="text-18 fw-500 mb-10">Cari Wisata</h5>
                            <form action="{{ route('wisatawan.destination') }}" method="GET">
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

                    </aside>
                </div>

                <div class="col-xl-9 col-lg-8">
                    <div class="mt-30"></div>

                    <div class="row y-gap-30">
                        @foreach ($list_wisata as $wisata)
                            <div class="col-12">

                                <div class="border-top-light pt-30">
                                    <div class="row x-gap-20 y-gap-20">
                                        <div class="col-md-auto">

                                            <div class="cardImage ratio ratio-1:1 w-250 md:w-1/1 rounded-4">
                                                <div class="cardImage__content">

                                                    @if (isset($wisata->images[0]))
                                                        <img class="rounded-4 col-12"
                                                            src="{{ Storage::url($wisata->images[0]->path) }}"
                                                            alt="image">
                                                    @endif

                                                </div>



                                            </div>

                                        </div>

                                        <div class="col-md">
                                            <div class="row x-gap-10 y-gap-10 items-center pt-10">
                                                <div class="col-auto">
                                                    <h1 class="text-18 lh-16 fw-500">{{ $wisata->nama }}</h1>
                                                </div>
                                            </div>

                                            <div class="text-14 lh-15 mt-20">
                                                <div class="text-light-1">{{ $wisata->daerah->kecamatan }},
                                                    {{ $wisata->daerah->provinsi }}</div>
                                            </div>

                                            <div class="text-14 text-light-1 lh-15 mt-10">
                                                @php
                                                    $cleanedText = strip_tags($wisata->detail);
                                                    $limitedText = \Str::limit($cleanedText, 300, '...');
                                                @endphp

                                                {{ $limitedText }}
                                            </div>
                                        </div>

                                        <div class="col-md-auto text-right md:text-left">
                                            <div class="">
                                                <a href="{{ route('wisatawan.destination.show', $wisata->id) }}"
                                                    class="button -md -dark-1 bg-blue-1 mt-24 text-white">
                                                    Lihat Detail Wisata
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
                            @if ($list_wisata->onFirstPage())
                                <div class="col-auto md:order-1">
                                    <button class="button -blue-1 size-40 border-light rounded-full" disabled>
                                        <i class="icon-chevron-left text-12"></i>
                                    </button>
                                </div>
                            @else
                                <div class="col-auto md:order-1">
                                    <a href="{{ $list_wisata->previousPageUrl() }}"
                                        class="button -blue-1 size-40 border-light rounded-full">
                                        <i class="icon-chevron-left text-12"></i>
                                    </a>
                                </div>
                            @endif

                            <div class="col-md-auto md:order-3">
                                <div class="row x-gap-20 y-gap-20 md:d-none items-center">
                                    <!-- Page Numbers -->
                                    @foreach ($list_wisata->getUrlRange(1, $list_wisata->lastPage()) as $page => $url)
                                        <div class="col-auto">
                                            <a href="{{ $url }}"
                                                class="size-40 flex-center {{ $page == $list_wisata->currentPage() ? 'bg-dark-1 text-white' : '' }} rounded-full">
                                                {{ $page }}
                                            </a>
                                        </div>
                                    @endforeach

                                    <!-- Ellipsis -->
                                    @if ($list_wisata->lastPage() > 5)
                                        <div class="col-auto">
                                            <div class="size-40 flex-center rounded-full">...</div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="{{ $list_wisata->url($list_wisata->lastPage()) }}"
                                                class="size-40 flex-center rounded-full">
                                                {{ $list_wisata->lastPage() }}
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                <!-- Mobile Pagination -->
                                <div class="row x-gap-10 y-gap-20 d-none md:d-flex items-center justify-center">
                                    @foreach ($list_wisata->getUrlRange(1, min(3, $list_wisata->lastPage())) as $page => $url)
                                        <div class="col-auto">
                                            <a href="{{ $url }}"
                                                class="size-40 flex-center {{ $page == $list_wisata->currentPage() ? 'bg-dark-1 text-white' : '' }} rounded-full">
                                                {{ $page }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-30 text-center md:mt-10">
                                    <div class="text-14 text-light-1">
                                        {{ $list_wisata->firstItem() }} – {{ $list_wisata->lastItem() }} of
                                        {{ $list_wisata->total() }} wisata ditemukan
                                    </div>
                                </div>
                            </div>

                            <!-- Next Page Link -->
                            @if ($list_wisata->hasMorePages())
                                <div class="col-auto md:order-2">
                                    <a href="{{ $list_wisata->nextPageUrl() }}"
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
