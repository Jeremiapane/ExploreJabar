@extends('travel.layouts.master')
@section('content')

<div class="content">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="doctors.html">Marketing </a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item active">Paket Wisata</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-sm-12">

            <div class="card card-table show-entire">
                <div class="card-body">

                    <!-- Table Header -->
                    <div class="page-table-header mb-2">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="doctor-table-blk">
                                    <h3>Paket Wisata</h3>
                                    <div class="doctor-search-blk">
                                        <div class="top-nav-search table-search-blk">
                                            <form>
                                                <input type="text" class="form-control" placeholder="Search here">
                                                <a class="btn"><img
                                                        src="{{ asset('assets/travel/img/icons/search-normal.svg') }}"
                                                        alt=""></a>
                                            </form>
                                        </div>
                                        <div class="add-group">
                                            <a href="/marketing/tambah-paket-wisata"
                                                class="btn btn-primary add-pluss ms-2"><img
                                                    src="{{ asset('assets/travel/img/icons/plus.svg') }}" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Table Header -->

                    <div class="table-responsive">
                        <table class="table border-0 custom-table comman-table datatable mb-0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Paket</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Lokasi</th>
                                    <th>Status Paket</th>
                                    <th>Status Verifikasi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paketWisata as $paket)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $paket->nama }}</td>
                                    <td>{{ $paket->kategoriPaket->nama }}</td>
                                    <td>{{ Str::limit($paket->deskripsi, 50, '...') }}</td>
                                    <td>{{ $paket->wisata->nama }}</td>
                                    <td>
                                        @if ($paket->status_paket == 'tidak tersedia')
                                        <button class="custom-badge status-red">{{ $paket->status_paket }}</button>
                                        @elseif($paket->status_paket == 'tersedia')
                                        <button class="custom-badge status-green">{{ $paket->status_paket }}</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($paket->status_verifikasi == 'tidak aktif')
                                        <button class="custom-badge status-red">{{ $paket->status_verifikasi }}</button>
                                        @elseif($paket->status_verifikasi == 'diproses')
                                        <button class="custom-badge status-orange">{{ $paket->status_verifikasi
                                            }}</button>
                                        @elseif($paket->status_verifikasi == 'aktif')
                                        <button class="custom-badge status-green">{{ $paket->status_verifikasi
                                            }}</button>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item"
                                                    href="{{ route('marketing.paket.show', $paket->id) }}"><i
                                                        class="fa-solid fa-eye m-r-5"></i> Detail</a>
                                                <a class="dropdown-item" href="#"
                                                    onclick="confirmDelete({{ $paket->id }})">
                                                    <i class="fa fa-trash-alt m-r-5"></i> Delete
                                                </a>
                                                <form id="delete-form-{{ $paket->id }}"
                                                    action="{{ route('marketing.paket.delete', ['id' => $paket->id]) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
            Swal.fire({
                title: 'Delete Paket!',
                text: "Apakah anda yakin ingin menghapus data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log(id);
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
</script>

@stop