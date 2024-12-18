@forelse ($kategoris as $kategori)
    <tr class="transition-colors duration-200 hover:bg-gray-100">
        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">{{ $kategori->nama }}</td>
        <td class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-900">
            <button onclick="openEditKategoriModal({{ $kategori->id }}, '{{ $kategori->nama }}')"
                class="mr-2 rounded-lg px-2 py-1 text-primary-500 hover:text-primary-600">
                Edit
            </button>
            <button
                onclick="openDeleteModal({{ $kategori->id }}, '{{ $kategori->nama }}',{{ $kategori->wisatas_count }})"
                class="rounded-lg px-2 py-1 text-red-500 hover:text-red-600">
                Hapus
            </button>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-900">
            Tidak ada hasil ditemukan. Periksa kata kunci atau coba kata lain.
        </td>
    </tr>
@endforelse