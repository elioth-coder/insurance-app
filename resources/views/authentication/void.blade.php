@php
    $breadcrumbs = [
        [
            'url' => '/authentication',
            'title' => 'Authentication',
        ],
        [
            'url' => '/authentication/void',
            'title' => 'Void',
        ],
    ];
@endphp

<x-layout :$breadcrumbs>
    <div class="flex space-x-3 min-h-screen">
        <div class="w-3/5 pb-6 pt-2">
            <div class="max-w-xl">
                @if (session('message'))
                    <x-alerts.success id="alert-authentication">
                        {{ session('message') }}
                    </x-alerts.success>
                @endif
            </div>
            <x-card class="max-w-xl">
                <x-card-header>Void Authentication</x-card-header>
                <form id="void-authentication-form" method="POST">
                    @csrf
                    <x-forms.input-field
                        class="w-full"
                        name="serial"
                        type="text"
                        label="Enter/Scan COC serial number"
                        placeholder="--"
                        required
                    />

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
                </form>
            </x-card>
        </div>
        <div class="w-2/5 pb-6 pt-2">
            <section class="bg-violet-500 text-white p-8 rounded-lg">
                <h2 class="mb-2 text-lg font-semibold dark:text-white">IMPORTANT NOTES: </h2>
                <ul class="max-w-md space-y-1 list-disc list-inside dark:text-gray-400">
                    <li>Only use valid serial numbers for authentication.</li>
                </ul>
            </section>
        </div>
    </div>
    <x-slot:script>
        <script>
            (function() {
                let form = document.getElementById('void-authentication-form');
                form.addEventListener('submit', async (e)=> {
                    e.preventDefault();
                    let formData = new FormData(e.target);
                    let serial = formData.get('serial');

                    let response = await fetch("/api/authentication/check_serial", {
                        method: 'POST',
                        body: formData,
                    });
                    let { status, message } = await response.json();

                    let input = document.querySelector('[name="serial"]');
                    input.value = "";

                    if(status=='error') {
                        await Swal.fire({
                            title: "Error!",
                            text: message,
                            icon: "error",
                            showConfirmButton: false,
                        });

                        return false;
                    }

                    let result = await Swal.fire({
                        title: "Void this authentication?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Continue"
                    });

                    if(result.isConfirmed) {
                        Swal.fire({
                            title: 'Voiding...',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                        });

                        await new Promise((resolve, reject) => setTimeout(resolve, 2000));

                        let response = await fetch("/api/authentication/void_serial", {
                            method: 'POST',
                            body: formData,
                        });
                        let { status, message } = await response.json();

                        await Swal.fire({
                            title: `${status[0].toUpperCase()}${status.substring(1)}!`,
                            text: message,
                            icon: status,
                            showConfirmButton: false,
                            timer: 2000,
                        });
                    }
                    return false;
                });

            })();
        </script>
    </x-slot>
</x-layout>
