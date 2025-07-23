<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="bg-gray-100 dark:bg-gray-900 flex">
            @include('layouts.navigation')

            <div class="flex-1 flex-col gap-8 p-8 bg-gray-100 ">
                @isset($header)
                    <div class="flex items-center justify-between">
                        <h1 class="text-5xl font-bold text-gray-800">{{$header}}</h1>
                        <div class="flex items-center gap-8">
                            <div class="relative w-80">
                                <input type="text" placeholder="Enter your search" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-200 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-orange-400" />
                                <span class="material-icons absolute left-3 top-2.5 text-gray-400">search</span>
                            </div>
                            <span class="material-icons text-gray-400 text-3xl">notifications</span>
                        </div>
                    </div>
                @endisset

                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
