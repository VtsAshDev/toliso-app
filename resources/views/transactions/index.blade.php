<x-app-layout>
    @if(session('success'))
        <div class="mb-4 px-4 py-3 rounded-md bg-green-100 text-green-800 ">
            {{ session('success') }}
        </div>
    @endif
    <x-slot name="header">
        {{ __('Transações') }}
    </x-slot>
    <div class="flex-1 gap-8 p-8 ">
        <div class="col-span-3 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div class="w-full text-left rtl:text-right text-gray-500 p-6 justify-between items-center">
                <div class="flex justify-between items-center p-4">
                    <div class="w-full flex justify-between items-center">
                        <form method="GET" action="{{ route('transactions.index') }}" class="grid grid-cols-7 gap-4 items-end justify-between w-full">
                            <div class="col-span-1">
                                <label for="type" class=" text-sm font-medium text-gray-500">Tipo</label>
                                <select name="type" id="type" class="mt-1  w-full border-gray-300 rounded-md bg-white">
                                    <option value="">Todos</option>
                                    <option value="income" {{ request('type') == 'income' ? 'selected' : '' }}>Receita</option>
                                    <option value="expense" {{ request('type') == 'expense' ? 'selected' : '' }}>Despesa</option>
                                </select>
                            </div>
                            <div class="col-span-1">
                                <label for="category" class=" text-sm font-medium text-gray-500">Categoria</label>
                                <input type="text" name="category" id="category" value="{{ request('category') }}" class="mt-1  w-full border-gray-300 rounded-md bg-white" />
                            </div>
                            <div class="col-span-1">
                                <label for="date_from" class=" text-sm font-medium text-gray-500">Data Inicial</label>
                                <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" class="mt-1  w-full border-gray-300 rounded-md bg-white" />
                            </div>
                            <div class="col-span-1">
                                <label for="date_to" class=" text-sm font-medium text-gray-500">Data Final</label>
                                <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" class="mt-1  w-full border-gray-300 rounded-md bg-white" />
                            </div>
                            <div class="col-span-1 ">
                                <button type="submit" class="material-icons mr-2 bg-orange-500 text-white font-md text-xl px-4 py-2 rounded-3xl">search</button>
                                <a href="{{ route('transactions.index') }}" class="material-icons mr-2 bg-red-500 text-white font-md text-xl px-4 py-2 rounded-3xl">clear</a>

                            </div>
                            <div class="col-span-2 flex justify-end">
                                <x-link-button route='transactions.create' text="+Nova Transação" />
                            </div>

                        </form>
                    </div>

                </div>

                <table class="w-full text-gray-500 bg-gray-100 rounded-2xl">

                    <thead >
                    <tr class="text-xl text-gray-700 text-center">
                        <th class="px-6 py-3">Descrição</th>
                        <th class="px-6 py-3">Valor</th>
                        <th class="px-6 py-3">Data</th>
                        <th class="px-6 py-3">Categoria</th>
                        <th class="px-6 py-3">Tipo</th>
                        <th class="px-6 py-3">Parcelas</th>
                        <th class="px-6 py-3">Recorrente</th>
                        <th class="px-6 py-3">Vencimento</th>
                        <th class="px-6 py-3">Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($transactions as $transaction)
                        <tr class="bg-white  border-t hover:bg-gray-200 text-center">
                            <th class="px-6 py-4 font-md text-gray-700 whitespace-nowrap ">
                                {{ $transaction->description }}
                            </th>
                            <th class="px-6 py-4 font-md ">
                                    <span class="{{ $transaction->category->type == 'income' ? 'text-green-600' : 'text-red-600' }}">
                                        R$ {{ number_format($transaction->amount, 2, ',', '.') }}
                                    </span>
                            </th>
                            <th class="px-6 py-4 font-md text-gray-700 whitespace-nowrap ">
                                {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/Y') }}
                            </th>

                            <th class="px-6 py-4 font-md text-gray-700 whitespace-nowrap ">
                                {{ $transaction->category->name ?? 'Sem categoria' }}
                            </th>
                            <th class="px-6 py-4 font-md text-gray-700 whitespace-nowrap ">
                                {{ $transaction->category->type == 'income' ? 'Entrada' : 'Saída' }}
                            </th>
                            <th class="px-6 py-4 font-md text-gray-700 whitespace-nowrap ">
                                {{ $transaction->installments ? $transaction->installments.'X' : '-' }}
                            </th>
                            <th class="px-6 py-4 font-md text-gray-700 whitespace-nowrap ">
                                {{ $transaction->is_recurring ? 'Sim' : 'Não'  }}
                            </th>
                            <th class="px-6 py-4 font-md text-gray-700 whitespace-nowrap ">
                                {{!$transaction->is_recurring ? '-' : \Carbon\Carbon::parse($transaction->due_date)->format('d/m/Y') }}
                            </th>
                            <th class="px-6 py-4 font-md text-gray-700 flex gap-4 justify-center items-center">
                                <a href="{{ route('transactions.edit', $transaction) }}" class="bg-orange-500 p-2 material-icons rounded-3xl text-white">edit</a>
                                <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?')" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium text-white bg-red-500 p-2 rounded-3xl  hover:underline  material-icons">delete</button>
                                </form>
                            </th>
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
</x-app-layout>
