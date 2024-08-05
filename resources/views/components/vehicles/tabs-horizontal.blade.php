@props(['client', 'vehicle'])

<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-md font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
        <li class="me-2" role="presentation">
            <button aria-selected="true"
                id="details-tab"
                class="inline-block p-4 border-b-2 rounded-t-lg"
                data-tabs-target="#details"
                type="button"
                role="tab">Details</button>
        </li>
        <li class="me-2" role="presentation">
            <button
                id="insurance-tab"
                class="inline-block p-4 border-b-2 rounded-t-lg"
                data-tabs-target="#insurance"
                type="button"
                role="tab">Insurance</button>
        </li>
    </ul>
</div>
<div id="default-tab-content">
    <div class="hidden p-8 rounded-lg bg-gray-50 dark:bg-gray-800"
        id="details"
        role="tabpanel"
        aria-labelledby="details-tab">
        <div class="flex">
            <x-vehicles.vehicle-details :$vehicle />
        </div>
    </div>
    <div class="hidden p-8 rounded-lg bg-gray-50 dark:bg-gray-800"
        id="insurance"
        role="tabpanel"
        aria-labelledby="insurance-tab">
        <div class="flex">
            <x-vehicles.table-vehicle-insurances :$client :$vehicle />
        </div>
    </div>
    <div class="hidden p-8 rounded-lg bg-gray-50 dark:bg-gray-800" id="transactions" role="tabpanel" aria-labelledby="settings-tab">
        <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
    </div>
</div>
