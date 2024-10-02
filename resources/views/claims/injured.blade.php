@php
    $breadcrumbs = [
        [
            'url' => '/claims',
            'title' => 'Insurance Claims',
        ],
        [
            'url' => '#',
            'title' => 'Process',
        ],
        [
            'url' => "/claims/process/$authentication->coc_number",
            'title' => $authentication->coc_number,
        ],
        [
            'url' => "/claims/process/$authentication->coc_number/$accident->id?index=" . request()->index,
            'title' => 'Accident ' . request()->index,
        ],
        [
            'url' =>
                "/claims/process/$authentication->coc_number/$accident->id/$injured_person->id?index=" .
                request()->index,
            'title' => $injured_person->name,
        ],
    ];

    $step = 3;
@endphp

<x-layout :$breadcrumbs>
    <div class="flex items-center bg-gray-200/50 p-3 rounded-lg my-3">
        <x-stepper :$step />
    </div>
    <div class="flex space-x-3 min-h-screen">
        <div class="w-3/5 pb-6 pt-2">
            <div class="max-w-xl">
                @if (session('message'))
                    <x-alerts.success id="alert-injured_person">
                        {{ session('message') }}
                    </x-alerts.success>
                @endif
            </div>
            <div class="max-w-xl relative overflow-x-auto shadow-md w-full">
                <h1
                    class="px-8 py-6 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Supporting Evidences
                </h1>
                <div id="gallery" class="relative w-full" data-carousel="static">
                    <!-- Carousel wrapper -->
                    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                        @foreach ($injured_person->evidences as $evidence)
                            <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                                <img src="{{ $evidence }}"
                                    class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                    alt="">
                            </div>
                        @endforeach
                    </div>
                    <!-- Slider controls -->
                    <button type="button"
                        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-prev>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button"
                        class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-next>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="mt-2">
                @foreach ($injured_person->evidences as $evidence)
                    <a href="{{ $evidence }}" target="_blank"
                        class="m-1 inline-block bg-violet-500 text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded">
                        @php
                            $segments = explode('/', $evidence);
                            $fileName = $segments[count($segments) - 1];
                        @endphp
                        {{ $fileName }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="w-2/5 pb-6 pt-2">
            <form id="approve-form" class="w-full p-5 block"
                action="/claims/accidents/injured/{{ $injured_person->id }}?index={{ request()->index }}"
                method="POST">
                @method('PATCH')
                @csrf
                <input type="hidden" name="index" value="{{ request()->index }}">
                <input type="hidden" name="injured_person_id" value="{{ $injured_person->id }}">
                <input type="hidden" name="serial" value="{{ $authentication->coc_number }}">
                <input type="hidden" name="accident_id" value="{{ $accident->id }}">
                <h3 class="text-2xl font-bold text-center">Injured Person Details</h3>
                <hr class="my-5">
                <b class="inline-block" style="width: 90px;">Name:</b> {{ $injured_person->name }}<br>
                <b class="inline-block" style="width: 90px;">Contact #:</b> {{ $injured_person->contact_number }}<br>
                @if ($injured_person->status != 'For Approval')
                    <b class="inline-block" style="width: 90px;">Claimable:</b>
                    P{{ number_format($injured_person->claimable_amount, 2) }}<br>
                @else
                    <b class="inline-block" style="width: 90px;">Claimable:</b> <input type="text"
                        name="claimable_amount" value="{{ $injured_person->claimable_amount }}" /><br>
                @endif
                <b class="inline-block" style="width: 90px;">Status:</b> <span class="text-xl">{{ $injured_person->status }}</span><br>
                <b>Details: </b><br>
                <div class="overflow-y-scroll h-[175px] pe-3 mb-3">
                    <p style="text-indent:30px; text-align: justify;">{{ $injured_person->details }}</p>
                </div>
                @if ($injured_person->remarks)
                    <b>Remarks: </b><br>
                    <div class="overflow-y-scroll h-[175px] pe-3 mb-3">
                        <p style="text-indent:30px; text-align: justify;">{{ $injured_person->remarks }}</p>
                    </div>
                @endif
                @if ($injured_person->status == 'For Approval')
                    <div class="flex space-x-2 justify-end mt-2">
                        <span class="inline-block w-32">
                            <x-forms.button type="submit" color="violet">Approve</x-forms.button>
                        </span>
                        <button id="deny" type="button"
                            class="text-center flex items-center justify-center w-auto px-10 border border-gray-500 rounded-lg bg-white hover:bg-gray-500 hover:text-white">
                            Deny
                        </button>
                    </div>
                @endif
            </form>
        </div>
    </div>
    <x-slot:script>
        <script>
            (function() {
                document.getElementById('deny').addEventListener('click', async (e) => {
                    let form = document.getElementById('approve-form');
                    let formData = new FormData(form);
                    let denyFormData = new FormData();

                    Swal.fire({
                        title: 'Reason for denying',
                        input: 'textarea',
                        showCancelButton: true,
                        confirmButtonText: "Continue"
                    }).then(async (result) => {
                        if (result.isConfirmed) {
                            denyFormData.set('remarks', result.value ?? 'No reason');
                            denyFormData.set('serial', formData.get('serial'));
                            denyFormData.set('accident_id', formData.get('accident_id'));
                            denyFormData.set('_method', formData.get('_method'));
                            denyFormData.set('_token', formData.get('_token'));

                            Swal.fire({
                                title: 'Processing...',
                                allowOutsideClick: false,
                                showConfirmButton: false,
                            });

                            let response = await fetch(`/claims/accidents/injured/deny/${formData.get('injured_person_id')}`, {
                                method: 'POST',
                                body: denyFormData,
                            });
                            let { status, message } = await response.json();

                            await Swal.fire({
                                title: `${status[0].toUpperCase()}${status.substring(1)}!`,
                                text: message,
                                icon: status,
                                showConfirmButton: false,
                                timer: 2000,
                            });

                            if(status=='success') {
                                window.href.location = `/claims/process/${formData.get('serial')}/${formData.get('accident_id')}/?index=}`
                            }
                        }
                    });
                });
            })();
        </script>
    </x-slot>
</x-layout>
