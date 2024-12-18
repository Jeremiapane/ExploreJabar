<x-dinas.layout title="Tanggapan">

    <!-- Toast Container -->
    <x-dinas.toast-container :errors="$errors" :session="session()" />

    <div class="container mx-auto rounded-lg bg-white p-6 shadow-md">
        <div class="mb-6 flex flex-row items-center justify-between">
            <div class="mb-2">
                <h1 class="mb-2 text-h3 text-neutral-black">Daftar Tanggapan Masuk</h1>
                <p class="text-gray-600">Di bawah ini adalah daftar tanggapan yang telah diterima. Klik tombol "Lihat
                    Detail" untuk mengakses informasi lengkap mengenai setiap tanggapan.</p>
            </div>
        </div>

        <!-- Search bar-->
        <x-dinas.search-bar id="search" placeholder="Cari tanggapan berdasarkan perihal" />

        <!-- Table -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table id="tanggapan-table" class="min-w-full overflow-hidden rounded-lg bg-white shadow-md">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th scope="col" class="cursor-pointer px-6 py-3" data-sort="pengirim" data-column="0"
                            onclick="sortTable('pengirim')">
                            <div class="flex items-center">
                                Pengirim
                                <svg class="ms-1.5 h-4 w-4 min-w-[1rem] max-w-[1.5rem]" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="cursor-pointer px-6 py-3" data-sort="perihal" data-column="1"
                            onclick="sortTable('perihal')">
                            <div class="flex items-center">
                                Perihal
                                <svg class="ms-1.5 h-4 w-4 min-w-[1rem] max-w-[1.5rem]" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="cursor-pointer px-6 py-3" data-sort="tanggal" data-column="2"
                            onclick="sortTable('tanggal')">
                            <div class="flex items-center">
                                Tanggal Masuk
                                <svg class="ms-1.5 h-4 w-4 min-w-[1rem] max-w-[1.5rem]" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @include('dinas.tanggapan.partials.table', [
                        'tanggapans' => $tanggapans,
                    ])
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $tanggapans->links() }}
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
                axios.get('{{ route('dinas.tanggapan.index') }}', {
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
            }, 300); // 300 ms debounce delay

            // Event listener for search input
            document.getElementById('search').addEventListener('input', debouncedSearch);

            // Function to sort table
            function sortTable(sortBy) {
                const table = document.getElementById('tanggapan-table');
                const th = Array.from(table.querySelectorAll('th')).find(th => th.dataset.sort === sortBy);
                const sortDirection = th.dataset.order || 'asc';
                const newDirection = sortDirection === 'asc' ? 'desc' : 'asc';

                // Reset all sorting indicators
                table.querySelectorAll('th').forEach(th => th.dataset.order = '');

                // Set the new sorting direction
                th.dataset.order = newDirection;

                // Make the AJAX request to fetch sorted data
                axios.get('{{ route('dinas.tanggapan.index') }}', {
                        params: {
                            search: document.getElementById('search').value,
                            sort: sortBy,
                            direction: newDirection
                        }
                    })
                    .then(response => {
                        document.querySelector('tbody').innerHTML = response.data;
                    })
                    .catch(error => console.error('Error during sorting:', error));
            }
        </script>
    @endpush
</x-dinas.layout>
