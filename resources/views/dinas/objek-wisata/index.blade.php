<x-dinas.layout title="Kelola Objek Wisata">

    <!-- Toast Container -->
    <x-dinas.toast-container :errors="$errors" :session="session()" />

    <div class="container mx-auto rounded-lg bg-white p-6 shadow-md">

        <!-- Heading and Description -->
        <div class="mb-6 flex flex-col items-center justify-between sm:flex-row">
            <div class="mb-4 w-full sm:mb-0 sm:w-auto">
                <h1 class="text-3xl font-semibold text-gray-800">Kelola Objek Wisata</h1>
                <p class="mt-2 text-gray-600">Kelola objek wisata Anda dengan mudah. Anda dapat menambah,
                    mengedit,
                    atau menghapus data dari sini.</p>
            </div>
            <div class="mt-4 w-full sm:mt-0 sm:w-auto">
                <a href="{{ route('dinas.objek-wisata.create') }}"
                    class="flex items-center rounded-lg bg-primary-500 px-4 py-2 font-semibold text-white hover:bg-primary-600">
                    <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                        </path>
                    </svg>
                    Tambah Objek Wisata
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
                    placeholder="Cari objek wisata berdasarkan nama" maxlength="100" />
            </div>
        </form>

        <!-- Table -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table id="objek-wisata-table" class="min-w-full overflow-hidden rounded-lg bg-white shadow-md"
                data-sort-order="asc">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th scope="col" class="cursor-pointer px-6 py-3" data-sort="nama" data-column="0"
                            onclick="sortTable(0, 'nama')">
                            <div class="flex items-center">
                                Nama
                                <svg class="ms-1.5 h-4 w-4 min-w-[1rem] max-w-[1.5rem]" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="cursor-pointer px-6 py-3" data-sort="kategori" data-column="1"
                            onclick="sortTable(1, 'kategori')">
                            <div class="flex items-center">
                                Kategori
                                <a href="#">
                                    <svg class="ms-1.5 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                    </svg>
                                </a>
                            </div>
                        </th>
                        <th scope="col" class="cursor-pointer px-6 py-3" data-sort="daerah" data-column="2"
                            onclick="sortTable(2, 'daerah')">
                            <div class="flex items-center">
                                Daerah
                                <a href="#">
                                    <svg class="ms-1.5 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                    </svg>
                                </a>
                            </div>
                        </th>
                        <th scope="col" class="cursor-pointer px-6 py-3" data-sort="status" data-column="3"
                            onclick="sortTable(3, 'status')">
                            <div class="flex items-center">
                                Status
                                <a href="#">
                                    <svg class="ms-1.5 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                    </svg>
                                </a>
                            </div>
                        </th>
                        <th scope="col"
                            class="px-8 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="text-sm font-medium text-gray-900">
                    @include('dinas.objek-wisata.partials.table', ['objekWisatas' => $objekWisatas])
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $objekWisatas->links() }}
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-600 bg-opacity-50">
            <div class="relative w-full max-w-md rounded-lg bg-white p-6 shadow-md">
                <button type="button" onclick="closeModal('deleteModal')"
                    class="absolute right-4 top-4 text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <h2 class="text-lg font-semibold text-gray-800">Konfirmasi Hapus</h2>
                <p id="deleteConfirmationText" class="mt-2 text-gray-600">Apakah Anda yakin ingin menghapus data objek
                    wisata
                    ini?
                </p>
                <div class="mt-4 flex justify-end">
                    <button type="button" class="text-gray-600 hover:text-gray-800"
                        onclick="closeModal('deleteModal')">Batal</button>
                    <form id="deleteForm" method="POST" class="ms-4" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="rounded-lg bg-red-600 px-4 py-2 text-white hover:bg-red-700">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function sortTable(columnIndex, sortBy) {
                const table = document.getElementById('objek-wisata-table');
                const isAscending = table.dataset.sortOrder === 'asc';
                const sortOrder = isAscending ? 'desc' : 'asc';

                // Update sort order for current column only
                table.dataset.sortOrder = sortOrder;
                table.dataset.sortBy = sortBy;

                axios.get('{{ route('dinas.objek-wisata.index') }}', {
                        params: {
                            search: document.getElementById('search').value,
                            sort_column: sortBy,
                            sort_direction: sortOrder
                        }
                    })
                    .then(response => {
                        document.querySelector('tbody').innerHTML = response.data;
                    })
                    .catch(error => {
                        console.error('Error during sorting:', error);
                    });
            }

            function openModal(modalId) {
                document.getElementById(modalId).classList.remove('hidden');
                document.getElementById(modalId).classList.add('flex');
            }

            function closeModal(modalId) {
                document.getElementById(modalId).classList.add('hidden');
                document.getElementById(modalId).classList.remove('flex');
            }

            function openDeleteModal(id, nama) {
                const form = document.getElementById('deleteForm');
                form.action = `{{ route('dinas.objek-wisata.destroy', '') }}/${id}`;

                const confirmationText = document.getElementById('deleteConfirmationText');
                confirmationText.innerHTML = `Apakah Anda yakin ingin menghapus objek "${nama}"?`;
                openModal('deleteModal');
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
            function searchData(query) {
                axios.get('{{ route('dinas.objek-wisata.index') }}', {
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
                searchData(event.target.value);
            }, 100); // 100 ms debounce delay

            // Event listener for search input
            document.getElementById('search').addEventListener('input', debouncedSearch);
        </script>
    @endpush
</x-dinas.layout>
