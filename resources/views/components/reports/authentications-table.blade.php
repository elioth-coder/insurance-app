@props(['authentications'])

<div>
    <h3 class="text-center text-2xl my-2">Today's Uploads - Per Authentication</h3>
    <h4 class="text-center text-md my-1">{{ date('M d, Y @ h:m a') }}</h4>
    <table id="authentications-table" class="bg-white w-full text-sm text-left rtl:text-right">
        <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-2 py-1 border">#</th>
                <th class="px-2 py-1 border">Type</th>
                <th class="px-2 py-1 border">COC Number</th>
                <th class="px-2 py-1 border">Branch</th>
                <th class="px-2 py-1 border text-right" style="text-align: right;">Agent</th>
                <th class="px-2 py-1 border text-right" style="text-align: right;">Rate</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalUploadRate = $authentications->reduce(function (
                    ?int $carry,
                    object $authentication,
                ) {
                    return $carry + $authentication->upload_rate;
                });
            @endphp

            @forelse ($authentications as $authentication)
                <tr class="group cursor-pointer">
                    <td class="px-2 py-1 border">{{ $loop->index + 1 }}.</td>
                    <td class="px-2 py-1 border capitalize">{{ $authentication->type }}</td>
                    <td class="px-2 py-1 border">{{ $authentication->coc_number }}</td>
                    <td class="px-2 py-1 border">{{ $authentication->agent->branch }}</td>
                    <td class="px-2 py-1 border text-right" style="text-align: right;">
                        {{ $authentication->agent->first_name }} {{ $authentication->agent->last_name }}
                    </td>
                    <td class="px-2 py-1 border text-right" style="text-align: right;">
                        {{ $authentication->upload_rate }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-2 py-1 border text-center">No data found.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="border-t">
                <td colspan="5" class="px-2 py-1 border text-right text-2xl" style="text-align: right;">
                    Total
                    Upload Rate</td>
                <td class="px-2 py-1 border text-right font-bolder text-4xl" style="text-align: right;">
                    {{ number_format($totalUploadRate, 2) }}</td>
            </tr>
        </tfoot>
    </table>
</div>
