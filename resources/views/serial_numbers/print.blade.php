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
            font-family: 'Courier New', Courier, monospace;
        }
    </style>
    <style type="text/css" media="print">
        body
        {
            background-image:url("{{ asset('images/security-paper.png') }}");
            background-repeat:repeat-y;
            background-position: right top;
            background-attachment:fixed;
            background-size:100%;
        }
        .coc_number {
            font-size: 14px;
            font-weight: bold;
            color: #06402B;
            position: absolute;
            right: 85px;
            top: 235px;
        }

        .qr_code {
            position: absolute;
            right: 60px;
            bottom: 80px;
            height: 110px;
            width: 110px;
        }
    </style>
</head>

<body>
    @foreach ($serials as $serial)
        <div class="page-break" style="position:relative; height: 11.7in; width: 8.3in; border: 1px solid black; margin: 0;">
            <div class="coc_number">{{ $serial }}</div>
            <div class="qr_code">
                {!! QrCode::size(100)->generate($serial) !!}
            </div>
        </div>
    @endforeach
</body>
<script>
(function() {
    window.print();
})();
</script>
</html>
