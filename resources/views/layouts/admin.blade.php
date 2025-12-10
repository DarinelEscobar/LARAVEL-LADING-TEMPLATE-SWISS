<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="h-full bg-background font-sans antialiased text-foreground selection:bg-primary/10">

    <div class="flex h-screen overflow-hidden">
        {{-- Sidebar --}}
        <x-admin.sidebar />

        <div class="flex flex-col flex-1 min-w-0 overflow-hidden">
            {{-- Header --}}
            <x-admin.header />

            {{-- Main Content --}}
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                @include('partials.alerts')
                @yield('content')
            </main>
        </div>
    </div>

    @livewireScripts
</body>

</html>
