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
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/data-table.css', 'resources/js/app.js'])
    <style>
    html, body {
        overflow: hidden;
    }
    </style>
</head>

<body class="bg-gray-100 font-hanken-grotesk">
    <x-navbar />
    <div class="w-full">
        <main class="mx-auto flex">
            @if ($sidebar)
                <x-sidebar />
            @endif
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @auth
                        <x-breadcrumb :$breadcrumbs />
                    @endauth
                    <div>
                        {{ $slot }}
                    </div>
                </section>
                <x-copyright />
            </div>
        </main>
    </div>
    <script>
        function clickTab(name) {
            console.log('called clickTab().');
            let button = document.querySelector(`#${name}-tab`);

            if(button) {
                console.log({button});
                button.click();

                console.log(button.getAttribute('aria-selected'));
                if(button.getAttribute('aria-selected')=='true') {
                    return;
                }
            }

            setTimeout(() => {
                clickTab(name);
            }, 1000);
        }

        (function() {
            name = 'dashboard';

            @if (request()->is('subagents') || request()->is('subagents/*')) name='users'; @endif
            @if (request()->is('coc_series') || request()->is('coc_series/*')) name='series'; @endif
            @if (request()->is('authentication') || request()->is('authentication/*')) name='authentication'; @endif
            @if (request()->is('interagency') || request()->is('interagency/*')) name='interagency'; @endif
            @if (request()->is('reports') || request()->is('reports/*')) name='reports'; @endif

            clickTab(name);
        })();
    </script>

    {{ $script }}
</body>
</html>
