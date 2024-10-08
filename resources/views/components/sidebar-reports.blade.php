@php
$path = request()->path();
$segments = explode('/', $path);
$segment_0 = $segments[0] ?? "";
$segment_1 = $segments[1] ?? "";
@endphp

<div id="reports" role="tabpanel" aria-labelled-by="reports-tab" class="h-full space-y-6 px-6 py-8 overflow-y-auto bg-gray-50 dark:bg-gray-800">
    <h2 class="text-2xl font-black px-5">Reports Monitoring</h2>
    <hr>
    <ul class="space-y-1 font-medium">
        <li role="presentation">
            <a href="/reports/authentication_fees"
                class="{{ ($segment_0=='reports' && $segment_1=='authentication_fees') ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }} flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group">
                <span class="">Authentication Fees</span>
            </a>
        </li>
        <li role="presentation">
            <a href="/reports/authentication_taxes"
                class="{{ ($segment_0=='reports' && $segment_1=='authentication_taxes') ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }} flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group">
                <span class="">Authentication Taxes</span>
            </a>
        </li>
        <li role="presentation">
            <a href="/reports/insurance_claims"
                class="{{ ($segment_0=='reports' && $segment_1=='insurance_claims') ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }} flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group">
                <span class="">Insurance Claims</span>
            </a>
        </li>
    </ul>
</div>
