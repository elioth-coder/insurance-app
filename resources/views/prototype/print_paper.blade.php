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
    <style type="text/css" media="print">
        * {
            font-family: 'Courier New', Courier, monospace;
        }

        @media(print) {
            #insurance_details {
                display: block !important;
            }
        }


        body {
            background-image:url("{{ asset('images/security-paper.png') }}");
            background-repeat:repeat-y;
            background-position: right top;
            background-attachment:fixed;
            background-size:100%;
        }

        .date_issued, .inception_date, .expiry_date, .model, .make, .color, .mv_file_number, .plate_number, .serial_number, .engine_number, .liability_limit, .basic_premium {
            font-size: 14px;
            font-weight: bold;
            /* color: #06402B; */
            color: #000;
            position: absolute;
            left: 70px;
            top: 360px;
            /* background-color: white; */
            width: 100px;
            text-align: center;
            line-height: 11pt;
        }

        .inception_date, .expiry_date {
            top: 313px;
        }

        .inception_date, .date_issued {
            left: 385px;
            width: 160px;
        }

        .date_issued {
            top: 268px;
        }

        .expiry_date {
            left: 547px;
            width: 168px;
        }

        .make, .serial_number {
            left: 175px;
            width: 125px;
        }

        .engine_number {
            left: 304px;
            width: 135px;
        }

        .color {
            left: 442px;
            width: 136px;
        }

        .mv_file_number {
            left: 582px;
            width: 134px;
        }

        .liability_limit, .basic_premium {
            top: 417px;
            left: 545px;
            width: 170px;
            text-align: right;
            padding-left: 30px;
        }

        .liability_limit {
            /* font-size: 16px; */
        }

        .basic_premium {
            top: 450px;
        }

        .plate_number, .serial_number, .engine_number {
            top: 388px;
        }

        .assured_name, .assured_address {
            font-size: 14px;
            font-weight: bold;
            /* color: #06402B; */
            color: #000;
            position: absolute;
            left: 70px;
            top: 245px;
            /* background-color: white; */
            width: 310px;
            text-align: center;
            line-height: 11pt;
        }

        .assured_address {
            top: 275px;
        }

        .policy_number, .coc_number, .or_number {
            font-size: 14px;
            font-weight: bold;
            /* color: #06402B; */
            color: #000;
            position: absolute;
            right: 80px;
            top: 205px;
        }

        .coc_number {
            top: 235px;
        }

        .or_number {
            top: 265px;
        }

        .qr_code {
            position: absolute;
            right: 60px;
            bottom: 80px;
            height: 110px;
            width: 110px;
        }

        .paper-container {
            position:relative;
            height: 11.7in;
            width: 8.3in;
            border: 1px solid black;
            margin: 0;
        }
    </style>
</head>

<body>
    <div style="text-align: center;" id="insurance_details" class="page-break paper-container">
        {{-- <img src="{{ asset('images/security-paper.png') }}" alt=""> --}}
        <div class="policy_number">{{ $authentication->policy_number }}</div>
        <div class="coc_number">{{ $authentication->coc_number }}</div>
        <div class="or_number">{{ $authentication->or_number }}</div>
        <div class="assured_name uppercase">{{ $authentication->assured_name }}</div>
        <div class="assured_address uppercase">{{ $authentication->assured_address }}</div>
        <div class="date_issued">{{ $authentication->inception_date }}</div>
        <div class="inception_date">{{ $authentication->inception_date }}</div>
        <div class="expiry_date">{{ $authentication->expiry_date }}</div>
        <div class="model">{{ $authentication->model }}</div>
        <div class="make">{{ $authentication->make }}</div>
        <div class="color">{{ $authentication->color }}</div>
        <div class="mv_file_number">{{ $authentication->mv_file_number }}</div>
        <div class="plate_number">{{ $authentication->plate_number }}</div>
        <div class="serial_number">{{ $authentication->serial_number }}</div>
        <div class="engine_number">{{ $authentication->engine_number }}</div>
        <div class="liability_limit">P{{ number_format($settings['LIABILITY_LIMIT'],2) }}</div>
        <div class="basic_premium">P{{ number_format($authentication->basic_premium,2) }}</div>
        <div class="qr_code text-center">
            <div class="mx-auto" style="width: 120px;">{!! QrCode::size(100)->generate($authentication->coc_number) !!}</div>
        </div>
    </div>
</body>
<script>
(function() {
    window.print();
})();
</script>
</html>
