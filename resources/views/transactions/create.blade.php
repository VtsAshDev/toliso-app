<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Nova Transação
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('transactions.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Categoria
                        </label>
                        <select name="category_id" id="category_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Descrição
                        </label>
                        <input type="text" name="description" id="description"
                               value="{{ old('description') }}"
                               required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="value" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Valor
                        </label>
                        <input type="number" step="0.01" name="value" id="value"
                               value="{{ old('value') }}"
                               required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="is_recurring" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Recorrente?
                        </label>
                        <select name="is_recurring" id="is_recurring" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="0" {{ old('is_recurring') == '0' ? 'selected' : '' }}>Não</option>
                            <option value="1" {{ old('is_recurring') == '1' ? 'selected' : '' }}>Sim</option>
                        </select>
                    </div>

                    <div>
                        <label for="installments" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Parcelas (opcional)
                        </label>
                        <input type="number" name="installments" id="installments"
                               value="{{ old('installments') }}"
                               min="1"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Data de Vencimento(opcional)
                        </label>
                        <input type="date" name="due_date" id="due_date"
                               value="{{ old('due_date') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="transaction_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Data da Transação
                        </label>
                        <input type="date" name="transaction_date" id="transaction_date"
                               value="{{ \Carbon\Carbon::today()->toDateString() }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('transactions.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline mr-4">Cancelar</a>
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700">
                            Salvar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
