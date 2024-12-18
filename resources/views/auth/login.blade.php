@extends('customer.layouts.master')
@section('content')
<section class="layout-pt-lg layout-pb-lg bg-blue-2">
    <div class="container">
        <div class="row justify-center">
            <div class="col-xl-6 col-lg-7 col-md-9">
                <div class="px-50 py-50 sm:px-20 sm:py-20 bg-white shadow-4 rounded-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row y-gap-20">
                            <div class="col-12">
                                <h1 class="text-22 fw-500">Masuk atau Buat Akun</h1>
                                <p class="mt-10">Belum memiliki akun? <a href="{{route('wisatawan.signup')}}" class="text-blue-1">Sign Up</a></p>
                            </div>

                            <div class="col-12">
                                <div class="form-input ">
                                    <input type="email" name="email" required>
                                    <label class="lh-1 text-14 text-light-1">Email</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-input ">
                                    <input type="password" name="password" required>
                                    <label class="lh-1 text-14 text-light-1">Password</label>
                                </div>
                            </div>
                            <button type="submit" class="button py-20 -dark-1 bg-blue-1 text-white">
                                Log In <div class="icon-arrow-top-right ml-15"></div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
