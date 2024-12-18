<form action="{{ route('aduan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Judul Aduan -->
    <div class="mb-4">
        <label for="judul" class="block text-sm font-medium text-gray-700">Judul Aduan</label>
        <input type="text" name="judul" id="judul" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            placeholder="Masukkan judul aduan">
    </div>

    <!-- Deskripsi -->
    <div class="mb-4">
        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" rows="4" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            placeholder="Masukkan deskripsi aduan"></textarea>
    </div>

    <!-- Tanggal Kejadian -->
    <div class="mb-4">
        <label for="tanggal_kejadian" class="block text-sm font-medium text-gray-700">Tanggal Kejadian</label>
        <input type="date" name="tanggal_kejadian" id="tanggal_kejadian" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
    </div>

    <!-- Bukti (Wajib) -->
    <div class="mb-4">
        <label for="bukti_path" class="block text-sm font-medium text-gray-700">Unggah Bukti</label>
        <input type="file" name="bukti_path" id="bukti_path" required accept=".jpg,.jpeg,.png,.pdf"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        <p class="mt-1 text-sm text-gray-500">Maksimal ukuran file: 2MB. Format yang diizinkan: jpg, jpeg, png, pdf.</p>
    </div>

    <!-- Submit Button -->
    <div class="flex justify-end">
        <button type="submit"
            class="rounded-lg bg-blue-500 px-4 py-2 text-white transition duration-200 hover:bg-blue-600">
            Submit
        </button>
    </div>
</form>
