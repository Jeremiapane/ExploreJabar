<x-dinas.layout title="Detail Pemberitahuan">

    <!-- Toast Container -->
    <x-dinas.toast-container :errors="$errors" :session="session()" />

    <div class="container mx-auto rounded-lg bg-neutral-white px-4 py-8 shadow-md sm:px-4 lg:px-12">
        <!-- Tombol Kembali -->
        <a href="{{ route('dinas.pemberitahuan.index') }}"
            class="mb-4 inline-block font-semibold text-blue-500 hover:text-blue-700">
            &larr; Kembali
        </a>

        <div class="mb-6 flex flex-row items-center justify-between">
            <div class="mb-2">
                <h1 class="text-3xl font-semibold text-gray-800">Detail Pemberitahuan</h1>
            </div>
        </div>

        <!-- Detail pemberitahuan -->

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div>
                <p class="text-sm text-gray-500">Perihal:</p>
                <p class="text-lg font-medium text-gray-800">{{ $pemberitahuan->perihal }}</p>
                <!-- Properti perihal -->
            </div>
            <div>
                <p class="text-sm text-gray-500">Isi:</p>
                <p class="text-lg text-gray-800">{{ $pemberitahuan->isi }}</p> <!-- Properti isi -->
            </div>
            <div>
                <p class="text-sm text-gray-500">Nama Pengirim:</p>
                <p class="text-lg font-medium text-gray-800">{{ $pemberitahuan->pengirim->nama }}</p>
                <!-- Relasi ke pengirim -->
            </div>
            <div>
                <p class="text-sm text-gray-500">Nama Penerima:</p>
                <p class="text-lg font-medium text-gray-800">{{ $pemberitahuan->penerima->nama_perusahaan }}</p>
                <!-- Relasi ke penerima -->
            </div>
            <div class="md:col-span-2">
                @if ($pemberitahuan->lampiran)
                    @php
                        $lampiranExtension = pathinfo($pemberitahuan->lampiran, PATHINFO_EXTENSION);
                    @endphp

                    <p class="text-sm text-gray-500">Lampiran:</p>
                    @if (in_array($lampiranExtension, ['jpg', 'jpeg', 'png']))
                        <img src="{{ asset('storage/' . $pemberitahuan->lampiran) }}" alt="Preview"
                            class="h-auto max-w-full">
                    @elseif ($lampiranExtension === 'pdf')
                        <iframe src="{{ asset('storage/' . $pemberitahuan->lampiran) }}" class="h-96 w-full"
                            frameborder="0"></iframe>
                    @elseif (in_array($lampiranExtension, ['doc', 'docx']))
                        <a href="{{ asset('storage/' . $pemberitahuan->lampiran) }}" target="_blank"
                            class="inline-flex items-center rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">
                            Lihat Dokumen
                        </a>
                    @else
                        <p>File type not supported for preview</p>
                    @endif
                    <a href="{{ asset('storage/' . $pemberitahuan->lampiran) }}" target="_blank"
                        class="mt-4 flex items-center space-x-1 text-blue-600 hover:text-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>
                        <span>Lihat Lampiran</span>
                    </a>
                @else
                    <p class="text-gray-500">Tidak ada lampiran.</p>
                @endif
            </div>
        </div>
    </div>

</x-dinas.layout>
