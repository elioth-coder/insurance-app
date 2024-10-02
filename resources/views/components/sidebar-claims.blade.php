@php
$path = request()->path();
$segments = explode('/', $path);
$segment_0 = $segments[0] ?? "";
$segment_1 = $segments[1] ?? "";
@endphp

<div id="claims" role="tabpanel" aria-labelled-by="claims-tab"
    class="h-full space-y-6 px-6 py-8 overflow-y-auto bg-gray-50 dark:bg-gray-800">
    <h2 class="text-2xl font-black px-5">Insurance Claims</h2>
    <hr>
    <ul class="space-y-1 font-medium">
        <li role="presentation">
            <a href="/claims/verify"
                class="{{ ($segment_0=='claims' && $segment_1=='verify') ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }} flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group">
                <span class="">Verify COC</span>
            </a>
        </li>
        <li role="presentation">
            <a
                class="{{ ($segment_0=='claims' && $segment_1=='process') ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }} flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group">
                <span class="">Process Claim</span>
            </a>
        </li>
        <li role="presentation">
            <a href="/claims"
                class="{{ ($segment_0=='claims' && $segment_1=='') ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }} flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group">
                <span class="">Accidents Table</span>
            </a>
        </li>
    </ul>
</div>
