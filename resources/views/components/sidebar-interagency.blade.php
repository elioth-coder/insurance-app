<div id="interagency" role="tabpanel" aria-labelled-by="interagency-tab" class="h-full space-y-6 px-6 py-8 overflow-y-auto bg-gray-50 dark:bg-gray-800">
    <h2 class="text-2xl font-black px-5">Interagency</h2>
    <hr>
    <ul class="space-y-1 font-medium">
        <li role="presentation">
            <a href="/interagency/hpg/?tab=hpg"
                class="relative flex items-center px-5 py-5 pl-12  text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group {{ (request()->tab=='hpg') ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }}">
                <img src="{{ asset('images/hpg-logo.png') }}" class="border w-7 h-7 rounded-full block absolute top-0 left-0 ml-3 mt-4" />
                <span class="">Highway Patrol Group (HPG)</span>
            </a>
        </li>
        <li role="presentation">
            <a href="/interagency/hpg/?tab=hpg"
                class="relative flex items-center px-5 py-5 pl-12  text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group {{ (request()->tab=='lto') ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }}">
                <img src="{{ asset('images/lto-logo.png') }}" class="border w-7 h-7 rounded-full block absolute top-0 left-0 ml-3 mt-4" />
                <span class="">Land Transportation Office (LTO)</span>
            </a>
        </li>
        <li role="presentation">
            <a href="/interagency/hpg/?tab=hpg"
                class="relative flex items-center px-5 py-5 pl-12  text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group {{ (request()->tab=='boc') ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }}">
                <img src="{{ asset('images/boc-logo.png') }}" class="border w-7 h-7 rounded-full block absolute top-0 left-0 ml-3 mt-4" />
                <span class="">Bureau of Customs (BOC)</span>
            </a>
        </li>
        <li role="presentation">
            <a href="/interagency/hpg/?tab=hpg"
                class="relative flex items-center px-5 py-5 pl-12  text-gray-900 rounded-2xl dark:text-white dark:hover:bg-gray-700 group {{ (request()->tab=='ltfrb') ? 'bg-violet-500 text-white' : 'hover:bg-violet-200' }}">
                <img src="{{ asset('images/ltfrb-logo.png') }}" class="border w-7 h-7 rounded-full block absolute top-0 left-0 ml-3 mt-4" />
                <span class="">Land Transportation and Franchising Regulatory Board (LTFRB)</span>
            </a>
        </li>
    </ul>
</div>
