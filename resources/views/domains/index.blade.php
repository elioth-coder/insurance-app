@php
    $breadcrumbs = [
        [
            'url' => '/settings',
            'title' => 'Application Settings',
        ],
        [
            'url' => '/settings/domains',
            'title' => 'Allowed Domains',
        ],
    ];
@endphp

<x-layout :$breadcrumbs>
    <div class="py-3 min-h-screen">
        <div class="w-full pb-5">
            <a href="/settings/domains/create"
                class="ps-5 text-violet-600 mx-auto border border-violet-600 hover:bg-violet-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded-lg text-sm p-3 text-center inline-flex items-center">
                New Allowed Domain
                <svg class="w-4 h-4 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14m-7 7V5" />
                </svg>
            </a>
        </div>
        <div class="mx-auto max-w-full">
            @if (session('message'))
                <x-alerts.success id="alert-domain">
                    {{ session('message') }}
                </x-alerts.success>
            @endif
        </div>
        <div class="flex">
            <div class="relative overflow-x-auto shadow-md w-full">
                <table id="domains-table"
                    class="bg-white w-full text-sm text-left rtl:text-right">
                    <thead class="text-xs uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-4">Host / Domain</th>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($domains as $domain)
                            <tr class="group cursor-pointer">
                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ $domain->host }}</td>
                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ $domain->name }}</td>
                                <td class="group-hover:bg-violet-200 px-8 py-6">
                                    <x-forms.form class="hidden" method="POST" verb="DELETE"
                                        action="/settings/domains/{{ $domain->id }}"
                                        id="delete-domain-{{ $domain->id }}-form">
                                        <button type="submit">
                                            Delete
                                        </button>
                                    </x-forms.form>

                                    <a href="/settings/domains/{{ $domain->id }}/edit" title="Edit"
                                        class="text-violet-600 mx-auto border border-violet-600 hover:bg-violet-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded text-sm p-2 text-center inline-flex items-center">
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                        </svg>
                                    </a>
                                    <button onclick="confirmDelete({{ $domain->id }})" title="Delete"
                                        type="button"
                                        class="text-red-600 mx-auto border border-red-600 hover:bg-red-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded text-sm p-2 text-center inline-flex items-center">
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No data found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-slot:script>
        <script>
            const confirmDelete = async (id) => {
                let result = await Swal.fire({
                    title: "Delete this domain?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Continue"
                });

                if (result.isConfirmed) {
                    document.querySelector(`#delete-domain-${id}-form button`).click();
                }
            }
            (function() {
                setTimeout(() => {
                    if (document.getElementById("domains-table") && typeof DataTable !==
                        'undefined') {
                        const dataTable = new DataTable("#domains-table", {
                            fixedHeight: true,
                            searchable: true,
                            perPage: 50,
                        });
                    }
                }, 1000);
            })();
        </script>
    </x-slot:script>
</x-layout>
