<x-dinas.layout title="Dashboard Dinas">
    <h1 class="mb-4 text-h2 text-black">Dashboard Dinas</h1>
    <div class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-3">
        {{-- Chart 1: Jumlah Wisatawan --}}
        <div class="div w-full">
            <div class="w-full max-w-md rounded-lg bg-white p-4 shadow dark:bg-gray-800 md:p-6">
                <div class="flex justify-between">
                    <div>
                        <h5 class="pb-2 text-3xl font-bold leading-none text-gray-900 dark:text-white">
                            {{ $total_wisatawan }}
                        </h5>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Jumlah Wisatawan</p>
                    </div>
                    <div
                        class="{{ $change_wisatawan_class }} flex items-center px-2.5 py-0.5 text-center text-base font-semibold">
                        {{ $thisWeekCount }}
                        {!! $change_wisatawan_icon !!}
                    </div>
                </div>
                <div id="chart-wisatawan"></div>
            </div>
        </div>

        {{-- Chart 2: Jumlah Aduan --}}
        <div class="div w-full">
            <div class="w-full max-w-md rounded-lg bg-white p-4 shadow dark:bg-gray-800 md:p-6">
                <div class="flex justify-between">
                    <div>
                        <h5 class="pb-2 text-3xl font-bold leading-none text-gray-900 dark:text-white">
                            {{ $thisWeekAduanCount }}
                        </h5>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Jumlah Aduan Minggu Ini</p>
                    </div>
                    <div
                        class="{{ $change_aduan_class }} flex items-center px-2.5 py-0.5 text-center text-base font-semibold">
                        {{ $thisWeekAduanCount }}
                        {!! $change_aduan_icon !!}
                    </div>
                </div>
                <div id="chart-aduan"></div>
            </div>
        </div>

        {{-- Chart 3: Agen Baru Aktif --}}
        <div class="div w-full">
            <div class="w-full max-w-md rounded-lg bg-white p-4 shadow dark:bg-gray-800 md:p-6">
                <div class="flex justify-between">
                    <div>
                        <h5 class="pb-2 text-3xl font-bold leading-none text-gray-900 dark:text-white">
                            {{ array_sum($operasional_counts) }}
                        </h5>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Jumlah Agen Terverifikasi</p>
                    </div>
                    <div
                        class="{{ $change_agen_class }} flex items-center px-2.5 py-0.5 text-center text-base font-semibold">
                        {{ $thisWeekAgenCount }}
                        {!! $change_agen_icon !!}
                    </div>
                </div>
                <div id="chart-operasional"></div>
            </div>
        </div>
    </div>


    <div class="mt-8">
        <!-- Artikel Aktif -->
        <div class="w-full max-w-full rounded-lg bg-white p-4 shadow dark:bg-gray-800 md:p-6">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Artikel Aktif</h3>
            <div class="mt-4 overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Judul</th>
                            <th scope="col" class="px-4 py-3">Kategori</th>
                            <th scope="col" class="px-4 py-3">Penulis</th>
                            <th scope="col" class="px-4 py-3">Tanggal</th>
                            <th scope="col" class="px-4 py-3">Views</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($artikel_aktif as $artikel)
                            <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-900">
                                <td class="px-4 py-3">{{ $artikel->judul }}</td>
                                <td class="px-4 py-3">{{ $artikel->kategori->nama }}</td>
                                <td class="px-4 py-3">{{ $artikel->penulis->nama }}</td>
                                <td class="px-4 py-3">{{ $artikel->created_at->format('d F Y') }}</td>
                                <td class="px-4 py-3">{{ $artikel->views }}</td>
                            </tr>
                        @empty
                            <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-900">
                                <td colspan="5" class="px-4 py-3 text-center">Tidak ada artikel aktif</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-8">
        <!-- Objek Wisata Aktif -->
        <div class="w-full max-w-full rounded-lg bg-white p-4 shadow dark:bg-gray-800 md:p-6">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Objek Wisata Aktif</h3>
            <div class="mt-4 overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Nama</th>
                            <th scope="col" class="px-4 py-3">Kategori</th>
                            <th scope="col" class="px-4 py-3">Daerah</th>
                            <th scope="col" class="px-4 py-3">Pendata</th>
                            <th scope="col" class="px-4 py-3">URL Peta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($objekWisata as $objek)
                            <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-900">
                                <td class="px-4 py-3">{{ $objek->nama }}</td>
                                <td class="px-4 py-3">{{ $objek->kategori->nama }}</td>
                                <td class="px-4 py-3">{{ $objek->daerah->kecamatan }}</td>
                                <td class="px-4 py-3">{{ $objek->penulis->nama }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ $objek->search_url }}" target="_blank"
                                        class="text-blue-500 hover:underline">
                                        Lihat Peta
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-900">
                                <td colspan="5" class="px-4 py-3 text-center">Tidak ada objek wisata aktif</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        function renderChart(chartId, seriesData, categories, color, gradientShade) {
            const options = {
                chart: {
                    type: 'area',
                    height: '100%',
                    fontFamily: 'Inter, sans-serif',
                    dropShadow: {
                        enabled: false,
                    },
                    toolbar: {
                        show: false,
                    },
                },
                tooltip: {
                    enabled: true,
                    x: {
                        show: false,
                    },
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        opacityFrom: 0.55,
                        opacityTo: 0,
                        shade: gradientShade,
                        gradientToColors: [gradientShade],
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    width: 6,
                },
                grid: {
                    show: false,
                },
                xaxis: {
                    categories: categories,
                    labels: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                yaxis: {
                    labels: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                series: [{
                    name: chartId === 'chart-wisatawan' ? 'Jumlah Wisatawan Baru' : (chartId === 'chart-aduan' ?
                        'Jumlah Aduan Masuk' : 'Jumlah Agen Terverifikasi'),
                    data: seriesData,
                    color: color,
                }],
            };

            if (document.getElementById(chartId) && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById(chartId), options);
                chart.render();
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            renderChart('chart-wisatawan', @json($visitor_counts), @json($dates), '#1A56DB',
                '#1C64F2');
            renderChart('chart-aduan', @json($aduan_counts), @json($aduan_dates), '#F39C12',
                '#F39C12');
            renderChart('chart-operasional', @json($operasional_counts), @json($operasional_dates), '#1DAB89',
                '#1DAB89');
        });
    </script>
</x-dinas.layout>
