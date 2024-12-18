@forelse ($tanggapans as $tanggapan)
    <tr>
        <td class="px-6 py-4">{{ $tanggapan->pengirim->nama_perusahaan }}</td>
        <td class="px-6 py-4">{{ $tanggapan->perihal }}</td>
        <td class="px-6 py-4">{{ $tanggapan->created_at->format('d M Y') }}</td>
        <td class="px-6 py-4 text-right">
            <a href="{{ route('dinas.tanggapan.show', $tanggapan->id) }}" class="text-blue-600 hover:underline">Lihat
                Detail</a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-900">
            Tidak ada hasil ditemukan. Periksa kata kunci atau coba kata lain.
        </td>
    </tr>
@endforelse
