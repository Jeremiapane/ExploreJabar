@extends('customer.layouts.master')
@section('content')
<section class="py-10 d-flex items-center bg-light-2">
    <div class="container">
        <div class="row y-gap-10 items-center justify-between">
            <div class="col-auto">
                <div class="row x-gap-10 y-gap-5 items-center text-14 text-light-1">
                    <div class="col-auto">
                        <div class="">Home</div>
                    </div>
                </div>
            </div>

            <div class="col-auto">
                <a href="#" class="text-14 text-blue-1 underline">All Hotel in London</a>
            </div>
        </div>
    </div>
</section>

<section class="pt-40">
    <div class="container">
        <div class="relative d-flex justify-center js-section-slider" data-gap="10" data-slider-cols="xl-2 lg-2 base-1"
            data-nav-prev="js-img-prev" data-nav-next="js-img-next" data-loop>
            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <div class="ratio ratio-64:45">
                        <img src="img/lists/activity/single/1.png" alt="image" class="rounded-4 img-ratio">
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="ratio ratio-64:45">
                        <img src="img/lists/activity/single/2.png" alt="image" class="rounded-4 img-ratio">
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="ratio ratio-64:45">
                        <img src="img/lists/activity/single/3.png" alt="image" class="rounded-4 img-ratio">
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="ratio ratio-64:45">
                        <img src="img/lists/activity/single/4.png" alt="image" class="rounded-4 img-ratio">
                    </div>
                </div>

            </div>

            <div class="absolute h-full col-11">

                <button
                    class="section-slider-nav -prev flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-img-prev">
                    <i class="icon icon-chevron-left text-12"></i>
                </button>

                <button
                    class="section-slider-nav -next flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-img-next">
                    <i class="icon icon-chevron-right text-12"></i>
                </button>

            </div>

            <div class="absolute h-full col-12 px-20 py-20 d-flex justify-end items-end">
                <a href="img/lists/activity/single/1.png"
                    class="button -blue-1 px-24 py-15 bg-white text-dark-1 z-2 js-gallery" data-gallery="gallery2">
                    See All 90 Photos
                </a>
                <a href="img/lists/activity/single/2.png" class="js-gallery" data-gallery="gallery2"></a>
                <a href="img/lists/activity/single/3.png" class="js-gallery" data-gallery="gallery2"></a>
                <a href="img/lists/activity/single/4.png" class="js-gallery" data-gallery="gallery2"></a>
            </div>
        </div>
    </div>
</section>

<section class="pt-40">
    <div class="container">
        <div class="row y-gap-30">
            <div class="col-lg-8">
                <div class="row justify-between items-end">
                    <div class="col-auto">
                        <h1 class="text-26 fw-600">{{ $paket->nama }}</h1>

                        <div class="row x-gap-10 y-gap-20 items-center pt-10">
                            <div class="col-auto">
                                <div class="d-flex items-center">
                                    <i class="icon-star text-10 text-yellow-1"></i>

                                    <div class="text-14 text-light-1 ml-10">
                                        <span class="text-15 fw-500 text-dark-1">4.82</span>
                                        94 reviews
                                    </div>
                                </div>
                            </div>

                            <div class="col-auto">
                                <div class="row x-gap-10 items-center">
                                    <div class="col-auto">
                                        <div class="d-flex x-gap-5 items-center">
                                            <i class="icon-location-2 text-16 text-light-1"></i>
                                            <div class="text-15 text-light-1">{{ $paket->wisata->daerah->provinsi }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-auto">
                        <div class="row x-gap-10 y-gap-10">
                            <div class="col-auto">
                                <button class="button px-15 py-10 -blue-1">
                                    <i class="icon-share mr-10"></i>
                                    Share
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-top-light mt-40 mb-40"></div>

                <h3 class="text-22 fw-500 mt-30">
                    Ringkasan Perjalanan
                </h3>

                <div class="row y-gap-30 justify-between pt-20">

                    <div class="col-md-auto col-6">
                        <div class="d-flex">
                            <i class="icon-customer text-22 text-blue-1 mr-10"></i>
                            <div class="text-15 lh-15">
                                Group size:<br> {{ $paket->jumlah_peserta }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-auto col-6">
                        <div class="d-flex">
                            <i class="icon-customer text-22 text-blue-1 mr-10"></i>
                            <div class="text-15 lh-15">
                                Pemandu WIsata:<br> {{ $paket->pemanduWisata->user->nama }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-auto col-6">
                        <div class="d-flex">
                            <i class="icon-route text-22 text-blue-1 mr-10"></i>
                            <div class="text-15 lh-15">
                                Kendaraan<br> {{ $paket->kendaraan->jenis }}
                            </div>
                        </div>
                    </div>

                </div>

                <div class="border-top-light mt-40 mb-40"></div>

                <div class="row x-gap-40 y-gap-40">
                    <div class="col-12">
                        <h3 class="text-22 fw-500">Deskripsi Paket</h3>

                        <div class="show-more -h-60 js-show-more">
                            <div class="show-more__content">
                                <p class="text-dark-1 text-15 mt-20">
                                    {{ $paket->deskripsi }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <h5 class="text-16 fw-500">Rencana Perjalanan</h5>
                        <ul class="list-disc text-15 mt-10">
                            @foreach ($paket->aktivitas as $aktivitas)
                            <li>{{ $aktivitas->aktivitas }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="mt-40 border-top-light">
                    <div class="row x-gap-40 y-gap-40 pt-40">
                        <div class="col-12">
                            <h3 class="text-22 fw-500">Fasilitas</h3>

                            <div class="row x-gap-40 y-gap-40 pt-20">
                                <div class="col-md-6">
                                    <div class="text-dark-1 text-15">
                                        <i class="icon-check text-10 mr-10"></i> {{$paket->include}}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="text-dark-1 text-15">
                                        <i class="icon-close text-green-2 text-10 mr-10"></i> {{$paket->exclude}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="d-flex justify-end">
                    <div class="w-360 lg:w-full d-flex flex-column items-center">
                        <div class="px-30 py-30 rounded-4 border-light bg-white shadow-4">
                            <div class="text-14 text-light-1">
                                <span class="text-20 fw-500 text-dark-1 ml-5">RP. {{ $paket->harga }}</span>
                            </div>

                            <form id="bookingForm" action="{{ route('wisatawan.booking.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_paket" value="{{ $paket->id }}">
                                <input type="hidden" name="id_wisatawan" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="harga" value="{{ $paket->harga }}">
                                <div class="row y-gap-20 pt-30">
                                    <div class="col-12">
                                        <div class="form-input">
                                            <input type="text" name="nama" required>
                                            <label class="lh-1 text-16 text-light-1">Nama Lengkap</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-input">
                                            <input type="text" name="no_hp" required>
                                            <label class="lh-1 text-16 text-light-1">No Hp</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-input">
                                            <input type="date" name="tanggal" required>
                                            {{-- <label class="lh-1 text-16 text-light-1">Tanggal</label> --}}
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-input">
                                            <input type="text" name="jumlah_peserta" required>
                                            <label class="lh-1 text-16 text-light-1">Jumlah Peserta</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-input">
                                            <textarea name="catatan" rows="5"></textarea>
                                            <label class="lh-1 text-16 text-light-1">Catatan Tambahan (Opsional)</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="button" id="bookingButton"
                                            class="button -dark-1 py-15 px-35 h-60 col-12 rounded-4 bg-blue-1 text-white">
                                            Booking Sekarang
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.getElementById('bookingButton').addEventListener('click', function() {
        var form = document.getElementById('bookingForm');
        var isValid = true;
        var emptyFields = [];

        form.querySelectorAll('input[required], textarea[required]').forEach(function(input) {
            if (!input.value.trim()) {
                isValid = false;
                emptyFields.push(input.previousElementSibling ? input.previousElementSibling.textContent : input.name);
            }
        });

        if (isValid) {
            @if(Auth::check())
                form.submit();
            @else
                Swal.fire({
                    icon: 'warning',
                    title: 'Harap Login',
                    text: 'Anda harus login untuk melakukan booking.',
                    confirmButtonText: 'Login'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '{{ route('login') }}';
                    }
                });
            @endif
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Form Belum Lengkap',
                text: 'Kolom berikut belum diisi: ' + emptyFields.join(', '),
                confirmButtonText: 'Lengkapi'
            });
        }
    });

</script>

{{-- <section class="pt-40">
    <div class="container">
        <div class="pt-40 border-top-light">
            <div class="row x-gap-40 y-gap-40">
                <div class="col-auto">
                    <h3 class="text-22 fw-500">Important information</h3>
                </div>
            </div>

            <div class="row x-gap-40 y-gap-40 justify-between pt-20">
                <div class="col-lg-4 col-md-6">
                    <div class="fw-500 mb-10">Inclusions</div>
                    <ul class="list-disc">
                        <li>Superior Coach, Wi-Fi and USB Charging On-board</li>
                        <li>Expert guide</li>
                        <li>Admission to Windsor Castle (if option selected)</li>
                        <li>Admission to Stonehenge</li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="fw-500 mb-10">Departure details</div>
                    <div class="text-15">
                        Departures from 01st April 2022: Tour departs at 8 am (boarding at 7.30 am), Victoria Coach
                        Station Gate 1-5
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="fw-500 mb-10">Know before you go</div>
                    <ul class="list-disc">
                        <li>Duration: 11h</li>
                        <li>Mobile tickets accepted</li>
                        <li>Instant confirmation</li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="fw-500 mb-10">Exclusions</div>
                    <ul class="list-disc">
                        <li>Hotel pick-up and drop-off</li>
                        <li>Gratuities</li>
                        <li>Lunch</li>
                    </ul>
                </div>

                <div class="col-12">
                    <div class="fw-500 mb-10">Additional information</div>
                    <ul class="list-disc">
                        <li>Confirmation will be received at time of booking</li>
                        <li>Departs at 8am (boarding at 7.30am), Victoria Coach Station Gate 1-5, 164 Buckingham Palace
                            Road, London, SW1W 9TP</li>
                        <li>As Windsor Castle is a working royal palace, sometimes the entire Castle or the State
                            Apartments within the Castle need to be closed at short notice. (if selected this option)
                        </li>
                        <li>Stonehenge is closed on 21 June due to the Summer Solstice. During this time, we will
                            instead visit the Avebury Stone Circle.</li>
                        <li>Please note: the tour itinerary and order may change</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<div class="container mt-40 mb-40">
    <div class="border-top-light"></div>
</div>

{{-- <section class="mb-40">
    <div class="container">
        <h3 class="text-22 fw-500 mb-20">Activity's Location</h3>

        <div class="map rounded-4 map-500 js-map-single"></div>
    </div>
</section> --}}
{{--
<section>
    <div class="container">
        <div class="row y-gap-20">
            <div class="col-lg-4">
                <h2 class="text-22 fw-500">FAQs about<br> The Crown Hotel</h2>
            </div>

            <div class="col-lg-8">
                <div class="accordion -simple row y-gap-20 js-accordion">

                    <div class="col-12">
                        <div class="accordion__item px-20 py-20 border-light rounded-4">
                            <div class="accordion__button d-flex items-center">
                                <div class="accordion__icon size-40 flex-center bg-light-2 rounded-full mr-20">
                                    <i class="icon-plus"></i>
                                    <i class="icon-minus"></i>
                                </div>

                                <div class="button text-dark-1">What do I need to hire a car?</div>
                            </div>

                            <div class="accordion__content">
                                <div class="pt-20 pl-60">
                                    <p class="text-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                        veniam, quis nostrud exercitation ullamco.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="accordion__item px-20 py-20 border-light rounded-4">
                            <div class="accordion__button d-flex items-center">
                                <div class="accordion__icon size-40 flex-center bg-light-2 rounded-full mr-20">
                                    <i class="icon-plus"></i>
                                    <i class="icon-minus"></i>
                                </div>

                                <div class="button text-dark-1">How old do I have to be to rent a car?</div>
                            </div>

                            <div class="accordion__content">
                                <div class="pt-20 pl-60">
                                    <p class="text-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                        veniam, quis nostrud exercitation ullamco.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="accordion__item px-20 py-20 border-light rounded-4">
                            <div class="accordion__button d-flex items-center">
                                <div class="accordion__icon size-40 flex-center bg-light-2 rounded-full mr-20">
                                    <i class="icon-plus"></i>
                                    <i class="icon-minus"></i>
                                </div>

                                <div class="button text-dark-1">Can I book a hire car for someone else?</div>
                            </div>

                            <div class="accordion__content">
                                <div class="pt-20 pl-60">
                                    <p class="text-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                        veniam, quis nostrud exercitation ullamco.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="accordion__item px-20 py-20 border-light rounded-4">
                            <div class="accordion__button d-flex items-center">
                                <div class="accordion__icon size-40 flex-center bg-light-2 rounded-full mr-20">
                                    <i class="icon-plus"></i>
                                    <i class="icon-minus"></i>
                                </div>

                                <div class="button text-dark-1">How do I find the cheapest car hire deal?</div>
                            </div>

                            <div class="accordion__content">
                                <div class="pt-20 pl-60">
                                    <p class="text-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                        veniam, quis nostrud exercitation ullamco.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="accordion__item px-20 py-20 border-light rounded-4">
                            <div class="accordion__button d-flex items-center">
                                <div class="accordion__icon size-40 flex-center bg-light-2 rounded-full mr-20">
                                    <i class="icon-plus"></i>
                                    <i class="icon-minus"></i>
                                </div>

                                <div class="button text-dark-1">What should I look for when I&#39;m choosing a car?
                                </div>
                            </div>

                            <div class="accordion__content">
                                <div class="pt-20 pl-60">
                                    <p class="text-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                        veniam, quis nostrud exercitation ullamco.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section> --}}

<div class="container mt-40 mb-40">
    <div class="border-top-light"></div>
</div>

<section>
    <div class="container">
        <div class="row y-gap-40 justify-between">
            <div class="col-xl-3">
                <h3 class="text-22 fw-500">Guest reviews</h3>

                <div class="d-flex items-center mt-20">
                    <div class="flex-center bg-blue-1 rounded-4 size-70 text-22 fw-600 text-white">4.8</div>
                    <div class="ml-20">
                        <div class="text-16 text-dark-1 fw-500 lh-14">Exceptional</div>
                        <div class="text-15 text-light-1 lh-14 mt-4">3,014 reviews</div>
                    </div>
                </div>

                <div class="row y-gap-20 pt-20">

                    <div class="col-12">
                        <div class="">
                            <div class="d-flex items-center justify-between">
                                <div class="text-15 fw-500">Location</div>
                                <div class="text-15 text-light-1">9.4</div>
                            </div>

                            <div class="progressBar mt-10">
                                <div class="progressBar__bg bg-blue-2"></div>
                                <div class="progressBar__bar bg-blue-1" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="">
                            <div class="d-flex items-center justify-between">
                                <div class="text-15 fw-500">Staff</div>
                                <div class="text-15 text-light-1">9.4</div>
                            </div>

                            <div class="progressBar mt-10">
                                <div class="progressBar__bg bg-blue-2"></div>
                                <div class="progressBar__bar bg-blue-1" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="">
                            <div class="d-flex items-center justify-between">
                                <div class="text-15 fw-500">Cleanliness</div>
                                <div class="text-15 text-light-1">9.4</div>
                            </div>

                            <div class="progressBar mt-10">
                                <div class="progressBar__bg bg-blue-2"></div>
                                <div class="progressBar__bar bg-blue-1" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="">
                            <div class="d-flex items-center justify-between">
                                <div class="text-15 fw-500">Value for money</div>
                                <div class="text-15 text-light-1">9.4</div>
                            </div>

                            <div class="progressBar mt-10">
                                <div class="progressBar__bg bg-blue-2"></div>
                                <div class="progressBar__bar bg-blue-1" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="">
                            <div class="d-flex items-center justify-between">
                                <div class="text-15 fw-500">Comfort</div>
                                <div class="text-15 text-light-1">9.4</div>
                            </div>

                            <div class="progressBar mt-10">
                                <div class="progressBar__bg bg-blue-2"></div>
                                <div class="progressBar__bar bg-blue-1" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="">
                            <div class="d-flex items-center justify-between">
                                <div class="text-15 fw-500">Facilities</div>
                                <div class="text-15 text-light-1">9.4</div>
                            </div>

                            <div class="progressBar mt-10">
                                <div class="progressBar__bg bg-blue-2"></div>
                                <div class="progressBar__bar bg-blue-1" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="">
                            <div class="d-flex items-center justify-between">
                                <div class="text-15 fw-500">Free WiFi</div>
                                <div class="text-15 text-light-1">9.4</div>
                            </div>

                            <div class="progressBar mt-10">
                                <div class="progressBar__bg bg-blue-2"></div>
                                <div class="progressBar__bar bg-blue-1" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-xl-8">
                <div class="row y-gap-40">

                    <div class="col-12">
                        <div class="row x-gap-20 y-gap-20 items-center">
                            <div class="col-auto">
                                <img src="img/avatars/2.png" alt="image">
                            </div>
                            <div class="col-auto">
                                <div class="fw-500 lh-15">Tonko</div>
                                <div class="text-14 text-light-1 lh-15">March 2022</div>
                            </div>
                        </div>

                        <h5 class="fw-500 text-blue-1 mt-20">9.2 Superb</h5>
                        <p class="text-15 text-dark-1 mt-10">Nice two level apartment in great London location. Located
                            in quiet small street, but just 50 meters from main street and bus stop. Tube station is
                            short walk, just like two grocery stores. </p>

                        <div class="row x-gap-30 y-gap-30 pt-20">

                            <div class="col-auto">
                                <img src="img/testimonials/1/1.png" alt="image" class="rounded-4">
                            </div>

                            <div class="col-auto">
                                <img src="img/testimonials/1/2.png" alt="image" class="rounded-4">
                            </div>

                            <div class="col-auto">
                                <img src="img/testimonials/1/3.png" alt="image" class="rounded-4">
                            </div>

                            <div class="col-auto">
                                <img src="img/testimonials/1/4.png" alt="image" class="rounded-4">
                            </div>

                        </div>

                        <div class="d-flex x-gap-30 items-center pt-20">
                            <button class="d-flex items-center text-blue-1">
                                <i class="icon-like text-16 mr-10"></i>
                                Helpful
                            </button>

                            <button class="d-flex items-center text-light-1">
                                <i class="icon-dislike text-16 mr-10"></i>
                                Not helpful
                            </button>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row x-gap-20 y-gap-20 items-center">
                            <div class="col-auto">
                                <img src="img/avatars/2.png" alt="image">
                            </div>
                            <div class="col-auto">
                                <div class="fw-500 lh-15">Tonko</div>
                                <div class="text-14 text-light-1 lh-15">March 2022</div>
                            </div>
                        </div>

                        <h5 class="fw-500 text-blue-1 mt-20">9.2 Superb</h5>
                        <p class="text-15 text-dark-1 mt-10">Nice two level apartment in great London location. Located
                            in quiet small street, but just 50 meters from main street and bus stop. Tube station is
                            short walk, just like two grocery stores. </p>

                        <div class="row x-gap-30 y-gap-30 pt-20">

                            <div class="col-auto">
                                <img src="img/testimonials/1/1.png" alt="image" class="rounded-4">
                            </div>

                            <div class="col-auto">
                                <img src="img/testimonials/1/2.png" alt="image" class="rounded-4">
                            </div>

                            <div class="col-auto">
                                <img src="img/testimonials/1/3.png" alt="image" class="rounded-4">
                            </div>

                            <div class="col-auto">
                                <img src="img/testimonials/1/4.png" alt="image" class="rounded-4">
                            </div>

                        </div>

                        <div class="d-flex x-gap-30 items-center pt-20">
                            <button class="d-flex items-center text-blue-1">
                                <i class="icon-like text-16 mr-10"></i>
                                Helpful
                            </button>

                            <button class="d-flex items-center text-light-1">
                                <i class="icon-dislike text-16 mr-10"></i>
                                Not helpful
                            </button>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row x-gap-20 y-gap-20 items-center">
                            <div class="col-auto">
                                <img src="img/avatars/2.png" alt="image">
                            </div>
                            <div class="col-auto">
                                <div class="fw-500 lh-15">Tonko</div>
                                <div class="text-14 text-light-1 lh-15">March 2022</div>
                            </div>
                        </div>

                        <h5 class="fw-500 text-blue-1 mt-20">9.2 Superb</h5>
                        <p class="text-15 text-dark-1 mt-10">Nice two level apartment in great London location. Located
                            in quiet small street, but just 50 meters from main street and bus stop. Tube station is
                            short walk, just like two grocery stores. </p>

                        <div class="d-flex x-gap-30 items-center pt-20">
                            <button class="d-flex items-center text-blue-1">
                                <i class="icon-like text-16 mr-10"></i>
                                Helpful
                            </button>

                            <button class="d-flex items-center text-light-1">
                                <i class="icon-dislike text-16 mr-10"></i>
                                Not helpful
                            </button>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row x-gap-20 y-gap-20 items-center">
                            <div class="col-auto">
                                <img src="img/avatars/2.png" alt="image">
                            </div>
                            <div class="col-auto">
                                <div class="fw-500 lh-15">Tonko</div>
                                <div class="text-14 text-light-1 lh-15">March 2022</div>
                            </div>
                        </div>

                        <h5 class="fw-500 text-blue-1 mt-20">9.2 Superb</h5>
                        <p class="text-15 text-dark-1 mt-10">Nice two level apartment in great London location. Located
                            in quiet small street, but just 50 meters from main street and bus stop. Tube station is
                            short walk, just like two grocery stores. </p>

                        <div class="d-flex x-gap-30 items-center pt-20">
                            <button class="d-flex items-center text-blue-1">
                                <i class="icon-like text-16 mr-10"></i>
                                Helpful
                            </button>

                            <button class="d-flex items-center text-light-1">
                                <i class="icon-dislike text-16 mr-10"></i>
                                Not helpful
                            </button>
                        </div>
                    </div>

                    <div class="col-auto">

                        <a href="#" class="button -md -outline-blue-1 text-blue-1">
                            Show all 116 reviews <div class="icon-arrow-top-right ml-15"></div>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container mt-40 mb-40">
    <div class="border-top-light"></div>
</div>

<section>
    <div class="container">
        <div class="row y-gap-30 justify-between">
            <div class="col-xl-3">
                <div class="row">
                    <div class="col-auto">
                        <h3 class="text-22 fw-500">Leave a Reply</h3>
                        <p class="text-15 text-dark-1 mt-5">Your email address will not be published.</p>
                    </div>
                </div>

                <div class="row y-gap-30 pt-30">

                    <div class="col-sm-6">
                        <div class="text-15 lh-1 fw-500">Location</div>
                        <div class="d-flex x-gap-5 items-center pt-10">

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="text-15 lh-1 fw-500">Staff</div>
                        <div class="d-flex x-gap-5 items-center pt-10">

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="text-15 lh-1 fw-500">Cleanliness</div>
                        <div class="d-flex x-gap-5 items-center pt-10">

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="text-15 lh-1 fw-500">Value for money</div>
                        <div class="d-flex x-gap-5 items-center pt-10">

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="text-15 lh-1 fw-500">Comfort</div>
                        <div class="d-flex x-gap-5 items-center pt-10">

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="text-15 lh-1 fw-500">Facilities</div>
                        <div class="d-flex x-gap-5 items-center pt-10">

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="text-15 lh-1 fw-500">Free WiFi</div>
                        <div class="d-flex x-gap-5 items-center pt-10">

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                            <div class="icon-star text-10 text-yellow-1"></div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-xl-8">
                <div class="row y-gap-30">
                    <div class="col-xl-6">

                        <div class="form-input ">
                            <input type="text" required>
                            <label class="lh-1 text-16 text-light-1">Text</label>
                        </div>

                    </div>
                    <div class="col-xl-6">

                        <div class="form-input ">
                            <input type="text" required>
                            <label class="lh-1 text-16 text-light-1">Email</label>
                        </div>

                    </div>
                    <div class="col-12">

                        <div class="form-input ">
                            <textarea required rows="6"></textarea>
                            <label class="lh-1 text-16 text-light-1">Write Your Comment</label>
                        </div>

                    </div>
                    <div class="col-auto">

                        <a href="#" class="button -md -dark-1 bg-blue-1 text-white">
                            Post Comment <div class="icon-arrow-top-right ml-15"></div>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="mt-50 border-top-light"></div>
</div>

<section class="layout-pt-lg layout-pb-lg">
    <div class="container">
        <div class="row justify-between items-end">
            <div class="col-auto">
                <div class="sectionTitle -md">
                    <h2 class="sectionTitle__title">Similar Experiences</h2>
                    <p class=" sectionTitle__text mt-5 sm:mt-0">Interdum et malesuada fames ac ante ipsum</p>
                </div>
            </div>

            <div class="col-auto">

                <a href="#" class="button h-50 px-24 -blue-1 bg-blue-1-05 text-blue-1">
                    See All <div class="icon-arrow-top-right ml-15"></div>
                </a>

            </div>
        </div>

        <div class="row y-gap-30 pt-40 sm:pt-20">

            <div class="col-xl-3 col-lg-3 col-sm-6">

                <a href="tour-single.html" class="tourCard -type-1 rounded-4 ">
                    <div class="tourCard__image">

                        <div class="cardImage ratio ratio-1:1">
                            <div class="cardImage__content">

                                <img class="rounded-4 col-12" src="img/tours/1.png" alt="image">

                            </div>

                            <div class="cardImage__wishlist">
                                <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                    <i class="icon-heart text-12"></i>
                                </button>
                            </div>

                            <div class="cardImage__leftBadge">
                                <div
                                    class="py-5 px-15 rounded-right-4 text-12 lh-16 fw-500 uppercase bg-dark-1 text-white">
                                    LIKELY TO SELL OUT*
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="tourCard__content mt-10">
                        <div class="d-flex items-center lh-14 mb-5">
                            <div class="text-14 text-light-1">16+ hours</div>
                            <div class="size-3 bg-light-1 rounded-full ml-10 mr-10"></div>
                            <div class="text-14 text-light-1">Full-day Tours</div>
                        </div>

                        <h4 class="tourCard__title text-dark-1 text-18 lh-16 fw-500">
                            <span>Stonehenge, Windsor Castle and Bath with Pub Lunch in Lacock</span>
                        </h4>

                        <p class="text-light-1 lh-14 text-14 mt-5">Westminster Borough, London</p>

                        <div class="row justify-between items-center pt-15">
                            <div class="col-auto">
                                <div class="d-flex items-center">
                                    <div class="d-flex items-center x-gap-5">

                                        <div class="icon-star text-yellow-1 text-10"></div>

                                        <div class="icon-star text-yellow-1 text-10"></div>

                                        <div class="icon-star text-yellow-1 text-10"></div>

                                        <div class="icon-star text-yellow-1 text-10"></div>

                                        <div class="icon-star text-yellow-1 text-10"></div>

                                    </div>

                                    <div class="text-14 text-light-1 ml-10">3,014 reviews</div>
                                </div>
                            </div>

                            <div class="col-auto">
                                <div class="text-14 text-light-1">
                                    From
                                    <span class="text-16 fw-500 text-dark-1">US$72</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>

            <div class="col-xl-3 col-lg-3 col-sm-6">

                <a href="tour-single.html" class="tourCard -type-1 rounded-4 ">
                    <div class="tourCard__image">

                        <div class="cardImage ratio ratio-1:1">
                            <div class="cardImage__content">

                                <div class="cardImage-slider rounded-4 overflow-hidden js-cardImage-slider">
                                    <div class="swiper-wrapper">

                                        <div class="swiper-slide">
                                            <img class="col-12" src="img/tours/2.png" alt="image">
                                        </div>

                                        <div class="swiper-slide">
                                            <img class="col-12" src="img/tours/1.png" alt="image">
                                        </div>

                                        <div class="swiper-slide">
                                            <img class="col-12" src="img/tours/3.png" alt="image">
                                        </div>

                                    </div>

                                    <div class="cardImage-slider__pagination js-pagination"></div>

                                    <div class="cardImage-slider__nav -prev">
                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2 js-prev">
                                            <i class="icon-chevron-left text-10"></i>
                                        </button>
                                    </div>

                                    <div class="cardImage-slider__nav -next">
                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2 js-next">
                                            <i class="icon-chevron-right text-10"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>

                            <div class="cardImage__wishlist">
                                <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                    <i class="icon-heart text-12"></i>
                                </button>
                            </div>

                        </div>

                    </div>

                    <div class="tourCard__content mt-10">
                        <div class="d-flex items-center lh-14 mb-5">
                            <div class="text-14 text-light-1">9+ hours</div>
                            <div class="size-3 bg-light-1 rounded-full ml-10 mr-10"></div>
                            <div class="text-14 text-light-1">Attractions &amp; Museums</div>
                        </div>

                        <h4 class="tourCard__title text-dark-1 text-18 lh-16 fw-500">
                            <span>Westminster Walking Tour & Westminster Abbey Entry</span>
                        </h4>

                        <p class="text-light-1 lh-14 text-14 mt-5">Ciutat Vella, Barcelona</p>

                        <div class="row justify-between items-center pt-15">
                            <div class="col-auto">
                                <div class="d-flex items-center">
                                    <div class="d-flex items-center x-gap-5">

                                        <div class="icon-star text-yellow-1 text-10"></div>

                                        <div class="icon-star text-yellow-1 text-10"></div>

                                        <div class="icon-star text-yellow-1 text-10"></div>

                                        <div class="icon-star text-yellow-1 text-10"></div>

                                        <div class="icon-star text-yellow-1 text-10"></div>

                                    </div>

                                    <div class="text-14 text-light-1 ml-10">3,014 reviews</div>
                                </div>
                            </div>

                            <div class="col-auto">
                                <div class="text-14 text-light-1">
                                    From
                                    <span class="text-16 fw-500 text-dark-1">US$72</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>

            <div class="col-xl-3 col-lg-3 col-sm-6">

                <a href="tour-single.html" class="tourCard -type-1 rounded-4 ">
                    <div class="tourCard__image">

                        <div class="cardImage ratio ratio-1:1">
                            <div class="cardImage__content">

                                <img class="rounded-4 col-12" src="img/tours/3.png" alt="image">

                            </div>

                            <div class="cardImage__wishlist">
                                <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                    <i class="icon-heart text-12"></i>
                                </button>
                            </div>

                            <div class="cardImage__leftBadge">
                                <div
                                    class="py-5 px-15 rounded-right-4 text-12 lh-16 fw-500 uppercase bg-blue-1 text-white">
                                    Best Seller
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="tourCard__content mt-10">
                        <div class="d-flex items-center lh-14 mb-5">
                            <div class="text-14 text-light-1">40–55 minutes</div>
                            <div class="size-3 bg-light-1 rounded-full ml-10 mr-10"></div>
                            <div class="text-14 text-light-1">Private and Luxury</div>
                        </div>

                        <h4 class="tourCard__title text-dark-1 text-18 lh-16 fw-500">
                            <span>High-Speed Thames River RIB Cruise in London</span>
                        </h4>

                        <p class="text-light-1 lh-14 text-14 mt-5">Manhattan, New York</p>

                        <div class="row justify-between items-center pt-15">
                            <div class="col-auto">
                                <div class="d-flex items-center">
                                    <div class="d-flex items-center x-gap-5">

                                        <div class="icon-star text-yellow-1 text-10"></div>

                                        <div class="icon-star text-yellow-1 text-10"></div>

                                        <div class="icon-star text-yellow-1 text-10"></div>

                                        <div class="icon-star text-yellow-1 text-10"></div>

                                        <div class="icon-star text-yellow-1 text-10"></div>

                                    </div>

                                    <div class="text-14 text-light-1 ml-10">3,014 reviews</div>
                                </div>
                            </div>

                            <div class="col-auto">
                                <div class="text-14 text-light-1">
                                    From
                                    <span class="text-16 fw-500 text-dark-1">US$72</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>

            <div class="col-xl-3 col-lg-3 col-sm-6">

                <a href="tour-single.html" class="tourCard -type-1 rounded-4 ">
                    <div class="tourCard__image">

                        <div class="cardImage ratio ratio-1:1">
                            <div class="cardImage__content">

                                <img class="rounded-4 col-12" src="img/tours/4.png" alt="image">

                            </div>

                            <div class="cardImage__wishlist">
                                <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                    <i class="icon-heart text-12"></i>
                                </button>
                            </div>

                            <div class="cardImage__leftBadge">
                                <div
                                    class="py-5 px-15 rounded-right-4 text-12 lh-16 fw-500 uppercase bg-yellow-1 text-dark-1">
                                    Top Rated
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="tourCard__content mt-10">
                        <div class="d-flex items-center lh-14 mb-5">
                            <div class="text-14 text-light-1">94+ days</div>
                            <div class="size-3 bg-light-1 rounded-full ml-10 mr-10"></div>
                            <div class="text-14 text-light-1">Bus Tours</div>
                        </div>

                        <h4 class="tourCard__title text-dark-1 text-18 lh-16 fw-500">
                            <span>Edinburgh Darkside Walking Tour: Mysteries, Murder and Legends</span>
                        </h4>

                        <p class="text-light-1 lh-14 text-14 mt-5">Vaticano Prati, Rome</p>

                        <div class="row justify-between items-center pt-15">
                            <div class="col-auto">
                                <div class="d-flex items-center">
                                    <div class="d-flex items-center x-gap-5">

                                        <div class="icon-star text-yellow-1 text-10"></div>

                                        <div class="icon-star text-yellow-1 text-10"></div>

                                        <div class="icon-star text-yellow-1 text-10"></div>

                                        <div class="icon-star text-yellow-1 text-10"></div>

                                        <div class="icon-star text-yellow-1 text-10"></div>

                                    </div>

                                    <div class="text-14 text-light-1 ml-10">3,014 reviews</div>
                                </div>
                            </div>

                            <div class="col-auto">
                                <div class="text-14 text-light-1">
                                    From
                                    <span class="text-16 fw-500 text-dark-1">US$72</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>

        </div>
    </div>
</section>
@stop