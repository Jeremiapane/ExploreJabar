@extends('customer.layouts.master')
@section('content')

<section class="pt-40">
    <div class="container">
        <div class="row y-gap-20 justify-between items-end">
            <div class="col-auto">
                <div class="row x-gap-20  items-center">
                    <div class="col-auto">
                        <h1 class="text-30 sm:text-25 fw-600">{{ $wisata->nama }}</h1>
                        <span class="text-15 sm:text-25 fw-200">{{ $wisata->daerah->provinsi }}, {{
                            $wisata->daerah->kecamatan }}</span>
                    </div>

                </div>

            </div>

        </div>

        <div class="galleryGrid -type-1 pt-30">
            @if(isset($wisata->images[0]))
            <div class="galleryGrid__item relative d-flex">
                <img src="{{ Storage::url($wisata->images[0]->path) }}" alt="image" class="rounded-4">
            </div>
            @endif

            @if(isset($wisata->images[1]))
            <div class="galleryGrid__item">
                <img src="{{ Storage::url($wisata->images[1]->path) }}" alt="image" class="rounded-4">
            </div>
            @endif

            @if(isset($wisata->images[2]))
            <div class="galleryGrid__item relative d-flex">
                <img src="{{ Storage::url($wisata->images[2]->path) }}" alt="image" class="rounded-4">
            </div>
            @endif

            @if(isset($wisata->images[3]))
            <div class="galleryGrid__item">
                <img src="{{ Storage::url($wisata->images[3]->path) }}" alt="image" class="rounded-4">
            </div>
            @endif

            @if(isset($wisata->images[4]))
            <div class="galleryGrid__item relative d-flex">
                <img src="{{ Storage::url($wisata->images[4]->path) }}" alt="image" class="rounded-4">
            </div>
            @endif
        </div>
    </div>
</section>

<section class="pt-30">
    <div class="container">
        <div class="row y-gap-30">
            <div class="col-xl-12">
                <div class="row y-gap-40">

                    <div id="overview" class="col-12">
                        <h3 class="text-22 fw-500 pt-40 border-top-light">Deskripsi</h3>
                        <p class="text-dark-1 text-15 mt-20">
                            {!! $wisata->detail !!}
                        </p>
                    </div>

                    <div class="col-12 mb-50">
                        <h3 class="text-22 fw-500 pt-40 border-top-light">Activity Locations</h3>
                        <div class="row y-gap-10 pt-20">

                            <div class="col-md-12">
                                <div class="d-flex x-gap-15 y-gap-15 items-center">
                                    <iframe src="{{ $wisata->url_peta }}" width="100%" height="450" style="border:0;"
                                        allowfullscreen="" aria-hidden="false" tabindex="0">
                                    </iframe>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
</section>
@stop