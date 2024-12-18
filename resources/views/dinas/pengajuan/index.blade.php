<x-dinas.layout title="Riwayat Pengajuan">

    <!-- Toast Container -->
    <x-dinas.toast-container :errors="$errors" :session="session()" />

    <div class="container mx-auto rounded-lg bg-white p-6 shadow-md">
        <div class="mb-6 flex flex-col items-center justify-between sm:flex-row">
            <div class="mb-4 w-full sm:mb-0 sm:w-auto">
                <h1 class="text-3xl font-semibold text-gray-800">Kelola Pengajuan</h1>
                <p class="mt-2 text-gray-600">Di bawah ini adalah daftar riwayat pengajuan yang telah Anda buat. Anda
                    dapat mengurutkan dan melihat detail dari setiap pengajuan.</p>
            </div>
            <div class="mt-4 w-full sm:mt-0 sm:w-auto">
                <a href="{{ route('dinas.pengajuan.create') }}"
                    class="flex items-center rounded-lg bg-primary-500 px-4 py-2 font-semibold text-white hover:bg-primary-600">
                    <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Buat Pengajuan
                </a>
            </div>
        </div>

        <!-- Search bar-->
        <x-dinas.search-bar id="search" placeholder="Cari berdasarkan judul pengajuan" />

        <!-- Table -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table id="pengajuan-table" class="min-w-full overflow-hidden rounded-lg bg-white shadow-md">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th scope="col" class="cursor-pointer px-6 py-3" data-column="judul" data-direction="asc">
                            <div class="flex items-center">
                                Judul
                                <svg class="ms-1.5 h-4 w-4 min-w-[1rem] max-w-[1.5rem]" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="cursor-pointer px-6 py-3" data-column="created_at"
                            data-direction="asc">
                            <div class="flex items-center">
                                Tanggal Buat
                                <svg class="ms-1.5 h-4 w-4 min-w-[1rem] max-w-[1.5rem]" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">Approver</th>
                        <th scope="col" class="px-6 py-3 text-left">Status</th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @include('dinas.pengajuan.partials.table', ['pengajuans' => $pengajuans])
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $pengajuans->links() }}
        </div>
    </div>

    <!-- JavaScript for Sorting and Modal Handling -->
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Add event listeners to table headers
                document.querySelectorAll('th.cursor-pointer').forEach(th => {
                    th.addEventListener('click', function() {
                        const column = this.getAttribute('data-column');
                        const sortDirection = this.getAttribute('data-direction') === 'asc' ? 'desc' :
                            'asc';
                        this.setAttribute('data-direction', sortDirection);
                        sortTable(column, sortDirection);
                    });
                });

                function sortTable(column, direction) {
                    axios.get('{{ route('dinas.pengajuan.index') }}', {
                            params: {
                                sort_by: column,
                                sort_direction: direction
                            }
                        })
                        .then(response => {
                            document.querySelector('tbody').innerHTML = response.data.html;
                            document.querySelector('.pagination').innerHTML = response.data.pagination;
                        })
                        .catch(error => {
                            console.error('Error during sorting:', error);
                        });
                }
            });


            function toggleModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.toggle('hidden');
                    modal.classList.toggle('flex');
                }
            }

            function debounce(func, wait) {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            }

            function searchData(query) {
                axios.get('{{ route('dinas.pengajuan.index') }}', {
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

            const debouncedSearch = debounce(function(event) {
                searchData(event.target.value);
            }, 100);

            document.getElementById('search').addEventListener('input', debouncedSearch);
        </script>
    @endpush
</x-dinas.layout>
