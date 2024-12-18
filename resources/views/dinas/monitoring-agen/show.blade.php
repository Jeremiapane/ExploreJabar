<x-dinas.layout title="Monitoring Agen Perjalanan">
    <!-- Toast Container -->
    <x-dinas.toast-container :errors="$errors" :session="session()" />

    <div class="container mx-auto rounded bg-white p-6 py-8 shadow-md">
        <!-- Tombol Kembali -->
        <a href="{{ route('dinas.monitoring-agen.index') }}"
            class="hover:text-primary-700 mb-4 inline-block font-semibold text-primary-500">
            &larr; Kembali
        </a>
        </a>

        <!-- Informasi Perusahaan -->
        <div class="mb-6 mt-2">
            <h1 class="mb-6 text-2xl font-bold sm:text-3xl">{{ Str::title($agen->nama_perusahaan) }}</h1>

            <div class="mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="mr-2 h-4 w-4 text-gray-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                </svg>
                <p class="text-sm sm:text-base">{{ $agen->alamat_perusahaan }}</p>
            </div>
            <div class="mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="mr-2 h-4 w-4 text-gray-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                </svg>
                <p class="text-sm sm:text-base">{{ $agen->no_telp_perusahaan }}</p>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Ringkasan:</h2>
                <p class="text-gray-700">{{ $agen->deskripsi }}</p>
            </div>
            <div>
                <h2 class="mt-4 text-lg font-semibold">Verifikator:</h2>
                <p class="text-gray-700">{{ $agen->verifikator->nama }}</p>
            </div>
        </div>

        <div class="mb-8 grid grid-cols-1 gap-6 sm:grid-cols-3">
            <!-- Card for Bookings -->
            <div class="flex items-center justify-center rounded-lg border bg-blue-50 p-6 shadow-sm">
                <div>
                    {{-- dummy --}}
                    <h2 class="mb-2 text-2xl font-bold text-blue-700">{{ $totalBooking }}</h2>
                    <p class="text-sm text-gray-700">Total Booking</p>
                </div>
                <div class="ml-4 rounded-full bg-blue-200 p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-8 w-8 text-blue-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672Zm-7.518-.267A8.25 8.25 0 1 1 20.25 10.5M8.288 14.212A5.25 5.25 0 1 1 17.25 10.5" />
                    </svg>
                </div>
            </div>

            <!-- Card for Paket -->
            <div class="flex items-center justify-center rounded-lg border bg-green-50 p-6 shadow-sm">
                <div>
                    {{-- dummy --}}
                    <h2 class="mb-2 text-2xl font-bold text-green-700">{{ $totalPaket }}</h2>
                    <p class="text-sm text-gray-700">Total Paket</p>
                </div>
                <div class="ml-4 rounded-full bg-green-200 p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-8 w-8 text-green-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>
                </div>
            </div>

            <!-- Card for Aduans -->
            <div class="flex items-center justify-center rounded-lg border bg-yellow-50 p-6 shadow-sm">
                <div>
                    {{-- dummy --}}
                    <h2 class="mb-2 text-2xl font-bold text-yellow-700">{{ $averageRating }}</h2>
                    <p class="text-sm text-gray-700">Rating Agen</p>
                </div>
                <div class="ml-4 rounded-full bg-yellow-200 p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-8 w-8 text-yellow-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Tabs for Documents -->
        <div class="tabs mb-6">
            <div class="tab-container flex overflow-x-auto whitespace-nowrap">
                <ul class="mb-2 flex flex-nowrap border-b border-gray-300">
                    @foreach ($agen->attachments as $attachment)
                        @php
                            $nameParts = explode('_', $attachment->name);
                            $prefix = ucfirst($nameParts[0]);
                        @endphp
                        <li class="inline-block">
                            <button
                                class="tab-button border-b-2 px-6 py-4 text-sm font-medium text-gray-600 hover:border-blue-700 hover:text-blue-700 focus:outline-none"
                                data-target="#tab-{{ $attachment->id }}">
                                Dokumen {{ $prefix }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>

            @foreach ($agen->attachments as $attachment)
                <div id="tab-{{ $attachment->id }}"
                    class="tab-content mt-2 hidden rounded-md border border-gray-300 p-4">
                    @php
                        $dokumenExtension = strtolower(pathinfo($attachment->path, PATHINFO_EXTENSION));
                    @endphp

                    @if (in_array($dokumenExtension, ['jpg', 'jpeg', 'png']))
                        <img src="{{ asset($attachment->path) }}" alt="Preview" class="mb-6 h-auto max-w-full">
                    @elseif ($dokumenExtension === 'pdf')
                        <iframe src="{{ asset($attachment->path) }}" class="h-[500px] w-full" frameborder="0"></iframe>
                    @elseif (in_array($dokumenExtension, ['doc', 'docx']))
                        <a href="{{ asset($attachment->path) }}" target="_blank"
                            class="mb-6 inline-flex items-center rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">
                            Lihat Dokumen
                        </a>
                    @else
                        <p>File type not supported for preview</p>
                    @endif

                    <a href="{{ asset($attachment->path) }}" target="_blank" class="text-blue-600 hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="mr-1 inline-block h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>
                        Lihat di tab baru
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Modal for Rejection Note -->
        <div id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true"
            class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 p-4">
            <div class="relative w-full max-w-lg rounded-lg bg-white shadow-lg">
                <form action="{{ route('dinas.verifikasi-agen.tolak', $agen->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="border-b p-6">
                        <h5 class="text-lg font-semibold" id="rejectModalLabel">Catatan Penolakan</h5>
                        <button type="button" class="absolute right-2 top-2 text-gray-500 hover:text-gray-700"
                            onclick="closeRejectModal()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-6">
                        <div class="mb-4">
                            <label for="catatan_penolakan" class="block text-sm font-medium text-gray-700">Catatan
                                Penolakan</label>
                            <textarea id="catatan_penolakan" name="catatan_penolakan" required
                                class="mt-1 block h-32 w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                         </textarea>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-2 border-t p-6">
                        <button type="button"
                            class="rounded-md bg-gray-500 px-4 py-2 text-white transition-colors duration-300 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500"
                            onclick="closeRejectModal()">
                            Batal
                        </button>
                        <button type="submit"
                            class="rounded-md bg-red-500 px-4 py-2 text-white transition-colors duration-300 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                            Tolak
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tabs = document.querySelectorAll('.tab-button');
                const tabContents = document.querySelectorAll('.tab-content');

                if (tabs.length > 0) {
                    // Open the first tab by default
                    tabs[0].classList.add('text-primary-500', 'border-blue-700', 'font-semibold');
                    tabContents[0].classList.remove('hidden');
                }

                tabs.forEach(tab => {
                    tab.addEventListener('click', () => {
                        const target = document.querySelector(tab.dataset.target);

                        // Remove active classes from all tabs and hide all tab contents
                        tabs.forEach(t => {
                            t.classList.remove('text-primary-500', 'border-blue-700',
                                'font-semibold');
                        });

                        tabContents.forEach(content => {
                            content.classList.add('hidden');
                        });

                        // Add active classes to the clicked tab and show the corresponding content
                        tab.classList.add('text-primary-500', 'border-blue-700', 'font-semibold');
                        target.classList.remove('hidden');
                    });
                });
            });

            function showRejectModal() {
                const modal = document.getElementById('rejectModal');
                const textarea = document.getElementById('catatan_penolakan');
                if (modal) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    textarea.value = '';
                }
            }

            function closeRejectModal() {
                const modal = document.getElementById('rejectModal');
                if (modal) {
                    modal.classList.remove('flex');
                    modal.classList.add('hidden');
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const tabContainer = document.querySelector('.tab-container');

                let isDown = false;
                let startX;
                let scrollLeft;

                tabContainer.addEventListener('mousedown', (e) => {
                    isDown = true;
                    tabContainer.classList.add('active');
                    startX = e.pageX - tabContainer.offsetLeft;
                    scrollLeft = tabContainer.scrollLeft;
                });

                tabContainer.addEventListener('mouseleave', () => {
                    isDown = false;
                    tabContainer.classList.remove('active');
                });

                tabContainer.addEventListener('mouseup', () => {
                    isDown = false;
                    tabContainer.classList.remove('active');
                });

                tabContainer.addEventListener('mousemove', (e) => {
                    if (!isDown) return;
                    e.preventDefault();
                    const x = e.pageX - tabContainer.offsetLeft;
                    const walk = (x - startX) * 2; // Scroll-fast
                    tabContainer.scrollLeft = scrollLeft - walk;
                });
            });
        </script>
    @endpush
</x-dinas.layout>
