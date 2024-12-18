@extends('customer.layouts.master')
@section('content')
    <section data-anim="slide-up" class="layout-pt-md">
        <div class="container">
            <div class="row y-gap-40 justify-center text-center">
                <div class="col-auto">
                    <h1 class="text-30 fw-600">{{ $artikel->judul }}</h1>
                    <div class="text-15 text-light-1 mt-10">{{ $artikel->created_at->format('F d, Y') }}</div>
                </div>

                <div class="col-12">
                    <img src="{{ Storage::url($artikel->foto_sampul) }}" alt="image" class="col-12 rounded-8">
                </div>
            </div>
        </div>
    </section>

    <section data-anim="slide-up" class="layout-pt-md layout-pb-md">
        <div class="container">
            <div class="row y-gap-30 justify-center">
                <div class="col-xl-8 col-lg-10">
                    <div class="">
                        <h3 class="text-20 fw-500">Tentang artikel ini.</h3>
                        <div class="text-15 mt-20">{!! $artikel->detail !!}</div>
                    </div>

                </div>
            </div>
        </div>
    </section>

<section class="layout-pt-md layout-pb-lg">
    <div class="container">
        <div class="row justify-center text-center">
            <div class="col-auto">
                <div class="sectionTitle -md">
                    <h2 class="sectionTitle__title">Artikel Lainnya</h2>
                    <p class=" sectionTitle__text mt-5 sm:mt-0">Jelajahi artikel menarik lainnya yang mungkin Anda sukai
                    </p>
                </div>
            </div>
        </div>

            <div class="row y-gap-30 pt-40">

                @foreach ($list_artikel as $item)
                    <div class="col-lg-3 col-sm-6">

                        <a href="/blog/{{ $item->slug }}" class="blogCard -type-2 d-block rounded-4 shadow-4 bg-white">
                            <div class="blogCard__image">
                                <div class="ratio ratio-1:1 rounded-4">
                                    <img class="img-ratio js-lazy" src="#"
                                        data-src="{{ Storage::url($item->foto_sampul) }}" alt="image">
                                </div>
                            </div>

                            <div class="px-20 py-20">
                                <h4 class="text-dark-1 text-16 lh-18 fw-500">{{ $item->judul }}</h4>
                                <div class="text-light-1 text-15 lh-14 mt-10">{{ $item->created_at->format('F d, Y') }}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach


            </div>
        </div>
    </section>

@stop
