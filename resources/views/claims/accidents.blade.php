@php
    $breadcrumbs = [
        [
            'url' => '/claims',
            'title' => 'Insurance Claims',
        ],
        [
            'url' => "#",
            'title' => 'Process',
        ],
        [
            'url' => "/claims/process/$authentication->coc_number",
            'title' => $authentication->coc_number,
        ],
    ];

    $step = 1;
@endphp

<x-layout :$breadcrumbs>
    <div class="flex items-center bg-gray-200/50 p-3 rounded-lg my-3">
        <x-stepper :$step />
    </div>
    <div class="flex space-x-3 min-h-screen">
        <div class="w-3/5 pb-6 pt-2">
            <div class="max-w-xl">
                @if (session('message'))
                    <x-alerts.success id="alert-authentication">
                        {{ session('message') }}
                    </x-alerts.success>
                @endif
            </div>
            <div class="max-w-xl relative overflow-x-auto shadow-md w-full">
                <a href="#new_accident"
                    class="absolute right-0 ps-5 m-3 flex text-violet-600 border border-violet-600 hover:bg-violet-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded-lg text-sm p-3 text-center items-center">
                    New Accident
                    <svg class="w-4 h-4 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14m-7 7V5" />
                    </svg>
                </a>
                <h1 class="px-8 py-6 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Accident List
                </h1>
                <table id="accidents-table"
                    class="bg-white w-full text-sm text-left rtl:text-right">
                    <thead class="text-xs uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-4">Accident</th>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4">Location</th>
                            <th class="px-6 py-4 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($accidents as $accident)
                            <tr class="group cursor-pointer">
                                <td class="group-hover:bg-violet-200 px-6 py-4 text-center">{{ $loop->index + 1 }}</td>
                                <td class="group-hover:bg-violet-200 px-6 py-4 w-32">{{ date('m-d-Y', strtotime($accident->date_occured)) }}</td>
                                <td class="group-hover:bg-violet-200 px-6 py-4">{{ $accident->location }}</td>
                                <td class="group-hover:bg-violet-200 px-6 py-4">
                                    <a href="/claims/process/{{ $authentication->coc_number }}/{{ $accident->id }}?index={{ $loop->index + 1 }}"
                                        class="text-violet-600 mx-auto border border-violet-600 hover:bg-violet-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded text-sm p-2 text-center inline-flex items-center dark:border-violet-600 dark:text-violet-600 dark:hover:text-white dark:focus:ring-violet-800 dark:hover:bg-violet-600">
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No data found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <hr class="my-5">
            <x-card class="max-w-xl" id="new_accident">
                <x-card-header>Accident Details</x-card-header>
                <x-forms.form method="POST" action="/claims/accidents" enctype="multipart/form-data">
                    <input
                        type="hidden"
                        value={{ $authentication->coc_number }}
                        name="serial"
                    />
                    @csrf
                    <div class="flex space-x-2">
                        <x-forms.input-field class="w-full"
                            name="date_occured"
                            type="date"
                            label="Date of the Accident"
                            placeholder="--"
                            required
                        />
                        <div class="w-full"></div>
                    </div>
                    <hr class="my-3">
                    <x-forms.input-field
                        class="w-full"
                        name="location"
                        type="text"
                        label="Location of the Accident"
                        placeholder="--"
                        required
                    />
                    <x-forms.textarea-field
                        class="w-full"
                        name="details"
                        label="Details of the Accident"
                        placeholder="--"
                        rows="8"
                        required
                    />
                    <label for="dropzone-file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="location">
                        Supporting Files
                    </label>
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                            </div>
                            <input id="dropzone-file" name="supporting_files[]" type="file" class="hidden" multiple />
                        </label>
                    </div>
                    <div class="w-full">
                        {{-- text-white text-sm inline-block px-3 py-1 rounded-xl bg-gray-400 mx-1 --}}
                        <p id="selected-files" class="my-2"></p>
                    </div>
                    <hr class="my-1">
                    <div class="flex space-x-2 justify-end">
                        <span class="inline-block w-32">
                            <x-forms.button type="submit" color="violet">Submit</x-forms.button>
                        </span>
                        <a href="/authentication"
                            class="text-center flex items-center justify-center w-auto px-10 border border-gray-500 rounded-lg bg-white hover:bg-gray-500 hover:text-white">
                            Back
                        </a>
                    </div>
                </x-forms.form>
            </x-card>
        </div>
        <div class="w-2/5 pb-6 pt-2">
            <div class="w-full p-5">
                <h3 class="text-2xl font-bold text-center">Insurance Details</h3>
                <hr class="my-5">
                <table class="w-full">
                    <tr>
                        <th class="px-1 text-center">Policy Number</th>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="px-1 text-center">{{ $authentication->policy_number }}</td>
                    </tr>
                    <tr>
                        <th class="px-1 text-center">COC Number</th>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="px-1 text-center">{{ $authentication->coc_number }}</td>
                    </tr>
                </table>
            </div>
            <hr class="my-3">
            <table class="w-full">
                <tr>
                    <th class="text-end px-1">OR Number:</th>
                    <td class="px-1">{{ $authentication->or_number }}</td>
                </tr>
                <tr>
                    <th class="text-end px-1">Assured Name:</th>
                    <td class="px-1">
                        {{ $authentication->assured_name }}</td>
                    </td>
                </tr>
                <tr>
                    <th class="text-end px-1">Address</th>
                    <td class="px-1">{{ $authentication->assured_address }}</td>
                </tr>
                <tr>
                    <th class="text-end px-1">Coverage:</th>
                    <td class="px-1">
                        {{ $authentication->coverage == 1 ? 'One (1) year' : 'Three (3) years' }}</td>
                    </td>
                </tr>
                <tr>
                    <th class="text-end px-1">Duration: </th>
                    <td class="px-1">{{ $authentication->inception_date }} &RightArrow;
                        {{ $authentication->expiry_date }}</td>
                </tr>
                <tr>
                    <th class="text-end px-1">Plate Number:</th>
                    <td class="px-1">{{ $authentication->plate_number }}</td>
                </tr>
                <tr>
                    <th class="text-end px-1">MV File Number:</th>
                    <td class="px-1">{{ $authentication->mv_file_number }}</td>
                </tr>
                <tr>
                    <th class="text-end px-1">Make Model:</th>
                    <td class="px-1">{{ $authentication->make }} {{ $authentication->model }} ({{ $authentication->year }})</td>
                </tr>
                <tr>
                    <th class="text-end px-1">Color:</th>
                    <td class="px-1">{{ $authentication->color }}</td>
                </tr>
                <tr>
                    <th class="text-end px-1">Liability Limit:</th>
                    <td class="px-1">P{{ number_format($settings['LIABILITY_LIMIT'], 2) }}</td>
                </tr>
            </table>
            <hr class="my-5">
        </div>
    </div>
    <x-slot:script>
        <script>
            (function() {
                let dropzone = document.getElementById('dropzone-file');
                dropzone.addEventListener('change', (e) => {
                    console.log('It changed');
                    let input = e.target;
                    let selectedFiles = document.getElementById('selected-files');
                    selectedFiles.innerHTML = '';

                    for (let i = 0; i < input.files.length; ++i) {
                        const name = input.files.item(i).name;
                        const node = document.createElement("span");
                            node.setAttribute('class', 'text-white text-sm inline-block px-3 py-1 rounded-xl bg-gray-400 mx-1');
                        const textnode = document.createTextNode(name);
                            node.appendChild(textnode);

                        selectedFiles.appendChild(node);
                    }
                });
            })();
        </script>
    </x-slot>
</x-layout>
