<x-dinas.layout title="Kelola Pegawai">
    <!-- Toast Container -->
    <x-dinas.toast-container :errors="$errors" :session="session()" />

    <div class="container mx-auto rounded-lg bg-white p-6 py-8 shadow-md">
        <ul class="tabs flex space-x-4 border-b">
            <li class="current cursor-pointer border-b-2 border-blue-600 px-4 py-2 text-blue-600" data-tab="tab-pegawai">
                Daftar
                Pegawai</li>
            <li class="cursor-pointer px-4 py-2 text-gray-600 hover:text-blue-600" data-tab="tab-jabatan">Jabatan</li>
        </ul>

        <div id="tab-pegawai" class="tab-content current p-2">
            @include('dinas.pegawai.tab-pegawai')
        </div>
        <div id="tab-jabatan" class="tab-content hidden p-2">
            @include('dinas.pegawai.tab-jabatan')
        </div>
    </div>
</x-dinas.layout>
