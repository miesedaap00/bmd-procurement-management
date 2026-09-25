<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ config('app.name', 'Procurement Management') }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F2F2F2] text-[#252525]">

    <div class="min-h-screen">

        {{-- Sidebar --}}
        @include('components.sidebar')

        {{-- Main Content --}}
        <div
            id="main-content"
            class="transition-all duration-300"
            style="margin-left: 16rem;"
        >

            {{-- Navbar --}}
            @include('components.navbar')

            {{-- Page Content --}}
            <main class="p-6">
                @yield('content')
            </main>

        </div>

    </div>

</body>

</html>