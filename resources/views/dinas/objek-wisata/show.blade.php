<x-dinas.layout title="Kelola Objek Wisata">
    <!-- Toast Container -->
    <x-dinas.toast-container :errors="$errors" :session="session()" />

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">{{ $objekWisata->nama }}</h1>

        <div class="bg-white p-6 rounded shadow-md">
            <div class="mb-4">
                <h2 class="text-lg font-semibold">Detail</h2>
                <p>{{ $objekWisata->detail }}</p>
            </div>

            <div class="mb-4">
                <h2 class="text-lg font-semibold">Kategori</h2>
                <p>{{ $objekWisata->kategori->nama }}</p>
            </div>

            <div class="mb-4">
                <h2 class="text-lg font-semibold">Daerah</h2>
                <p>{{ $objekWisata->daerah->kecamatan }}</p>
            </div>

            <div class="mb-4">
                <h2 class="text-lg font-semibold">URL Peta</h2>
                <a href="{{ $objekWisata->url_peta }}" target="_blank"
                    class="text-blue-500 hover:underline">{{ $objekWisata->url_peta }}</a>
            </div>

            <div class="mb-4">
                <h2 class="text-lg font-semibold">Status</h2>
                <p>{{ ucfirst($objekWisata->status) }}</p>
            </div>

            <div class="mb-4">
                <h2 class="text-lg font-semibold">Images</h2>
                <div class="grid grid-cols-3 gap-4">
                    @foreach ($objekWisata->images as $image)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $objekWisata->nama }}"
                                class="w-full h-32 object-cover rounded">
                            <form action="{{ route('dinas.objek-wisata.images.destroy', $image->id) }}" method="POST"
                                class="absolute top-2 right-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('dinas.objek-wisata.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back to List</a>
                <a href="{{ route('dinas.objek-wisata.edit', $objekWisata->id) }}"
                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
            </div>
        </div>
    </div>
</x-dinas.layout>
