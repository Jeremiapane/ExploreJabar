<x-dinas.layout title="Buat Pemberitahuan Baru">
    <!-- Toast Container -->
    <x-dinas.toast-container :errors="$errors" :session="session()" />

    <div class="container mx-auto min-w-full rounded-lg bg-white p-6 px-4 shadow-lg sm:px-6 lg:px-8">
        <a href="{{ route('dinas.pemberitahuan.index') }}"
            class="mb-4 inline-block font-semibold text-primary-500 hover:text-primary-600">
            &larr; Kembali
        </a>
        <h1 class="mb-4 text-2xl font-bold">Buat Pemberitahuan Baru</h1>

        <!-- Form untuk membuat pemberitahuan baru -->
        <form action="{{ route('dinas.pemberitahuan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Pilih Agen -->
            <div class="mb-4">
                <label for="penerima_id" class="mb-2 block text-sm font-bold text-gray-700">Pilih Agen</label>
                <select id="penerima_id" name="penerima_id" required
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                    <option value="">Pilih Agen</option>
                    @foreach ($agens as $agen)
                        <option value="{{ $agen->id }}">{{ $agen->nama_perusahaan }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Perihal pemberitahuan -->
            <div class="mb-4">
                <label for="perihal" class="mb-2 block text-sm font-bold text-gray-700">Perihal</label>
                <input type="text" id="perihal" name="perihal" required
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Deskripsi pemberitahuan -->
            <div class="mb-4">
                <label for="isi" class="mb-2 block text-sm font-bold text-gray-700">Deskripsi</label>
                <textarea id="isi" name="isi" required
                    class="mt-1 block min-h-[150px] w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"></textarea>
            </div>

            <!-- Upload lampiran -->
            <div class="mb-4">
                <label for="lampiran" class="mb-2 block text-sm font-bold text-gray-700">Lampiran</label>
                <input type="file" id="lampiran" name="lampiran"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-between">
                <button type="submit"
                    class="rounded-md bg-primary-500 px-4 py-2 font-bold text-white hover:bg-primary-600">
                    Kirim Pemberitahuan
                </button>
            </div>
        </form>
    </div>
</x-dinas.layout>
