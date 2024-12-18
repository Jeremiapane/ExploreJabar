<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                @if (Auth::user()->id_level == 2)
                <li class="menu-title">Manager Operasional</li>
                <li>
                    <a href="/manager-operasional"><span class="menu-side"><img
                                src="{{ asset('assets/travel/img/icons/menu-icon-01.svg') }}" alt=""></span>
                        <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="/manager-operasional/akses"><span class="menu-side"><img
                                src="{{ asset('assets/travel/img/icons/Akses.svg') }}" alt=""></span> <span>Akses
                            Akun</span></a>
                </li>
                <li>
                    <a href="/manager-operasional/informasi"><span class="menu-side"><img
                                src="{{ asset('assets/travel/img/icons/Pemberitahuan.svg') }}" alt=""></span>
                        <span>Pemberitahuan</span></a>
                </li>
                <li>
                    <a href="/manager-operasional/profile"><span class="menu-side"><img
                                src="{{ asset('assets/travel/img/icons/Perusahaan.svg') }}" alt=""></span>
                        <span>Profile Perusahaan </span></a>
                </li>
                @endif
                @if (Auth::user()->id_level == 3)
                <li class="menu-title">Operasional</li>
                <li>
                    <a href="/operasional"><span class="menu-side">

                        <img src="{{ asset('assets/travel/img/icons/Kendaraan1.svg')}}"alt="">
                            </span>
                        <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="/operasional/kendaraan"><span class="menu-side"><img
                                src="{{ asset('assets/travel/img/icons/kendaraan.svg') }}" alt=""></span>
                        <span>Kendaraan</span></a>
                </li>
                <li>
                    <a href="/operasional/pemandu-wisata"><span class="menu-side"><img
                                src="{{ asset('assets/travel/img/icons/Pemandu.svg') }}" alt=""></span>
                        <span>Pemandu Wisata</span></a>
                </li>

                @endif
                @if (Auth::user()->id_level == 4)
                <li class="menu-title">Manager Marketing</li>
                <li>
                    <a href="/manager-marketing"><span class="menu-side"><img
                                src="{{ asset('assets/travel/img/icons/menu-icon-01.svg') }}" alt=""></span>
                                
                        <span>Dashboard</span></a>
                </li>
                @endif
                @if (Auth::user()->id_level == 5)
                <li class="menu-title">Marketing</li>
                <li>
                    <a href="/marketing"><span class="menu-side"><img
                                src="{{ asset('assets/travel/img/icons/menu-icon-01.svg') }}" alt=""></span>
                        <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="/marketing/paket-wisata"><span class="menu-side"><img
                                src="{{ asset('assets/travel/img/icons/Paket.svg') }}" alt=""></span> <span>Paket
                            Wisata</span></a>
                </li>
                @endif
                @if (Auth::user()->id_level == 6)
                <li class="menu-title">Staff Penjualan</li>
                <li>
                    <a href="/penjualan"><span class="menu-side"><img
                                src="{{ asset('assets/travel/img/icons/menu-icon-01.svg') }}" alt=""></span>
                        <span>Dashboard</span></a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
