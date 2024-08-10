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

<body class="font-hanken-grotesk bg-violet-700 text-white">
    <nav class="flex justify-between sticky top-0 left-0 right-0 bg-violet-800 border-b border-violet-600">
        <x-logo-brand class="text-white p-3" />
        <div class="flex items-center p-3">
            <a href="/login"
                class="text-white bg-purple-700 hover:bg-gray-100 hover:text-purple-700 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                Login &rarr;
            </a>
        </div>
    </nav>

    <div class="h-screen w-screen flex flex-col justify-center items-center space-y-12">
        <div class="text-center max-w-4xl mx-auto space-y-5">
            <h1 class="text-7xl">Welcome! to iVeIM System v1.0.0</h1>
            <p>
                The system that enhances the communication and data sharing between the LTO, Highway Patrol Group,
                Insurance Commission, Bureau of Customs and the LTFRB ensuring that all relevant parties have real-time access to a vehicle's
                insurance status.
            </p>
        </div>
        <div class="flex space-x-2 justify-center">
            <a target="_blank" title="LTO Official Website" href="https://lto.gov.ph" class="block">
                <img style="height: 150px;" src="{{ asset('images/lto-logo.png') }}" alt="">
            </a>
            <a target="_blank" title="Insurance Commission Official Website" href="https://www.insurance.gov.ph/" class="block">
                <img style="height: 150px;" class="w-full"
                    src="{{ asset('images/ic-logo.png') }}" alt="">
            </a>
            <a target="_blank" title="HPG Official Website" href="https://hpg.pnp.gov.ph/" class="block">
                <img style="height: 150px;" class="w-full" src="{{ asset('images/hpg-logo.png') }}"
                    alt="">
            </a>
            <a target="_blank" title="Bureau of Customs Official Website" href="https://www.customs.gov.ph/" class="block">
                <img style="height: 150px;" class="w-full"
                    src="{{ asset('images/boc-logo.png') }}" alt="">
            </a>
            <a target="_blank" title="LTFRB Official Website" href="https://www.ltfrb.gov.ph/" class="block">
                <img style="height: 150px;" class="w-full"
                    src="{{ asset('images/ltfrb-logo.png') }}" alt="">
            </a>
        </div>
    </div>

    <footer class="bg-violet-800 border-t border-violet-600 text-white py-5">
        <p class="text-center font-thin">&copy; 2024 iVeIM System | v1.0.0</p>
    </footer>
</body>

</html>
