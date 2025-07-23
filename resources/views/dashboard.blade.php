<x-app-layout>
    <x-slot name="header">
        {{ __('DashBoard') }}
    </x-slot>
    <div class="flex flex-col gap-8 p-8 bg-gray-100">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Últimas Transações + Gráfico -->
            <div class="col-span-2 bg-white rounded-2xl shadow p-6 flex flex-col">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Últimas Transações</h2>
                        <div class="text-xs text-gray-400">Expenses summary from 1-12 Apr, 2024</div>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-gray-800">R$1,278.45</div>
                        <div class="text-xs text-orange-500">↑ 2.1% vs Última semana</div>
                    </div>
                </div>
                <canvas id="transactionsChart" height="100"></canvas>
                <div id="chart-error" class="text-center text-red-500 mt-4 hidden">O gráfico não está disponível no momento.</div>
                <div class="flex justify-end mt-2">
                    <span class="text-xs text-gray-400">Últimas Transações</span>
                </div>
            </div>
            <!-- Registros via Telegram -->
            <div class="bg-white rounded-2xl shadow p-6 flex flex-col">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Registros via Telegram</h2>
                    <a href="#" class="text-orange-500 text-xs font-semibold">See All</a>
                </div>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <img src="https://randomuser.me/api/portraits/women/65.jpg" class="w-10 h-10 rounded-full mr-3" />
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-gray-800">Samantha William</span>
                                <span class="bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded">Status</span>
                            </div>
                            <div class="text-xs text-gray-400">$1,156</div>
                            <div class="text-xs text-gray-500 mt-1">Expenses for business trip to Madrid. Flight ticket, hotel for 2 days and for conference ticket entrance.</div>
                            <div class="text-xs text-gray-300 mt-1">2 days ago</div>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="w-10 h-10 rounded-full mr-3" />
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-gray-800">Robert Wise</span>
                                <span class="bg-orange-400 text-white text-xs px-2 py-1 rounded">Status</span>
                            </div>
                            <div class="text-xs text-gray-400">$1,156</div>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" class="w-10 h-10 rounded-full mr-3" />
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-gray-800">Jack Summer</span>
                                <span class="bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded">Status</span>
                            </div>
                            <div class="text-xs text-gray-400">$1,156</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Segunda linha -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Próximas Transações -->
            <div class="bg-white rounded-2xl shadow p-6 flex flex-col col-span-1">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Últimas Transações</h2>
                    <a href="#" class="text-orange-500 text-xs font-semibold">See All</a>
                </div>

                <ul class="divide-y divide-gray-100">
                @foreach ($transactions as $transaction)
                <li class="flex items-center py-4">
                        <span class="bg-orange-400 text-white rounded-full w-10 h-10 flex items-center justify-center font-bold mr-4">MS</span>
                        <div class="flex-1">
                            <div class="font-semibold text-gray-800"> {{ $transaction->description }}</div>
                            <div class="text-xs text-gray-400"> {{ $transaction->transaction_date }}</div>
                        </div>
                        <div class="font-semibold text-gray-800">${{ $transaction->amount }}</div>
                    </li>
                @endforeach
                </ul>
            </div>
            <!-- RoadMap Financeiro + Categorias -->

                <div class="bg-orange-100 rounded-2xl shadow p-6 flex flex-col items-center justify-center">
                    <img src="https://img.icons8.com/ios-filled/50/000000/diamond.png" class="w-12 h-12 mb-2" />
                    <div class="font-semibold text-lg text-gray-800 mb-2">RoadMap Financeiro</div>
                    <div class="text-xs text-gray-600 mb-4 text-center">Junto a nossa ferramenta de IA criaremos um Plano para você sair das dívidas ou para alcançar seu objetivo.</div>
                    <button class="bg-gray-900 text-white px-4 py-2 rounded-lg font-semibold text-sm">Teste Grátis</button>
                </div>
                <div class="bg-orange-400 rounded-2xl shadow p-6 flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-semibold text-white">Metas</h2>
                        <a href="#" class="text-white text-xs font-semibold">See All</a>
                    </div>
                        @foreach ($savings as $saving)
                        <div class="mb-2">
                        <div class="flex justify-between text-white text-sm font-semibold">
                            <span>{{$saving->note}}</span>
                            <span>R${{number_format($saving->balance, 2, ',', '.')}}</span>
                        </div>
                        <div class="w-full h-2 bg-orange-300 rounded mt-1 mb-3">
                            <div class="h-2 bg-white rounded" style="width: 80%"></div>
                        </div>
                    </div>
                        @endforeach
                </div>
        </div>
        <!-- Chart.js CDN -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const chartLabels = @json($chartData['chartLabels']);
            const chartDataCurrent = @json($chartData['chartDataCurrent']);
            const chartDataPrevious = @json($chartData['chartDataPrevious']);
            try {
                const ctx = document.getElementById('transactionsChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: chartLabels,
                        datasets: [
                            {
                                label: 'Gastos atuais',
                                data: chartDataCurrent,
                                backgroundColor: 'rgba(255, 99, 71, 0.7)',
                                borderRadius: 10,
                                barPercentage: 0.5,
                                categoryPercentage: 0.5,
                            },
                            {
                                label: 'Gastos Comparados a semana anterior',
                                data: chartDataPrevious,
                                backgroundColor: 'rgba(55, 55, 55, 0.7)',
                                borderRadius: 10,
                                barPercentage: 0.5,
                                categoryPercentage: 0.5,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'bottom',
                                labels: {
                                    boxWidth: 16,
                                    boxHeight: 10,
                                    font: { size: 14 }
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: { display: false },
                                ticks: { color: '#b0b0b0', font: { size: 14 } }
                            },
                            y: {
                                beginAtZero: true,
                                grid: { color: '#e5e5e5' },
                                ticks: { color: '#b0b0b0', font: { size: 14 } }
                            }
                        }
                    }
                });
            } catch (e) {
                document.getElementById('transactionsChart').style.display = 'none';
                document.getElementById('chart-error').classList.remove('hidden');
            }
        </script>
        <!-- Material Icons CDN -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </div>
</x-app-layout>
