<x-dinas.layout title="Verifikasi Aduan">

    <!-- Toast Container -->
    <x-dinas.toast-container :errors="$errors" :session="session()" />

    <div class="container mx-auto rounded-lg bg-white p-6 px-4 shadow-lg sm:px-6 lg:px-8">
        <a href="{{ $aduan->status == 'Diajukan' ? route('dinas.verifikasi-aduan.index') : route('dinas.penyelesaian-aduan.index') }}"
            class="hover:text-primary-700 mb-4 inline-block font-semibold text-primary-500">
            &larr; Kembali
        </a>
        <div class="mb-6 grid grid-cols-2 items-center justify-between">
            <div class="mb-2">
                <h1 class="text-3xl font-semibold text-gray-800">Detail Aduan</h1>
            </div>
            @if ($aduan->status == 'Diajukan')
                <div class="flex justify-end space-x-4">
                    <button onclick="openModal('tolakModal')"
                        class="rounded-lg px-4 py-2 font-semibold text-negative">Tolak</button>
                    <form action="{{ route('dinas.verifikasi-aduan.verify', $aduan->id) }}" method="POST"
                        class="inline">
                        @csrf
                        <button type="submit"
                            class="rounded-lg bg-primary-500 px-4 py-2 font-semibold text-white hover:bg-primary-600">Verifikasi</button>
                    </form>
                </div>
            @elseif ($aduan->status == 'Diverifikasi')
                <!-- Actions -->
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="openModal('selesaiModal')"
                        class="rounded-lg bg-green-500 px-4 py-2 font-semibold text-white shadow-sm transition duration-150 ease-in-out hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
                        Selesaikan
                    </button>
                </div>
            @else
                <div class="w-full rounded-lg bg-white p-6 shadow-md sm:relative">
                    @php
                        $heading = '';
                        $content = '';
                        if ($aduan->status === 'Ditolak') {
                            $heading = 'Catatan Penolakan:';
                            $content = $aduan->keterangan;
                        } elseif ($aduan->status === 'Diselesaikan') {
                            $heading = 'Resolusi Aduan:';
                            $content = $aduan->keterangan;
                        }
                    @endphp
                    @if ($heading)
                        <h2 class="text-lg font-semibold">{{ $heading }}</h2>
                        @if ($content)
                            <p class="mt-2 text-gray-700">{{ $content }}</p>
                        @endif
                    @endif
                </div>
            @endif
        </div>

        <!-- Detail Aduan -->
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div>
                <p class="text-sm text-gray-500">Judul:</p>
                <p class="text-lg font-medium text-gray-800">{{ $aduan->judul }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Status:</p>
                <p
                    class="{{ $aduan->status == 'Diajukan'
                        ? 'text-yellow-600'
                        : ($aduan->status == 'Ditolak'
                            ? 'text-red-600'
                            : 'text-green-600') }} text-lg font-medium">
                    {{ $aduan->status }}
                </p>

            </div>
            <div>
                <p class="text-sm text-gray-500">Nama Pengirim:</p>
                <p class="text-lg font-medium text-gray-800">{{ $aduan->pemohon->nama }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Tanggal Kejadian:</p>
                <p class="text-lg font-medium text-gray-800">
                    {{ \Carbon\Carbon::parse($aduan->tanggal_kejadian)->format('d M Y') }}</p>
            </div>
            <div class="md:col-span-2">
                <p class="text-sm text-gray-500">Deskripsi:</p>
                <p class="text-lg text-gray-800">{{ $aduan->deskripsi }}</p>
            </div>
            <div class="md:col-span-2">
                <p class="mb-2 text-sm text-gray-500">Bukti:</p>
                @php
                    $dokumenExtension = pathinfo($aduan->bukti_path, PATHINFO_EXTENSION);
                @endphp

                @if (in_array($dokumenExtension, ['jpg', 'jpeg', 'png']))
                    <img src="{{ asset('storage/' . $aduan->bukti_path) }}" alt="Preview" class="h-auto max-w-full">
                @elseif ($dokumenExtension === 'pdf')
                    <iframe src="{{ asset('storage/' . $aduan->bukti_path) }}" class="h-96 w-full"
                        frameborder="0"></iframe>
                @elseif (in_array($dokumenExtension, ['doc', 'docx']))
                    <a href="{{ asset('storage/' . $aduan->bukti_path) }}" target="_blank"
                        class="inline-flex items-center rounded-md bg-primary-500 px-4 py-2 text-white hover:bg-primary-600">
                        Lihat Dokumen
                    </a>
                @else
                    <p>File type not supported for preview</p>
                @endif
                <a href="{{ asset('storage/' . $aduan->bukti_path) }}" target="_blank"
                    class="hover:text-primary-800 mt-2 flex items-center space-x-1 text-primary-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    <span>Lihat Bukti</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Modal Penolakan -->
    <div id="tolakModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-600 bg-opacity-50">
        <div class="relative w-full max-w-md rounded-lg bg-white p-6 shadow-md">
            <button type="button" onclick="closeModal('tolakModal')"
                class="absolute right-4 top-4 text-gray-500 hover:text-gray-700">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <h2 class="mb-4 text-xl font-semibold">Form Penolakan</h2>
            <form action="{{ route('dinas.verifikasi-aduan.reject', $aduan->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan Penolakan<span
                            class="text-red-500">*</span></label>
                    <textarea id="catatan" name="catatan" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50"
                        placeholder="Tuliskan alasan penolakan..." required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('tolakModal')"
                        class="hover:bg-white-600 mr-2 rounded-lg bg-white px-4 py-2 text-gray-500 hover:text-gray-800">Batal</button>
                    <button type="submit" class="rounded-lg bg-red-500 px-4 py-2 text-white hover:bg-red-600">Tolak
                        Aduan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Penyelesaian -->
    <div id="selesaiModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-600 bg-opacity-50">
        <div class="relative w-full max-w-md rounded-lg bg-white p-6 shadow-md">
            <button type="button" onclick="closeModal('selesaiModal')"
                class="absolute right-4 top-4 text-gray-500 hover:text-gray-700">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <h2 class="mb-4 text-xl font-semibold">Form Penyelesaian Aduan</h2>
            <form action="{{ route('dinas.penyelesaian-aduan.resolve', $aduan->id) }}" method="POST">
                @csrf
                <div class="p-auto space-y-6">
                    <div class="mb-4">
                        <label for="catatan" class="block text-sm font-medium text-gray-700">Resolusi
                            Aduan<span class="text-red-500">*</span></label>
                        <textarea id="catatan" name="catatan" rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50"
                            placeholder="Tuliskan solusi atas aduan..." required></textarea>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('selesaiModal')"
                        class="hover:bg-white-600 mr-2 rounded-lg bg-white px-4 py-2 text-gray-500 hover:text-gray-800">Batal</button>
                    <button type="submit"
                        class="rounded-lg bg-green-500 px-4 py-2 font-semibold text-white shadow-sm transition duration-150 ease-in-out hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">Kirim
                        Penyelesaian</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function openModal(modalId) {
                document.getElementById(modalId).classList.remove('hidden');
                document.getElementById(modalId).classList.add('flex');
            }

            function closeModal(modalId) {
                document.getElementById(modalId).classList.add('hidden');
                document.getElementById(modalId).classList.remove('flex');
            }
        </script>
    @endpush
</x-dinas.layout>
