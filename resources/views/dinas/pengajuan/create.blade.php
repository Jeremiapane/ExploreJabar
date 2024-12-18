<x-dinas.layout title="Buat Pengajuan Baru">

    <!-- Toast Container -->
    <x-dinas.toast-container :errors="$errors" :session="session()" />
    <div class="container mx-auto min-w-full rounded-lg bg-white p-6 px-4 shadow-lg sm:px-6 lg:px-8">
        <a href="{{ route('dinas.pengajuan.index') }}"
            class="mb-4 inline-block font-semibold text-primary-500 hover:text-primary-600">
            &larr; Kembali
        </a>
        <h1 class="mb-4 text-2xl font-bold">Buat Pengajuan Baru</h1>

        <!-- Form untuk membuat pengajuan baru -->
        <form action="{{ route('dinas.pengajuan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Judul Pengajuan -->
            <div class="mb-4">
                <label for="judul" class="mb-2 block text-sm font-bold text-gray-700">Judul</label>
                <input type="text" id="judul" name="judul" required
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Deskripsi Pengajuan -->
            <div class="mb-4">
                <label for="deskripsi" class="mb-2 block text-sm font-bold text-gray-700">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" required
                    class="mt-1 block min-h-[150px] w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"></textarea>
            </div>

            <!-- Upload Dokumen -->
            <div class="mb-4">
                <label for="dokumen" class="mb-2 block text-sm font-bold text-gray-700">Dokumen</label>
                <input type="file" id="dokumen" name="dokumen" required
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Pilihan Approver 1 -->
            <div class="mb-4">
                <label for="approver1_id" class="mb-2 block text-sm font-bold text-gray-700">Approver 1</label>
                <select id="approver1_id" name="approver1_id" required
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                    onchange="toggleApprover2()">
                    <option value="">Pilih Approver 1</option>
                    @foreach ($pegawais as $pegawai)
                        @if ($pegawai->id != Auth::guard('pegawai')->id())
                            <option value="{{ $pegawai->id }}">{{ $pegawai->nama }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- Pilihan Approver 2 -->
            <div class="mb-6">
                <label for="approver2_id" class="mb-2 block text-sm font-bold text-gray-700">Approver 2
                    (Opsional)</label>
                <select id="approver2_id" name="approver2_id"
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                    <option value="">Pilih Approver 2</option>
                    @foreach ($pegawais as $pegawai)
                        @if ($pegawai->id != Auth::guard('pegawai')->id())
                            <option value="{{ $pegawai->id }}">{{ $pegawai->nama }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit"
                class="rounded-md bg-primary-500 px-4 py-2 font-bold text-white hover:bg-primary-600">Buat
                Pengajuan</button>
        </form>
    </div>

    <!-- JavaScript untuk Logika Approver -->
    @push('scripts')
        <script>
            function toggleApprover2() {
                const approver1 = document.getElementById('approver1_id').value;
                const approver2 = document.getElementById('approver2_id');

                // Enable atau disable field Approver 2
                approver2.disabled = !approver1;

                // Reset nilai Approver 2 jika Approver 1 diubah
                if (!approver1) {
                    approver2.value = '';
                }

                // Tampilkan atau sembunyikan opsi untuk Approver 2
                for (let option of approver2.options) {
                    if (option.value === approver1) {
                        option.style.display = 'none';
                    } else {
                        option.style.display = 'block';
                    }
                }
            }

            // Inisialisasi status Approver 2 saat halaman dimuat
            document.addEventListener('DOMContentLoaded', (event) => {
                toggleApprover2();
            });

            // Pastikan Approver 2 diset ke default saat Approver 1 diubah
            document.getElementById('approver1_id').addEventListener('change', () => {
                const approver1Value = document.getElementById('approver1_id').value;
                const approver2 = document.getElementById('approver2_id');
                if (approver2.value === approver1Value) {
                    approver2.value = '';
                }
                toggleApprover2();
            });
        </script>
    @endpush
</x-dinas.layout>
