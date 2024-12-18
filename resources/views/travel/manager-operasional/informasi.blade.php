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
                    <li class="breadcrumb-item active">Daftar Pemberitahuan</li>
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
                                    <h3>Daftar Pemberitahuan</h3>
                                    <div class="doctor-search-blk">
                                        <div class="top-nav-search table-search-blk">
                                            <form>
                                                <input type="text" class="form-control" placeholder="Search here">
                                                <a class="btn"><img
                                                        src="{{ asset('assets/travel/img/icons/search-normal.svg') }}"
                                                        alt=""></a>
                                            </form>
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
                                    <th>Nama Pengirim</th>
                                    <th>Nama Penerima</th>
                                    <th>Perihal</th>
                                    <th>Tanggal Diterima</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_pemberitahuan as $pemberitahuan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pemberitahuan->pengirim->nama }}</td>
                                    <td>{{ $pemberitahuan->penerima->nama_perusahaan }}</td>
                                    <td>{{ $pemberitahuan->perihal }}</td>
                                    <td>{{ $pemberitahuan->created_at->format('F d, Y') }}</td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item"
                                                    href="{{ route('manager-operasional.informasi.show', $pemberitahuan->id) }}"><i
                                                        class="fa-solid fa-eye m-r-5"></i> Detail</a>
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

@stop