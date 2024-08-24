@php
$path = request()->path();
$segments = explode('/', $path);
$segment_0 = $segments[0] ?? "";
$segment_1 = $segments[1] ?? "";
@endphp

<div id="series" role="tabpanel" aria-labelled-by="series-tab" class="h-full space-y-6 px-6 py-8 overflow-y-auto bg-gray-50 dark:bg-gray-800">
    <h2 class="text-2xl font-black px-5">Series Management</h2>
    <ul class="space-y-1 font-medium">
        <li role="presentation">
            <a href="/series/create"
                class="{{ ($segment_0=='series' && $segment_1=='create') ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }} flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group">
                <span class="">Assign / Allocate</span>
            </a>
        </li>
        <li role="presentation">
            <a href="/series"
                class="{{ ($segment_0=='series' && $segment_1=='') ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }} flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group">
                <span class="">Assigned Series Table</span>
            </a>
        </li>
        <li role="presentation">
            <a href="/series/owned"
                class="{{ ($segment_0=='series' && $segment_1=='owned') ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }} flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group">
                <span class="">Owned Series</span>
            </a>
        </li>

    </ul>
</div>
