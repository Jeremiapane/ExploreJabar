@extends('travel.layouts.master')
@section('content')

<div class="content">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/operasional">Dashboard </a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item active">Pemandu Wisata</li>
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
                                    <h3>Pemandu Wisata</h3>
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
                                            <a href="/operasional/tambah-pemandu-wisata"
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
                                    <th>Foto</th>
                                    <th>Nama Pemandu Wisata</th>
                                    <th>No Lisensi</th>
                                    <th>No Telp</th>
                                    <th>Alamat</th>
                                    <th>Status Pemandu</th>
                                    <th>Status Verifikasi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemanduWisata as $index => $pemandu)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($pemandu->attachment)
                                        <img src="{{ asset($pemandu->attachment->path) }}"
                                            alt="{{ $pemandu->attachment->name }}" style="width: 100px;">
                                        @else
                                        <span>Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td>{{ $pemandu->user->nama }}</td>
                                    <td>{{ $pemandu->sertifikasi }}</td>
                                    <td>{{ $pemandu->user->no_telp }}</td>
                                    <td>{{ $pemandu->user->alamat }}</td>
                                    <td>
                                        <button
                                            class="custom-badge status-{{ $pemandu->status_pemandu == 'tersedia' ? 'green' : 'red' }}">
                                            {{ ucfirst($pemandu->status_pemandu) }}
                                        </button>
                                    </td>
                                    <td>
                                        @if ($pemandu->status_verifikasi == 'tidak aktif')
                                        <button class="custom-badge status-red">{{ $pemandu->status_verifikasi
                                            }}</button>
                                        @elseif($pemandu->status_verifikasi == 'diproses')
                                        <button class="custom-badge status-orange">{{ $pemandu->status_verifikasi
                                            }}</button>
                                        @elseif($pemandu->status_verifikasi == 'aktif')
                                        <button class="custom-badge status-green">{{ $pemandu->status_verifikasi
                                            }}</button>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item"
                                                    href="{{ route('operasional.pemandu-wisata.show', $pemandu->id) }}"><i
                                                        class="fa-solid fa-eye m-r-5"></i> Detail</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('operasional.pemandu-wisata.edit', $pemandu->id) }}">
                                                    <i class="fa-solid fa-pen-to-square m-r-5"></i> Edit
                                                </a>
                                                @if ($pemandu->status_verifikasi == 'tidak aktif' ||
                                                $pemandu->status_verifikasi == 'diproses')
                                                <a class="dropdown-item" href="#"
                                                    onclick="confirmDelete({{ $pemandu->id }})"><i
                                                        class="fa fa-trash-alt m-r-5"></i> Delete</a>
                                                <form id="delete-form-{{ $pemandu->id }}"
                                                    action="{{ route('operasional.pemandu.delete', $pemandu->id) }}"
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
                title: 'Delete pemandu!',
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