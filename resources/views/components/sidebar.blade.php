@php
    $activeClasses = 'text-white bg-violet-500 hover:text-white hover:bg-violet-500';
    $path = request()->path();
    $segments = explode('/', $path);
    $segment_0 = $segments[0] ?? '';
@endphp

<div id="sidebar" class="border-r flex min-w-[350px] box-border bg-white" style="height: calc(100vh - 56px)">
    <ul class="flex flex-col min-w-[90px] h-full border-r" id="default-tab" data-tabs-toggle="#default-tab-content"
        data-tabs-active-classes="{{ $activeClasses }}" role="tablist">

        @if (Auth::user()->role == 'admin')
            @if ($segment_0 == 'search')
                <li role="presentation">
                    <button id="search-tab" type="button" role="tab" data-tabs-target="#search"
                        aria-controls="search" aria-selected="{{ $segment_0 == 'search' ? 'true' : 'false' }}"
                        class="{{ $segment_0 == 'search' ? $activeClasses : '' }} group w-full py-3 text-gray-900 text-center items-center justify-center hover:bg-violet-200">
                        <i class="font-medium inline-flex">
                            <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                    d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
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
            <li role="presentation">
                <button id="serial_numbers-tab" data-tabs-target="#serial_numbers" type="button" role="tab"
                    aria-controls="serial_numbers"
                    aria-selected="{{ $segment_0 == 'serial_numbers' ? 'true' : 'false' }}"
                    class="{{ $segment_0 == 'serial_numbers' ? $activeClasses : '' }} group w-full py-3 text-gray-900 hover:bg-violet-200 text-center items-center justify-center">
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
                    <p class="text-center text-xs font-bold">Serials</p>
                </button>
            </li>
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
            <li role="presentation">
                <button id="agents-tab" type="button" role="tab" data-tabs-target="#agents" aria-controls="agents"
                    aria-selected="{{ $segment_0 == 'agents' ? 'true' : 'false' }}"
                    class="{{ $segment_0 == 'agents' ? $activeClasses : '' }} group w-full py-3 text-gray-900 hover:bg-violet-200 text-center items-center justify-center">
                    <i class="font-medium inline-flex">
                        <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z"
                                clip-rule="evenodd" />
                        </svg>
                    </i>
                    <p class="text-center text-xs font-bold">Agents</p>
                </button>
            </li>
            <li role="presentation">
                <button id="branches-tab" type="button" role="tab" data-tabs-target="#branches"
                    aria-controls="branches" aria-selected="{{ $segment_0 == 'branches' ? 'true' : 'false' }}"
                    class="{{ $segment_0 == 'branches' ? $activeClasses : '' }} group w-full py-3 text-gray-900 hover:bg-violet-200 text-center items-center justify-center">
                    <i class="font-medium inline-flex">
                        <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z"
                                clip-rule="evenodd" />
                        </svg>
                    </i>
                    <p class="text-center text-xs font-bold">Branches</p>
                </button>
            </li>
            <li role="presentation">
                <button id="settings-tab" type="button" role="tab" data-tabs-target="#settings"
                    aria-controls="settings" aria-selected="{{ $segment_0 == 'settings' ? 'true' : 'false' }}"
                    class="{{ $segment_0 == 'settings' ? $activeClasses : '' }} group w-full py-3 text-gray-900 hover:bg-violet-200 text-center items-center justify-center">
                    <i class="font-medium inline-flex">
                        <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M9.586 2.586A2 2 0 0 1 11 2h2a2 2 0 0 1 2 2v.089l.473.196.063-.063a2.002 2.002 0 0 1 2.828 0l1.414 1.414a2 2 0 0 1 0 2.827l-.063.064.196.473H20a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-.089l-.196.473.063.063a2.002 2.002 0 0 1 0 2.828l-1.414 1.414a2 2 0 0 1-2.828 0l-.063-.063-.473.196V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.089l-.473-.196-.063.063a2.002 2.002 0 0 1-2.828 0l-1.414-1.414a2 2 0 0 1 0-2.827l.063-.064L4.089 15H4a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2h.09l.195-.473-.063-.063a2 2 0 0 1 0-2.828l1.414-1.414a2 2 0 0 1 2.827 0l.064.063L9 4.089V4a2 2 0 0 1 .586-1.414ZM8 12a4 4 0 1 1 8 0 4 4 0 0 1-8 0Z"
                                clip-rule="evenodd" />
                        </svg>
                    </i>
                    <p class="text-center text-xs font-bold">Settings</p>
                </button>
            </li>
        @endif

        @if (Auth::user()->role == 'agent')
            @if ($segment_0 == 'search')
                <li role="presentation">
                    <button id="search-tab" type="button" role="tab" data-tabs-target="#search"
                        aria-controls="search" aria-selected="{{ $segment_0 == 'search' ? 'true' : 'false' }}"
                        class="{{ $segment_0 == 'search' ? $activeClasses : '' }} group w-full py-3 text-gray-900 text-center items-center justify-center hover:bg-violet-200">
                        <i class="font-medium inline-flex">
                            <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                    d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
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
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 4.5V19a1 1 0 0 0 1 1h15M7 14l4-4 4 4 5-5m0 0h-3.207M20 9v3.207" />
                        </svg>
                    </i>
                    <p class="text-center text-xs font-bold">Dashboard</p>
                </button>
            </li>
            <li role="presentation">
                <button id="authentication-tab" data-tabs-target="#authentication" type="button" role="tab"
                    aria-controls="authentication"
                    aria-selected="{{ $segment_0 == 'authentication' ? 'true' : 'false' }}"
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
            <li role="presentation">
                <button id="agents-tab" type="button" role="tab" data-tabs-target="#agents"
                    aria-controls="agents" aria-selected="{{ $segment_0 == 'agents' ? 'true' : 'false' }}"
                    class="{{ $segment_0 == 'agents' ? $activeClasses : '' }} group w-full py-3 text-gray-900 hover:bg-violet-200 text-center items-center justify-center">
                    <i class="font-medium inline-flex">
                        <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z"
                                clip-rule="evenodd" />
                        </svg>
                    </i>
                    <p class="text-center text-xs font-bold">Agents</p>
                </button>
            </li>
            <li role="presentation">
                <button id="branches-tab" type="button" role="tab" data-tabs-target="#branches"
                    aria-controls="branches" aria-selected="{{ $segment_0 == 'branches' ? 'true' : 'false' }}"
                    class="{{ $segment_0 == 'branches' ? $activeClasses : '' }} group w-full py-3 text-gray-900 hover:bg-violet-200 text-center items-center justify-center">
                    <i class="font-medium inline-flex">
                        <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z"
                                clip-rule="evenodd" />
                        </svg>
                    </i>
                    <p class="text-center text-xs font-bold">Branches</p>
                </button>
            </li>
            <li role="presentation">
                <button id="claims-tab" type="button" role="tab" data-tabs-target="#claims"
                    aria-controls="claims" aria-selected="{{ $segment_0 == 'claims' ? 'true' : 'false' }}"
                    class="{{ $segment_0 == 'claims' ? $activeClasses : '' }} group w-full py-3 text-gray-900 hover:bg-violet-200 text-center items-center justify-center">
                    <i class="font-medium inline-flex">
                        <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v5.703l-4.311-1.58a2 2 0 0 0-1.377 0l-5 1.832A2 2 0 0 0 8 11.861c.03 2.134.582 4.228 1.607 6.106.848 1.555 2 2.924 3.382 4.033H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M15.345 9.061a1 1 0 0 0-.689 0l-5 1.833a1 1 0 0 0-.656.953c.028 1.97.538 3.905 1.485 5.641a12.425 12.425 0 0 0 3.956 4.34 1 1 0 0 0 1.12 0 12.426 12.426 0 0 0 3.954-4.34A12.14 12.14 0 0 0 21 11.848a1 1 0 0 0-.656-.954l-5-1.833ZM15 19.765a10.401 10.401 0 0 0 2.76-3.235 10.15 10.15 0 0 0 1.206-4.011L15 11.065v8.7Z" clip-rule="evenodd"/>
                        </svg>
                    </i>
                    <p class="text-center text-xs font-bold">Claims</p>
                </button>
            </li>
        @endif
    </ul>
    <section class="w-full text-sm" id="default-tab-content">
        @if (Auth::user()->role == 'admin')
            @if ($segment_0 == 'search')
                <x-sidebar-search />
            @endif
            <x-sidebar-dashboard />
            <x-sidebar-serial_numbers />
            <x-sidebar-agents />
            <x-sidebar-branches />
            <x-sidebar-reports />
            <x-sidebar-settings />
        @endif

        @if (Auth::user()->role == 'agent')
            @if ($segment_0 == 'search')
                <x-sidebar-search />
            @endif
            <x-sidebar-dashboard />
            <x-sidebar-authentication />
            <x-sidebar-agents />
            <x-sidebar-reports />
            <x-sidebar-branches />
            <x-sidebar-claims />
        @endif

        @if (Auth::user()->role == 'subagent')
            @if ($segment_0 == 'search')
                <x-sidebar-search />
            @endif
            <x-sidebar-dashboard />
            <x-sidebar-authentication />
        @endif
    </section>
</div>
