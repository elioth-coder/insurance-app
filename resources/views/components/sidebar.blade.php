@php
    $activeClasses = 'text-white bg-violet-500 hover:text-white hover:bg-violet-500';
    $path = request()->path();
    $segments = explode('/', $path);
    $segment_0 = $segments[0] ?? '';

@endphp

<div id="sidebar" class="border-r flex min-w-[350px] box-border bg-white" style="height: calc(100vh - 56px)">
    <ul class="flex flex-col min-w-[90px] h-full border-r" id="default-tab" data-tabs-toggle="#default-tab-content"
        data-tabs-active-classes="{{ $activeClasses }}" role="tablist">
        @if ($segment_0 == 'search')
            <li role="presentation">
                <button id="search-tab" type="button" role="tab" data-tabs-target="#search"
                    aria-controls="search" aria-selected="{{ $segment_0 == 'search' ? 'true' : 'false' }}"
                    class="{{ $segment_0 == 'search' ? $activeClasses : '' }} group w-full py-3 text-gray-900 text-center items-center justify-center hover:bg-violet-200">
                    <i class="font-medium inline-flex">
                        <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                        </svg>
                    </i>
                    <p class="text-center text-xs font-bold">Search</p>
                </button>
            </li>
        @endif
        <li role="presentation">
            <button id="dashboard-tab" type="button" role="tab" data-tabs-target="#dashboard"
                aria-controls="dashboard" aria-selected="{{ $segment_0 == 'dashboard' ? 'true' : 'false' }}"
                class="{{ $segment_0 == 'dashboard' ? $activeClasses : '' }} group w-full py-3 text-gray-900 text-center items-center justify-center hover:bg-violet-200">
                <i class="font-medium inline-flex">
                    <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4.5V19a1 1 0 0 0 1 1h15M7 14l4-4 4 4 5-5m0 0h-3.207M20 9v3.207" />
                    </svg>
                </i>
                <p class="text-center text-xs font-bold">Dashboard</p>
            </button>
        </li>
        @if (Auth::user()->role != 'admin')
            <li role="presentation">
                <button id="authentication-tab" data-tabs-target="#authentication" type="button" role="tab"
                    aria-controls="authentication" aria-selected="{{ $segment_0 == 'authentication' ? 'true' : 'false' }}"
                    class="{{ $segment_0 == 'authentication' ? $activeClasses : '' }} group w-full py-3 text-gray-900 hover:bg-violet-200 text-center items-center justify-center">
                    <i class="font-medium inline-flex">
                        <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                                clip-rule="evenodd" />
                        </svg>
                    </i>
                    <p class="text-center text-xs font-bold">Authentication</p>
                </button>
            </li>
        @endif
        @if (Auth::user()->role != 'subagent')
            <li role="presentation">
                <button id="series-tab" data-tabs-target="#series" type="button" role="tab" aria-controls="series"
                    aria-selected="{{ $segment_0 == 'series' ? 'true' : 'false' }}"
                    class="{{ $segment_0 == 'series' ? $activeClasses : '' }} group w-full py-3 text-gray-900 hover:bg-violet-200 text-center items-center justify-center">
                    <i class="font-medium inline-flex">
                        <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M18 3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1V9a4 4 0 0 0-4-4h-3a1.99 1.99 0 0 0-1 .267V5a2 2 0 0 1 2-2h7Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M8 7.054V11H4.2a2 2 0 0 1 .281-.432l2.46-2.87A2 2 0 0 1 8 7.054ZM10 7v4a2 2 0 0 1-2 2H4v6a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3Z"
                                clip-rule="evenodd" />
                        </svg>
                    </i>
                    <p class="text-center text-xs font-bold">Series</p>
                </button>
            </li>
        @endif
        <li role="presentation">
            <button id="reports-tab" type="button" role="tab" data-tabs-target="#reports"
                aria-selected="{{ $segment_0 == 'reports' ? 'true' : 'false' }}"
                class="{{ $segment_0 == 'reports' ? $activeClasses : '' }} group w-full py-3 text-gray-900 hover:bg-violet-200 text-center items-center justify-center">
                <i class="font-medium inline-flex">
                    <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm-1 9a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2Zm2-5a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1Zm4 4a1 1 0 1 0-2 0v3a1 1 0 1 0 2 0v-3Z"
                            clip-rule="evenodd" />
                    </svg>
                </i>
                <p class="text-center text-xs font-bold">Reports</p>
            </button>
        </li>
        @if (Auth::user()->role != 'subagent')
            <li role="presentation">
                <button id="users-tab" type="button" role="tab" data-tabs-target="#users"
                    aria-controls="users" aria-selected="{{ $segment_0 == 'agents' ? 'true' : 'false' }}"
                    class="{{ $segment_0 == 'agents' ? $activeClasses : '' }} group w-full py-3 text-gray-900 hover:bg-violet-200 text-center items-center justify-center">
                    <i class="font-medium inline-flex">
                        <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z"
                                clip-rule="evenodd" />
                        </svg>
                    </i>
                    <p class="text-center text-xs font-bold">Users</p>
                </button>
            </li>
        @endif
        <li role="presentation">
            <button id="interagency-tab" type="button" role="tab" data-tabs-target="#interagency"
                aria-controls="interagency" aria-selected="{{ $segment_0 == 'interagency' ? 'true' : 'false' }}"
                class="{{ $segment_0 == 'interagency' ? $activeClasses : '' }} group w-full py-3 text-gray-900 hover:bg-violet-200 text-center items-center justify-center">
                <i class="font-medium inline-flex">
                    <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M17.5 3a3.5 3.5 0 0 0-3.456 4.06L8.143 9.704a3.5 3.5 0 1 0-.01 4.6l5.91 2.65a3.5 3.5 0 1 0 .863-1.805l-5.94-2.662a3.53 3.53 0 0 0 .002-.961l5.948-2.667A3.5 3.5 0 1 0 17.5 3Z" />
                    </svg>
                </i>
                <p class="text-center text-xs font-bold">Interagency</p>
            </button>
        </li>
    </ul>
    <section class="w-full text-sm" id="default-tab-content">
        <x-sidebar-dashboard />
        @if (Auth::user()->role != 'admin')
            <x-sidebar-authentication />
        @endif
        @if (Auth::user()->role != 'subagent')
            <x-sidebar-series />
            <x-sidebar-users />
        @endif
        <x-sidebar-reports />
        <x-sidebar-interagency />
        @if ($segment_0 == 'search')
            <x-sidebar-search />
        @endif
    </section>
</div>
