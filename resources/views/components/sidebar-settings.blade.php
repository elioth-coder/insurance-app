@php
$path = request()->path();
$segments = explode('/', $path);
$segment_0 = $segments[0] ?? "";
$segment_1 = $segments[1] ?? "";
@endphp

<div id="settings" role="tabpanel" aria-labelled-by="settings-tab" class="h-full space-y-6 px-6 py-8 overflow-y-auto bg-gray-50 dark:bg-gray-800">
    <h2 class="text-2xl font-black px-5">Application Settings</h2>
    <ul class="space-y-1 font-medium">
        <li role="presentation">
            <a href="/settings"
                class="{{ ($segment_0=='settings' && $segment_1=='') ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }} flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group">
                <span class="">General Settings</span>
            </a>
        </li>
        <li role="presentation">
            <a href="/settings/announcements"
                class="{{ ($segment_0=='settings' && $segment_1=='announcements') ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }} flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group">
                <span class="">Announcement</span>
            </a>
        </li>
        <li role="presentation">
            <a href="/settings/vehicle_types"
                class="{{ ($segment_0=='settings' && $segment_1=='vehicle_types') ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }} flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group">
                <span class="">Vehicle Basic Premiums</span>
            </a>
        </li>
        <li role="presentation">
            <a href="/settings/domains"
                class="{{ ($segment_0=='settings' && $segment_1=='domains') ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }} flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group">
                <span class="">Allowed Domains</span>
            </a>
        </li>
    </ul>
</div>
