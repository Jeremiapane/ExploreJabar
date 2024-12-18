@forelse ($agens as $agen)
    <tr class="transition-colors duration-200 hover:bg-gray-100">
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            {{ \Str::limit($agen->nama_perusahaan, 50, '...') }}</td>
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            {{ $agen->no_telp_perusahaan ?? '-' }}</td>
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            @if ($agen->status_verifikasi == 'aktif')
                <span class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">
                    Terverifikasi
                </span>
            @endif
        </td>

        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            {{ $agen->updated_at->format('d M Y') }}</td>
        <td class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-900">
            <a href="{{ route('dinas.monitoring-agen.show', $agen->id) }}"
                class="mr-1 font-medium text-blue-600 hover:underline dark:text-blue-500">Periksa</a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-900">
            Tidak ada hasil ditemukan. Periksa kata kunci atau coba kata lain.
        </td>
    </tr>
@endforelse
