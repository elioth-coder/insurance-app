@php
    $accidents = [
        [
            'report_number'  => '10001',
            'policy_number'  => '12342457772323',
            'plate_number'   => 'ZSS1344',
            'mv_file_number' => '323220209111',
            'nature'         => 'Rear-end Collision',
            'summary'        => 'Vehicle rear-ended another at a traffic light.',
            'hpg_officer'    => 'Dindo Avanzado',
            'accident_date'  => '2024-08-15',
        ],
        [
            'report_number'  => '10002',
            'policy_number'  => '987456546454',
            'plate_number'   => 'ZSS1344',
            'mv_file_number' => '11412121209111',
            'nature'         => 'Side Swipe',
            'summary'        => 'Vehicle side/swiped another during lane change.',
            'hpg_officer'    => 'Martin Bulacan',
            'accident_date'  => '2024-07-15',
        ],
        [
            'report_number'  => '10003',
            'policy_number'  => '64364564567772323',
            'plate_number'   => 'XLHS5255',
            'mv_file_number' => '209092121209111',
            'nature'         => 'Rollover',
            'summary'        => 'Vehicle lost control and rolled over on the highway.',
            'hpg_officer'    => 'Dindo Avanzado',
            'accident_date'  => '2024-08-12',
        ],
        [
            'report_number'  => '10004',
            'policy_number'  => '675678457772323',
            'plate_number'   => 'TKAY344',
            'mv_file_number' => '19929221209111',
            'nature'         => 'Hit and Run',
            'summary'        => 'Vehicle struck a pedestrian and fled the scene.',
            'hpg_officer'    => 'Banjo Reguyal',
            'accident_date'  => '2024-07-02',
        ],
        [
            'report_number'  => 10005,
            'policy_number'  => '322345657772323',
            'plate_number'   => 'LLAP1344',
            'mv_file_number' => '929349829111',
            'nature'         => 'Rear/end Collision',
            'summary'        => 'Vehicles collided head/on at an intersection.',
            'hpg_officer'    => 'Junmar Mercado',
            'accident_date'  => '2024-12-16',
        ],
    ];

    // dd($report_number);
    $accident = null;
    foreach($accidents as $item) {
        if($item['report_number'] == $report_number) {
            $accident = $item;
        }
    }

    $breadcrumbs = [
        [
            'url' => '/authentication',
            'title' => 'Authentication',
        ],
        [
            'url' => '/coc_series/create',
            'title' => 'Claim',
        ],
    ];
@endphp

<x-layout :$breadcrumbs>
    <div class="flex space-x-3">
        <div class="w-3/5 pb-6 pt-2">
            <div class="max-w-xl">
                @if (request()->status=='success')
                    <x-alerts.success id="alert-subagent">
                        Successfully claimed insurance!
                    </x-alerts.success>
                @endif
            </div>
            <x-card class="max-w-xl">
                <x-card-header>Claim Insurance</x-card-header>
                <x-forms.form method="GET">
                    <div class="flex space-x-2">
                        <x-forms.input-field
                            class="w-full"
                            name="policy_number"
                            type="text"
                            label="Policy no."
                            value="{{ $accident['policy_number'] ?? '' }}"
                            placeholder="Enter policy no."
                        />
                        <x-forms.input-field
                            class="w-full"
                            name="plate_number"
                            type="text" label="Plate no."
                            placeholder="Enter plate no."
                            value="{{ $accident['plate_number'] ?? '' }}"
                        />
                    </div>
                    <div class="flex space-x-2">
                        <x-forms.input-field class="w-full"
                            name="accident_date"
                            type="date"
                            label="Date of Accident"
                            placeholder=""
                            value="{{ $accident['accident_date'] ?? '' }}"
                            required
                        />
                        <x-forms.input-field class="w-full"
                            name="nature"
                            type="text"
                            label="Nature of Accident"
                            placeholder="Enter nature of accident"
                            value="{{ $accident['nature'] ?? '' }}"
                            required
                        />
                    </div>
                    <x-forms.textarea-field
                        name="summary"
                        label="Summary of Accident"
                        placeholder="Enter summary of accident"
                        required
                        value="{{ $accident['summary'] ?? ''}}"
                    />
                    <x-forms.input-field
                        class="w-full"
                        name="supporting_documents"
                        type="file"
                        multiple
                        label="Supporting documents"
                        placeholder="Upload supporting documents"
                    />
                    <hr class="my-1">
                    <div class="flex space-x-2 justify-end">
                        <a href="/authentication/claim/xxx?status=success" class="inline-block w-32">
                            <x-forms.button type="button" color="violet">Submit</x-forms.button>
                        </a>
                        <a href="/"
                            class="text-center flex items-center justify-center w-auto px-10 border border-gray-500 rounded-lg bg-white hover:bg-gray-500 hover:text-white">
                            Back
                        </a>
                    </div>
                </x-forms.form>
            </x-card>
        </div>
        <div class="w-2/5 pb-6 pt-2">
            <section class="bg-violet-500 text-white p-8 rounded-lg">
                <h2 class="mb-2 text-lg font-semibold dark:text-white">IMPORTANT NOTES:</h2>
                <p class="text-justify">
                    Please keep the following documents below handy when filing for claims.
                </p>
                <ul class="max-w-md space-y-1 list-disc list-inside dark:text-gray-400">
                    <li>
                        OR/CR
                    </li>
                    <li>
                        Drivers License
                    </li>
                    <li>
                        Police Report
                    </li>
                    <li>
                        Deed of Sale
                    </li>
                </ul>
            </section>
            </div>
    </div>
</x-layout>
