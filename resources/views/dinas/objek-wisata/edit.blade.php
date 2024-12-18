<x-dinas.layout title="Kelola Objek Wisata">
    <!-- Toast Container -->
    <x-dinas.toast-container :errors="$errors" :session="session()" />

    <div class="container mx-auto mt-4 rounded-lg bg-white p-6 shadow-lg">

        <!-- Tombol Kembali -->
        <a href="{{ route('dinas.objek-wisata.index') }}"
            class="mb-4 inline-block font-semibold text-primary-500 hover:text-primary-600">
            &larr; Kembali
        </a>

        <h1 class="mb-4 text-2xl font-bold">Edit Objek Wisata</h1>

        <!-- Form Utama -->
        <form action="{{ route('dinas.objek-wisata.update', $objekWisata->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Input Nama -->
            <div class="mb-4">
                <label for="nama" class="mb-2 block text-sm font-bold text-gray-700">Nama</label>
                <input type="text" name="nama" id="nama"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
                    value="{{ old('nama', $objekWisata->nama) }}" required>
                @error('nama')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input Kategori -->
            <div class="mb-4">
                <label for="kategori_id" class="mb-2 block text-sm font-bold text-gray-700">Kategori</label>
                <select name="kategori_id" id="kategori_id"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    @foreach ($kategoriWisatas as $kategoriWisata)
                        <option value="{{ $kategoriWisata->id }}"
                            {{ $kategoriWisata->id == $objekWisata->kategori_id ? 'selected' : '' }}>
                            {{ $kategoriWisata->nama }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input Daerah -->
            <div class="mb-4">
                <label for="daerah_id" class="mb-2 block text-sm font-bold text-gray-700">Daerah</label>
                <select name="daerah_id" id="daerah_id"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    @foreach ($daerahs as $daerah)
                        <option value="{{ $daerah->id }}"
                            {{ $daerah->id == $objekWisata->daerah_id ? 'selected' : '' }}>
                            {{ $daerah->kecamatan }}
                        </option>
                    @endforeach
                </select>
                @error('daerah_id')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input Detail -->
            <div class="mb-4">
                <label for="detail" class="mb-2 block text-sm font-bold text-gray-700">Detail</label>
                <textarea name="detail" id="detail" rows="5"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">{{ old('detail', $objekWisata->detail) }}</textarea>
                @error('detail')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input URL Peta -->
            <div class="mb-4">
                <label for="url_peta" class="mb-2 block text-sm font-bold text-gray-700">URL Peta</label>
                <input type="url" name="url_peta" id="url_peta"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
                    value="{{ old('url_peta', $objekWisata->url_peta) }}">
                @error('url_peta')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input Gambar -->
            <div class="mb-4">
                <label for="images" class="mb-2 block text-sm font-bold text-gray-700">Gambar (Maksimal 5)</label>
                <input type="file" name="images[]" id="images"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
                    multiple>
                <div class="mt-2" id="image-previews">
                    @foreach ($objekWisata->images as $image)
                        <div class="mb-2 flex items-center space-x-2">
                            <img src="{{ Storage::url($image->path) }}" alt="Gambar Objek Wisata"
                                class="h-32 w-32 object-cover">
                            <button type="button" class="remove-image text-red-500 hover:text-red-700"
                                data-image-id="{{ $image->id }}">Hapus</button>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Input Status -->
            <div class="mb-4">
                <label for="status" class="mb-2 block text-sm font-bold text-gray-700">Status</label>
                <select name="status" id="status"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    <option value="active" {{ $objekWisata->status == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ $objekWisata->status == 'inactive' ? 'selected' : '' }}>Tidak Aktif
                    </option>
                </select>
                @error('status')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- Hidden Input for Deleted Images -->
            <div id="deleted-images-container"></div>

            <div class="flex justify-start">
                <button type="submit"
                    class="hover:bg-primary-700 rounded-md bg-primary-600 px-4 py-2 text-white shadow-sm">Perbarui</button>
            </div>
        </form>
    </div>

    @push('scripts')
        <!-- WYSIWYG Editor Initialization -->
        <script src="https://cdn.jsdelivr.net/npm/tinymce@5/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector: '#detail',
                menubar: false,
                apiKey: 'uul1oj4issmwjrsanqs7zmthx1pw77ambsjazxeggy06i4oc',
                plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste code help wordcount',
                toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image code help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
                height: 300,
                file_picker_types: 'image',
                file_picker_callback: function(callback, value, meta) {
                    if (meta.filetype === 'image') {
                        var input = document.createElement('input');
                        input.setAttribute('type', 'file');
                        input.setAttribute('accept', 'image/*');
                        input.addEventListener('change', function() {
                            var file = this.files[0];
                            var reader = new FileReader();
                            reader.onload = function() {
                                callback(reader.result, {
                                    alt: file.name
                                });
                            };
                            reader.readAsDataURL(file);
                        });
                        input.click();
                    }
                }
            });
        </script>
        <script>
            document.querySelectorAll('.remove-image').forEach(button => {
                button.addEventListener('click', function() {
                    const imageId = this.getAttribute('data-image-id');
                    const deletedImagesContainer = document.getElementById('deleted-images-container');

                    // Create hidden input for deleted image
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'deleted_images[]';
                    input.value = imageId;

                    deletedImagesContainer.appendChild(input);

                    // Remove image preview
                    this.parentElement.remove();
                });
            });
        </script>
    @endpush
</x-dinas.layout>
