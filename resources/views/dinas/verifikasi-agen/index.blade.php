<x-dinas.layout title="Verifikasi Agen Perjalanan">

    <!-- Toast Container -->
    <x-dinas.toast-container :errors="$errors" :session="session()" />

    <div class="container mx-auto rounded-lg bg-white p-6 shadow-md">
        <!-- Heading and Description -->
        <div class="mb-6 flex flex-row items-center justify-between">
            <div class="mb-2 w-auto">
                <h1 class="text-3xl font-semibold text-gray-800">Agen Belum Diverifikasi</h1>
                <p class="mt-2 text-gray-600">Tabel ini menampilkan agen yang belum diverifikasi. Verifikasi diperlukan
                    untuk memastikan agen memenuhi syarat dan standar kami sebelum bergabung sepenuhnya. Silakan periksa
                    detail dan lakukan verifikasi sesuai prosedur.</p>
            </div>
        </div>

        <!-- Table -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="min-w-full overflow-hidden rounded-lg bg-white shadow-md">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th scope="col" class="cursor-pointer px-6 py-3">
                            <a href="{{ route('dinas.verifikasi-agen.index', [
                                'sort' => 'nama_perusahaan',
                                'direction' => $sortColumn === 'nama_perusahaan' && $sortDirection === 'asc' ? 'desc' : 'asc',
                            ]) }}"
                                class="flex items-center">
                                Nama Perusahaan
                                <svg class="{{ $sortColumn === 'nama_perusahaan' ? ($sortDirection === 'asc' ? 'rotate-180' : '') : '' }} ml-1 h-4 w-4"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg>
                            </a>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">
                            Telepon
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">
                            Status
                        </th>
                        <th scope="col" class="cursor-pointer px-6 py-3">
                            <a href="{{ route('dinas.verifikasi-agen.index', [
                                'sort' => 'created_at',
                                'direction' => $sortColumn === 'created_at' && $sortDirection === 'asc' ? 'desc' : 'asc',
                            ]) }}"
                                class="flex items-center">
                                Tanggal Daftar
                                <svg class="{{ $sortColumn === 'created_at' ? ($sortDirection === 'asc' ? 'rotate-180' : '') : '' }} ml-1 h-4 w-4"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg>
                            </a>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse ($agens as $agen)
                        <tr class="transition-colors duration-200 hover:bg-gray-100">
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                {{ \Str::limit($agen->nama_perusahaan, 50, '...') }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                {{ $agen->no_telp_perusahaan ?? '-' }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                @if ($agen->status_verifikasi == 'diproses')
                                    <span
                                        class="inline-flex rounded-full bg-yellow-100 px-2 text-xs font-semibold leading-5 text-yellow-800">
                                        Belum Diverifikasi
                                    </span>
                                @elseif($agen->status_verifikasi == 'pending')
                                    <span
                                        class="inline-flex rounded-full bg-yellow-100 px-2 text-xs font-semibold leading-5 text-yellow-800">
                                        Revisi
                                    </span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                {{ $agen->created_at->format('d M Y') }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-900">
                                @if ($agen->status_verifikasi === 'diproses' || $agen->status_verifikasi === 'pending')
                                    <a href="{{ route('dinas.verifikasi-agen.show', $agen->id) }}"
                                        class="mr-1 font-medium text-blue-600 hover:underline dark:text-blue-500">Periksa</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-900">
                                Tidak ada hasil ditemukan. Periksa kata kunci atau coba kata lain.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $agens->appends(['sort' => $sortColumn, 'direction' => $sortDirection])->links() }}
        </div>
    </div>

</x-dinas.layout>
