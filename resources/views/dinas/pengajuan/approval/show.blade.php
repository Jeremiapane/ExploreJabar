<x-dinas.layout title="Detail Pengajuan">

    <!-- Toast Container -->
    <x-dinas.toast-container :errors="$errors" :session="session()" />

    <div class="container mx-auto rounded-lg bg-white p-6 shadow-lg sm:px-6 lg:px-8">
        <a href="{{ route('dinas.approval.index') }}"
            class="hover:text-primary-700 mb-4 inline-block font-semibold text-primary-500">
            &larr; Kembali
        </a>
        <div class="mb-6 grid grid-cols-1 items-center justify-between sm:grid-cols-2">
            <div class="mb-2">
                <h1 class="text-3xl font-semibold text-gray-800">Detail Pengajuan</h1>
            </div>
            <div class="flex justify-end space-x-4">
                @php
                    $userId = Auth::guard('pegawai')->id();
                    $isApprover1 = $pengajuan->approver1_id == $userId;
                    $isApprover2 = $pengajuan->approver2_id == $userId;
                    $canApprove =
                        ($isApprover1 && in_array($pengajuan->status, ['pending', 'pending approver 1'])) ||
                        ($isApprover2 && $pengajuan->status == 'pending approver 2');
                    $canReject =
                        ($isApprover1 && in_array($pengajuan->status, ['pending approver 1', 'pending'])) ||
                        ($isApprover2 && $pengajuan->status == 'pending approver 2');
                @endphp

                @if ($canReject)
                    <button onclick="showRejectModal()" class="rounded-lg px-4 py-2 font-semibold text-negative">
                        Tolak
                    </button>
                @endif

                @if ($canApprove)
                    <form action="{{ route('dinas.pengajuan.approve', $pengajuan->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="rounded-lg bg-primary-500 px-4 py-2 font-semibold text-white hover:bg-primary-600">
                            Setuju
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div>
                <p class="text-sm text-gray-500">Judul:</p>
                <p class="text-lg font-medium text-gray-800">{{ $pengajuan->judul }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Pemohon:</p>
                <p class="text-lg font-medium text-gray-800">{{ $pengajuan->pemohon->nama }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Tanggal Pengajuan:</p>
                <p class="text-lg font-medium text-gray-800">
                    {{ \Carbon\Carbon::parse($pengajuan->tanggal_kejadian)->format('d M Y') }}
                </p>
            </div>
            <div class="md:col-span-2">
                <p class="text-sm text-gray-500">Deskripsi:</p>
                <p class="text-lg text-gray-800">{{ $pengajuan->deskripsi }}</p>
            </div>
            <div class="md:col-span-2">
                <p class="mb-2 text-sm text-gray-500">Dokumen:</p>
                @php
                    $dokumenExtension = pathinfo($pengajuan->dokumen, PATHINFO_EXTENSION);
                @endphp

                @if (in_array($dokumenExtension, ['jpg', 'jpeg', 'png']))
                    <img src="{{ asset('storage/' . $pengajuan->dokumen) }}" alt="Preview"
                        class="mb-4 h-auto max-w-full">
                @elseif ($dokumenExtension === 'pdf')
                    <iframe src="{{ asset('storage/' . $pengajuan->dokumen) }}" class="mb-4 h-96 w-full"
                        frameborder="0"></iframe>
                @elseif (in_array($dokumenExtension, ['doc', 'docx']))
                    <a href="{{ asset('storage/' . $pengajuan->dokumen) }}" target="_blank"
                        class="mb-4 inline-flex items-center rounded-md bg-primary-500 px-4 py-2 text-white hover:bg-primary-600">
                        Lihat Dokumen
                    </a>
                @else
                    <p>File type not supported for preview</p>
                @endif
                @if (in_array($dokumenExtension, ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx']))
                    <a href="{{ asset('storage/' . $pengajuan->dokumen) }}" target="_blank"
                        class="hover:text-primary-800 flex items-center space-x-1 text-primary-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>
                        <span>Lihat Dokumen</span>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal for Rejection Note -->
    <div id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-600 bg-opacity-50 p-4">
        <div class="relative w-full max-w-md rounded-lg bg-white p-6 shadow-md">
            <button type="button" onclick="closeRejectModal()"
                class="absolute right-4 top-4 text-gray-500 hover:text-gray-700">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <h2 class="mb-4 text-xl font-semibold">Form Penolakan</h2>
            <form action="{{ route('dinas.pengajuan.reject', $pengajuan->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="catatan_penolakan" class="block text-sm font-medium text-gray-700">Catatan Penolakan
                        <span class="text-red-500">*</span></label>
                    <textarea id="catatan_penolakan" name="catatan_penolakan" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50"
                        placeholder="Tuliskan alasan penolakan..." required></textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeRejectModal()"
                        class="rounded-lg bg-white px-4 py-2 text-gray-500 hover:bg-gray-100">Batal</button>
                    <button type="submit"
                        class="rounded-lg bg-red-500 px-4 py-2 text-white hover:bg-red-600">Tolak</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function showRejectModal() {
                document.getElementById('rejectModal').classList.remove('hidden');
                document.getElementById('rejectModal').classList.add('flex');
            }

            function closeRejectModal() {
                document.getElementById('rejectModal').classList.add('hidden');
                document.getElementById('rejectModal').classList.remove('flex');
            }
        </script>
    @endpush
</x-dinas.layout>
