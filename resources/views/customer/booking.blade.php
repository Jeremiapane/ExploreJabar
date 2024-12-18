@extends('customer.layouts.master')
@section('content')
<style>
    .rating-button.active {
        background-color: #007bff;
        /* Warna background saat tombol aktif */
        color: #fff;
        /* Warna teks saat tombol aktif */
    }
</style>
<div class="dashboard__content bg-light-2">
    <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
        <div class="col-auto">

            <h1 class="text-30 lh-14 fw-600">Booking History</h1>
            <div class="text-15 text-light-1">Informasi terperinci mengenai setiap booking yang pernah Anda buat</div>

        </div>

        <div class="col-auto">

        </div>
    </div>


    <div class="py-30 px-30 rounded-4 bg-white shadow-3">
        <div class="tabs -underline-2 js-tabs">
            <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">

                <div class="col-auto">
                    <button
                        class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active"
                        data-tab-target=".-tab-item-1">All Booking</button>
                </div>

            </div>

            <div class="tabs__content pt-30 mb-30 js-tabs-content">

                <div class="tabs__pane -tab-item-1 is-tab-el-active">
                    <div class="overflow-scroll scroll-bar-1">
                        <table class="table-3 -border-bottom col-12">
                            <thead class="bg-light-2">
                                <tr>
                                    <th>No</th>
                                    <th>Agen Travel</th>
                                    <th>Paket Wisata</th>
                                    <th>Jumlah Peserta</th>
                                    <th>Tanggal Keberangkatan</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Ulasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_booking as $booking)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $booking->paket->operasional->nama_perusahaan }}</td>
                                    <td>{{ $booking->paket->nama }}</td>
                                    <td>{{ $booking->jumlah_peserta }}</td>
                                    <td>{{ $booking->tanggal }}</td>
                                    <td>RP. {{ $booking->paket->harga }}</td>
                                    <td>
                                        <span style="text-transform: capitalize;" class="rounded-100 py-4 px-10 text-center text-14 fw-500
                                            @if($booking->status == 'diproses')
                                                bg-yellow-4 text-yellow-3
                                            @elseif($booking->status == 'ditolak')
                                                bg-red-3 text-red-2
                                            @elseif($booking->status == 'diterima')
                                                bg-blue-1-05 text-blue-1
                                            @elseif($booking->status == 'selesai')
                                                bg-blue-1-05 text-blue-1
                                            @endif">
                                            {{ $booking->status }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($booking->status == 'selesai')
                                        @if ($booking->review_operasional && $booking->review_operasional->type ==
                                        "operasional")
                                        <button class="button button-sm text-blue-1 reviewOperasional">
                                            Agen Perjalanan
                                        </button>
                                        @else
                                        <button class="button button-sm text-blue-1" data-x-click="agen"
                                            data-id="{{ $booking->paket->operasional->id }}"
                                            data-id-booking="{{ $booking->id }}">
                                            Agen Perjalanan
                                        </button>
                                        @endif
                                        @if ($booking->review_paket && $booking->review_paket->type == "paket")
                                        <button class="button button-sm text-blue-1 reviewOperasional">
                                            Paket Wisata
                                        </button>
                                        @else
                                        <button class="button button-sm text-blue-1 mt-2" data-x-click="paket"
                                            data-id="{{ $booking->paket->id }}" data-id-booking="{{ $booking->id }}">
                                            Paket Wisata
                                        </button>
                                        @endif

                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>

        <div class="pt-30">
            <div class="row justify-between">
                <div class="col-auto">
                    @if ($list_booking->onFirstPage())
                    <button class="button -blue-1 size-40 rounded-full border-light" disabled>
                        <i class="icon-chevron-left text-12"></i>
                    </button>
                    @else
                    <a href="{{ $list_booking->previousPageUrl() }}"
                        class="button -blue-1 size-40 rounded-full border-light">
                        <i class="icon-chevron-left text-12"></i>
                    </a>
                    @endif
                </div>

                <div class="col-auto">
                    <div class="row x-gap-20 y-gap-20 items-center">
                        @foreach ($list_booking->getUrlRange(1, $list_booking->lastPage()) as $page => $url)
                        <div class="col-auto">
                            <a href="{{ $url }}"
                                class="size-40 flex-center rounded-full {{ $page == $list_booking->currentPage() ? 'bg-dark-1 text-white' : '' }}">
                                {{ $page }}
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-auto">
                    @if ($list_booking->hasMorePages())
                    <a href="{{ $list_booking->nextPageUrl() }}"
                        class="button -blue-1 size-40 rounded-full border-light">
                        <i class="icon-chevron-right text-12"></i>
                    </a>
                    @else
                    <button class="button -blue-1 size-40 rounded-full border-light" disabled>
                        <i class="icon-chevron-right text-12"></i>
                    </button>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

<div class="currencyMenu is-hidden js-currencyMenu" data-x="agen" data-x-toggle="is-hidden">
    <div class="currencyMenu__bg" data-x-click="agen"></div>
    <div class="currencyMenu__content bg-white rounded-4" style="max-width: 700px; width: 100%;">
        <div class="d-flex items-center justify-between px-30 py-20 sm:px-15 border-bottom-light">
            <button class="pointer" data-x-click="agen">
                <i class="icon-close"></i>
            </button>
        </div>
        <div class="px-30 py-30 sm:px-15 sm:py-15 text-center">
            <div class="py-10 px-15 sm:px-5 sm:py-5">
                <div class="text-15 lh-15 fw-500 text-dark-1">Beri Rating dan Ulasan atas pengalaman menggunakan agen
                    perjalanan</div>
            </div>
            <form action="{{ route('wisatawan.review.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_type" value="">
                <input type="hidden" name="type" value="operasional">
                <input type="hidden" name="id_booking" value="">
                <div class="py-10 px-15 sm:px-5 sm:py-5">
                    <div class="row x-gap-10 y-gap-10 pt-10 justify-content-center">
                        @for ($i = 1; $i <= 5; $i++) <div class="col-auto">
                            <label>
                                <input type="radio" id="rating-{{ $i }}" name="rating" value="{{ $i }}" required hidden>
                                <a href="#"
                                    class="rating-button button -blue-1 bg-blue-1-05 text-blue-1 py-5 px-20 rounded-100"
                                    data-rating="{{ $i }}">
                                    {{ $i }}
                                </a>
                            </label>
                    </div>
                    @endfor
                </div>
                <div class="row x-gap-10 y-gap-10 pt-10 justify-content-center">
                    <div class="form-input">
                        <textarea name="deskripsi" required rows="4"></textarea>
                        <label class="lh-1 text-16 text-light-1">Write Your Comment</label>
                    </div>
                    <button type="submit" class="button -blue-1 -md bg-blue-1-05 text-blue-1">
                        Submit
                    </button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>

<div class="currencyMenu is-hidden js-currencyMenu" data-x="paket" data-x-toggle="is-hidden">
    <div class="currencyMenu__bg" data-x-click="paket"></div>
    <div class="currencyMenu__content bg-white rounded-4" style="max-width: 700px; width: 100%;">
        <div class="d-flex items-center justify-between px-30 py-20 sm:px-15 border-bottom-light">
            <button class="pointer" data-x-click="paket">
                <i class="icon-close"></i>
            </button>
        </div>
        <div class="px-30 py-30 sm:px-15 sm:py-15 text-center">
            <div class="py-10 px-15 sm:px-5 sm:py-5">
                <div class="text-15 lh-15 fw-500 text-dark-1">Beri Rating dan Ulasan atas pengalaman menggunakan paket
                    wisata</div>
            </div>
            <form action="{{ route('wisatawan.review.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_type" value="">
                <input type="hidden" name="type" value="paket">
                <input type="hidden" name="id_booking" value="">
                <div class="py-10 px-15 sm:px-5 sm:py-5">
                    <div class="row x-gap-10 y-gap-10 pt-10 justify-content-center">
                        @for ($i = 1; $i <= 5; $i++) <div class="col-auto">
                            <label>
                                <input type="radio" id="rating-{{ $i }}" name="rating" value="{{ $i }}" required hidden>
                                <a href="#"
                                    class="rating-button button -blue-1 bg-blue-1-05 text-blue-1 py-5 px-20 rounded-100"
                                    data-rating="{{ $i }}">
                                    {{ $i }}
                                </a>
                            </label>
                    </div>
                    @endfor
                </div>
                <div class="row x-gap-10 y-gap-10 pt-10 justify-content-center">
                    <div class="form-input">
                        <textarea name="deskripsi" required rows="4"></textarea>
                        <label class="lh-1 text-16 text-light-1">Write Your Comment</label>
                    </div>
                    <button type="submit" class="button -blue-1 -md bg-blue-1-05 text-blue-1">
                        Submit
                    </button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const agenButtons = document.querySelectorAll('button[data-x-click="agen"]');
        const paketButtons = document.querySelectorAll('button[data-x-click="paket"]');
        const currencyMenus = document.querySelectorAll('.currencyMenu');

        agenButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const idBooking = this.getAttribute('data-id-booking');
                document.querySelector('.currencyMenu[data-x="agen"] input[name="id_type"]').value = id;
                document.querySelector('.currencyMenu[data-x="agen"] input[name="id_booking"]').value = idBooking;
            });
        });

        paketButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const idBooking = this.getAttribute('data-id-booking');
                document.querySelector('.currencyMenu[data-x="paket"] input[name="id_type"]').value = id;
                document.querySelector('.currencyMenu[data-x="paket"] input[name="id_booking"]').value = idBooking;
            });
        });

        // Add the logic to handle the rating button clicks for both modals
        document.querySelectorAll('.rating-button').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const parentForm = this.closest('form');
                parentForm.querySelectorAll('.rating-button').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                parentForm.querySelector('input[id="rating-' + this.dataset.rating + '"]').checked = true;
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('.reviewOperasional').on('click', function() {
        Swal.fire({
            icon: 'success',
            title: 'Review Sukses',
            text: 'Anda telah melakukan review!',
        });
    });
</script>

@stop