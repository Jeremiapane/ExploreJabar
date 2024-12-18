@extends('travel.layouts.master')
@section('content')

<div class="content">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="doctors.html">Manager Operasional </a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item active">Daftar Akses Akun</li>
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
                                    <h3>Daftar Akses Akun</h3>
                                    <div class="doctor-search-blk">
                                        <div class="top-nav-search table-search-blk">
                                            <form>
                                                <input type="text" class="form-control" placeholder="Search here">
                                            </form>
                                        </div>
                                        <div class="add-group">
                                            @if(session('status_verifikasi') == 'diproses')
                                            <button type="button" class="btn btn-primary add-pluss ms-2"
                                                id="verify-status-button">
                                                <img src="{{ asset('assets/travel/img/icons/plus.svg') }}" alt="">
                                            </button>

                                            <script>
                                                document.getElementById('verify-status-button').addEventListener('click', function () {
            Swal.fire({
                icon: 'warning',
                title: 'Akun Belum Diverifikasi',
                text: 'Maaf, akun Anda belum diverifikasi. Silakan tunggu hingga proses verifikasi selesai.',
                confirmButtonText: 'OK'
            });
        });
                                            </script>
                                            @else
                                            <button type="button" class="btn btn-primary add-pluss ms-2"
                                                data-bs-toggle="modal" data-bs-target="#signup-modal">
                                                <img src="{{ asset('assets/travel/img/icons/plus.svg') }}" alt="">
                                            </button>
                                            @endif
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
                                    <th>Nama Akses</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Deskripsi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($operasionals as $operasional)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $operasional->user->nama }}</td>
                                    <td>{{ $operasional->user->email }}</td>
                                    <td class="text-capitalize">{{ $operasional->user->level->description }}</td>
                                    <td>{{ $operasional->deskripsi }}</td>
                                    {{-- <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item"
                                                    href="{{ route('operasional.kendaraan.edit', $kendaraan->id) }}"><i
                                                        class="fa-solid fa-pen-to-square m-r-5"></i> Edit</a>
                                            </div>
                                        </div>
                                    </td> --}}
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

<!-- Signup modal content -->
<div id="signup-modal" class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <form class="px-3" method="POST" action="{{ route('manager-operasional.akses.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Nama Akses</label>
                        <input class="form-control" type="text" name="nama">
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input class="form-control" type="text" name="username">
                    </div>

                    <div class="mb-3">
                        <label for="emailaddress" class="form-label">Email</label>
                        <input class="form-control" type="email" name="email">
                    </div>

                    <div class="mb-3">
                        <label for="emailaddress" class="form-label">Role Level</label>
                        <select class="form-control" name="id_level">
                            <option>-- Select --</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}" class="text-capitalize">{{ $level->description }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Deskripsi</label>
                        <input class="form-control" type="text" name="deskripsi">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input class="form-control" type="password" id="password" name="password"
                            placeholder="Enter your password">
                    </div>

                    <div class="mb-3 text-center">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
                    // Submit form to delete kendaraan
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
</script>
@stop