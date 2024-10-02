@php
$path = request()->path();
$segments = explode('/', $path);
$segment_0 = $segments[0] ?? "";
$segment_1 = $segments[1] ?? "";
@endphp

<div id="serial_numbers" role="tabpanel" aria-labelled-by="serial_numbers-tab" class="h-full space-y-6 px-6 py-8 overflow-y-auto bg-gray-50 dark:bg-gray-800">
    <h2 class="text-2xl font-black px-5">Serial Numbers Management</h2>
    <ul class="space-y-1 font-medium">
        <li role="presentation">
            <a href="/serial_numbers/create"
                class="{{ ($segment_0=='serial_numbers' && $segment_1=='create') ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }} flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group">
                <span class="">New Serial Numbers</span>
            </a>
        </li>
        <li role="presentation">
            <a href="/serial_numbers"
                class="{{ ($segment_0=='serial_numbers' && $segment_1=='') ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }} flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group">
                <span class="">Serial Numbers Table</span>
            </a>
        </li>
    </ul>
</div>
