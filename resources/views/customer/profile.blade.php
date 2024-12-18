@extends('customer.layouts.master')
@section('content')
<section data-anim="fade" class="d-flex items-center py-15 border-top-light">
    <div class="container">
        <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
            <div class="col-auto">

                <h1 class="text-30 lh-14 fw-600">Settings</h1>
                <div class="text-15 text-light-1">Pengaturan untuk informasi akun anda</div>

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
                            data-tab-target=".-tab-item-1">Personal Information</button>
                    </div>
                    <div class="col-auto">
                        <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button "
                            data-tab-target=".-tab-item-2">Change Password</button>
                    </div>

                </div>

                <div class="tabs__content pt-30 js-tabs-content">
                    <div class="tabs__pane -tab-item-1 is-tab-el-active">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row y-gap-30 items-center">
                                <div class="col-auto">
                                    <div class="d-flex ratio ratio-1:1 w-200">
                                        @if(isset($wisatawan->attachment) && $wisatawan->attachment->path)
                                        <img src="{{ asset($wisatawan->attachment->path) }}"
                                            class="img-ratio rounded-4">
                                        @endif
                                        <div class="d-flex justify-end px-10 py-10 h-100 w-1/1 absolute">
                                            {{-- <div class="size-40 bg-white rounded-4">
                                                <i class="icon-trash text-16"></i>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <h4 class="text-16 fw-500">Your avatar</h4>
                                    <div class="text-14 mt-5">PNG or JPG no bigger than 800px wide and tall.</div>
                                    <div class="d-inline-block mt-15">
                                        <input type="file" name="avatar" class="">
                                    </div>
                                </div>
                            </div>

                            <div class="border-top-light mt-30 mb-30"></div>

                            <div class="col-xl-9">
                                <div class="row x-gap-20 y-gap-20">
                                    <div class="col-12">
                                        <div class="form-input">
                                            <input type="text" name="username" value="{{ $wisatawan->user->username }}"
                                                required>
                                            <label class="lh-1 text-16 text-light-1">User Name</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-input">
                                            <input type="text" name="first_name" required
                                                value="{{ $wisatawan->nama_depan }}">
                                            <label class="lh-1 text-16 text-light-1">First Name</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-input">
                                            <input type="text" name="last_name" required
                                                value="{{ $wisatawan->nama_belakang }}">
                                            <label class="lh-1 text-16 text-light-1">Last Name</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-input">
                                            <input type="email" name="email" required
                                                value="{{ $wisatawan->user->email }}">
                                            <label class="lh-1 text-16 text-light-1">Email</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-input">
                                            <input type="text" name="phone" required
                                                value="{{ $wisatawan->user->no_telp }}">
                                            <label class="lh-1 text-16 text-light-1">Phone Number</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-input">
                                            <textarea name="alamat" required
                                                rows="5">{{ $wisatawan->user->alamat }}</textarea>
                                            <label class="lh-1 text-16 text-light-1">Address</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-input">
                                            <textarea name="about" required
                                                rows="5">{{ $wisatawan->deskripsi }}</textarea>
                                            <label class="lh-1 text-16 text-light-1">About Yourself</label>
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
                        <div class="col-xl-9">
                            <form action="{{ route('profile.changePassword') }}" method="POST">
                                @csrf
                                <div class="row x-gap-20 y-gap-20">
                                    <div class="col-12">
                                        <div class="form-input">
                                            <input type="password" name="current_password" required>
                                            <label class="lh-1 text-16 text-light-1">Current Password</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-input">
                                            <input type="password" name="new_password" required>
                                            <label class="lh-1 text-16 text-light-1">New Password</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-input">
                                            <input type="password" name="new_password_confirmation" required>
                                            <label class="lh-1 text-16 text-light-1">New Password Again</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row x-gap-10 y-gap-10">
                                            <div class="col-auto">
                                                <button type="submit"
                                                    class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                                                    Save Changes <div class="icon-arrow-top-right ml-15"></div>
                                                </button>
                                            </div>

                                            <div class="col-auto">
                                                <button type="button"
                                                    class="button h-50 px-24 -blue-1 bg-blue-1-05 text-blue-1">Cancel</button>
                                            </div>
                                        </div>
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

@stop