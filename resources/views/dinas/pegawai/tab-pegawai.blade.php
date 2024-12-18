<div class="mb-8 mt-2 rounded-lg p-4 shadow">
    <div class="mb-6 flex flex-col items-center justify-between sm:flex-row">
        <h2 class="text-xl font-semibold">Manajemen Pegawai</h2>
        <button onclick="openModal('tambahPegawaiModal')"
            class="flex items-center rounded-lg bg-primary-500 px-4 py-2 font-semibold text-white transition duration-300 hover:bg-primary-600">
            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Akun
        </button>
    </div>

    <div class="relative overflow-x-auto sm:rounded-lg">
        <table class="min-w-full overflow-hidden rounded-lg bg-white shadow-md">
            <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 text-left text-gray-700">Nama Pegawai</th>
                    <th class="px-4 py-2 text-left text-gray-700">Jabatan</th>
                    <th class="px-4 py-2 text-left text-gray-700">Foto Profil</th>
                    <th class="px-8 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="text-sm font-medium text-gray-900">
                @foreach ($pegawais as $pegawai)
                    <tr class="border-b bg-white hover:bg-gray-100">
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">{{ $pegawai->nama }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">{{ $pegawai->jabatan->nama }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                            @if ($pegawai->foto)
                                <img src="{{ asset('storage/' . $pegawai->foto) }}" alt="Foto Pegawai"
                                    class="h-16 w-16 rounded-full">
                            @else
                                <span class="text-gray-500">Tidak ada foto</span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-900">
                            <!-- Tombol Hapus -->
                            <button onclick="openModal('confirmDeletePegawaiModal{{ $pegawai->id }}')"
                                class="rounded-lg px-2 py-1 text-red-500 transition duration-300 hover:text-red-600">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Pegawai -->
    <div id="tambahPegawaiModal" tabindex="-1" aria-hidden="true"
        class="fixed inset-0 z-50 hidden items-center justify-center overflow-y-auto bg-gray-900 bg-opacity-50 transition-opacity duration-300">
        <div class="max-h-md relative w-full max-w-2xl rounded-lg bg-white shadow-lg">
            <div class="flex items-start justify-between rounded-t p-4 dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Tambah Akun Pegawai
                </h3>
                <button type="button" onclick="closeModal('tambahPegawaiModal')"
                    class="inline-flex items-center rounded-lg p-1.5 text-sm text-gray-400 transition duration-300 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form action="{{ route('dinas.manajemen-pegawai.store-pegawai') }}" method="POST"
                enctype="multipart/form-data" class="gap-1 p-6">
                @csrf
                <div class="mb-2">
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50 sm:text-sm">
                    @error('nama')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50 sm:text-sm">
                    @error('email')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50 sm:text-sm">
                    @error('password')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi
                        Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50 sm:text-sm">
                    @error('password_confirmation')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="jabatan_id" class="block text-sm font-medium text-gray-700">Jabatan</label>
                    <select id="jabatan_id" name="jabatan_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50 sm:text-sm">
                        <option value="">Pilih Jabatan</option>
                        @foreach ($jabatans as $jabatan)
                            <option value="{{ $jabatan->id }}">{{ $jabatan->nama }}</option>
                        @endforeach
                    </select>
                    @error('jabatan_id')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
                    <input type="file" id="foto" name="foto"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50 sm:text-sm">
                    @error('foto')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="rounded-lg bg-primary-500 px-4 py-2 font-medium text-white transition-colors hover:bg-primary-600">Simpan</button>
                </div>
            </form>

        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    @foreach ($pegawais as $pegawai)
        <div id="confirmDeletePegawaiModal{{ $pegawai->id }}" tabindex="-1" aria-hidden="true"
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
                        Apakah Anda yakin ingin menghapus Pegawai ini?</h3>
                    <p class="mb-5 text-sm font-normal text-gray-500 dark:text-gray-400">Semua data yang berkaitan
                        dengan pegawai ini akan hilang seperti artikel, pengajuan dan objek
                        wisata</p>
                    <form action="{{ route('dinas.manajemen-pegawai.destroy-pegawai', $pegawai->id) }}"
                        method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="rounded-lg px-4 py-2 text-red-500 duration-300 hover:text-red-600">
                            Ya, Hapus
                        </button>
                        <button type="button" onclick="closeModal('confirmDeletePegawaiModal{{ $pegawai->id }}')"
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
