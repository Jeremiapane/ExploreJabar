<x-dinas.layout title="Kelola Kategori Wisata">

    <!-- Toast Container -->
    <x-dinas.toast-container :errors="$errors" :session="session()" />

    <div class="container mx-auto rounded-lg bg-white p-6 shadow-md">
        <!-- Heading and Description -->
        <div class="mb-6 flex flex-col items-center justify-between sm:flex-row">
            <div class="mb-4 w-full sm:mb-0 sm:w-auto">
                <h1 class="text-3xl font-semibold text-gray-800">Kelola Kategori Wisata</h1>
                <p class="mt-2 text-gray-600">Kelola objek wisata Anda dengan mudah. Anda dapat menambah, mengedit,
                    atau menghapus Wisata dari sini.</p>
            </div>
            <div class="mt-4 w-full sm:mt-0 sm:w-auto">
                <a onclick="openModal('createKategoriModal')"
                    class="flex items-center rounded-lg bg-primary-500 px-4 py-2 font-semibold text-white hover:bg-primary-600"><svg
                        class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Kategori Wisata
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
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pl-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                    placeholder="Cari kategori berdasarkan nama" maxlength="100" />
            </div>
        </form>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table id="kategori-table" class="min-w-full overflow-hidden rounded-lg bg-white shadow-md">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th scope="col" class="cursor-pointer px-6 py-3" data-column="0" onclick="sortTable(0)">
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
                <tbody class="divide-y divide-gray-200 bg-white">
                    @include('dinas.objek-wisata.kategori.partials.table', ['kategoris' => $kategoris])
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $kategoris->links() }}
        </div>
    </div>

    <!-- Create Kategori Modal -->
    <x-dinas.kategori-modal modalId="createKategoriModal" title="Tambah Kategori Wisata" formId="createKategoriForm"
        action="{{ route('dinas.kategori-wisata.store') }}" method="POST" label="Nama Kategori" inputId="nama_kategori"
        buttonText="Simpan" />

    <!-- Edit Kategori Modal -->
    <x-dinas.kategori-modal modalId="editKategoriModal" title="Edit Kategori Wisata" formId="editKategoriForm"
        action="" method="PUT" label="Nama Kategori" inputId="edit_nama_kategori" buttonText="Simpan" />

    <!-- Delete Confirmation Modal -->
    <x-dinas.delete-kategori-modal modalId="deleteKategoriModal" title="Konfirmasi Hapus"
        confirmationText="Apakah Anda yakin ingin menghapus kategori ini?" confirmationTextId="deleteConfirmationText"
        formId="deleteKategoriForm" action="" deleteButtonId="deleteButton" />

    <!-- Include JavaScript Functions -->
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
                form.action = `{{ route('dinas.kategori-wisata.update', '') }}/${id}`;

                const namaInput = document.getElementById('edit_nama_kategori');
                namaInput.value = nama;

                openModal('editKategoriModal');
            }

            function openDeleteModal(id, nama, count) {
                const form = document.getElementById('deleteKategoriForm');
                form.action = `{{ route('dinas.kategori-wisata.destroy', '') }}/${id}`;

                const confirmationText = document.getElementById('deleteConfirmationText');
                const deleteButton = document.getElementById('deleteButton');
                const cancelButton = document.getElementById('cancelButton')

                if (count > 0) {
                    confirmationText.innerHTML =
                        `Anda tidak dapat menghapus kategori "${nama}" karena digunakan pada ${count} Objek Wisata.`;
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

            function sortTable(columnIndex) {
                const table = document.getElementById('kategori-table');
                const currentSortColumn = table.getAttribute('data-sort-column');
                const currentSortDirection = table.getAttribute('data-sort-direction');
                const column = ['nama', 'ObjekWisatas_count'][columnIndex]; // Adjust this array according to your column names

                let newSortDirection = 'asc';
                if (currentSortColumn === column && currentSortDirection === 'asc') {
                    newSortDirection = 'desc';
                }

                axios.get('{{ route('dinas.kategori-wisata.index') }}', {
                        params: {
                            sort_column: column,
                            sort_direction: newSortDirection,
                            search: document.getElementById('search').value
                        }
                    })
                    .then(response => {
                        document.querySelector('tbody').innerHTML = response.data;
                        table.setAttribute('data-sort-column', column);
                        table.setAttribute('data-sort-direction', newSortDirection);
                    })
                    .catch(error => {
                        console.error('Error during sorting:', error);
                    });
            }


            // Debounce function
            function debounce(func, wait) {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            }

            // Function to perform search
            function searchKategori(query) {
                axios.get('{{ route('dinas.kategori-wisata.index') }}', {
                        params: {
                            search: query
                        }
                    })
                    .then(response => {
                        document.querySelector('tbody').innerHTML = response.data;
                    })
                    .catch(error => {
                        console.error('Error during search:', error);
                    });
            }

            // Debounced search function
            const debouncedSearch = debounce(function(event) {
                searchKategori(event.target.value);
            }, 100); // 100 ms debounce delay

            // Event listener for search input
            document.getElementById('search').addEventListener('input', debouncedSearch);
        </script>
    @endpush
</x-dinas.layout>
