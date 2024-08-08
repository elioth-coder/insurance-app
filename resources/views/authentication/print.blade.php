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
</head>

<body>
    <div class="mx-auto w-fit text-center">
        <p>Republic of the Philippines</p>
        <p>DEPARTMENT OF INSURANCE COMMISION</p>
        <h3 class="text-xl font-bold">INSURANCE COMMISSION OFFICE</h3>
        <p class="text-xs">East Avenue, Quezon City</p>
        <h2 class="text-2xl font-bold">CERTIFICATE OF AUTHENTICATION</h2>

    </div>
    <table class="table border mx-auto">
        <tbody>
            <tr class="border-b">
                <td class="px-6 py-4 border-r font-bold">Registration Type</td>
                <td class="px-6 py-4 uppercase">{{ $authentication->type }}</td>
            </tr>
            <tr class="border-b">
                <td class="px-6 py-4 border-r font-bold">Transaction Date</td>
                <td class="px-6 py-4">{{ date("M d, Y h:i A", strtotime($authentication->created_at)) }}</td>
            </tr>
            <tr class="border-b">
                <td class="px-6 py-4 border-r font-bold">Assured Name</td>
                <td class="px-6 py-4 uppercase">{{ $authentication->assured_name }}</td>
            </tr>
            <tr class="border-b">
                <td class="px-6 py-4 border-r font-bold">COC Number</td>
                <td class="px-6 py-4">{{ $authentication->coc_number }}</td>
            </tr>
            <tr class="border-b">
                <td class="px-6 py-4 border-r font-bold">POLICY Number</td>
                <td class="px-6 py-4">{{ $authentication->policy_number }}</td>
            </tr>
            <tr class="border-b">
                <td class="px-6 py-4 border-r font-bold">OR Number</td>
                <td class="px-6 py-4">{{ $authentication->or_number }}</td>
            </tr>
            <tr class="border-b">
                <td class="px-6 py-4 border-r font-bold">Plate Number</td>
                <td class="px-6 py-4">{{ $authentication->plate_number ?? '--' }}</td>
            </tr>
            <tr class="border-b">
                <td class="px-6 py-4 border-r font-bold">MV File Number</td>
                <td class="px-6 py-4">{{ $authentication->mv_file_number ?? '--' }}</td>
            </tr>
            <tr class="border-b">
                <td class="px-6 py-4 border-r font-bold">Chassis Number</td>
                <td class="px-6 py-4">{{ $authentication->serial_number }}</td>
            </tr>
            <tr class="border-b">
                <td class="px-6 py-4 border-r font-bold">Engine Number</td>
                <td class="px-6 py-4">{{ $authentication->engine_number ?? '--' }}</td>
            </tr>
            <tr class="border-b">
                <td class="px-6 py-4 border-r font-bold">Inception From</td>
                <td class="px-6 py-4">{{ date("M d, Y h:i A", strtotime($authentication->inception_date)) }}</td>
            </tr>
            <tr class="border-b">
                <td class="px-6 py-4 border-r font-bold">Inception To</td>
                <td class="px-6 py-4">{{ date("M d, Y h:i A", strtotime($authentication->expiry_date)) }}</td>
            </tr>
            <tr class="border-b">
                <td class="px-6 py-4 border-r font-bold">Agent Name</td>
                <td class="px-6 py-4 uppercase">
                    {{ $series_number->agent->first_name }}
                    {{ $series_number->agent->last_name }} -
                    [{{ $series_number->agent->branch }}]
                </td>
            </tr>
            @php
            $premiums = [
                [],
                ['description' => 'Private Cars (including jeeps and AUVs)', 'duration' => '1 -Year(s)', 'amount' => '560.00' ],
                ['description' => 'Light Medium Trucks (Own Goods) Not over 3,930 kgs.', 'duration' => '1 -Year(s)', 'amount' => '610.00' ],
                ['description' => 'Heavy Trucks (Own Good), Private Buses over 3,930 kgs.', 'duration' => '1 -Year(s)', 'amount' => '1,200.00' ],
                ['description' => 'AC and Tourists Cars', 'duration' => '1 -Year(s)', 'amount' => '740.00' ],
                ['description' => 'Taxi, PUJ and Mini bus', 'duration' => '1 -Year(s)', 'amount' => '1,100.00' ],
                ['description' => 'PUB and Tourists Bus', 'duration' => '1 -Year(s)', 'amount' => '1,450.00' ],
                ['description' => 'Motorcycles/Tricycles/Trailers', 'duration' => '1 -Year(s)', 'amount' => '250.00' ],
                ['description' => 'Private Cars (including jeeps and AUVs)', 'duration' => '3 -Year(s)', 'amount' => '1,610.00' ],
                ['description' => 'Light Medium Trucks (Own Goods) Not over 3,930 kgs.', 'duration' => '3 -Year(s)', 'amount' => '1,750.00' ],
                ['description' => 'Heavy Trucks (Own Good), Private Buses over 3,930 kgs.', 'duration' => '3 -Year(s)', 'amount' => '3,440.00' ],
                ['description' => 'AC and Tourists Cars', 'duration' => '3 -Year(s)', 'amount' => '2,120.00' ],
                ['description' => 'Taxi, PUJ and Mini bus', 'duration' => '3 -Year(s)', 'amount' => '3,150.00' ],
                ['description' => 'PUB and Tourists Bus', 'duration' => '3 -Year(s)', 'amount' => '4,150.00' ],
                ['description' => 'Motorcycles/Tricycles/Trailers', 'duration' => '3 -Year(s)', 'amount' => '720.00' ],
            ];
            @endphp
            <tr class="border-b">
                <td class="px-6 py-4 border-r font-bold">Premium Amount</td>
                <td class="px-6 py-4">{{ $premiums[$authentication->vehicle_type]['amount'] ?? '--' }}</td>
            </tr>
            <tr class="border-b">
                <td class="px-6 py-4 border-r font-bold">Status</td>
                <td class="px-6 py-4"> Valid</td>
            </tr>
            <tr class="border-b">
                <td class="px-6 py-4 border-r font-bold">IC-LTMS Authentication Code</td>
                <td class="px-6 py-4">1584-4A57-A8D9-02C7</td>
            </tr>
        </tbody>
    </table>

</body>

</html>
