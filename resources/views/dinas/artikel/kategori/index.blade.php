<x-dinas.layout title="Kelola Kategori Artikel">

    <!-- Toast Container -->
    <x-dinas.toast-container :errors="$errors" :session="session()" />

    <div class="container mx-auto rounded-lg bg-white p-6 shadow-md">
        <div class="mb-6 flex flex-col items-center justify-between sm:flex-row">
            <div class="mb-4 w-full sm:mb-0 sm:w-auto">
                <h1 class="text-3xl font-semibold text-gray-800">Kelola Kategori Artikel</h1>
                <p class="mt-2 text-gray-600">Atur kategori artikel Anda dengan mudah. Anda bisa menambah, mengedit, atau
                    menghapus kategori artikel di sini</p>
            </div>
            <div class="mt-4 w-full sm:mt-0 sm:w-auto">
                <a onclick="openModal('createKategoriModal')"
                    class="flex items-center rounded-lg bg-primary-500 px-4 py-2 font-semibold text-white hover:bg-primary-600">
                    <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Kategori Artikel
                </a>
            </div>
        </div>

        <!-- Search Bar -->
        <form class="mb-4 flex w-full items-center">
            <label for="search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="search"
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pl-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Cari kategori berdasarkan nama" maxlength="100" />
            </div>
        </form>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table id="kategori-table" class="min-w-full overflow-hidden rounded-lg bg-white shadow-md"
                data-sort-column="nama" data-sort-direction="asc">

                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th scope="col" class="cursor-pointer px-6 py-3" data-sort="nama"
                            onclick="sortTable('nama')">
                            <div class="flex items-center">
                                Kategori
                                <svg class="ms-1.5 h-4 w-4 min-w-[1rem] max-w-[1.5rem]" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col"
                            class="m px-8 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody id="kategori-tbody">
                    @include('dinas.artikel.kategori.partials.table', [
                        'kategoriArtikel' => $kategoriArtikel,
                    ])
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $kategoriArtikel->links() }}
        </div>

        <!-- Create Kategori Modal -->
        <x-dinas.kategori-modal modalId="createKategoriModal" title="Tambah Kategori Artikel"
            formId="createKategoriForm" action="{{ route('dinas.kategori-artikel.store') }}" method="POST"
            label="Nama Kategori" inputId="nama_kategori" buttonText="Simpan" />

        <!-- Edit Kategori Modal -->
        <x-dinas.kategori-modal modalId="editKategoriModal" title="Edit Kategori Artikel" formId="editKategoriForm"
            action="" method="PUT" label="Nama Kategori" inputId="edit_nama_kategori" buttonText="Simpan" />

        <!-- Delete Confirmation Modal -->
        <x-dinas.delete-kategori-modal modalId="deleteKategoriModal" title="Konfirmasi Hapus"
            confirmationText="Apakah Anda yakin ingin menghapus kategori ini?"
            confirmationTextId="deleteConfirmationText" formId="deleteKategoriForm" action=""
            deleteButtonId="deleteButton" />

        @push('scripts')
            <script>
                function openModal(modalId) {
                    document.getElementById(modalId).classList.remove('hidden');
                    document.getElementById(modalId).classList.add('flex');
                }

                function closeModal(modalId) {
                    document.getElementById(modalId).classList.add('hidden');
                    document.getElementById(modalId).classList.remove('flex');
                }

                function openEditKategoriModal(id, nama) {
                    const form = document.getElementById('editKategoriForm');
                    form.action = `{{ route('dinas.kategori-artikel.update', '') }}/${id}`;

                    const namaInput = document.getElementById('edit_nama_kategori');
                    namaInput.value = nama;

                    openModal('editKategoriModal');
                }

                function openDeleteModal(id, nama, count) {
                    const form = document.getElementById('deleteKategoriForm');
                    form.action = `{{ route('dinas.kategori-artikel.destroy', '') }}/${id}`;

                    const confirmationText = document.getElementById('deleteConfirmationText');
                    const deleteButton = document.getElementById('deleteButton');
                    const cancelButton = document.getElementById('cancelButton')

                    if (count > 0) {
                        confirmationText.innerHTML =
                            `Anda tidak dapat menghapus kategori "${nama}" karena digunakan pada ${count} artikel.`;
                        deleteButton.style.display = 'none'
                        cancelButton.style.display = 'none';
                    } else {
                        confirmationText.innerHTML = `Apakah Anda yakin ingin menghapus kategori "${nama}"?`;
                        deleteButton.disabled = false;
                        deleteButton.classList.add('bg-red-500', 'hover:bg-red-600', 'text-white');
                        deleteButton.classList.remove('text-gray-400', 'hover:bg-transparent', 'hover:text-gray-400');
                    }
                    openModal('deleteKategoriModal');
                }
                
                document.addEventListener('DOMContentLoaded', () => {
                    const searchInput = document.getElementById('search');
                    searchInput.addEventListener('input', debounce(searchData, 300)); // Debounced search with 300ms delay

                    function debounce(func, delay) {
                        let timer;
                        return function(...args) {
                            clearTimeout(timer);
                            timer = setTimeout(() => func.apply(this, args), delay);
                        };
                    }

                    function searchData() {
                        const query = searchInput.value;
                        fetchTableData(query, getCurrentSortColumn(), getCurrentSortDirection());
                    }

                    function sortTable(column) {
                        const table = document.getElementById('kategori-table');
                        const isAscending = table.dataset.sortDirection === 'asc';
                        const sortDirection = isAscending ? 'desc' : 'asc';

                        table.dataset.sortColumn = column;
                        table.dataset.sortDirection = sortDirection;

                        fetchTableData(searchInput.value, column, sortDirection);
                    }

                    function getCurrentSortColumn() {
                        return document.getElementById('kategori-table').dataset.sortColumn;
                    }

                    function getCurrentSortDirection() {
                        return document.getElementById('kategori-table').dataset.sortDirection;
                    }

                    function fetchTableData(search, sortColumn, sortDirection) {
                        axios.get('{{ route('dinas.kategori-artikel.index') }}', {
                                params: {
                                    search: search,
                                    sort_column: sortColumn,
                                    sort_direction: sortDirection
                                }
                            })
                            .then(response => {
                                document.getElementById('kategori-tbody').innerHTML = response.data;
                            })
                            .catch(error => {
                                console.error('Error during data fetch:', error);
                            });
                    }

                    window.sortTable = sortTable; // Make sortTable available globally
                });
            </script>
        @endpush
    </div>
</x-dinas.layout>
