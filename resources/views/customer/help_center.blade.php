@extends('customer.layouts.master')
@section('content')


<section class="layout-pt-md">
    <div class="container">
        <div class="row y-gap-30 justify-between items-center">
            <div class="col-lg-5">
                <h2 class="text-30 fw-600">Explore Jabar</h2>
                <p class="mt-5">kami berdedikasi untuk memberikan pelayanan terbaik dan solusi inovatif bagi pelanggan
                    kami</p>

                <p class="text-dark-1 mt-60 lg:mt-40 md:mt-20">
                    Explore Jawa Barat adalah portal wisata terdepan yang didedikasikan untuk mengeksplorasi keindahan
                    dan kekayaan Provinsi Jawa Barat. Kami menyediakan informasi lengkap dan terbaru mengenai objek
                    wisata, dan paket wisata yang menarik dapat dilakukan di Jawa Barat. <br><br>
                    Misi Kami
                    Misi kami adalah untuk mempromosikan Jawa Barat sebagai destinasi wisata unggulan dengan memberikan
                    informasi yang akurat, inspiratif, dan mudah diakses. Kami berkomitmen untuk membantu wisatawan
                    dalam merencanakan perjalanan yang tak terlupakan di Jawa Barat. </p>
            </div>

            <div class="col-lg-6 text-center">
                <img style="max-width: 400px" src="{{ asset('images/logo.png') }}" alt="logo icon">
            </div>
        </div>
    </div>
</section>

<section class="layout-pt-lg layout-pb-lg">
    <div class="container">
        <div class="row justify-center text-center">
            <div class="col-auto">
                <div class="sectionTitle -md">
                    <h2 class="sectionTitle__title">Frequently Asked Questions</h2>
                    <p class=" sectionTitle__text mt-5 sm:mt-0">Berikut adalah beberapa pertanyaan umum yang sering kami
                        terima, beserta jawabannya</p>
                </div>
            </div>
        </div>

        <div class="row y-gap-30 justify-center pt-40 sm:pt-20">
            <div class="col-xl-8 col-lg-10">
                <div class="accordion -simple row y-gap-20 js-accordion">

                    <div class="col-12">
                        <div class="accordion__item px-20 py-20 border-light rounded-4">
                            <div class="accordion__button d-flex items-center">
                                <div class="accordion__icon size-40 flex-center bg-light-2 rounded-full mr-20">
                                    <i class="icon-plus"></i>
                                    <i class="icon-minus"></i>
                                </div>

                                <div class="button text-dark-1">Apa itu Aplikasi Explore Jabar?</div>
                            </div>

                            <div class="accordion__content">
                                <div class="pt-20 pl-60">
                                    <p class="text-15">Explore Jabar adalah platform website yang menyediakan informasi
                                        lengkap tentang objek wisata,artikel,pengaduan dan paket wisata di jawa barat.</p>
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

                                <div class="button text-dark-1">Bagaimana cara memesan/booking paket wisata melalui
                                    Explore Jabar?</div>
                            </div>

                            <div class="accordion__content">
                                <div class="pt-20 pl-60">
                                    <p class="text-15">Untuk booking paket wisata, Anda bisa memilih salah satu agen perjalanan
                                        di bagian home, kemudian anda pilih paket wisata yang tersedia dan isi form yang ada
                                        kemudian bisa klik booking</p>
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

                                <div class="button text-dark-1">Bagaimana cara memberikan ulasan tentang pengalaman
                                    wisata saya?</div>
                            </div>

                            <div class="accordion__content">
                                <div class="pt-20 pl-60">
                                    <p class="text-15">Setelah selesai melakukan perjalanan, Anda bisa melakukan ulasan
                                        pengalaman berwisata pada paket wisata dan agen perjalanan yang anda gunakan
                                        pada bagian booking history.</p>
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

                                <div class="button text-dark-1">Bagaimana cara untuk Melakukan Pengaduan?</div>
                            </div>

                            <div class="accordion__content">
                                <div class="pt-20 pl-60">
                                    <p class="text-15">untuk melakukan pengaduan anda bisa memilih menu pengaduan pada
                                        header website dan kemudian anda mengisi form yang tersedia dan bisa melakukan
                                        submit.</p>
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
