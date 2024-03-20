<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!doctype html>

        <!-- <link rel="stylesheet" href="{{ asset('dist/style.css') }}"> -->

        <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/{{ session('theme', 'cerulean') }}/bootstrap.min.css" rel="stylesheet">


        <!-- Fonts -->

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireScripts
        @livewireStyles
  
    </head>
    <body class="font-sans antialiased">
   
        <div class="bg-gray-100 dark:bg-gray-800">
            @include('layouts.navigation')
            </div>
            <div class="bg-gray-100 dark:bg-gray-800">
            <!-- Side panel -->
            @include('layouts.side-panel')
            </div>
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-dark dark:bg-gray-900 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }} 
                    </div>
                </header> 
            @endif
            <div class="bg-gray-100 dark:bg-gray-800">
                 <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            </div>
           
        </div>
    </body>
</html>
