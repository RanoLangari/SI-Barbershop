<x-admin-layout>

    <div id="content-container" class="content-container ml-64">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white shadow rounded-lg p-6 transform transition duration-500 hover:scale-105">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-12 w-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 4h10a2 2 0 012 2v11a2 2 0 01-2 2H7a2 2 0 01-2-2V9a2 2 0 012-2zm3 4h4m-4 4h4">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Total Transaksi</h3>
                        <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $totalTransaksi }}</p>
                        <div class="flex text-sm mt-1">
                            <span class="text-blue-500 mr-2">{{ $totalReservasi }} Online</span>
                            <span class="text-orange-500">{{ $totalOrder }} Offline</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow rounded-lg p-6 transform transition duration-500 hover:scale-105">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M12 12a4 4 0 100-8 4 4 0 000 8zm6 8h-1.4a5.97 5.97 0 00-9.2 0H6">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Total Pelanggan</h3>
                        <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $pelangganCount }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow rounded-lg p-6 transform transition duration-500 hover:scale-105">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-12 w-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5zm0 7v-6m0 0L3 9m9 5l9-5-9 5z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Total Barberman</h3>
                        <p class="mt-1 text-2xl font-semibold text-gray-900"> {{ $barbermanCount }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-6 transform transition duration-500 hover:scale-105">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-12 w-12 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Total Pendapatan</h3>
                        <p class="mt-1 text-2xl font-semibold text-gray-900">Rp
                            {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter section -->
        <div class="mt-8 bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Filter Pendapatan</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label for="filter-type" class="block text-sm font-medium text-gray-700 mb-1">Periode</label>
                    <select id="filter-type"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="daily">Harian</option>
                        <option value="weekly">Mingguan</option>
                        <option value="monthly">Bulanan</option>
                        <option value="yearly">Tahunan</option>
                        <option value="custom">Kustom</option>
                    </select>
                </div>

                <div id="date-range-container" class="hidden md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="start-date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                                Mulai</label>
                            <input type="date" id="start-date"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="end-date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                                Akhir</label>
                            <input type="date" id="end-date"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <div class="md:col-span-3 flex justify-end">
                    <button id="filter-button"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        Terapkan Filter
                    </button>
                </div>
            </div>

            <!-- Revenue summary -->
            <div id="revenue-summary" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                    <h4 class="text-sm font-medium text-gray-600">Total Pendapatan</h4>
                    <p class="text-xl font-bold text-gray-900" id="total-revenue">Rp
                        {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                </div>
                <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                    <h4 class="text-sm font-medium text-gray-600">Rata-rata per Reservasi</h4>
                    <p class="text-xl font-bold text-gray-900" id="avg-revenue">Rp
                        {{ $totalReservasi > 0 ? number_format($totalPendapatan / $totalReservasi, 0, ',', '.') : 0 }}
                    </p>
                </div>
                <div class="bg-purple-50 p-4 rounded-lg border border-purple-100">
                    <h4 class="text-sm font-medium text-gray-600">Jumlah Transaksi</h4>
                    <p class="text-xl font-bold text-gray-900" id="transaction-count">{{ $totalReservasi }}</p>
                </div>
            </div>

            <!-- Revenue chart -->
            <div class="rounded-lg border border-gray-200 overflow-hidden">
                <div id="revenue-chart" class="h-72 p-4">
                    <div class="flex items-center justify-center h-full text-gray-500 text-sm" id="chart-placeholder">
                        Pilih filter untuk menampilkan grafik pendapatan
                    </div>
                    <canvas id="revenueChart" class="w-full h-full hidden"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent transactions -->
        <div class="mt-8 bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Transaksi Terbaru</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jenis</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pelanggan</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Layanan</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jumlah</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="recent-transactions-body">
                        @forelse ($recentTransactions as $transaction)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $transaction->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if (isset($transaction->is_offline))
                                        <span
                                            class="px-2 py-1 rounded-md bg-orange-500 text-white text-xs">Offline</span>
                                    @else
                                        <span class="px-2 py-1 rounded-md bg-blue-500 text-white text-xs">Online</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if (isset($transaction->is_offline))
                                        {{ $transaction->nama_pemesan ?? 'N/A' }}
                                    @else
                                        {{ $transaction->user->name ?? 'N/A' }}
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $transaction->layanan->nama ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if (isset($transaction->is_offline))
                                        {{ date('d-m-Y', strtotime($transaction->tanggal)) }}
                                    @else
                                        {{ date('d-m-Y', strtotime($transaction->tanggal_reservasi)) }}
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Rp {{ number_format($transaction->layanan->harga ?? 0, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"
                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Tidak ada
                                    data transaksi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Load Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animation for content container
            const contentContainer = document.getElementById('content-container');
            contentContainer.style.opacity = 0;
            contentContainer.style.transform = 'translateY(-50px)';
            setTimeout(() => {
                contentContainer.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
                contentContainer.style.opacity = 1;
                contentContainer.style.transform = 'translateY(0)';
                setTimeout(() => {
                    contentContainer.style.transition = 'transform 0.2s ease-in-out';
                    contentContainer.style.transform = 'translateY(5px)';
                    setTimeout(() => {
                        contentContainer.style.transform = 'translateY(0)';
                    }, 200);
                }, 500);
            }, 100);

            // Handle filter type change
            const filterTypeSelect = document.getElementById('filter-type');
            const dateRangeContainer = document.getElementById('date-range-container');

            filterTypeSelect.addEventListener('change', function() {
                if (this.value === 'custom') {
                    dateRangeContainer.classList.remove('hidden');
                } else {
                    dateRangeContainer.classList.add('hidden');
                }
            });

            // Set default dates for custom range
            const startDateInput = document.getElementById('start-date');
            const endDateInput = document.getElementById('end-date');
            const today = new Date();
            const lastMonth = new Date();
            lastMonth.setMonth(lastMonth.getMonth() - 1);

            startDateInput.valueAsDate = lastMonth;
            endDateInput.valueAsDate = today;

            // Initialize chart with empty data
            let revenueChart;

            // Handle filter button click
            document.getElementById('filter-button').addEventListener('click', function() {
                const filterType = filterTypeSelect.value;
                let startDate = null;
                let endDate = null;

                if (filterType === 'custom') {
                    startDate = startDateInput.value;
                    endDate = endDateInput.value;
                }

                // Show loading state
                document.getElementById('chart-placeholder').textContent = 'Memuat data...';
                document.getElementById('chart-placeholder').classList.remove('hidden');
                document.getElementById('revenueChart').classList.add('hidden');

                // Make AJAX request
                fetch(
                        `/barberman/dashboard/revenue?filter=${filterType}&start_date=${startDate || ''}&end_date=${endDate || ''}`
                    )
                    .then(response => response.json())
                    .then(data => {
                        updateRevenueDisplay(data);
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        document.getElementById('chart-placeholder').textContent =
                            'Terjadi kesalahan saat memuat data';
                    });
            });

            function updateRevenueDisplay(data) {
                // Update summary cards
                document.getElementById('total-revenue').textContent = 'Rp ' + formatNumber(data.summary.total);
                document.getElementById('avg-revenue').textContent = 'Rp ' + formatNumber(data.summary.average);
                document.getElementById('transaction-count').textContent = data.summary.count;

                // Update chart
                document.getElementById('chart-placeholder').classList.add('hidden');
                document.getElementById('revenueChart').classList.remove('hidden');

                // Destroy existing chart if exists
                if (revenueChart) {
                    revenueChart.destroy();
                }

                const ctx = document.getElementById('revenueChart').getContext('2d');
                revenueChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.chart.labels,
                        datasets: [{
                                label: 'Total',
                                data: data.chart.totalValues,
                                backgroundColor: 'rgba(99, 102, 241, 0.5)',
                                borderColor: 'rgb(99, 102, 241)',
                                borderWidth: 1,
                                order: 3
                            },
                            {
                                label: 'Online',
                                data: data.chart.onlineValues,
                                backgroundColor: 'rgba(59, 130, 246, 0.5)',
                                borderColor: 'rgb(59, 130, 246)',
                                borderWidth: 1,
                                order: 2
                            },
                            {
                                label: 'Offline',
                                data: data.chart.offlineValues,
                                backgroundColor: 'rgba(249, 115, 22, 0.5)',
                                borderColor: 'rgb(249, 115, 22)',
                                borderWidth: 1,
                                order: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + formatNumber(value);
                                    }
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.dataset.label + ': Rp ' + formatNumber(context
                                            .parsed.y);
                                    }
                                }
                            },
                            legend: {
                                display: true,
                                position: 'top'
                            }
                        }
                    }
                });

                // Update revenue summary cards with online/offline breakdown
                const totalRevenueEl = document.getElementById('total-revenue');
                totalRevenueEl.innerHTML = `
        Rp ${formatNumber(data.summary.total)}
        <div class="flex text-sm mt-1">
            <span class="text-blue-500 mr-2">Online: Rp ${formatNumber(data.summary.online)}</span>
            <span class="text-orange-500">Offline: Rp ${formatNumber(data.summary.offline)}</span>
        </div>
    `;

                // Update transaction count with breakdown
                const transactionCountEl = document.getElementById('transaction-count');
                transactionCountEl.innerHTML = `
        ${data.summary.count}
        <div class="flex text-sm mt-1">
            <span class="text-blue-500 mr-2">Online: ${data.summary.onlineCount}</span>
            <span class="text-orange-500">Offline: ${data.summary.offlineCount}</span>
        </div>
    `;

                // Update recent transactions table
                const tbody = document.getElementById('recent-transactions-body');
                tbody.innerHTML = '';

                if (data.transactions.length === 0) {
                    const row = document.createElement('tr');
                    row.innerHTML =
                        `<td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Tidak ada data transaksi</td>`;
                    tbody.appendChild(row);
                } else {
                    data.transactions.forEach(transaction => {
                        const row = document.createElement('tr');
                        const typeClass = transaction.type === 'online' ? 'bg-blue-500' : 'bg-orange-500';
                        const typeLabel = transaction.type === 'online' ? 'Online' : 'Offline';

                        row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${transaction.id}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <span class="px-2 py-1 rounded-md ${typeClass} text-white text-xs">${typeLabel}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${transaction.customer_name}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${transaction.service_name}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${transaction.date}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp ${formatNumber(transaction.amount)}</td>
            `;
                        tbody.appendChild(row);
                    });
                }
            }

            function formatNumber(number) {
                return new Intl.NumberFormat('id-ID').format(number);
            }
        });
    </script>

</x-admin-layout>
