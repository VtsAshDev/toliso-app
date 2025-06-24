<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar Categoria
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nome da Categoria
                        </label>
                        <input type="text" name="name" id="name"
                               value="{{ old('name', $category->name) }}"
                               required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tipo
                        </label>
                        <select name="type" id="type" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="income" {{ $category->type == 'income' ? 'selected' : '' }}>Entrada</option>
                            <option value="expense" {{ $category->type == 'expense' ? 'selected' : '' }}>Saída</option>
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('categories.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline mr-4">Cancelar</a>
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
