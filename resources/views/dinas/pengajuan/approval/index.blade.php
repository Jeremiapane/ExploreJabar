<x-dinas.layout title="Pengajuan untuk Persetujuan">

    <!-- Toast Container -->
    <x-dinas.toast-container :errors="$errors" :session="session()" />

    <div class="container mx-auto rounded-lg bg-white p-6 shadow-md">
        <div class="mb-6 flex flex-row items-center justify-between">
            <div class="mb-2">
                <h1 class="mb-2 text-h3 text-neutral-black">Daftar Pengajuan Masuk</h1>
                <p class="text-gray-600">
                    Berikut adalah daftar pengajuan yang telah diterima dalam sistem. Anda dapat mengklik tombol
                    "Periksa" pada setiap baris untuk meninjau detail lebih lanjut dari masing-masing pengajuan dan
                    mengambil keputusan yang diperlukan sesuai dengan prosedur yang berlaku.
                </p>
            </div>
        </div>

        @if ($pengajuans->isEmpty())
            <p class="text-center text-gray-500">Tidak ada pengajuan untuk disetujui.</p>
        @else
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table id="pengajuanTable" class="min-w-full overflow-hidden rounded-lg bg-white shadow-md">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                        <tr>
                            <th scope="col" class="cursor-pointer px-6 py-3" data-column="0" data-type="text">
                                <div class="flex items-center" onclick="sortTable(0, 'text')">
                                    Judul
                                    <svg class="ms-1.5 h-4 w-4 min-w-[1rem] max-w-[1.5rem]" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                    </svg>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left">Tanggal Pengajuan</th>
                            <th scope="col" class="px-6 py-3 text-left">Pemohon</th>
                            <th scope="col" class="px-6 py-3 text-left">Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach ($pengajuans as $pengajuan)
                            <tr class="transition-colors duration-200 hover:bg-gray-100">
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">{{ $pengajuan->judul }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                    {{ $pengajuan->created_at->format('d M Y') }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                    {{ $pengajuan->pemohon->nama }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                    @if ($pengajuan->status == 'pending approver 1' || $pengajuan->status == 'pending')
                                        <span
                                            class="inline-flex rounded-full bg-yellow-100 px-2 text-xs font-semibold leading-5 text-yellow-800">
                                            Menunggu Persetujuan
                                        </span>
                                    @elseif($pengajuan->status == 'pending approver 2')
                                        <span
                                            class="inline-flex rounded-full bg-yellow-100 px-2 text-xs font-semibold leading-5 text-yellow-800">
                                            Menunggu Approver 2
                                        </span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                    <a href="{{ route('dinas.approval.show', $pengajuan->id) }}"
                                        class="inline-flex items-center text-blue-600 hover:text-blue-900">Periksa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="mt-4">
                {{ $pengajuans->links() }}
            </div>
        @endif

    </div>

    <!-- JavaScript untuk Sorting Tabel -->
    @push('scripts')
        <script>
            function sortTable(columnIndex, type) {
                const table = document.getElementById('pengajuanTable');
                const rows = Array.from(table.querySelectorAll('tbody tr'));
                const header = table.querySelectorAll('th')[columnIndex];
                const isAscending = header.classList.contains('asc');

                // Toggle sorting direction
                header.classList.toggle('asc', !isAscending);
                header.classList.toggle('desc', isAscending);

                rows.sort((a, b) => {
                    const aCell = a.querySelector(`td:nth-child(${columnIndex + 1})`).textContent.trim();
                    const bCell = b.querySelector(`td:nth-child(${columnIndex + 1})`).textContent.trim();

                    if (type === 'date') {
                        return isAscending ? new Date(aCell) - new Date(bCell) : new Date(bCell) - new Date(aCell);
                    } else {
                        return isAscending ? aCell.localeCompare(bCell) : bCell.localeCompare(aCell);
                    }
                });

                rows.forEach(row => table.querySelector('tbody').appendChild(row));
            }

            document.addEventListener('DOMContentLoaded', function() {
                const sortableHeaders = document.querySelectorAll('th[data-column]');
                sortableHeaders.forEach(header => {
                    header.addEventListener('click', () => {
                        const columnIndex = header.getAttribute('data-column');
                        const type = header.getAttribute('data-type') || 'text';
                        sortTable(columnIndex, type);
                    });
                });
            });
        </script>
    @endpush
</x-dinas.layout>
