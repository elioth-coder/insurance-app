<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/data-table.css', 'resources/js/app.js'])
    <style>
        html,
        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body class="font-hanken-grotesk text-white">
    <nav class="flex justify-between sticky top-0 left-0 right-0 bg-violet-800 border-b border-violet-600">
        <x-logo-brand class="text-white p-3" />
        <div class="flex items-center p-3">
            <a href="/login"
                class="text-white bg-purple-700 hover:bg-gray-100 hover:text-purple-700 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                Login &rarr;
            </a>
        </div>
    </nav>

    <div style="height: calc(100vh - 135px);" class="text-black w-screen flex flex-col justify-center items-center space-y-6">
        <h1 class="text-center text-4xl">QR Verifier</h1>
        <div class="border-violet-900 border-8 h-60 w-60 flex relative items-center justify-center">
            <img class="block" src="/prototype/qr.png" alt="" style="width: 190px;">
        </div>
        <p class="text-center">Point the QR Code inside the box</p>
    </div>

    <footer class="bg-violet-800 border-t border-violet-600 text-white py-5">
        <p class="text-center font-thin">Copyright &copy; 2024 iVeIM System | v1.0.0</p>
    </footer>
</body>

</html>
