@extends('travel.layouts.master')
@section('content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Marketing </a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Tambah Paket Wisata</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <!-- Lightbox -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Tambah Paket Wisata</h4>
                    </div>
                    <div class="card-body">
                        <div class="wizard">
                            <div class="tab-content" id="myTabContent">
                                <form action="{{ route('marketing.paket.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="tab-pane fade show active" role="tabpanel" id="step1" aria-labelledby="step1-tab">
                                        <div class="row">
                                            <div class="col-12 ">
                                                <div class="input-block local-forms">
                                                    <label>Foto Paket <span class="login-danger">*</span></label>
                                                    <input class="form-control @error('foto') is-invalid @enderror" type="file" name="foto">
                                                    @error('foto')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 ">
                                                <div class="input-block local-forms">
                                                    <label>Nama Paket <span class="login-danger">*</span></label>
                                                    <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama" value="{{ old('nama') }}">
                                                    @error('nama')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 ">
                                                <div class="input-block local-forms">
                                                    <label>Kategori Paket <span class="login-danger">*</span></label>
                                                    <select class="form-control @error('kategori_paket_id') is-invalid @enderror" name="kategori_paket_id">
                                                        <option>-- Select --</option>
                                                        @foreach ($kategoriPaket as $kategori)
                                                            <option value="{{ $kategori->id }}" {{ old('kategori_paket_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('kategori_paket_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-block local-forms">
                                                    <label>Deskripsi Paket <span class="login-danger">*</span></label>
                                                    <input class="form-control @error('deskripsi') is-invalid @enderror" type="text" name="deskripsi" value="{{ old('deskripsi') }}">
                                                    @error('deskripsi')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12">
                                                <div class="input-block local-forms">
                                                    <label>Yang akan didapatkan <span class="login-danger">*</span></label>
                                                    <input class="form-control @error('include') is-invalid @enderror" type="text" name="include" value="{{ old('include') }}">
                                                    @error('include')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12">
                                                <div class="input-block local-forms">
                                                    <label>Yang tidak akan didapatkan <span class="login-danger">*</span></label>
                                                    <input class="form-control @error('exclude') is-invalid @enderror" type="text" name="exclude" value="{{ old('exclude') }}">
                                                    @error('exclude')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12">
                                                <div class="input-block local-forms">
                                                    <label>Wilayah Wisata <span class="login-danger">*</span></label>
                                                    <select class="form-control @error('daerah_id') is-invalid @enderror" name="daerah_id" id="wilayahSelect">
                                                        <option>-- Select --</option>
                                                        @foreach ($wilayah as $wil)
                                                            <option value="{{ $wil->id }}" {{ old('daerah_id') == $wil->id ? 'selected' : '' }}>{{ $wil->kecamatan. ' - ' . $wil->provinsi }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('daerah_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12">
                                                <div class="input-block local-forms">
                                                    <label>Tempat Wisata yang dikunjungi <span class="login-danger">*</span></label>
                                                    <select class="form-control tagging @error('wisata_ids') is-invalid @enderror" multiple="multiple" id="wisataSelect2" name="wisata_ids[]">
                                                        <!-- Options will be populated by JavaScript -->
                                                    </select>
                                                    @error('wisata_ids')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12">
                                                <div class="input-block local-forms">
                                                    <label>Jumlah Peserta <span class="login-danger">*</span></label>
                                                    <input class="form-control @error('jumlah_peserta') is-invalid @enderror" type="number" name="jumlah_peserta" placeholder="" id="jumlahPeserta" value="{{ old('jumlah_peserta') }}">
                                                    @error('jumlah_peserta')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12">
                                                <div class="input-block local-forms">
                                                    <label>Kendaraan <span class="login-danger">*</span></label>
                                                    <select class="form-control @error('kendaraan_id') is-invalid @enderror" name="kendaraan_id" id="kendaraanSelect">
                                                        <!-- Options will be populated by JavaScript -->
                                                    </select>
                                                    @error('kendaraan_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12">
                                                <div class="input-block local-forms">
                                                    <label>Pemandu Wisata <span class="login-danger">*</span></label>
                                                    <select class="form-control @error('pemandu_id') is-invalid @enderror" name="pemandu_id" id="pemanduSelect">
                                                        <!-- Options will be populated by JavaScript -->
                                                    </select>
                                                    @error('pemandu_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12">
                                                <div class="input-block local-forms">
                                                    <label>Harga <span class="login-danger">*</span></label>
                                                    <input class="form-control @error('harga') is-invalid @enderror" type="number" name="harga" value="{{ old('harga') }}">
                                                    @error('harga')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <a class="btn btn btn-primary next">Next</a>
                                        </div>
                                    </div>
                                    {{-- Step 2 --}}
                                    <div class="tab-pane fade" role="tabpanel" id="step2" aria-labelledby="step2-tab">
                                        <div class="row">
                                            <div class="col-12 ">
                                                <div class="input-block local-forms">
                                                    <label>Aktivitas 1<span class="login-danger">*</span></label>
                                                    <input class="form-control @error('aktivitas.0') is-invalid @enderror" type="text" name="aktivitas[]">
                                                    @error('aktivitas.0')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 ">
                                                <div class="input-block local-forms">
                                                    <label>Aktivitas 2 <span class="login-danger">*</span></label>
                                                    <input class="form-control @error('aktivitas.1') is-invalid @enderror" type="text" name="aktivitas[]">
                                                    @error('aktivitas.1')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div id="dynamicForm"></div>
                                        <div class="d-flex">
                                            <button type="button" class="btn btn btn-primary previous me-2"> Kembali</button>
                                            <button id="addActivityBtn" type="button" class="btn btn-primary me-2">Add Aktivitas</button>
                                            <button type="submit" class="btn btn-primary submit-form me-2">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        let activityCount = 2;
        var sessionId = '{{ session()->get('id_operasional') }}';

        document.getElementById('addActivityBtn').addEventListener('click', function() {
            activityCount++;
            const newActivity = `
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="input-block local-forms">
                            <label>Aktivitas ${activityCount}<span class="login-danger">*</span></label>
                            <input name="aktivitas[]" class="form-control" type="text" placeholder="">
                        </div>
                    </div>
                </div>
            `;
            document.getElementById('dynamicForm').insertAdjacentHTML('beforeend', newActivity);
        });

        document.getElementById('jumlahPeserta').addEventListener('input', function() {
            var jumlahPeserta = this.value;
            var kendaraanSelect = document.getElementById('kendaraanSelect');
            kendaraanSelect.innerHTML = ''; // Clear current options

            if (jumlahPeserta) {
                fetch(`/api/get-kendaraan-by-jumlah-peserta/${jumlahPeserta}?id=${sessionId}`)
                .then(response => response.json())
                    .then(data => {
                        data.forEach(kendaraan => {
                            var option = document.createElement('option');
                            option.value = kendaraan.id;
                            option.textContent = `${kendaraan.jenis} - ${kendaraan.merk}`;
                            kendaraanSelect.appendChild(option);
                        });
                    });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            var pemanduSelect = document.getElementById('pemanduSelect');
            fetch(`/api/get-pemandu-wisata-tersedia?id=${sessionId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(pemandu => {
                        var option = document.createElement('option');
                        option.value = pemandu.id;
                        option.textContent = pemandu.user.nama;
                        pemanduSelect.appendChild(option);
                    });
                });
        });

        document.getElementById('wilayahSelect').addEventListener('change', function() {
            console.log(1);
            var wilayahId = this.value;
            var wisataSelect = document.getElementById('wisataSelect2');
            wisataSelect.innerHTML = ''; // Clear current options

            if (wilayahId) {
                fetch(`/api/get-wisata-by-wilayah/${wilayahId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(wisata => {
                            var option = document.createElement('option');
                            option.value = wisata.id;
                            option.textContent = wisata.nama;
                            wisataSelect.appendChild(option);
                        });

                        // Reinitialize select2
                        $('#wisataSelect2').select2({
                            tags: true
                        });
                    });
            }
        });
    </script>
@stop
