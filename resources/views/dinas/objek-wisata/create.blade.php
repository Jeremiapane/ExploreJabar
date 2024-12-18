<x-dinas.layout title="Tambah Objek Wisata">
    <!-- Toast Container -->
    <x-dinas.toast-container :errors="$errors" :session="session()" />

    <div class="container mx-auto min-w-full rounded-lg bg-white p-6 px-4 shadow-lg sm:px-6 lg:px-8">
        <a href="{{ route('dinas.objek-wisata.index') }}"
            class="mb-4 inline-block font-semibold text-primary-500 hover:text-primary-600">
            &larr; Kembali
        </a>
        <h1 class="mb-4 text-2xl font-bold">Tambah Data Objek</h1>
        <!-- Form Container -->

        <form action="{{ route('dinas.objek-wisata.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="nama" class="mb-2 block text-sm font-bold text-gray-700">Nama</label>
                <input type="text" name="nama" id="nama"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    value="{{ old('nama') }}" required>
            </div>
            <div class="mb-4">
                <label for="kategori_id" class="mb-2 block text-sm font-bold text-gray-700">Kategori</label>
                <select name="kategori_id" id="kategori_id"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
                    @foreach ($kategoriWisatas as $kategoriWisata)
                        <option value="{{ $kategoriWisata->id }}">{{ $kategoriWisata->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="daerah_id" class="mb-2 block text-sm font-bold text-gray-700">Daerah</label>
                <select name="daerah_id" id="daerah_id"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
                    @foreach ($daerahs as $daerah)
                        <option value="{{ $daerah->id }}">{{ $daerah->kecamatan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="detail" class="mb-2 block text-sm font-bold text-gray-700">Detail</label>
                <textarea name="detail" id="detail" rows="5"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>{{ old('detail') }}</textarea>
            </div>
            <div class="mb-4">
                <label for="url_peta" class="mb-2 block text-sm font-bold text-gray-700">URL Peta</label>
                <input type="url" name="url_peta" id="url_peta"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    value="{{ old('url_peta') }}" required>
            </div>
            <div class="mb-4">
                <label for="images" class="mb-2 block text-sm font-bold text-gray-700">
                    Gambar (Maksimal 5, Maks 5MB per gambar)
                </label>
                <input type="file" name="images[]" id="images"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    accept="image/*" multiple required>
                <p id="file-count-warning" class="mt-2 hidden text-red-500">
                    Anda hanya dapat memilih hingga 5 gambar.
                </p>
                <p id="file-type-warning" class="mt-2 hidden text-red-500">
                    Hanya file gambar dengan ukuran maksimal 5MB yang diperbolehkan.
                </p>
            </div>
            <div id="image-previews" class="mb-4">
                <!-- Preview images will be added here -->
            </div>
            <div class="mb-4">
                <label for="status" class="mb-2 block text-sm font-bold text-gray-700">Status</label>
                <select name="status" id="status"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
                    <option value="active">Aktif</option>
                    <option value="inactive">Tidak Aktif</option>
                </select>
            </div>
            <button type="submit"
                class="rounded-md bg-primary-500 px-4 py-2 font-bold text-white hover:bg-primary-600">Tambah
                Objek Wisata</button>
        </form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const imageInput = document.getElementById('images');
                const previewContainer = document.getElementById('image-previews');
                const fileCountWarning = document.getElementById('file-count-warning');
                const fileTypeWarning = document.getElementById('file-type-warning');

                imageInput.addEventListener('change', () => {
                    const files = imageInput.files;
                    const maxFiles = 5; // Maximum number of files
                    const maxFileSize = 5 * 1024 * 1024; // 5MB in bytes
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

                    // Clear previous previews
                    previewContainer.innerHTML = '';
                    let validFiles = [];

                    // Filter valid files
                    Array.from(files).forEach(file => {
                        if (file.size <= maxFileSize && allowedTypes.includes(file.type)) {
                            validFiles.push(file);
                        }
                    });

                    // Show warnings if necessary
                    if (validFiles.length > maxFiles) {
                        fileCountWarning.classList.remove('hidden');
                        validFiles = validFiles.slice(0, maxFiles);

                        setTimeout(() => {
                            fileCountWarning.classList.add('hidden');
                        }, 3000); // Hide after 3 seconds
                    }

                    if (validFiles.length !== files.length) {
                        fileTypeWarning.classList.remove('hidden');

                        setTimeout(() => {
                            fileTypeWarning.classList.add('hidden');
                        }, 3000); // Hide after 3 seconds
                    }

                    // Update the input files
                    const dataTransfer = new DataTransfer();
                    validFiles.forEach(file => dataTransfer.items.add(file));
                    imageInput.files = dataTransfer.files;

                    // Display previews for valid files
                    validFiles.forEach(file => {
                        const reader = new FileReader();
                        const previewDiv = document.createElement('div');
                        previewDiv.classList.add('relative', 'inline-block', 'mr-2');

                        reader.onload = (e) => {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.classList.add('w-32', 'h-32', 'object-cover', 'border',
                                'border-gray-300', 'rounded');
                            previewDiv.appendChild(img);

                            const removeBtn = document.createElement('button');
                            removeBtn.type = 'button';
                            removeBtn.textContent = 'Hapus';
                            removeBtn.classList.add('absolute', 'top-0', 'right-0', 'bg-red-500',
                                'text-white', 'px-2', 'py-1', 'text-xs', 'rounded');
                            removeBtn.addEventListener('click', () => {
                                previewDiv.remove();
                                // Remove the file from input
                                const newFiles = Array.from(imageInput.files).filter(f =>
                                    f !== file);
                                const newTransfer = new DataTransfer();
                                newFiles.forEach(f => newTransfer.items.add(f));
                                imageInput.files = newTransfer.files;

                                if (imageInput.files.length <= maxFiles) {
                                    fileCountWarning.classList.add('hidden');
                                }
                            });
                            previewDiv.appendChild(removeBtn);

                            previewContainer.appendChild(previewDiv);
                        };

                        reader.readAsDataURL(file);
                    });
                });
            });
        </script>
    @endpush
</x-dinas.layout>
