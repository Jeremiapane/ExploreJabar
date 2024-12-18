<div class="mb-8 mt-2 rounded-lg p-4 shadow">
    <div class="mb-6 flex flex-col items-center justify-between sm:flex-row">
        <h2 class="text-xl font-semibold">Manajemen Jabatan</h2>
        <button onclick="openModal('tambahJabatanModal')"
            class="flex items-center rounded-lg bg-primary-500 px-4 py-2 font-semibold text-white transition duration-300 hover:bg-primary-600">
            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Jabatan
        </button>
    </div>

    <div class="relative overflow-x-auto sm:rounded-lg">
        <table class="min-w-full overflow-hidden rounded-lg bg-white shadow-md">
            <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 text-left text-gray-700">Nama Jabatan</th>
                    <th class="px-8 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="text-sm font-medium text-gray-900">
                @foreach ($jabatans as $jabatan)
                    <tr class="border-b bg-white hover:bg-gray-100">
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">{{ $jabatan->nama }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-900">
                            <!-- Tombol Ubah -->
                            <button onclick="openModal('ubahJabatanModal{{ $jabatan->id }}')"
                                class="mr-1 font-medium text-blue-600 transition duration-300 hover:underline dark:text-blue-500">
                                Ubah
                            </button>
                            <!-- Tombol Hapus -->
                            <button onclick="openModal('confirmDeleteJabatanModal{{ $jabatan->id }}')"
                                class="rounded-lg px-2 py-1 text-red-500 transition duration-300 hover:text-red-600">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Jabatan -->
    <div id="tambahJabatanModal" tabindex="-1" aria-hidden="true"
        class="fixed inset-0 z-50 hidden items-center justify-center overflow-y-auto bg-gray-900 bg-opacity-50 transition-opacity duration-300">
        <div class="relative w-full max-w-2xl rounded-lg bg-white p-4 shadow-lg md:h-auto">
            <div class="flex items-start justify-between rounded-t border-b p-4 dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Tambah Jabatan
                </h3>
                <button type="button" onclick="closeModal('tambahJabatanModal')"
                    class="inline-flex items-center rounded-lg p-1.5 text-sm text-gray-400 transition duration-300 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="space-y-6 p-6">
                <form action="{{ route('dinas.manajemen-pegawai.store-jabatan') }}" method="POST">
                    @csrf
                    <div class="flex flex-col gap-4">
                        <div class="flex flex-col">
                            <label for="nama" class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Nama
                                Jabatan</label>
                            <input type="text" name="nama" id="nama" placeholder="Nama Jabatan"
                                class="w-full rounded-lg border border-gray-300 p-2 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                required>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button type="button" onclick="closeModal('tambahJabatanModal')"
                            class="mr-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-900">Batal</button>
                        <button type="submit"
                            class="rounded-lg bg-primary-500 px-6 py-2 font-medium text-white duration-300 hover:bg-primary-600">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Ubah Jabatan -->
    @foreach ($jabatans as $jabatan)
        <div id="ubahJabatanModal{{ $jabatan->id }}" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 hidden items-center justify-center overflow-y-auto bg-gray-900 bg-opacity-50 transition-opacity duration-300">
            <div class="relative w-full max-w-2xl rounded-lg bg-white p-4 shadow-lg md:h-auto">
                <div class="flex items-start justify-between rounded-t border-b p-4 dark:border-gray-600">
                    <h2 class="text-xl font-semibold">
                        Ubah Jabatan
                    </h2>
                    <button type="button" onclick="closeModal('ubahJabatanModal{{ $jabatan->id }}')"
                        class="inline-flex items-center rounded-lg p-1.5 text-sm text-gray-400 transition duration-300 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="space-y-6 p-6">
                    <form action="{{ route('dinas.manajemen-pegawai.update-jabatan', $jabatan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="nama{{ $jabatan->id }}"
                                class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Nama Jabatan</label>
                            <input type="text" name="nama" id="nama{{ $jabatan->id }}"
                                value="{{ $jabatan->nama }}"
                                class="w-full rounded-lg border border-gray-300 p-2 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                required>
                        </div>
                        <div class="flex items-center justify-end">
                            <button type="button" onclick="closeModal('ubahJabatanModal{{ $jabatan->id }}')"
                                class="mr-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-900">Batal</button>
                            <button type="submit"
                                class="rounded-lg bg-primary-500 px-4 py-2 font-semibold text-white hover:bg-primary-600">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Konfirmasi Hapus -->
    @foreach ($jabatans as $jabatan)
        <div id="confirmDeleteJabatanModal{{ $jabatan->id }}" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 hidden items-center justify-center overflow-y-auto bg-gray-900 bg-opacity-50 transition-opacity duration-300">
            <div class="relative w-full max-w-md rounded-lg bg-white p-4 shadow-lg md:h-auto">
                <div class="p-6 text-center">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor"
                        class="mx-auto mb-4 h-14 w-14 text-gray-400 dark:text-gray-200">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-700 dark:text-gray-400">
                        Apakah Anda yakin ingin menghapus jabatan ini?</h3>
                    <form action="{{ route('dinas.manajemen-pegawai.destroy-jabatan', $jabatan->id) }}"
                        method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="rounded-lg px-4 py-2 text-red-500 duration-300 hover:text-red-600">
                            Ya, Hapus
                        </button>
                        <button type="button" onclick="closeModal('confirmDeleteJabatanModal{{ $jabatan->id }}')"
                            class="mr-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-900">
                            Batal
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach


    @push('scripts')
        <script>
            // Function to open a modal by ID
            function openModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    document.body.style.overflow = 'hidden'; // Disable scrolling
                }
            }

            // Function to close a modal by ID
            function closeModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.body.style.overflow = 'auto'; // Enable scrolling
                }
            }

            // Add click event listener to close modals when clicking outside of the content
            window.addEventListener('click', function(event) {
                const modals = document.querySelectorAll('.fixed.inset-0');
                modals.forEach(function(modal) {
                    if (event.target === modal) {
                        closeModal(modal.id);
                    }
                });
            });
        </script>
    @endpush
</div>
