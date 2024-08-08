@php
    $breadcrumbs = [
        [
            'url' => '/subagents',
            'title' => 'Subagents',
        ],
    ];
@endphp

<x-layout :$breadcrumbs>
    <div class="py-3 min-h-screen">
        <div class="mx-auto max-w-full">
            @if (session('message'))
                <x-alerts.success id="alert-subagent">
                    {{ session('message') }}
                </x-alerts.success>
            @endif
        </div>

        <div class="flex">
            <div class="relative overflow-x-auto shadow-md w-full">
                <table id="subagents-table"
                    class="bg-white w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Email Address</th>
                            <th class="px-6 py-4">Branch</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subagents as $subagent)
                            <tr class="group cursor-pointer">
                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ $subagent->last_name }} {{ $subagent->first_name }}</td>
                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ $subagent->email }}</td>
                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ $subagent->branch }}</td>
                                <td class="group-hover:bg-violet-200 px-8 py-6 capitalize">{{ $subagent->role }}</td>
                                <td class="group-hover:bg-violet-200 px-8 py-6">
                                    @if ($subagent->status=='active')
                                        <span class="bg-green-500 rounded-lg text-white inline-block px-1 text-xs">Active</span>
                                    @else
                                        <span class="bg-red-500 rounded-lg text-white inline-block px-1 text-xs">Inactive</span>
                                    @endif
                                </td>
                                <td class="group-hover:bg-violet-200 px-8 py-6">
                                    @if ($subagent->status=='active')
                                        <x-forms.form
                                            class="hidden"
                                            method="POST"
                                            verb="PATCH"
                                            action="/subagents/{{ $subagent->id }}/lock"
                                            id="lock-agent-{{ $subagent->id }}-form">
                                            <button type="submit">
                                                Lock
                                            </button>
                                        </x-forms.form>
                                        <button onclick="confirmLock({{ $subagent->id }})" title="Lock" type="button" class="text-gray-500 border border-gray-500 hover:bg-gray-500 hover:text-white focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded text-sm p-2 text-center inline-flex items-center dark:border-gray-500 dark:text-gray-500 dark:hover:text-white dark:focus:ring-gray-800 dark:hover:bg-gray-500">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M15 7a2 2 0 1 1 4 0v4a1 1 0 1 0 2 0V7a4 4 0 0 0-8 0v3H5a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V7Zm-5 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    @else
                                        <x-forms.form
                                            class="hidden"
                                            method="POST"
                                            verb="PATCH"
                                            action="/subagents/{{ $subagent->id }}/unlock"
                                            id="unlock-agent-{{ $subagent->id }}-form">
                                            <button type="submit">
                                                Unlock
                                            </button>
                                        </x-forms.form>
                                        <button onclick="confirmUnlock({{ $subagent->id }})" title="Unlock" type="button" class="text-gray-500 border border-gray-500 hover:bg-gray-500 hover:text-white focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded text-sm p-2 text-center inline-flex items-center dark:border-gray-500 dark:text-gray-500 dark:hover:text-white dark:focus:ring-gray-800 dark:hover:bg-gray-500">
                                            <svg class="w-5 h-5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M8 10V7a4 4 0 1 1 8 0v3h1a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h1Zm2-3a2 2 0 1 1 4 0v3h-4V7Zm2 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    @endif

                                    <a href="/subagents/{{ $subagent->id }}/edit" title="Edit" type="button" class="text-violet-500 border border-violet-500 hover:bg-violet-500 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded text-sm p-2 text-center inline-flex items-center dark:border-violet-500 dark:text-violet-500 dark:hover:text-white dark:focus:ring-violet-800 dark:hover:bg-violet-500">
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center">No data found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-slot:script>
        <script>
            const confirmLock =  async (id) => {
                let result = await Swal.fire({
                    title: "Lock this agent's account?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Continue"
                });

                if(result.isConfirmed) {
                    document.querySelector(`#lock-agent-${id}-form button`).click();
                }
            }

            const confirmUnlock =  async (id) => {
                let result = await Swal.fire({
                    title: "Unlock this agent's account?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Continue"
                });

                if(result.isConfirmed) {
                    document.querySelector(`#unlock-agent-${id}-form button`).click();
                }
            }

            (function() {
                setTimeout(() => {
                    if (document.getElementById("subagents-table") && typeof DataTable !==
                        'undefined') {
                        const dataTable = new DataTable("#subagents-table", {
                            fixedHeight: true,
                            searchable: true,
                            perPage: 5,
                        });
                    }
                }, 1000);
            })();
        </script>
    </x-slot>
</x-layout>
