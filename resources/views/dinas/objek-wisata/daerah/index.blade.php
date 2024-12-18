<x-dinas.layout title="Kelola Daerah Wisata">
    <!-- Toast Container -->
    <x-dinas.toast-container :errors="$errors" :session="session()" />

    <div class="container mx-auto rounded-lg bg-white p-6 shadow-md">
        <!-- Heading and Description -->
        <div class="mb-6 flex flex-col items-center justify-between sm:flex-row">
            <div class="mb-4 w-full sm:mb-0 sm:w-auto">
                <h1 class="text-3xl font-semibold text-gray-800">Kelola Daerah</h1>
                <p class="mt-2 text-gray-600">Kelola Data Daerah Wisata Anda dengan mudah. Anda dapat menambah, mengedit,
                    atau menghapus data dari sini.</p>
            </div>
            <div class="mt-4 w-full sm:mt-0 sm:w-auto">
                <!-- Button to Open Create Modal -->
                <a onclick="openModal('createDaerahModal')"
                    class="flex items-center rounded-lg bg-primary-500 px-4 py-2 font-semibold text-white hover:bg-primary-600">
                    <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Daerah
                </a>
            </div>
        </div>

        <!-- Search Bar -->
        <form class="mb-4 flex w-full items-center" method="GET" action="{{ route('dinas.daerah.index') }}">
            <label for="search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="search" name="search"
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pl-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Cari daerah berdasarkan nama" maxlength="100" value="{{ request('search') }}" />
            </div>
            <button type="submit" class="sr-only">Search</button>
        </form>


        <!-- Table -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table id="daerah-table" class="min-w-full overflow-hidden rounded-lg bg-white shadow-md"
                data-sort-order="asc">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th scope="col" class="cursor-pointer px-6 py-3" data-column="kecamatan"
                            onclick="sortTable('kecamatan')">
                            <div class="flex items-center">
                                Kecamatan
                                <svg class="ms-1.5 h-4 w-4 min-w-[1rem] max-w-[1.5rem]" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg>
                            </div>
                        </th>
                        <th class="px-6 py-3">
                            <div class="flex items-center">Provinsi</div>
                        </th>
                        <th scope="col"
                            class="px-8 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @include('dinas.objek-wisata.daerah.partials.table', ['daerahs' => $daerahs])
                </tbody>
            </table>

        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $daerahs->links() }}
        </div>

        <!-- Create Daerah Modal -->
        <div id="createDaerahModal"
            class="fixed inset-0 z-50 hidden max-h-screen items-center justify-center overflow-auto bg-gray-600 bg-opacity-50">
            <div class="relative w-full max-w-md rounded-lg bg-white p-6 shadow-md">
                <h2 class="mb-4 text-xl font-semibold">Tambah Daerah Wisata</h2>
                <button class="absolute right-4 top-4 text-gray-500 hover:text-gray-700"
                    onclick="closeModal('createDaerahModal')" aria-label="Close Modal">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <form id="createDaerahForm" method="POST" action="{{ route('dinas.daerah.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="namaDaerah" class="block text-sm font-medium text-gray-700">Nama
                            Kecamatan</label>
                        <input type="text" id="namaDaerah" name="kecamatan" required pattern="[A-Za-z\s]+"
                            title="Hanya huruf dan spasi yang diperbolehkan"
                            class="mt-1 block w-full rounded-lg border border-gray-300 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Kecamatan" />
                    </div>
                    <div class="mb-4">
                        <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi</label>
                        <input type="text" id="provinsi" name="provinsi" value="Jawa Barat" readonly
                            class="mt-1 block w-full cursor-not-allowed rounded-lg border border-gray-300 bg-gray-100 p-2.5 text-sm text-gray-900" />
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="closeModal('createDaerahModal')"
                            class="mr-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-900">Batal</button>
                        <button type="submit"
                            class="rounded-lg bg-primary-500 px-4 py-2 text-white hover:bg-primary-600">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Daerah Modal -->
        <div id="editDaerahModal"
            class="fixed inset-0 z-50 hidden max-h-screen items-center justify-center overflow-auto bg-black bg-opacity-50">
            <div class="relative w-full max-w-md rounded-lg bg-white p-6 shadow-md">
                <h2 class="mb-4 text-xl font-semibold">Edit Daerah Wisata</h2>
                <button class="absolute right-4 top-4 text-gray-500 hover:text-gray-700"
                    onclick="closeModal('editDaerahModal')" aria-label="Close Modal">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <form id="editDaerahForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editDaerahId" name="id" />
                    <div class="mb-4">
                        <label for="editNamaDaerah" class="block text-sm font-medium text-gray-700">Nama
                            Kecamatan</label>
                        <input type="text"pattern="[A-Za-z\s]+" title="Hanya huruf dan spasi yang diperbolehkan"
                            id="editNamaDaerah" name="kecamatan" required
                            class="mt-1 block w-full rounded-lg border border-gray-300 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Kecamatan" />
                    </div>
                    <div class="mb-4">
                        <label for="editProvinsi" class="block text-sm font-medium text-gray-700">Provinsi</label>
                        <input type="text" pattern="[A-Za-z\s]+" id="editProvinsi" name="provinsi" readonly
                            class="mt-1 block w-full cursor-not-allowed rounded-lg border border-gray-300 bg-gray-100 p-2.5 text-sm text-gray-900"
                            placeholder="Provinsi" />
                    </div>
                    <div class="flex items-center justify-end">
                        <button type="button" onclick="closeModal('editDaerahModal')"
                            class="mr-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-900">Batal</button>
                        <button type="submit"
                            class="rounded-lg bg-primary-500 px-4 py-2 font-semibold text-white hover:bg-primary-600">Simpan</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- Delete Daerah Modal -->
        <div id="deleteDaerahModal"
            class="fixed inset-0 z-50 hidden max-h-screen items-center justify-center overflow-auto bg-black bg-opacity-50">
            <div class="relative w-full max-w-md rounded-lg bg-white p-6 shadow-md">
                <h2 class="mb-4 text-xl font-semibold">Hapus Daerah Wisata</h2>
                <button class="absolute right-4 top-4 text-gray-500 hover:text-gray-700"
                    onclick="closeModal('deleteDaerahModal')" aria-label="Close Modal">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <form id="deleteDaerahForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <p id="deleteDaerahMessage" class="mb-4 text-sm text-gray-700">Apakah Anda yakin ingin
                        menghapus
                        daerah ini? Daerah ini memiliki <span id="deleteDaerahCount" class="font-semibold"></span>
                        objek wisata terkait.</p>
                    <div class="flex items-center justify-end">
                        <button type="button" onclick="closeModal('deleteDaerahModal')"
                            class="mr-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-900">Batal</button>
                        <button type="submit" id="deleteDaerahButton"
                            class="rounded-lg bg-red-500 px-4 py-2 font-semibold text-white hover:bg-red-600"
                            disabled>Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
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

        function openEditDaerahModal(id, kecamatan, provinsi) {
            document.getElementById('editDaerahId').value = id;
            document.getElementById('editNamaDaerah').value = kecamatan;
            document.getElementById('editProvinsi').value = provinsi;
            document.getElementById('editDaerahForm').action = `/dinas/daerah/${id}`;
            openModal('editDaerahModal');
        }

        function openDeleteModal(id, kecamatan, count) {
            const form = document.getElementById('deleteDaerahForm');
            const deleteMessage = document.getElementById('deleteDaerahMessage');
            const deleteButton = document.getElementById('deleteDaerahButton');
            const cancelButton = document.querySelector('#deleteDaerahModal button[type="button"]');

            // Ensure count is a number
            count = Number(count) || 0;

            // Set form action URL
            form.action = `/dinas/daerah/${id}`;

            // Update delete message and button state based on count
            if (count > 0) {
                deleteMessage.innerHTML =
                    `Anda tidak dapat menghapus daerah "${kecamatan}" karena digunakan pada ${count} objek wisata.`;
                deleteButton.style.display = 'none'
                cancelButton.style.display = 'none';
            } else {
                deleteMessage.innerHTML = `Apakah Anda yakin ingin menghapus daerah "${kecamatan}"?`;
                deleteButton.disabled = false;
                deleteButton.classList.add('bg-red-500', 'hover:bg-red-600', 'text-white');
                deleteButton.classList.remove('text-gray-400', 'hover:bg-transparent', 'hover:text-gray-400');
            }

            // Open the delete modal
            openModal('deleteDaerahModal');
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
        function searchDaerah(query) {
            axios.get('{{ route('dinas.daerah.index') }}', {
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
            searchDaerah(event.target.value);
        }, 100); // 100 ms debounce delay

        // Event listener for search input
        document.getElementById('search').addEventListener('input', debouncedSearch);

        function sortTable(columnName) {
            const table = document.getElementById('daerah-table');
            const sortOrder = table.getAttribute('data-sort-order') === 'asc' ? 'desc' : 'asc';

            axios.get('{{ route('dinas.daerah.index') }}', {
                    params: {
                        search: document.getElementById('search').value,
                        sortColumn: columnName,
                        sortOrder: sortOrder
                    }
                })
                .then(response => {
                    document.querySelector('tbody').innerHTML = response.data;
                    table.setAttribute('data-sort-order', sortOrder);
                })
                .catch(error => {
                    console.error('Error during sorting:', error);
                });
        }
    </script>
    @endpush
</x-dinas.layout>
