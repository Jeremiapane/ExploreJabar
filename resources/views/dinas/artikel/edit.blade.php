<x-dinas.layout title="Edit Artikel">

    <!-- Toast Container -->
    <x-dinas.toast-container :errors="$errors" :session="session()" />

    <div class="container mx-auto mt-4 rounded-lg bg-white p-6 shadow-lg">

        <!-- Tombol Kembali -->
        <a href="{{ route('dinas.artikel.index') }}"
            class="mb-4 inline-block font-semibold text-primary-500 hover:text-primary-600">
            &larr; Kembali
        </a>

        <h1 class="mb-4 text-2xl font-bold">Edit Artikel</h1>

        <form action="{{ route('dinas.artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Judul Input -->
            <div class="mb-4">
                <label for="judul" class="mb-2 block text-sm font-bold text-gray-700">Judul</label>
                <input type="text" id="judul" name="judul" value="{{ old('judul', $artikel->judul) }}"
                    class="w-full rounded border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-primary-500"
                    required>
            </div>

            <!-- Kategori Select -->
            <div class="mb-4">
                <label for="kategori_id" class="mb-2 block text-sm font-bold text-gray-700">Kategori</label>
                <select name="kategori_id" id="kategori_id"
                    class="w-full rounded border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-primary-500"
                    required>
                    @foreach ($kategori_artikels as $kategori)
                        <option value="{{ $kategori->id }}"
                            {{ $kategori->id == old('kategori_id', $artikel->kategori_id) ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Foto Sampul Input -->
            <div class="mb-4">
                <label for="foto_sampul" class="mb-2 block text-sm font-bold text-gray-700">Foto Sampul</label>
                <input type="file" id="foto_sampul" name="foto_sampul"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <div class="mt-2">
                    <img id="imagePreview" src="{{ Storage::url($artikel->foto_sampul) }}" alt="Foto Sampul"
                        class="h-32 w-32 rounded border border-gray-200 object-cover shadow">
                </div>
            </div>

            <!-- Detail Textarea -->
            <div class="mb-4">
                <label for="detail" class="mb-2 block text-sm font-bold text-gray-700">Detail</label>
                <textarea id="detail" name="detail"
                    class="w-full rounded border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-primary-500"
                    rows="5">{{ old('detail', $artikel->detail) }}</textarea>
            </div>

            <!-- Status Select -->
            <div class="mb-4">
                <label for="status" class="mb-2 block text-sm font-bold text-gray-700">Status</label>
                <select name="status" id="status"
                    class="w-full rounded border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-primary-500"
                    required>
                    <option value="draf" {{ old('status', $artikel->status) == 'draf' ? 'selected' : '' }}>Draf
                    </option>
                    <option value="aktif" {{ old('status', $artikel->status) == 'aktif' ? 'selected' : '' }}>Aktif
                    </option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="rounded bg-primary-500 px-4 py-2 font-bold text-white hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-500">
                Perbarui Artikel
            </button>
        </form>
    </div>

    @push('scripts')
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
    @endpush
</x-dinas.layout>
