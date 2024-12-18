<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <title>Explore Jabar - Register</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/travel/css/bootstrap.min.css') }}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/travel/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/travel/plugins/fontawesome/css/all.min.css') }}">
    <!-- Select2 CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/travel/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/travel/css/feather.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/travel/css/style.css') }}">

</head>

<body>
    @include('sweetalert::alert')
    <!-- Main Wrapper -->
    <div class="main-wrapper login-body">
        <div class="container-fluid px-0">
            <div class="row">

                <!-- Login logo -->
                <div class="col-lg-6 login-wrap">
                    <div class="login-sec">
                        <div class="log-img">
                            <img class="img-fluid" style="visibility: hidden"
                                src="{{ asset('assets/travel/img/login-operasional.png') }}" alt="Logo">
                        </div>
                    </div>
                </div>
                <!-- /Login logo -->

                <!-- Login Content -->
                <div class="col-lg-6 login-wrap-bg">
                    <div class="login-wrapper">
                        <div class="loginbox">
                            <div class="login-right">
                                <div class="login-right-wrap">
                                    <div class="account-logo">
                                        <a href="index.html"><img src="assets/travel/img/login-logo.png" alt=""></a>
                                    </div>
                                    <h2>Registrasi</h2>
                                    <!-- Form -->
                                    <form method="POST" action="{{ route('operasional.register.store') }}"
                                        autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                        <div class="input-block">
                                            <label>Nama Perusahaan <span class="login-danger">*</span></label>
                                            <input class="form-control" name="nama_perusahaan" type="text"
                                                value="{{ old('nama_perusahaan') }}">
                                            @error('nama_perusahaan')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="input-block">
                                            <label>No Telp <span class="login-danger">*</span></label>
                                            <input class="form-control" name="no_telp" type="number"
                                                value="{{ old('no_telp') }}">
                                            @error('no_telp')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="input-block">
                                            <label>Email Perusahaan<span class="login-danger">*</span></label>
                                            <input class="form-control" name="email_perusahaan" type="email"
                                                value="{{ old('email_perusahaan') }}">
                                            @error('email_perusahaan')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="input-block">
                                            <label>Username<span class="login-danger">*</span></label>
                                            <input class="form-control" name="username" type="text"
                                                value="{{ old('username') }}">
                                            @error('username')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="input-block">
                                            <label>Alamat Perusahaan <span class="login-danger">*</span></label>
                                            <textarea class="form-control"
                                                name="alamat_perusahaan">{{ old('alamat_perusahaan') }}</textarea>
                                            @error('alamat_perusahaan')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="input-block">
                                            <label>Deskripsi Perusahaan <span class="login-danger">*</span></label>
                                            <textarea class="form-control"
                                                name="deskripsi">{{ old('deskripsi') }}</textarea>
                                            @error('deskripsi')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12 ">
                                            <div class="input-block local-forms">
                                                <label>Upload Dokumen Akte Pendirian <span
                                                        class="login-danger">*</span></label>
                                                <input class="form-control" type="file" name="dokumen_akte">
                                                @error('dokumen_akte')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 ">
                                            <div class="input-block local-forms">
                                                <label>Upload Dokumen SK Kemenkumham <span
                                                        class="login-danger">*</span></label>
                                                <input class="form-control" type="file" name="dokumen_sk">
                                                @error('dokumen_sk')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 ">
                                            <div class="input-block local-forms">
                                                <label>Upload Dokumen NPWP <span class="login-danger">*</span></label>
                                                <input class="form-control" type="file" name="dokumen_npwp">
                                                @error('dokumen_npwp')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 ">
                                            <div class="input-block local-forms">
                                                <label>Upload Dokumen NIB <span class="login-danger">*</span></label>
                                                <input class="form-control" type="file" name="dokumen_nib">
                                                @error('dokumen_nib')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 ">
                                            <div class="input-block local-forms">
                                                <label>Upload Dokumen Sertifkasi Usaha <span
                                                        class="login-danger">*</span></label>
                                                <input class="form-control" type="file" name="dokumen_sertifikasi">
                                                @error('dokumen_sertifikasi')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 ">
                                            <div class="input-block local-forms">
                                                <label>Upload KTP Pemilik Agen Travel <span
                                                        class="login-danger">*</span></label>
                                                <input class="form-control" type="file" name="dokumen_ktp">
                                                @error('dokumen_ktp')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 ">
                                            <div class="input-block local-forms">
                                                <label>Upload Foto Profile <span class="login-danger">*</span></label>
                                                <input class="form-control" type="file" name="dokumen_profile">
                                                @error('dokumen_profile')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="input-block">
                                            <label>Password <span class="login-danger">*</span></label>
                                            <input class="form-control pass-input" name="password" type="password">
                                            <span class="profile-views feather-eye-off toggle-password"></span>
                                            @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="input-block login-btn">
                                            <button class="btn btn-primary btn-block" type="submit">Register</button>
                                        </div>
                                    </form>
                                    <div class="input-block login-btn">
                                        <p>Sudah punya akun? <a href="{{route('operasional.login')}}">Login</a></p>
                                    </div>
                                    <!-- /Form -->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /Login Content -->

            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets/travel/js/jquery-3.7.1.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('assets/travel/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Feather Js -->
    <script src="{{ asset('assets/travel/js/feather.min.js') }}"></script>

    <!-- Slimscroll -->
    <script src="{{ asset('assets/travel/js/jquery.slimscroll.js') }}"></script>

    <!-- Select2 Js -->
    <script src="{{ asset('assets/travel/js/select2.min.js') }}"></script>

    <!-- Datatables JS -->
    <script src="{{ asset('assets/travel/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/travel/plugins/datatables/datatables.min.js') }}"></script>

    <!-- counterup JS -->
    <script src="{{ asset('assets/travel/js/jquery.waypoints.js') }}"></script>
    <script src="{{ asset('assets/travel/js/jquery.counterup.min.js') }}"></script>

    <!-- Apexchart JS -->
    <script src="{{ asset('assets/travel/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/travel/plugins/apexchart/chart-data.j') }}s"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/travel/js/app.js') }}"></script>

    <!-- Custom JS -->

</body>

</html>