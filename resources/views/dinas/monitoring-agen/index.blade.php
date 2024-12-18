<x-dinas.layout title="Monitoring Agen Perjalanan">

    <!-- Toast Container -->
    <x-dinas.toast-container :errors="$errors" :session="session()" />

    <div class="container mx-auto rounded-lg bg-white p-6 shadow-md">
        <!-- Heading and Description -->
        <div class="mb-6 flex flex-row items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-gray-800">Daftar Agen Terverifikasi</h1>
                <p class="mt-2 text-gray-600">
                    Berikut adalah daftar agen perjalanan yang telah terverifikasi dan memenuhi standar layanan kami.
                    Proses monitoring ini bertujuan untuk mendukung pengambilan keputusan yang lebih baik dalam
                    manajemen pariwisata di Jawa Barat, memastikan setiap agen memenuhi kualitas dan keandalan yang
                    diharapkan.
                </p>
            </div>
        </div>

        <!-- Search Bar -->
        <x-dinas.search-bar id="search" placeholder="Cari agen berdasarkan nama" />

        <!-- Table -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table id="agen-table" class="min-w-full overflow-hidden rounded-lg bg-white shadow-md">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th scope="col" class="sortable cursor-pointer px-6 py-3" data-column="nama_perusahaan"
                            data-order="desc" onclick="sortTable('nama_perusahaan')">
                            <div class="flex items-center">
                                Nama Perusahaan
                                <svg class="ml-1.5 h-4 w-4 transform transition-transform" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Telepon
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Status
                            </div>
                        </th>
                        <th scope="col" class="sortable cursor-pointer px-6 py-3" data-column="tanggal_verifikasi"
                            data-order="desc" onclick="sortTable('tanggal_verifikasi')">
                            <div class="flex items-center">
                                Tanggal Verifikasi
                                <svg class="ml-1.5 h-4 w-4 transform transition-transform" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @include('dinas.monitoring-agen.partials.table', ['agens' => $agens])
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $agens->links() }}
        </div>
    </div>

    <!-- JavaScript -->
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
                axios.get('{{ route('dinas.monitoring-agen.index') }}', {
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

            function sortTable(column) {
                const table = document.getElementById('agen-table');
                const sortDirection = table.querySelector(`th[data-column="${column}"]`).dataset.order;
                const newDirection = sortDirection === 'asc' ? 'desc' : 'asc';
                table.querySelectorAll('.sortable').forEach(th => th.dataset.order = 'desc'); // Reset all
                table.querySelector(`th[data-column="${column}"]`).dataset.order = newDirection;

                axios.get('{{ route('dinas.monitoring-agen.index') }}', {
                        params: {
                            search: document.getElementById('search').value,
                            sort: column,
                            direction: newDirection
                        }
                    })
                    .then(response => document.querySelector('tbody').innerHTML = response.data)
                    .catch(error => console.error('Error during sorting:', error));
            }
        </script>
    @endpush
</x-dinas.layout>
