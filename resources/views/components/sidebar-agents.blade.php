<div id="agents" role="tabpanel" aria-labelled-by="agents-tab" class="h-full space-y-6 px-6 py-8 overflow-y-auto bg-gray-50 dark:bg-gray-800">
    <h2 class="text-2xl font-black px-5">Users Management</h2>
    <hr>
    <ul class="space-y-1 font-medium">
        <li role="presentation">
            <a href="/agents/create"
                class="flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group {{ (request()->is('agents/create')) ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }}">
                <span class="">
                    New {{ (Auth::user()->role=='agent') ? 'Subagent' : 'Agent'}}
                </span>
            </a>
        </li>
        <li role="presentation">
            <a href="/agents"
                class="flex items-center px-5 p-2 text-gray-900 rounded-2xl dark:text-white hover:bg-violet-200 dark:hover:bg-gray-700 group {{ (request()->is('agents')) ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }}">
                <span class="">
                    {{ (Auth::user()->role=='agent') ? 'Subagent' : 'Agent'}}s Table
                </span>
            </a>
        </li>
    </ul>
</div>
