@php
    $serverIp = gethostbyname(gethostname());

    $mv_types = [
        'C' => 'Car',
        'HB' => 'Shuttle Bus',
        'LE' => 'Light Electric Vehicle',
        'M' => 'Motorcycle without Sidecar',
        'MO' => 'Moped (0-49 cc)',
        'MS' => 'Motorcycle with Sidecar',
        'NC' => 'Non-Conventional MC (Car)',
        'NV' => 'Non-Conventional MV (UV)',
        'OB' => 'Tourist Bus',
        'SB' => 'School Bus',
        'SV' => 'Sports Utility Vehicle',
        'TB' => 'Truck Bus',
        'TC' => 'Tricycle',
        'TK' => 'Truck',
        'TL' => 'Trailer',
        'UV' => 'Utility Vehicle',
    ];
    $premiums = [
        [],
        [
            'description' => 'Private Cars (including jeeps and AUVs)',
            'duration' => '1 -Year(s)',
            'amount' => '560.00',
        ],
        [
            'description' => 'Light Medium Trucks (Own Goods) Not over 3,930 kgs.',
            'duration' => '1 -Year(s)',
            'amount' => '610.00',
        ],
        [
            'description' => 'Heavy Trucks (Own Good), Private Buses over 3,930 kgs.',
            'duration' => '1 -Year(s)',
            'amount' => '1,200.00',
        ],
        ['description' => 'AC and Tourists Cars', 'duration' => '1 -Year(s)', 'amount' => '740.00'],
        ['description' => 'Taxi, PUJ and Mini bus', 'duration' => '1 -Year(s)', 'amount' => '1,100.00'],
        ['description' => 'PUB and Tourists Bus', 'duration' => '1 -Year(s)', 'amount' => '1,450.00'],
        [
            'description' => 'Motorcycles/Tricycles/Trailers',
            'duration' => '1 -Year(s)',
            'amount' => '250.00',
        ],
        [
            'description' => 'Private Cars (including jeeps and AUVs)',
            'duration' => '3 -Year(s)',
            'amount' => '1,610.00',
        ],
        [
            'description' => 'Light Medium Trucks (Own Goods) Not over 3,930 kgs.',
            'duration' => '3 -Year(s)',
            'amount' => '1,750.00',
        ],
        [
            'description' => 'Heavy Trucks (Own Good), Private Buses over 3,930 kgs.',
            'duration' => '3 -Year(s)',
            'amount' => '3,440.00',
        ],
        ['description' => 'AC and Tourists Cars', 'duration' => '3 -Year(s)', 'amount' => '2,120.00'],
        ['description' => 'Taxi, PUJ and Mini bus', 'duration' => '3 -Year(s)', 'amount' => '3,150.00'],
        ['description' => 'PUB and Tourists Bus', 'duration' => '3 -Year(s)', 'amount' => '4,150.00'],
        [
            'description' => 'Motorcycles/Tricycles/Trailers',
            'duration' => '3 -Year(s)',
            'amount' => '720.00',
        ],
    ];
@endphp

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
            margin: 10px;
        }
    </style>
</head>

<body class="flex flex-col">
    <header class="block text-center relative mx-5">
        <h3 class="text-lg font-bold">Integrated Vehicle Insurance Monitoring System</h3>
        <section class="flex items-center justify-center space-x-2">
            <img class="block" style="height: 90px;" src="{{ asset('images/insurance-logo.png') }}" />
            <svg class="w-[100px] h-[100px] text-green-500 block" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M12 2c-.791 0-1.55.314-2.11.874l-.893.893a.985.985 0 0 1-.696.288H7.04A2.984 2.984 0 0 0 4.055 7.04v1.262a.986.986 0 0 1-.288.696l-.893.893a2.984 2.984 0 0 0 0 4.22l.893.893a.985.985 0 0 1 .288.696v1.262a2.984 2.984 0 0 0 2.984 2.984h1.262c.261 0 .512.104.696.288l.893.893a2.984 2.984 0 0 0 4.22 0l.893-.893a.985.985 0 0 1 .696-.288h1.262a2.984 2.984 0 0 0 2.984-2.984V15.7c0-.261.104-.512.288-.696l.893-.893a2.984 2.984 0 0 0 0-4.22l-.893-.893a.985.985 0 0 1-.288-.696V7.04a2.984 2.984 0 0 0-2.984-2.984h-1.262a.985.985 0 0 1-.696-.288l-.893-.893A2.984 2.984 0 0 0 12 2Zm3.683 7.73a1 1 0 1 0-1.414-1.413l-4.253 4.253-1.277-1.277a1 1 0 0 0-1.415 1.414l1.985 1.984a1 1 0 0 0 1.414 0l4.96-4.96Z" clip-rule="evenodd"/>
            </svg>
        </section>
        <h1 class="text-2xl text-center font-bold text-green-500">VERIFIED CERTIFICATE OF COVERAGE</h1>
    </header>
    <main class="relative flex flex-col">
        <div colspan="2" class="p-2 border my-2 mx-auto w-full">
            <p class="">Official Receipt Number</p>
            <p class="text-xl font-bold">{{ $authentication->or_number }}</p>
        </div>
        <div colspan="2" class="p-2 border my-2 mx-auto w-full">
            <p class="">COC Number</p>
            <p class="text-xl font-bold">{{ $authentication->or_number }}</p>
        </div>
        <div colspan="2" class="p-2 border my-2 mx-auto w-full">
            <p class="">Policy Number</p>
            <p class="text-xl font-bold">{{ $authentication->or_number }}</p>
        </div>
        <div colspan="2" class="p-2 border my-2 mx-auto w-full">
            <p class="">Assured Name</p>
            <p class="text-xl font-bold">{{ $authentication->assured_name }}</p>
        </div>
        <div colspan="2" class="p-2 border my-2 mx-auto w-full">
            <p class="">Assured Address</p>
            <p class="text-xl font-bold">{{ $authentication->assured_name }}</p>
        </div>
        <div colspan="2" class="p-2 border my-2 mx-auto w-full">
            <p class="">Plate Number</p>
            <p class="text-xl font-bold">{{ $authentication->plate_number ?? '--' }}</p>
        </div>
        <div colspan="2" class="p-2 border my-2 mx-auto w-full mt-5">
            <p class="">MV File Number</p>
            <p class="text-xl font-bold">{{ $authentication->mv_file_number ?? '--' }}</p>
        </div>
        <section class="block box-border border-2 border-black w-fit mx-auto"
            style="width: 210px; min-width: 210px; height: 210px; min-height: 210px; padding: 5px;">
            {!! QrCode::size(200)->generate(
                "http://$serverIp:" . env('SERVER_PORT') . "/authentication/$authentication->id/view",
            ) !!}
        </section>
    <footer class="text-center py-5">

    </footer>
</body>

</html>
