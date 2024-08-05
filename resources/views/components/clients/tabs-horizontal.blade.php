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
                id="owned-vehicles-tab"
                class="inline-block p-4 border-b-2 rounded-t-lg"
                data-tabs-target="#vehicles"
                type="button"
                role="tab">Vehicles</button>
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
        id="vehicles"
        role="tabpanel"
        aria-labelledby="vehicles-tab">
        <div class="flex">
            <x-clients.table-owned-vehicles :$client />
        </div>
    </div>
</div>
