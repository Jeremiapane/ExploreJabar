<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dinas' }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!-- Optional: Additional Icons for Various Sizes -->
    <link rel="icon" href="{{ asset('favicon-16x16.png') }}" type="image/png" sizes="16x16">
    <link rel="icon" href="{{ asset('favicon-32x32.png') }}" type="image/png" sizes="32x32">
    <link rel="icon" href="{{ asset('favicon-96x96.png') }}" type="image/png" sizes="96x96">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}" sizes="180x180">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/dinas.css'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="bg-background antialiased dark:bg-gray-900">
        <!-- navbar -->
        <nav
            class="fixed left-0 right-0 top-0 z-50 border-b border-gray-200 bg-neutral-white px-4 py-2.5 dark:border-gray-700 dark:bg-gray-800">
            <div class="flex flex-wrap items-center justify-between">
                <div class="flex items-center justify-start">
                    <button data-drawer-target="drawer-navigation" data-drawer-toggle="drawer-navigation"
                        aria-controls="drawer-navigation"
                        class="mr-2 cursor-pointer rounded-lg p-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:bg-gray-700 dark:focus:ring-gray-700 md:hidden">
                        <svg aria-hidden="true" class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <svg aria-hidden="true" class="hidden h-6 w-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Toggle sidebar</span>
                    </button>
                    <span class="self-center whitespace-nowrap text-2xl font-semibold dark:text-white">Dinas</span>
                </div>
                <div class="flex items-center lg:order-2">

                    <button type="button"
                        class="mx-3 flex rounded-full bg-gray-800 text-sm focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 md:mr-0"
                        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                        <span class="sr-only">Open user menu</span>

                        <div
                            class="relative inline-flex h-8 w-8 items-center justify-center overflow-hidden rounded-full bg-gray-100 dark:bg-gray-600">
                            @php
                                $user = auth('pegawai')->user();
                                $nama = $user->nama;
                                $initials = strtoupper(substr($nama, 0, 2));
                                $photoPath = $user->foto ? 'public/' . $user->foto : null;
                            @endphp

                            @if ($photoPath && Storage::exists($photoPath))
                                <img src="{{ asset('storage/' . $user->foto) }}" alt="{{ $nama }}"
                                    class="h-full w-full rounded-full object-cover">
                            @else
                                <span class="font-medium text-gray-600 dark:text-gray-300">{{ $initials }}</span>
                            @endif
                        </div>




                    </button>
                    <!-- Dropdown menu -->
                    <div class="z-50 my-4 hidden w-56 list-none divide-y divide-gray-100 rounded bg-white text-base shadow dark:divide-gray-600 dark:bg-gray-700"
                        id="dropdown">
                        <div class="px-4 py-3">
                            @auth('pegawai')
                                <span class="block text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ auth('pegawai')->user()->nama }}
                                </span>
                            @endauth
                        </div>
                        <div class="px-4 py-3">
                            @auth('pegawai')
                                <span class="block text-sm font-semibold text-gray-900 dark:text-white">
                                    {{-- Cek apakah pegawai memiliki relasi jabatan --}}
                                    {{ auth('pegawai')->user()->jabatan ? auth('pegawai')->user()->jabatan->nama : 'Tidak ada jabatan' }}
                                </span>
                            @endauth
                        </div>
                        <ul class="py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
                            <li>
                                <a href="#" id="settings-button"
                                    class="block px-4 py-2 text-sm hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-target="settingsModal">Pengaturan</a>
                            </li>

                            <li>
                                <form method="POST" action="{{ route('dinas.logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Modal Pengaturan Akun -->
        <div id="settingsModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-900 bg-opacity-50"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <!-- Modal Content -->
            <div class="relative mx-auto w-full max-w-lg rounded-b-lg bg-neutral-white p-6 shadow-lg">
                <button type="button" class="absolute right-4 top-4 text-gray-600 hover:text-gray-900"
                    data-modal-hide="settingsModal">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <h3 class="text-lg font-semibold text-gray-900">Pengaturan Akun</h3>
                <form method="POST" action="{{ route('dinas.pegawai.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Foto Profil -->
                    <div class="mt-4">
                        <label for="foto" class="block text-sm font-medium text-gray-700">Foto Profil
                            (Opsional)</label>
                        <input type="file" id="foto" name="foto"
                            class="mt-1 block w-full rounded-md border border-gray-300 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        @auth('pegawai')
                            @php
                                $user = auth('pegawai')->user();
                            @endphp
                            @if ($user->foto)
                                <img src="{{ asset('storage/' . $user->foto) }}" alt="{{ $user->nama }}"
                                    class="mt-2 h-24 w-24 rounded-full object-cover">
                            @else
                                <p class="mt-2 text-sm text-gray-500">Tidak ada foto profil yang tersedia.</p>
                            @endif
                        @endauth
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password Baru
                            (Opsional)</label>
                        <input type="password" id="password" name="password"
                            class="mt-1 block w-full rounded-md border border-gray-300 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="mt-6 w-full rounded-md bg-blue-600 px-4 py-2 font-semibold text-white shadow-sm hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                        Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <aside id="drawer-navigation"
            class="fixed left-0 top-0 z-40 h-screen w-64 -translate-x-full overflow-y-auto border-r border-gray-200 bg-white pt-20 transition-transform dark:border-gray-700 dark:bg-gray-800 md:translate-x-0"
            aria-label="Sidebar" id="drawer-navigation">
            <div class="no-scrollbar h-full overflow-y-auto bg-white px-3 pb-10 pt-0 dark:bg-gray-800">
                <ul class="space-y-2">
                    <li>
                        <x-dinas.menu-item :active="request()->is('dinas/dashboard')" href="{{ route('dinas.dashboard') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span class="ml-3">Dashboard</span></x-dinas.menu-item>
                    </li>
                </ul>
                @if (auth('pegawai')->user()->jabatan && auth('pegawai')->user()->jabatan->nama === 'Staf Humas')
                    <ul class="mt-5 space-y-2 border-t border-gray-200 pt-5 dark:border-gray-700">
                        <li>
                            <button type="button"
                                class="group flex w-full items-center rounded-lg p-2 text-base font-medium text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="dropdown-pages" data-collapse-toggle="dropdown-pages">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                                <span class="ml-3 flex-1 whitespace-nowrap text-left">Aduan</span>
                                <svg aria-hidden="true" class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <ul id="dropdown-pages"
                                class="{{ request()->routeIs('dinas.verifikasi-aduan.*') || request()->routeIs('dinas.penyelesaian-aduan.*') ? 'block' : 'hidden' }} space-y-2 py-2">
                                <li>
                                    <x-dinas.submenu-item href="{{ route('dinas.verifikasi-aduan.index') }}"
                                        :active="request()->routeIs('dinas.verifikasi-aduan.*')">
                                        Verifikasi Aduan
                                    </x-dinas.submenu-item>
                                </li>
                                <li>
                                    <x-dinas.submenu-item href="{{ route('dinas.penyelesaian-aduan.index') }}"
                                        :active="request()->routeIs('dinas.penyelesaian-aduan.*')">Penyelesaian
                                        Aduan
                                    </x-dinas.submenu-item>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <button type="button"
                                class="group flex w-full items-center rounded-lg p-2 text-base font-medium text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="dropdown-sales" data-collapse-toggle="dropdown-sales">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                <span class="ml-3 flex-1 whitespace-nowrap text-left">Artikel</span>
                                <svg aria-hidden="true" class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <ul id="dropdown-sales"
                                class="{{ request()->routeIs('dinas.artikel.*') || request()->routeIs('dinas.kategori-artikel.*') ? 'block' : 'hidden' }} space-y-2 py-2">
                                <li>
                                    <x-dinas.submenu-item href="{{ route('dinas.artikel.index') }}"
                                        :active="request()->routeIs('dinas.artikel.*')">Kelola Artikel</x-dinas.submenu-item>
                                </li>
                                <li>
                                    <x-dinas.submenu-item href="{{ route('dinas.kategori-artikel.index') }}"
                                        :active="request()->routeIs('dinas.kategori-artikel.*')">Kelola Kategori</x-dinas.submenu-item>
                                </li>
                            </ul>

                        <li>
                            <button type="button"
                                class="group flex w-full items-center rounded-lg p-2 text-base font-medium text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="dropdown-objekwisata" data-collapse-toggle="dropdown-objekwisata">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="ml-3 flex-1 whitespace-nowrap text-left">Objek Wisata</span>
                                <svg aria-hidden="true" class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <ul id="dropdown-objekwisata"
                                class="{{ request()->routeIs('dinas.objek-wisata.*') ||
                                request()->routeIs('dinas.kategori-wisata.*') ||
                                request()->routeIs('dinas.daerah.*')
                                    ? 'block'
                                    : 'hidden' }} space-y-2 py-2">
                                <li>
                                    <x-dinas.submenu-item href="{{ route('dinas.objek-wisata.index') }}"
                                        :active="request()->routeIs('dinas.objek-wisata.*')">Kelola Objek Wisata
                                    </x-dinas.submenu-item>
                                </li>
                                <li>
                                    <x-dinas.submenu-item href="{{ route('dinas.kategori-wisata.index') }}"
                                        :active="request()->routeIs('dinas.kategori-wisata.*')">Kelola Kategori
                                    </x-dinas.submenu-item>
                                </li>
                                <li>
                                    <x-dinas.submenu-item href="{{ route('dinas.daerah.index') }}"
                                        :active="request()->routeIs('dinas.daerah.*')">Kelola Daerah
                                    </x-dinas.submenu-item>
                                </li>
                            </ul>

                        </li>
                    </ul>
                @endif
                @if (
                    (auth('pegawai')->user()->jabatan && auth('pegawai')->user()->jabatan->nama === 'Staf Humas') ||
                        auth('pegawai')->user()->jabatan->nama === 'Staf Industri Pariwisata')
                    <ul class="mt-5 space-y-2 border-t border-gray-200 pt-5 dark:border-gray-700">
                        <li>
                            <x-dinas.menu-item href="{{ route('dinas.pengajuan.index') }}" :active="request()->routeIs('dinas.pengajuan.*')">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                <span class="ml-3 flex-1 whitespace-nowrap">Pengajuan
                                    Persetujuan</span></x-dinas.menu-item>
                        </li>
                        <li>
                            <x-dinas.menu-item href="{{ route('dinas.pemberitahuan.index') }}" :active="request()->routeIs('dinas.pemberitahuan.*')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                </svg>
                                <span class="ml-3">Pemberitahuan</span>
                            </x-dinas.menu-item>
                        </li>
                        <li>
                            <x-dinas.menu-item href=" {{ route('dinas.tanggapan.index') }}" :active="request()->routeIs('dinas.tanggapan.*')">

                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 3.75H6.912a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859M12 3v8.25m0 0-3-3m3 3 3-3" />
                                </svg>
                                <span class="ml-3 flex-1 whitespace-nowrap">Tanggapan</span></x-dinas.menu-item>
                        </li>
                    </ul>
                @endif
                @if (auth('pegawai')->user()->jabatan && auth('pegawai')->user()->jabatan->nama === 'Staf Industri Pariwisata')
                    <ul class="mt-5 space-y-2 border-t border-gray-200 pt-5 dark:border-gray-700">
                        <li>
                            <x-dinas.menu-item href="{{ route('dinas.verifikasi-agen.index') }}" :active="request()->routeIs('dinas.verifikasi-agen.*')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                                <span class="ml-3">Verifikasi Agen</span>
                            </x-dinas.menu-item>
                        </li>
                        <li>
                            <x-dinas.menu-item href="{{ route('dinas.monitoring-agen.index') }}" :active="request()->routeIs('dinas.monitoring-agen.*')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="ml-3 flex-1 whitespace-nowrap">Monitoring Agen</span>
                            </x-dinas.menu-item>
                        </li>
                    </ul>
                @endif
                @if (
                    (auth('pegawai')->user()->jabatan && auth('pegawai')->user()->jabatan->nama === 'Kepala Dinas') ||
                        auth('pegawai')->user()->jabatan->nama === 'Kasubag TU' ||
                        auth('pegawai')->user()->jabatan->nama === 'Kepala Bidang Industri Pariwisata')
                    <ul class="mt-5 space-y-2 border-t border-gray-200 pt-5 dark:border-gray-700">

                        <li>
                            <x-dinas.menu-item href="{{ route('dinas.approval.index') }}" :active="request()->routeIs('dinas.approval.*')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                </svg>
                                <span class="ml-3">Manajemen Persetujuan</span>
                            </x-dinas.menu-item>
                        </li>
                        @if (auth('pegawai')->user()->jabatan && auth('pegawai')->user()->jabatan->nama === 'Kasubag TU')
                            <li>
                                <x-dinas.menu-item href="{{ route('dinas.manajemen-pegawai.index') }}"
                                    :active="request()->routeIs('dinas.manajemen-pegawai.*')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span class="ml-3 flex-1 whitespace-nowrap">Manajemen Pegawai</span>
                                </x-dinas.menu-item>
                            </li>
                        @endif
                    </ul>
                @endif
            </div>
        </aside>

        <main class="min-h-dvh flex h-auto flex-col p-4 pt-20 md:ml-64">
            {{ $slot }}
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const settingsButton = document.getElementById('settings-button');
            const settingsModal = document.getElementById('settingsModal');
            const modalCloseButton = settingsModal.querySelector('[data-modal-hide]');

            settingsButton.addEventListener('click', () => {
                settingsModal.classList.remove('hidden');
            });

            modalCloseButton.addEventListener('click', () => {
                settingsModal.classList.add('hidden');
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');

            searchInput.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault(); // Mencegah form dari pengiriman
                }
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.5.0/flowbite.min.js"></script>
    <script>
        $(document).ready(function() {
            // Klik tab untuk mengubah tampilan
            $('ul.tabs li').click(function() {
                var tab_id = $(this).attr('data-tab');

                $('ul.tabs li').removeClass('current text-blue-600 border-blue-600').addClass(
                    'text-gray-600');
                $('.tab-content').removeClass('current').addClass('hidden');

                $(this).addClass('current text-blue-600 border-blue-600').removeClass('text-gray-600');
                $("#" + tab_id).removeClass('hidden').addClass('current');
            });

            // Retrieve the active tab from the URL or use default
            const urlParams = new URLSearchParams(window.location.search);
            const activeTab = urlParams.get('tab') || 'tab-pegawai'; // default tab if none specified

            $('ul.tabs li[data-tab="' + activeTab + '"]').click();
        });
    </script>
    @stack('scripts')
</body>

</html>
