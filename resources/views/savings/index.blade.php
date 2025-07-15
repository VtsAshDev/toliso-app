@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reservas') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">





                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                           Suas Reservas
                            <div class="flex justify-between items-center">
                                    <div class="flex flex-col items-start gap-2 ">
                                            <p class="mt-1 text-md font-normal text-gray-500 dark:text-gray-400">Aqui você vai registrar o quanto você tá economizando 😉</p>
                                        <div class="flex flex-row items-center gap-4">
                                            <h1 class="text-4xl">Reserva atual :</h1>
                                            <h1 class="text-6xl text-green-500">{{number_format($total, 2, ',', '.')}}</h1>
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-4 ">
                                        <a href="#" class="text-white bg-gradient-to-br from-green-800 to-green-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-bold rounded-xl text-xl px-5 py-2.5 text-center me-2 mb-2">Adicionar a Reserva</a>
                                        <a href="#" class="text-white bg-gradient-to-br from-green-800 to-green-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-bold rounded-xl text-xl px-5 py-2.5 text-center me-2 mb-2">Nova Meta</a>
                                    </div>
                                </div>
                        </caption>
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-center text-md">
                                Nota
                            </th>
                            <th scope="col" class="px-6 py-3 text-center text-md">
                                Valor
                            </th>
                            <th scope="col" class="px-6 py-3 text-center  text-md">
                                Quanto Falta
                            </th>
                            <th scope="col" class="px-6 py-3 text-center  text-md">
                                Ações
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($savings as $saving)
                            <tr>
                                <th class="px-6 py-3 text-center  text-md">
                                    {{$saving->note}}
                                </th >
                                <th class="px-6 py-3 text-center text-md">
                                    R${{number_format($saving->balance, 2, ',', '.')}}
                                </th>
                                <th>
                                </th>
                                <th class="px-6 py-4 flex justify-evenly    ">
                                    <a href="{{ route('savings.edit', $saving->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                                    <form action="{{ route('savings.destroy', $saving->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?')" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Excluir</button>
                                    </form>
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
