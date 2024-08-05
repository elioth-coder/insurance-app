@props([
    'script' => '',
    'breadcrumbs' => [],
    'sidebar' => true,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
    html, body {
        overflow: hidden;
    }
    </style>
</head>

<body class="bg-gray-100 font-hanken-grotesk pb-20">
    <x-navbar />
    <div class="w-full">
        <main class="max-w-[986px] mx-auto flex">
            @if ($sidebar)
                <x-sidebar />
            @endif
            <div class="w-full px-5 pt-2 overflow-hidden hover:overflow-y-scroll" style="height: calc(100vh - 56px)">
                @auth
                    <x-breadcrumb :$breadcrumbs />
                @endauth
                @guest
                    <div class="p-6"></div>
                @endguest
                <div class="py-2">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>
    {{ $script }}
</body>
</html>
