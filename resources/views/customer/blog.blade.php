@extends('customer.layouts.master')
@section('content')
<section class="section-bg pt-40 pb-40 relative z-5 text-center" style="height: 253px">
    <div class="section-bg__item col-12">
        <img src="{{ asset('images/header-artikel.jpeg') }}" alt="image" class="w-full h-full object-cover">
    </div>

    <div class="container h-100 d-flex align-items-center justify-content-center">
        <div class="row w-100">
            <div class="col-12">
                <div class="text-center mt-60">
                    <h1 class="text-30 fw-600 text-white">Artikel terbaru</h1>
                    <h4 class="text-15 fw-600 text-white">Temukan Cara Terbaik Untuk Menikmati Wisata.</h4>
                </div>
            </div>
        </div>
    </div>
</section>
<section data-anim-wrap class="layout-pt-md layout-pb-lg">
    <div class="container">

        <div data-anim-child="slide-up delay-2" class="tabs -pills-3 pt-30 js-tabs">
            <div class="tabs__content pt-30 js-tabs-content">

                <div class="tabs__pane -tab-item-1 is-tab-el-active">
                    <div class="row y-gap-30">
                        @foreach ($list_artikel as $artikel)
                        <div class="col-lg-4 col-sm-6">

                            <a href="/blog/{{ $artikel->slug }}" class="blogCard -type-1 d-block ">
                                <div class="blogCard__image">
                                    <div class="ratio ratio-4:3 rounded-8">
                                        <img class="img-ratio js-lazy" src="#"
                                            data-src="{{ Storage::url($artikel->foto_sampul) }}" alt="image">
                                    </div>
                                </div>

                                <div class="pt-20">
                                    <h4 class="text-dark-1 text-18 fw-500">{{ $artikel->judul }}</h4>
                                    <div class="text-light-1 text-15 lh-14 mt-5">{{ $artikel->created_at->format('F d,
                                        Y') }}</div>
                                </div>
                            </a>

                        </div>
                        @endforeach
                    </div>

                    <div class="border-top-light mt-30 pt-30">
                        <div class="row x-gap-10 y-gap-20 justify-between md:justify-center">
                            <!-- Previous Page Link -->
                            @if ($list_artikel->onFirstPage())
                            <div class="col-auto md:order-1">
                                <button class="button -blue-1 size-40 rounded-full border-light" disabled>
                                    <i class="icon-chevron-left text-12"></i>
                                </button>
                            </div>
                            @else
                            <div class="col-auto md:order-1">
                                <a href="{{ $list_artikel->previousPageUrl() }}"
                                    class="button -blue-1 size-40 rounded-full border-light">
                                    <i class="icon-chevron-left text-12"></i>
                                </a>
                            </div>
                            @endif

                            <div class="col-md-auto md:order-3">
                                <div class="row x-gap-20 y-gap-20 items-center md:d-none">
                                    <!-- Page Numbers -->
                                    @foreach ($list_artikel->getUrlRange(1, $list_artikel->lastPage()) as $page => $url)
                                    <div class="col-auto">
                                        <a href="{{ $url }}"
                                            class="size-40 flex-center rounded-full {{ $page == $list_artikel->currentPage() ? 'bg-dark-1 text-white' : '' }}">
                                            {{ $page }}
                                        </a>
                                    </div>
                                    @endforeach

                                    <!-- Ellipsis -->
                                    @if ($list_artikel->lastPage() > 5)
                                    <div class="col-auto">
                                        <div class="size-40 flex-center rounded-full">...</div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ $list_artikel->url($list_artikel->lastPage()) }}"
                                            class="size-40 flex-center rounded-full">
                                            {{ $list_artikel->lastPage() }}
                                        </a>
                                    </div>
                                    @endif
                                </div>

                                <!-- Mobile Pagination -->
                                <div class="row x-gap-10 y-gap-20 justify-center items-center d-none md:d-flex">
                                    @foreach ($list_artikel->getUrlRange(1, min(3, $list_artikel->lastPage())) as $page
                                    => $url)
                                    <div class="col-auto">
                                        <a href="{{ $url }}"
                                            class="size-40 flex-center rounded-full {{ $page == $list_artikel->currentPage() ? 'bg-dark-1 text-white' : '' }}">
                                            {{ $page }}
                                        </a>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="text-center mt-30 md:mt-10">
                                    <div class="text-14 text-light-1">
                                        {{ $list_artikel->firstItem() }} – {{ $list_artikel->lastItem() }} of {{
                                        $list_artikel->total() }} artikel ditemukan
                                    </div>
                                </div>
                            </div>

                            <!-- Next Page Link -->
                            @if ($list_artikel->hasMorePages())
                            <div class="col-auto md:order-2">
                                <a href="{{ $list_artikel->nextPageUrl() }}"
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
    </div>
</section>

@stop