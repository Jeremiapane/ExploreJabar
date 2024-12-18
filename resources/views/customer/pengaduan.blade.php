@extends('customer.layouts.master')
@section('content')
<section data-anim="fade" class="d-flex items-center py-15 border-top-light">
    <div class="container">
        <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
            <div class="col-auto">
                <h1 class="text-30 lh-14 fw-600">Pengaduan</h1>
                <div class="text-15 text-light-1">Pengaduan akun anda</div>
            </div>
        </div>

        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="tabs -underline-2 js-tabs">
                <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">

                    <div class="col-auto">
                        <button
                            class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active"
                            data-tab-target=".-tab-item-1">Form Pengaduan</button>
                    </div>
                    <div class="col-auto">
                        <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button "
                            data-tab-target=".-tab-item-2">List Pengaduan</button>
                    </div>

                </div>

                <div class="tabs__content pt-30 js-tabs-content">
                    <div class="tabs__pane -tab-item-1 is-tab-el-active">
                        <form action="{{ route('wisatawan.pengaduan.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-xl-9">
                                <div class="row x-gap-20 y-gap-20">
                                    <div class="col-12">
                                        <div class="form-input">
                                            <input type="text" name="judul" required>
                                            <label class="lh-1 text-16 text-light-1">Judul</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-input">
                                            <input type="date" name="tanggal_kejadian" required>
                                            <label class="lh-1 text-16 text-light-1">Tanggal Kejadian</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-input">
                                            <input type="file" name="bukti_path" required>
                                            <label class="lh-1 text-16 text-light-1">Bukti</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-input">
                                            <textarea name="deskripsi" required rows="5"></textarea>
                                            <label class="lh-1 text-16 text-light-1">Deskripsi</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-inline-block pt-30">
                                <button type="submit" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                                    Save Changes <div class="icon-arrow-top-right ml-15"></div>
                                </button>
                            </div>
                        </form>

                    </div>

                    <div class="tabs__pane -tab-item-2">

                        <div class="tabs -underline-2 js-tabs">
                            <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">


                                <div class="tabs__content pt-30 mb-30 js-tabs-content">

                                    <div class="overflow-scroll scroll-bar-1">
                                        <table class="table-3 -border-bottom col-12">
                                            <thead class="bg-light-2">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Judul</th>
                                                    <th>Tanggal Kejadian</th>
                                                    <th>Bukti</th>
                                                    <th>Deskripsi</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($list_pengaduan as $pengaduan)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $pengaduan->judul }}</td>
                                                    <td>{{ $pengaduan->tanggal_kejadian->format('F d, Y') }}</td>
                                                    <td>{{ $pengaduan->bukti_path}}</td>
                                                    <td>{{ $pengaduan->deskripsi }}</td>
                                                    <td><span class="rounded-100 py-4 px-10 text-center text-14 fw-500 @if($pengaduan->status == 'Diajukan' || $pengaduan->status == 'Diverifikasi')
                                                        bg-yellow-4 text-yellow-3
                                                    @elseif($pengaduan->status == 'Ditolak')
                                                        bg-red-3 text-red-2
                                                    @elseif($pengaduan->status == 'Diselesaikan')
                                                        bg-blue-1-05 text-blue-1
                                                    @endif">{{ $pengaduan->status }}</span>
                                                    </td>
                                                    <td>
                                                        @if ($pengaduan->status == 'Diselesaikan' ||
                                                        $pengaduan->status
                                                        == 'Ditolak')

                                                        <button class="button button-sm text-blue-1"
                                                            data-x-click="keterangan"
                                                            data-id-keterangan="{{ $pengaduan->keterangan}}">
                                                            Tanggapan
                                                        </button>
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

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="currencyMenu is-hidden js-currencyMenu" data-x="keterangan" data-x-toggle="is-hidden">
    <div class="currencyMenu__bg" data-x-click="keterangan"></div>
    <div class="currencyMenu__content bg-white rounded-4" style="max-width: 700px; width: 100%;">
        <div class="d-flex items-center justify-between px-30 py-20 sm:px-15 border-bottom-light">
            <button class="pointer" data-x-click="keterangan">
                <i class="icon-close"></i>
            </button>
        </div>
        <div class="px-30 py-30 sm:px-15 sm:py-15 text-center">
            <div class="py-10 px-15 sm:px-5 sm:py-5">
                <div class="text-15 lh-15 fw-500 text-dark-1">Tanggapan Dinas</div>
            </div>

            <div class="row x-gap-10 y-gap-10 pt-10 justify-content-center">
                <div class="form-input">
                    <textarea name="keterangan" required rows="4"></textarea>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const keteranganButtons = document.querySelectorAll('button[data-x-click="keterangan"]');
        keteranganButtons.forEach(button => {
            button.addEventListener('click', function () {
                const keterangan = this.getAttribute('data-id-keterangan');
                const textarea = document.querySelector('.currencyMenu[data-x="keterangan"] textarea[name="keterangan"]');
                textarea.value = keterangan;
                textarea.disabled = true; // Disable the textarea
            });
        });
    });
</script>


@stop