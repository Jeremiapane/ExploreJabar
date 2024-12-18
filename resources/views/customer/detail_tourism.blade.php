@extends('customer.layouts.master')
@section('content')
<style>
    .rounded-image {
        width: 50px;
        /* Sesuaikan dengan ukuran yang diinginkan */
        height: 50px;
        /* Sesuaikan dengan ukuran yang diinginkan */
        border-radius: 50%;
        /* Membuat gambar menjadi bulat */
        object-fit: cover;
        /* Menghindari distorsi gambar */
    }
</style>
<section data-anim="slide-up" class="layout-pt-md">
    <div class="container">
        <div class="row y-gap-40 justify-center text-center">
            <div class="col-12">
                @if ($paket->attachment)
                <img src="{{ asset($paket->attachment->path) }}" alt="{{ $paket->attachment->name }}" alt="image"
                    class="col-12 rounded-8" style="max-height: 658px;">
                @endif
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
                        @php
                        $averageRating = $paket->review->avg('rating');
                        $formattedRating = number_format($averageRating, 1);
                        $fullStars = floor($averageRating);
                        $halfStar = ($averageRating - $fullStars) >= 0.5 ? true : false;
                        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                        @endphp

                        <div class="row x-gap-10 y-gap-20 items-center pt-10">
                            <div class="col-auto">
                                <div class="d-flex items-center">
                                    <i class="icon-star text-10 text-yellow-1"></i>

                                    <div class="text-14 text-light-1 ml-10">
                                        <span class="text-15 fw-500 text-dark-1">{{ $formattedRating }}</span>
                                        {{ $paket->review->count() }} reviews
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
                                Pemandu Wisata:<br> {{ $paket->pemanduWisata->user->nama }}
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
                                            <input type="number" name="no_hp" required>
                                            <label class="lh-1 text-16 text-light-1">No Hp</label>
                                        </div>
                                    </div>
                                    @php
                                    $dayAfterTomorrow = \Carbon\Carbon::today()->addDays(2)->format('Y-m-d');
                                    @endphp
                                    <div class="col-12">
                                        <div class="form-input">
                                            <input type="date" name="tanggal" required min="{{ $dayAfterTomorrow }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-input">
                                            <input type="number" name="jumlah_peserta" id="jumlah_peserta" required
                                                data-max="{{ $paket->jumlah_peserta }}">
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

<div class="container mt-40 mb-40">
    <div class="border-top-light"></div>
</div>

<section>
    <div class="container">
        <div class="row y-gap-40 justify-between">
            <div class="col-xl-3">
                <h3 class="text-22 fw-500">Guest reviews</h3>
                <div class="d-flex items-center mt-20">
                    <div class="flex-center bg-blue-1 rounded-4 size-70 text-22 fw-600 text-white">{{ $formattedRating
                        }}</div>
                    <div class="ml-20">
                        <div class="text-16 text-dark-1 fw-500 lh-14">Exceptional</div>
                        <div class="text-15 text-light-1 lh-14 mt-4">{{ $paket->review->count() }} reviews</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="row y-gap-40">

                    @foreach ($paket->review as $review)
                    <div class="col-12">
                        <div class="row x-gap-20 y-gap-20 items-center">
                            <div class="col-auto">
                                @php
                                $wisatawan = \App\Models\Wisatawan::with('attachment')->where('id_user',
                                $review->user->id)->first();
                                @endphp
                                @if(isset($wisatawan->attachment) && $wisatawan->attachment->path)
                                <img src="{{ asset($wisatawan->attachment->path) }}" class="rounded-image">
                                @endif
                            </div>
                            <div class="col-auto">
                                <div class="fw-500 lh-15">{{ $review->user->nama }}</div>
                                <div class="text-14 text-light-1 lh-15">{{ $review->created_at->format('F d, Y')}}</div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mt-20">
                            <h5 class="fw-500 text-blue-1 mb-0">{{ $review->rating }}</h5>
                            <div class="rating d-flex align-items-center ml-10">
                                @for ($i = 0; $i < $review->rating; $i++)
                                    <i class="icon-star text-10 text-yellow-2"></i>
                                    @endfor
                            </div>
                        </div>

                        <p class="text-15 text-dark-1 mt-10">{{ $review->deskripsi }} </p>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>

<div class="container mt-40 mb-40">
    <div class="border-top-light"></div>
</div>

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

    document.addEventListener('DOMContentLoaded', function () {
    const jumlahPesertaInput = document.getElementById('jumlah_peserta');
    const maxPeserta = jumlahPesertaInput.dataset.max;

    jumlahPesertaInput.addEventListener('input', function () {
        if (parseInt(this.value) > parseInt(maxPeserta)) {
            Swal.fire({
                icon: 'warning',
                title: 'Maaf',
                text: `Jumlah peserta tidak boleh melebihi ${maxPeserta}.`,
            });

            // Reset the input to the maximum allowed value or clear it
            this.value = maxPeserta;
        }
    });
});


</script>

@stop