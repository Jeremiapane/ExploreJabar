@forelse ($objekWisatas as $objek)
    <tr class="border-b bg-white hover:bg-gray-100">
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">{{ $objek->nama }}</td>
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">{{ $objek->kategori_nama }}</td>
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            {{ $objek->daerah->kecamatan }}, {{ $objek->daerah->provinsi }}
        </td>
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            @if ($objek->status == 'active')
                <span class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">
                    Aktif
                </span>
            @else
                <span
                    class="inline-flex rounded-full bg-yellow-100 px-2 text-xs font-semibold leading-5 text-yellow-800">
                    Draf
                </span>
            @endif
        </td>
        <td class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-900">
            <a href="{{ route('dinas.objek-wisata.edit', $objek->id) }}"
                class="mr-2 rounded-lg px-2 py-1 text-primary-500 hover:text-primary-600">Edit</a>
            <button onclick="openDeleteModal('{{ $objek->id }}', '{{ $objek->nama }}')"
                class="rounded-lg px-2 py-1 text-red-500 hover:text-red-600">Hapus</button>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-900">
            Tidak ada hasil ditemukan. Periksa kata kunci atau coba kata lain.
        </td>
    </tr>
@endforelse
