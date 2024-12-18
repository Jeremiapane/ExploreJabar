@forelse ($pengajuans as $pengajuan)
    <tr class="transition-colors duration-200 hover:bg-gray-100">
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            {{ $pengajuan->judul }}
        </td>
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            {{ $pengajuan->created_at->format('d M Y') }}
        </td>
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            @if ($pengajuan->approver2)
                {{ $pengajuan->approver1->nama }}, {{ $pengajuan->approver2->nama }}
            @else
                {{ $pengajuan->approver1->nama }}
            @endif
        </td>
        <td class="whitespace-nowrap px-4 py-4 text-sm">
            @if ($pengajuan->status == 'pending')
                <span
                    class="inline-flex rounded-full bg-yellow-100 px-2 text-xs font-semibold leading-5 text-yellow-800">
                    Dalam Proses
                </span>
            @elseif ($pengajuan->status == 'ditolak')
                <span class="inline-flex rounded-full bg-red-100 px-2 text-xs font-semibold leading-5 text-red-800">
                    Ditolak
                </span>
            @elseif ($pengajuan->status == 'disetujui')
                <span class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">
                    Disetujui
                </span>
            @elseif ($pengajuan->status == 'disetujui oleh approver 1')
                <span class="inline-flex rounded-full bg-blue-100 px-2 text-xs font-semibold leading-5 text-blue-800">
                    Disetujui oleh Approver 1
                </span>
            @elseif ($pengajuan->status == 'pending approver 1')
                <span
                    class="inline-flex rounded-full bg-yellow-100 px-2 text-xs font-semibold leading-5 text-yellow-800">
                    Menunggu Approver 1
                </span>
            @elseif ($pengajuan->status == 'pending approver 2')
                <span
                    class="inline-flex rounded-full bg-yellow-100 px-2 text-xs font-semibold leading-5 text-yellow-800">
                    Menunggu Approver 2
                </span>
            @endif


        </td>
        <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
            <button class="inline-flex items-center text-blue-600 hover:text-blue-900"
                onclick="toggleModal('statusModal{{ $pengajuan->id }}')">
                Periksa
            </button>
        </td>
    </tr>

    <!-- Modal for Submission Status -->
    <div id="statusModal{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="relative mx-auto w-full max-w-lg rounded-lg bg-white">
            <div class="border-b p-6">
                <h5 class="text-lg font-bold" id="statusModalLabel">Status Pengajuan</h5>
                <button type="button" class="absolute right-4 top-4 text-gray-500 hover:text-gray-700"
                    onclick="toggleModal('statusModal{{ $pengajuan->id }}')">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <h5 class="text-lg font-semibold">{{ $pengajuan->judul }}</h5>
                <p class="mt-2"><strong>Tanggal Pengajuan:</strong>
                    {{ $pengajuan->created_at->format('d M Y') }}</p>
                <p class="mt-2"><strong>Status:</strong> {{ ucfirst($pengajuan->status) }}</p>
                <p class="mt-2"><strong>Approver 1:</strong> {{ $pengajuan->approver1->nama }}
                </p>
                @if ($pengajuan->approver2)
                    <p class="mt-2"><strong>Approver 2:</strong>
                        {{ $pengajuan->approver2->nama }}
                    </p>
                @endif
                @if ($pengajuan->status === 'ditolak')
                    <div class="mt-4 rounded border border-red-300 bg-red-100 p-4 text-red-800">
                        <strong>Ditolak dengan Catatan:</strong>
                        <p>{{ $pengajuan->catatan_penolakan }}</p>
                    </div>
                @endif
            </div>
            <div class="flex justify-end border-t p-6">
                <button type="button"
                    class="whitespace-nowrap rounded bg-gray-500 px-6 py-4 text-sm text-white hover:bg-gray-600"
                    onclick="toggleModal('statusModal{{ $pengajuan->id }}')">
                    Tutup
                </button>
            </div>
        </div>
    </div>
@empty
    <tr>
        <td colspan="5" class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-900">
            Tidak ada hasil ditemukan. Periksa kata kunci atau coba kata lain.
        </td>
    </tr>
@endforelse
