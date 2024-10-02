<div id="branches" role="tabpanel" aria-labelled-by="branches-tab" class="h-full space-y-6 px-6 py-8 overflow-y-auto bg-gray-50 dark:bg-gray-800">
    <h2 class="text-2xl font-black px-5">Branch Management</h2>
    <hr>
    <ul class="space-y-1 font-medium">
        <li role="presentation">
            <a href="/branches/create"
                class="flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group {{ (request()->is('branches/create')) ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }}">
                <span class="">
                    New Branch
                </span>
            </a>
        </li>
        <li role="presentation">
            <a href="/branches"
                class="flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white hover:bg-violet-200 dark:hover:bg-gray-700 group {{ (request()->is('branches')) ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }}">
                <span class="">
                    Branches Table
                </span>
            </a>
        </li>
    </ul>
</div>
