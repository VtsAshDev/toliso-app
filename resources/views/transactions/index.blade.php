<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transações') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 px-4 py-3 rounded-md bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <caption class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                            Suas Transações
                            <div class="flex justify-between items-center mt-2">
                                <p class="text-sm font-normal text-gray-500 dark:text-gray-400 max-w-xl">
                                    Aqui você vai adicionar seus gastos e ganhos para te auxiliarmos a se organizar pra você não ficar mais liso 😉
                                </p>
                                <a href="{{ route('transactions.create') }}"
                                   class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Nova Transação
                                </a>
                            </div>
                            <form method="GET" action="{{ route('transactions.index') }}" class="flex flex-1  gap-4 mb-4">
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-500">Tipo</label>
                                    <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded-md bg-gray-800">
                                        <option value="">Todos</option>
                                        <option value="income" {{ request('type') == 'income' ? 'selected' : '' }}>Receita</option>
                                        <option value="expense" {{ request('type') == 'expense' ? 'selected' : '' }}>Despesa</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="category" class="block text-sm font-medium text-gray-500">Categoria</label>
                                    <input type="text" name="category" id="category" value="{{ request('category') }}" class="mt-1 block w-full border-gray-300 rounded-md bg-gray-800" />
                                </div>

                                <div>
                                    <label for="date_from" class="block text-sm font-medium text-gray-500">Data Inicial</label>
                                    <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" class="mt-1 block w-full border-gray-300 rounded-md bg-gray-800" />
                                </div>

                                <div>
                                    <label for="date_to" class="block text-sm font-medium text-gray-500">Data Final</label>
                                    <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" class="mt-1 block w-full border-gray-300 rounded-md bg-gray-800" />
                                </div>

                                <div class="flex gap-2 mt-4">
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filtrar</button>
                                    <a href="{{ route('transactions.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded ">Limpar</a>
                                </div>
                            </form>
                        </caption>

                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3">Descrição</th>
                            <th class="px-6 py-3">Valor</th>
                            <th class="px-6 py-3 text-center">Data</th>
                            <th class="px-6 py-3 text-center">Categoria</th>
                            <th class="px-6 py-3 text-center">Tipo</th>
                            <th class="px-6 py-3 text-center">Parcelas</th>
                            <th class="px-6 py-3 text-center">Recorrente</th>
                            <th class="px-6 py-3 text-center">Vencimento</th>
                            <th class="px-6 py-3 text-center">Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($transactions as $transaction)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    {{ $transaction->description }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    <span class="{{ $transaction->category->type == 'income' ? 'text-green-600' : 'text-red-600' }}">
                                        R$ {{ number_format($transaction->amount, 2, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center text-gray-700 dark:text-gray-300">
                                    {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/Y') }}
                                </td>

                                <td class="px-6 py-4 text-center text-gray-700 dark:text-gray-300">
                                    {{ $transaction->category->name ?? 'Sem categoria' }}
                                </td>
                                <td class="px-6 py-4 text-center text-gray-700 dark:text-gray-300">
                                    {{ $transaction->category->type == 'income' ? 'Entrada' : 'Saída' }}
                                </td>
                                <td class="px-6 py-4 text-center text-gray-700 dark:text-gray-300">
                                    {{ $transaction->installments ?? '' }}
                                </td>
                                <td class="px-6 py-4 text-center text-gray-700 dark:text-gray-300">
                                    {{ $transaction->is_recurring ? 'Sim' : 'Não' }}
                                </td>
                                <td class="px-6 py-4 text-center text-gray-700 dark:text-gray-300">
                                    {{$transaction->due_date == null ? '' : \Carbon\Carbon::parse($transaction->due_date)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 text-center text-gray-700 dark:text-gray-300 justify-between">
                                    <a href="{{ route('transactions.edit', $transaction) }}">Editar</a>
                                    <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?')" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white dark:bg-gray-800">
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    Nenhuma transação encontrada.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
