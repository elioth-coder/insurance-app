<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/data-table.css', 'resources/js/app.js'])

    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            margin: 0.5in 1in;
        }

        @media print{@page {size: landscape}}
    </style>
</head>

<body>
    <header class="mx-auto w-full text-center relative">
        <img class="absolute" style="top: 0; left: 20px; height: 100px;"
            src="{{ asset('images/ic-logo.png') }}" />
        <p class="mt-3">Republic of the Philippines</p>
        <p>DEPARTMENT OF INSURANCE COMMISION</p>
        <h3 class="text-xl font-bold">INSURANCE COMMISSION OFFICE</h3>
        <p class="text-xs my-1">East Avenue, Quezon City</p>
    </header>
    <main class="relative flex flex-col">
        <x-reports.agents-table :$authentications />
    </main>
</body>
<script>
(function() {
    window.print();
})();
</script>
</html>
