@forelse ($aduans as $aduan)
    <tr class="transition-colors duration-200 hover:bg-gray-100">
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            @if ($aduan->pemohon)
            {{ $aduan->pemohon->nama }}
        @else
            <span>-</span>
        @endif
        </td>
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            {{ \Str::limit($aduan->judul, 30, '...') }}
        </td>
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            @if ($aduan->tanggal_verifikasi)
                {{ $aduan->tanggal_verifikasi->format('d M Y') }}
            @else
                <span>-</span>
            @endif
        </td>
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            @php
                $nama =
                    $aduan->status == 'Ditolak'
                        ? ($aduan->penyelesai
                            ? $aduan->penyelesai->nama
                            : 'Penyelesai tidak tersedia')
                        : ($aduan->verifikator
                            ? $aduan->verifikator->nama
                            : 'Verifikator tidak tersedia');
            @endphp
            {{ $nama }}
        </td>
        <td class="whitespace-nowrap px-6 py-4 text-sm">
            @if ($aduan->status === 'Diverifikasi')
                <span class="inline-flex rounded-full bg-blue-100 px-2 text-xs font-semibold leading-5 text-blue-800">
                    Diproses
                </span>
            @elseif ($aduan->status === 'Ditolak')
                <span class="inline-flex rounded-full bg-red-100 px-2 text-xs font-semibold leading-5 text-red-800">
                    Ditolak
                </span>
            @elseif ($aduan->status === 'Diselesaikan')
                <span class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">
                    Diselesaikan
                </span>
            @endif
        </td>
        <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
            @if ($aduan->status === 'Diverifikasi')
                <a href="{{ route('dinas.penyelesaian-aduan.show', $aduan->id) }}"
                    class="inline-flex items-center text-primary-500 hover:text-primary-600">
                    Proses
                </a>
            @else
                <a href="{{ route('dinas.penyelesaian-aduan.show', $aduan->id) }}"
                    class="inline-flex items-center text-gray-600 hover:text-gray-900">
                    Lihat
                </a>
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-900">
            Tidak ada hasil ditemukan. Periksa kata kunci atau coba kata lain.
        </td>
    </tr>
@endforelse
