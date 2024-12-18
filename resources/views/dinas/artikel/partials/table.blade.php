@forelse ($artikels as $artikel)
    <tr class="transition-colors duration-200 hover:bg-gray-100">
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            {{ \Str::limit($artikel->judul, 50, '...') }}</td>
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            {{ $artikel->kategori_nama ?? '-' }}
        </td>
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            @if ($artikel->status == 'draf')
                <span
                    class="inline-flex rounded-full bg-yellow-100 px-2 text-xs font-semibold leading-5 text-yellow-800">
                    Draf
                </span>
            @elseif ($artikel->status == 'aktif')
                <span class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">
                    Aktif
                </span>
            @endif
        </td>
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            {{ $artikel->created_at->format('d M Y') }}</td>
        <td class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-900">
            <a href="{{ route('dinas.artikel.edit', $artikel->slug) }}"
                class="mr-1 font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
            <button onclick="openDeleteModal('{{ $artikel->slug }}', '{{ $artikel->judul }}')"
                class="mr-1 rounded-lg px-2 py-1 text-red-500 hover:text-red-600">Hapus</button>

            <a href="{{ route('dinas.artikel.show', $artikel->slug) }}"
                class="mr-1 font-medium text-blue-600 hover:underline dark:text-blue-500">Preview</a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-900">
            Tidak ada hasil ditemukan. Periksa kata kunci atau coba kata lain.
        </td>
    </tr>
@endforelse
