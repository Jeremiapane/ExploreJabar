<x-dinas.layout title="Detail Tanggapan">

    <!-- Toast Container -->
    <x-dinas.toast-container :errors="$errors" :session="session()" />

    <div class="container mx-auto rounded-lg bg-white p-6 px-4 shadow-lg sm:px-6 lg:px-8">
        <!-- Tombol Kembali -->
        <a href="{{ route('dinas.tanggapan.index') }}"
            class="hover:text-primary-700 mb-4 inline-block font-semibold text-primary-500">
            &larr; Kembali
        </a>

        <!-- Heading -->
        <div class="mb-6 border-b border-gray-300 pb-4">
            <p class="text-sm text-gray-500">Perihal:</p>
            <h1 class="text-3xl font-semibold text-gray-800">{{ $tanggapan->perihal }}</h1>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <!-- Isi -->
            <div>
                <p class="text-sm text-gray-500">Isi:</p>
                <p class="text-lg font-medium text-gray-800">{{ $tanggapan->isi }}</p>
            </div>

            <!-- Waktu -->
            <div>
                <p class="text-sm text-gray-500">Waktu:</p>
                <p class="text-lg font-medium text-gray-800">
                    {{ \Carbon\Carbon::parse($tanggapan->created_at)->format('d M Y, H:i') }}
                </p>
            </div>

            <!-- Pengirim -->
            <div>
                <p class="text-sm text-gray-500">Pengirim:</p>
                <p class="text-lg font-medium text-gray-800">{{ $tanggapan->pengirim->nama_perusahaan }}</p>
            </div>

            <!-- Pemberitahuan -->
            <div>
                <p class="text-sm text-gray-500">Pemberitahuan:</p>
                <p class="text-lg font-medium text-gray-800">
                    <a href="{{ route('dinas.pemberitahuan.show', $tanggapan->pemberitahuan_id) }}"
                        class="text-blue-600 hover:text-blue-800">
                        {{ $tanggapan->pemberitahuan->perihal }}
                    </a>
                </p>
            </div>

            <!-- Lampiran -->
            @if ($tanggapan->lampiran)
                <div class="md:col-span-2">
                    <p class="mb-2 text-sm text-gray-500">Lampiran:</p>
                    @php
                        $lampiranExtension = pathinfo($tanggapan->lampiran, PATHINFO_EXTENSION);
                    @endphp

                    @if (in_array($lampiranExtension, ['jpg', 'jpeg', 'png']))
                        <img src="{{ asset('storage/' . $tanggapan->lampiran) }}" alt="Preview"
                            class="h-auto max-w-full rounded shadow-md">
                    @elseif ($lampiranExtension === 'pdf')
                        <iframe src="{{ asset('storage/' . $tanggapan->lampiran) }}"
                            class="h-96 w-full rounded shadow-md" frameborder="0"></iframe>
                    @elseif (in_array($lampiranExtension, ['doc', 'docx']))
                        <a href="{{ asset('storage/' . $tanggapan->lampiran) }}" target="_blank"
                            class="inline-flex items-center rounded-md bg-primary-500 px-4 py-2 text-white hover:bg-primary-600">
                            Lihat Dokumen
                        </a>
                    @else
                        <p>File type not supported for preview</p>
                    @endif

                    <a href="{{ asset('storage/' . $tanggapan->lampiran) }}" target="_blank"
                        class="hover:text-primary-800 mt-2 flex items-center space-x-1 text-primary-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>
                        <span>Lihat Lampiran</span>
                    </a>
                </div>
            @endif
        </div>
    </div>

</x-dinas.layout>
