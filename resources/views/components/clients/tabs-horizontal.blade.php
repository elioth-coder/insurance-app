@props(['client'])

<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-md font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
        <li class="me-2" role="presentation">
            <button aria-selected="true"
                id="personal-info-tab"
                class="inline-block p-4 border-b-2 rounded-t-lg"
                data-tabs-target="#personal_info"
                type="button"
                role="tab">Personal Info</button>
        </li>
        <li class="me-2" role="presentation">
            <button
                id="personal-info-tab"
                class="inline-block p-4 border-b-2 rounded-t-lg"
                data-tabs-target="#owned_vehicles"
                type="button"
                role="tab">Owned Vehicles</button>
        </li>
        <li class="me-2" role="presentation">
            <button
                id="transactions-tab"
                class="inline-block p-4 border-b-2 rounded-t-lg"
                data-tabs-target="#transactions"
                type="button"
                role="tab">Transactions</button>
        </li>
    </ul>
</div>
<div id="default-tab-content">
    <div class="hidden p-8 rounded-lg bg-gray-50 dark:bg-gray-800"
        id="personal_info"
        role="tabpanel"
        aria-labelledby="personal_info-tab">
        <div class="flex">
            <x-clients.personal-info :$client />
        </div>
    </div>
    <div class="hidden p-8 rounded-lg bg-gray-50 dark:bg-gray-800"
        id="owned_vehicles"
        role="tabpanel"
        aria-labelledby="dashboard-tab">
        <div class="flex">
            <x-clients.table-owned-vehicles :$client />
        </div>
    </div>
    <div class="hidden p-8 rounded-lg bg-gray-50 dark:bg-gray-800" id="transactions" role="tabpanel" aria-labelledby="settings-tab">
        <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
    </div>
</div>
