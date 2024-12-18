<x-dinas.layout title="Verifikasi Aduan">

    <!-- Toast Container -->
    <x-dinas.toast-container :errors="$errors" :session="session()" />

    <div class="container mx-auto rounded-lg bg-white p-6 shadow-md">
        <div class="mb-6 flex flex-row items-center justify-between">
            <div class="mb-4 w-full sm:mb-0 sm:w-auto">
                <h1 class="text-3xl font-semibold text-gray-800">Daftar Aduan Masuk</h1>
                <p class="text-gray-600">Berikut adalah daftar aduan yang telah masuk. Klik tombol "Periksa" untuk
                    melihat detail aduan dan melakukan verifikasi.</p>
            </div>
        </div>

        <!-- Search bar-->
        <x-dinas.search-bar id="search" placeholder="Cari berdasarkan judul aduan" />

        <!-- Table -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table id="aduan-table" class="min-w-full overflow-hidden rounded-lg bg-white shadow-md">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th scope="col" class="cursor-pointer px-6 py-3" data-sort="pengirim" data-column="0"
                            onclick="sortTable(0)">
                            <div class="flex items-center">
                                Nama Pengirim
                                <svg class="ms-1.5 h-4 w-4 min-w-[1rem] max-w-[1.5rem]" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="cursor-pointer px-6 py-3" data-sort="judul" data-column="1"
                            onclick="sortTable(1)">
                            <div class="flex items-center">
                                Judul
                                <svg class="ms-1.5 h-4 w-4 min-w-[1rem] max-w-[1.5rem]" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="cursor-pointer px-6 py-3" data-sort="tanggal" data-column="2"
                            onclick="sortTable(2)">
                            <div class="flex items-center">
                                Tanggal Masuk
                                <svg class="ms-1.5 h-4 w-4 min-w-[1rem] max-w-[1.5rem]" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">
                            Status
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Aksi
                        </th>

                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @include('dinas.aduan.partials.table', ['aduans' => $aduans])
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $aduans->links() }}
        </div>
    </div>

    @push('scripts')
        <script>
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
                axios.get('{{ route('dinas.verifikasi-aduan.index') }}', {
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

            function sortTable(columnIndex) {
                const table = document.getElementById('aduan-table');
                const tbody = table.querySelector('tbody');
                const rows = Array.from(tbody.querySelectorAll('tr'));
                const isAscending = table.dataset.sortOrder === 'asc';
                table.dataset.sortOrder = isAscending ? 'desc' : 'asc';

                rows.sort((rowA, rowB) => {
                    const cellA = rowA.querySelector(`td:nth-child(${columnIndex + 1})`).textContent.trim();
                    const cellB = rowB.querySelector(`td:nth-child(${columnIndex + 1})`).textContent.trim();

                    if (columnIndex === 2) { // Sort by date
                        const dateA = new Date(cellA);
                        const dateB = new Date(cellB);
                        return isAscending ? dateA - dateB : dateB - dateA;
                    } else { // Sort by text
                        return isAscending ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
                    }
                });

                tbody.innerHTML = '';
                rows.forEach(row => tbody.appendChild(row));
            }
        </script>
    @endpush
</x-dinas.layout>
