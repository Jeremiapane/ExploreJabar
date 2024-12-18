@forelse ($aduans as $aduan)
    <tr class="transition-colors duration-200 hover:bg-gray-100">
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            {{ $aduan->pemohon->nama }}
        </td>
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            {{ \Str::limit($aduan->judul, 30, '...') }}
        </td>
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            {{ $aduan->created_at->format('d M Y') }}
        </td>
        <td class="whitespace-nowrap px-4 py-4 text-sm">
            @if ($aduan->status == 'Diajukan')
                <span
                    class="inline-flex rounded-full bg-yellow-100 px-2 text-xs font-semibold leading-5 text-yellow-800">
                    Belum Diverifikasi
                </span>
            @elseif($aduan->status == 'Diverifikasi')
                <span class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">
                    Diverifikasi
                </span>
            @elseif($aduan->status == 'Ditolak')
                <span class="inline-flex rounded-full bg-red-100 px-2 text-xs font-semibold leading-5 text-red-800">
                    Ditolak
                </span>
            @endif
        </td>
        <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
            <a href="{{ route('dinas.verifikasi-aduan.show', $aduan->id) }}"
                class="inline-flex items-center text-blue-600 hover:text-blue-900">
                Periksa
            </a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-900">
            Tidak ada hasil ditemukan. Periksa kata kunci atau coba kata lain.
        </td>
    </tr>
@endforelse
