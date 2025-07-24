@if(session('success'))
    <x-alert type="success" message="{{ session('success') }}" />
@elseif (session('error'))
    <x-alert type="error" message="{{ session('error') }}" />
@endif
<x-app-layout>
    <x-slot name="header">
            {{ __('Categorias') }}
    </x-slot>
    <div class="flex-1 gap-8 p-8 ">
        <div class="col-span-3 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div class="w-full text-sm text-left rtl:text-right text-gray-500 p-6 justify-between items-center">
                <div class="flex justify-between items-center p-4">
                    <div class="flex justify-center items-center">
                        <p class="pr-1 text-lg font-bold text-left rtl:text-right text-gray-900 bg-white ">1-{{count($categories)}}</p>
                        <p class="text-lg  font-semibold text-left rtl:text-right text-gray-600 bg-white ">de {{count($categories)}} Categorias</p>
                    </div>

                    <x-link-button route='categories.create' text="+ Nova Categoria"/>
                </div>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 bg-gray-100 rounded-2xl">

                    <thead>
                        <tr class="text-md text-center font-bold text-gray-700 uppercase">
                            <th class="p-4 flex justify-center">
                                <input id="default-checkbox" type="checkbox" value="" class="p-3 text-orange-600 bg-gray-100 border-gray-300 rounded-md  focus:ring-1 focus:ring-orange-500 bg-white-700 ">
                            </th>
                            <th scope="col" class="px-6 py-3 text-gray-900  ">
                                Nome da Categoria
                            </th>
                            <th scope="col" class="px-6 py- text-gray-900">
                                Tipo
                            </th>
                            <th scope="col" class="px-6 py-3 text-gray-900">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)

                        <tr class="bg-white border-t border-gray-200 hover:bg-gray-200 text-center">
                            <th class="p-4 flex justify-center">
                                <input id="default-checkbox" type="checkbox" value="" class="p-3 text-orange-600  bg-gray-100 border-gray-300 rounded-md  focus:ring-1 focus:ring-orange-500 bg-white-700 ">
                            </th>
                            <th scope="row" class="px-6 py-4 font-md text-gray-700 whitespace-nowrap ">
                                {{$category->name}}
                            </th>
                                @if($category->type == 'expense')
                                <td class="px-6 py-4 text-red-500 ">  Saída </td>
                                @else
                                <td class="px-6 py-4 text-green-500 ">  Entrada </td>
                                @endif
                            <th class="px-6 py-4 font-md text-gray-700 flex gap-4 justify-center items-center">
                                <a href="{{ route('categories.edit', $category->id) }}" class="bg-orange-500 p-2 material-icons rounded-3xl text-white">edit</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?')" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium text-white bg-red-500 p-2 rounded-3xl  hover:underline  material-icons">delete</button>
                                </form>
                            </th>

                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
