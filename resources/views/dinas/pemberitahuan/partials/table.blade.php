@forelse ($pemberitahuan as $pesan)
    <tr class="border-b bg-white hover:bg-gray-100">
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            {{ $pesan->pengirim->nama }} <!-- Access `nama` from the related `pengirim` model -->
        </td>
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            {{ $pesan->penerima->nama_perusahaan }}
            <!-- Access `nama` from the related `penerima` model -->
        </td>
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            {{ $pesan->perihal }}
        </td>
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
            {{ $pesan->created_at->format('d M Y') }}
        </td>
        <td class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-900">
            <a href="{{ route('dinas.pemberitahuan.show', $pesan->id) }}"
                class="mr-1 font-medium text-primary-600 hover:underline dark:text-primary-500">Preview</a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-900">
            Tidak ada hasil ditemukan. Periksa kata kunci atau coba kata lain.
        </td>
    </tr>
@endforelse
