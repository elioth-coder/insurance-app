<div id="dashboard" role="tabpanel" aria-labelled-by="dashboard-tab"
    class="h-full space-y-6 px-6 py-8 overflow-y-auto bg-gray-50 dark:bg-gray-800">
    <h2 class="text-2xl font-black px-5">
        <a href="/dashboard/">Dashboard</a>
    </h2>
    <hr>
    <ul class="space-y-1 font-medium">
        <li role="presentation">
            <a href="/dashboard"
                class="flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group {{ (!request()->tab) ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }}">
                <span class="">Home</span>
            </a>
        </li>
        <li role="presentation">
            <a href="/dashboard/?tab=announcement#announcement"
                class="flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group {{ request()->tab == 'announcement' ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }}">
                <span class="">Announcement</span>
            </a>
        </li>
        <li role="presentation">
            <a href="/dashboard/?tab=quick_search#quick_search"
                class="flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group {{ request()->tab == 'quick_search' ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }}">
                <span class="">Quick Search</span>
            </a>
        </li>
        <li role="presentation">
            <a href="/dashboard/?tab=activity_logs#activity_logs"
                class="flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group {{ request()->tab == 'activity_logs' ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }}">
                <span class="">Activity Logs</span>
            </a>
        </li>
    </ul>
</div>
