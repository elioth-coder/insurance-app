@props(['authentication','series_number'])
@php
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

<table class="table border mx-auto w-full">
    <tbody>
        <tr>
            <td colspan="4" class="text-center font-bold border-b bg-gray-300 py-1">INSURED DETAILS</td>
        </tr>
        <tr class="border-b">
            <td colspan="2" class="p-2 border-r">
                <p class="font-bold">IC-LTMS Authentication Code:</p>
                <p class="text-center">1584-4A57-A8D9-02C7</p>
            </td>
            <td colspan="2" class="p-2">
                <p class="font-bold">Transaction Date:</p>
                <p class="text-center">{{ date('M d, Y h:i A', strtotime($authentication->created_at)) }}</p>
            </td>
        </tr>

        <tr class="border-b">
            <td class="p-2 border-r font-bold">Registration Type</td>
            <td class="p-2 border-r uppercase">{{ $authentication->type }}</td>
            <td class="p-2 border-r font-bold">POLICY Number</td>
            <td class="p-2 border-r">{{ $authentication->policy_number }}</td>
        </tr>
        <tr class="border-b">
            <td class="p-2 border-r font-bold">Assured Name</td>
            <td class="p-2 border-r uppercase">{{ $authentication->assured_name }}</td>
            <td class="p-2 border-r font-bold">COC Number</td>
            <td class="p-2">{{ $authentication->coc_number }}</td>
        </tr>
        <tr class="border-b">
            <td class="p-2 border-r font-bold">Assured Address</td>
            <td class="p-2 border-r">{{ $authentication->assured_address }}</td>
            <td class="p-2 border-r font-bold">OR Number</td>
            <td class="p-2">{{ $authentication->or_number }}</td>
        </tr>
        <tr>
            <td colspan="4" class="text-center font-bold border-b bg-gray-300 py-1">VEHICLE DETAILS</td>
        </tr>
        <tr class="border-b">
            <td class="p-2 border-r font-bold">Plate Number</td>
            <td class="p-2 border-r">{{ $authentication->plate_number ?? '--' }}</td>
            <td class="p-2 border-r font-bold">MV File Number</td>
            <td class="p-2">{{ $authentication->mv_file_number ?? '--' }}</td>
        </tr>
        <tr class="border-b">
            <td class="p-2 border-r font-bold">Chassis Number</td>
            <td class="p-2 border-r">{{ $authentication->serial_number }}</td>
            <td class="p-2 border-r font-bold">Engine Number</td>
            <td class="p-2">{{ $authentication->engine_number ?? '--' }}</td>
        </tr>
        <tr class="border-b">
            <td class="p-2 border-r font-bold">LTO MV Type</td>
            <td colspan="3" class="p-2 border-r uppercase">
                {{ $authentication->lto_mv_type }} - {{ $mv_types[$authentication->lto_mv_type] ?? '--' }}
            </td>
        </tr>
        <tr class="border-b">
            <td class="p-2 border-r font-bold">Vehicle Type</td>
            <td colspan="3" class="p-2 border-r uppercase">
                {{ $authentication->vehicle_type }} - {{ $premiums[$authentication->vehicle_type]['description'] ?? '--' }}
            </td>
        </tr>
        <tr>
            <td colspan="4" class="text-center font-bold border-b bg-gray-300 py-1">PERIOD OF INSURANCE</td>
        </tr>
        <tr class="border-b">
            <td class="p-2 border-r font-bold">Agent Name</td>
            <td colspan="3" class="p-2 border-r uppercase">
                {{ $series_number->agent->first_name }}
                {{ $series_number->agent->last_name }} -
                [{{ $series_number->agent->branch }}]
            </td>
        </tr>
        <tr class="border-b">
            <td colspan="2" class="p-2 border-r"><b>FROM:</b>
                {{ date('M d, Y h:i A', strtotime($authentication->inception_date)) }}</td>
            <td colspan="2" class="p-2"><b>TO:</b>
                {{ date('M d, Y h:i A', strtotime($authentication->expiry_date)) }}</td>
        </tr>
        <tr class="border-b">
            <td class="p-2 border-r font-bold">Status</td>
            <td class="p-2 border-r capitalize">Valid</td>
            <td class="p-2 border-r font-bold">Premium Amount</td>
            <td class="p-2">{{ $premiums[$authentication->vehicle_type]['amount'] ?? '--' }}</td>
        </tr>
    </tbody>
</table>
