@php
$path = request()->path();
$segments = explode('/', $path);
$segment_0 = $segments[0] ?? "";
$segment_1 = $segments[1] ?? "";
@endphp

<div id="authentication" role="tabpanel" aria-labelled-by="authentication-tab"
    class="h-full space-y-6 px-6 py-8 overflow-y-auto bg-gray-50 dark:bg-gray-800">
    <h2 class="text-2xl font-black px-5">Authentication</h2>
    <hr>
    <ul class="space-y-1 font-medium">
        <li role="presentation">
            <a href="/authentication/create"
                class="{{ ($segment_0=='authentication' && $segment_1=='create') ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }} flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group">
                <span class="">New Authentication</span>
            </a>
        </li>
        <li role="presentation">
            <a href="/authentication"
                class="{{ ($segment_0=='authentication' && $segment_1=='') ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }} flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group">
                <span class="">Authenticated Vehicles</span>
            </a>
        </li>
    </ul>
</div>
