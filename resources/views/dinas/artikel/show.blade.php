<x-dinas.layout title="Lihat Artikel">
    <div class="rounded-lg bg-white p-6">
        <div class="container mx-auto w-full px-4 md:px-0">
            <a href="{{ route('dinas.artikel.index') }}"
                class="mb-4 inline-block text-lg font-semibold text-primary-500 hover:text-primary-600">
                &larr; Kembali
            </a>

            <div class="mt-5 flex flex-col items-center space-y-6 text-center">
                <div class="text-sm font-semibold text-primary-500">{{ $artikel->kategori->nama ?? '-' }}</div>
                <h1 class="text-3xl font-bold">{{ $artikel->judul }}</h1>
                <div class="text-sm text-gray-500">
                    {{ \Carbon\Carbon::parse($artikel->created_at)->translatedFormat('d F Y') }}
                </div>
            </div>

            <div class="mb-8">
                <img src="{{ $artikel->foto_sampul ? Storage::url($artikel->foto_sampul) : 'https://via.placeholder.com/800x450.png?text=No+Image' }}"
                    alt="{{ $artikel->foto_sampul ? 'Foto Sampul' : 'No Image' }}"
                    class="mt-4 h-80 w-full rounded-lg object-cover shadow-md">
                @unless ($artikel->foto_sampul)
                    <p class="mt-2 text-gray-500">Tidak ada foto sampul</p>
                @endunless
            </div>

            <div class="prose prose-lg items-center p-12 text-justify">
                {!! $artikel->detail !!}
            </div>

            <div class="mx-auto mt-6 w-full max-w-2xl border-t border-gray-300 pt-6">
                <div class="flex items-start space-x-4">
                    <div>
                        <div class="text-sm text-gray-500">Ditulis oleh</div>
                        <h3 class="text-lg font-semibold">{{ $artikel->penulis->nama ?? 'Unknown Author' }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dinas.layout>
