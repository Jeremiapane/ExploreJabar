@extends('travel.layouts.master')
@section('content')

<div class="content">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="doctors.html">Operasional </a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item active">Daftar Kendaraan</li>
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
                                    <h3>Daftar Kendaraan</h3>
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
                                            <a href="/operasional/tambah-kendaraan"
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
                                    <th>Foto Kendaraan</th>
                                    <th>Jenis Kendaraan</th>
                                    <th>Merk Kendaraan</th>
                                    <th>No Plat</th>
                                    <th>Tahun Pembuatan</th>
                                    <th>Warna</th>
                                    <th>Status Kendaraan</th>
                                    <th>Status Verifikasi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_kendaraan as $kendaraan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($kendaraan->attachment)
                                        <img src="{{ asset($kendaraan->attachment->path) }}"
                                            alt="{{ $kendaraan->attachment->name }}" style="width: 100px;">
                                        @else
                                        <span>Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td>{{ $kendaraan->jenis }}</td>
                                    <td>{{ $kendaraan->merk }}</td>
                                    <td>{{ $kendaraan->no_plat }}</td>
                                    <td>{{ $kendaraan->tahun_pembuatan }}</td>
                                    <td>{{ $kendaraan->warna }}</td>
                                    <td>
                                        @if ($kendaraan->status_kendaraan == 'tidak tersedia' ||
                                        $kendaraan->status_kendaraan == 'digunakan')
                                        <button class="custom-badge status-red">{{ $kendaraan->status_kendaraan
                                            }}</button>
                                        @elseif($kendaraan->status_kendaraan == 'tersedia')
                                        <button class="custom-badge status-green">{{ $kendaraan->status_kendaraan
                                            }}</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($kendaraan->status_verifikasi == 'tidak aktif')
                                        <button class="custom-badge status-red">{{ $kendaraan->status_verifikasi
                                            }}</button>
                                        @elseif($kendaraan->status_verifikasi == 'diproses')
                                        <button class="custom-badge status-orange">{{ $kendaraan->status_verifikasi
                                            }}</button>
                                        @elseif($kendaraan->status_verifikasi == 'aktif')
                                        <button class="custom-badge status-green">{{ $kendaraan->status_verifikasi
                                            }}</button>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item"
                                                    href="{{ route('operasional.kendaraan.show', $kendaraan->id) }}"><i
                                                        class="fa-solid fa-eye m-r-5"></i> Detail</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('operasional.kendaraan.edit', $kendaraan->id) }}"><i
                                                        class="fa-solid fa-pen-to-square m-r-5"></i> Edit</a>
                                                @if ($kendaraan->status_verifikasi == 'tidak aktif' ||
                                                $kendaraan->status_verifikasi == 'diproses')
                                                <a class="dropdown-item" href="#"
                                                    onclick="confirmDelete({{ $kendaraan->id }})"><i
                                                        class="fa fa-trash-alt m-r-5"></i> Delete</a>
                                                <form id="delete-form-{{ $kendaraan->id }}"
                                                    action="{{ route('operasional.kendaraan.delete', $kendaraan->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                @endif
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
                title: 'Delete kendaraan!',
                text: "Apakah anda yakin ingin menghapus data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
</script>
@stop