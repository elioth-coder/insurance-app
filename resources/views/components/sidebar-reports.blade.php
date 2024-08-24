<div id="reports" role="tabpanel" aria-labelled-by="reports-tab" class="h-full space-y-6 px-6 py-8 overflow-y-auto bg-gray-50 dark:bg-gray-800">
    <h2 class="text-2xl font-black px-5">Reports</h2>
    <hr>
    <ul class="space-y-1 font-medium">
        <li role="presentation">
            <a href="/reports/create"
                class="flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white hover:bg-violet-200 dark:hover:bg-gray-700 group">
                <span class="">Reports Generator</span>
            </a>
        </li>
        <li role="presentation">
            <a href="/reports" onclick="(e) => { e.preventDefault(); document.querySelector(`#quick-search`).focus(); }"
                class="flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white hover:bg-violet-200 dark:hover:bg-gray-700 group">
                <span class="">Pre-Generated</span>
            </a>
        </li>
    </ul>
</div>
