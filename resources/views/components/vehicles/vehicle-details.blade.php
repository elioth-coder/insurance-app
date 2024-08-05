@props(['vehicle'])

<section class="w-full">
    <h2 class="text-xl underline mb-4 font-bold">Vehicle's Details</h2>

    <p class="font-normal text-gray-700 dark:text-gray-400">
        <strong class="font-bold inline-block w-44">Serial / Chassis no.: </strong>
        {{ $vehicle->chassis_number ?? '--' }}
    </p>
    <p class="font-normal text-gray-700 dark:text-gray-400">
        <strong class="font-bold inline-block w-44">Motor Engine no.: </strong>
        {{ $vehicle->engine_number ?? '--' }}
    </p>
    <p class="font-normal text-gray-700 dark:text-gray-400">
        <strong class="font-bold inline-block w-44">Make: </strong>
        {{ $vehicle->make ?? '--' }}
    </p>
    <p class="font-normal text-gray-700 dark:text-gray-400">
        <strong class="font-bold inline-block w-44">Model: </strong>
        {{ $vehicle->model ?? '--' }}
    </p>
    <p class="font-normal text-gray-700 dark:text-gray-400">
        <strong class="font-bold inline-block w-44">Color: </strong>
        {{ $vehicle->color ?? '--' }}
    </p>
    <p class="font-normal text-gray-700 dark:text-gray-400">
        <strong class="font-bold inline-block w-44">Body Type: </strong>
        {{ $vehicle->body_type ?? '--' }}
    </p>
    <p class="font-normal text-gray-700 dark:text-gray-400">
        <strong class="font-bold inline-block w-44">Unladen Weight (kg): </strong>
        {{ $vehicle->unladen_weight ?? '--' }}
    </p>
    <p class="font-normal text-gray-700 dark:text-gray-400">
        <strong class="font-bold inline-block w-44">Load Capacity (kg): </strong>
        {{ $vehicle->load_capacity ?? '--' }}
    </p>
</section>
