@props(['authentications'])

<div>
    <h3 class="text-center text-2xl my-2">Authentication Fees</h3>
    <h4 class="text-center text-md my-1">{{ date('M d, Y @ h:m a') }}</h4>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table id="authentications-table" class="bg-white w-full text-nowrap text-sm text-left rtl:text-right">
            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-2 py-1 border">#</th>
                    <th class="px-2 py-1 border">Branch</th>
                    <th class="px-2 py-1 border">COC No.</th>
                    <th class="px-2 py-1 border text-right" style="text-align: right;">Pira Fee</th>
                    <th class="px-2 py-1 border text-right" style="text-align: right;">Premiums</th>
                    <th class="px-2 py-1 border text-right" style="text-align: right;">Trans. Fee</th>
                    <th class="px-2 py-1 border text-right" style="text-align: right;">OICP Fee</th>
                    <th class="px-2 py-1 border text-right" style="text-align: right;">Amount Due</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalAmountDue = $authentications->reduce(function (?float $carry, object $authentication) {
                        return $carry + ((float) $authentication->amount_due);
                    });
                    $totalPiraFee = $authentications->reduce(function (?float $carry, object $authentication) {
                        return $carry + ((float) $authentication->pira_fee);
                    });
                    $totalTransFee = $authentications->reduce(function (?float $carry, object $authentication) {
                        return $carry + ((float) $authentication->transaction_fee);
                    });
                    $totalOicpFee = $authentications->reduce(function (?float $carry, object $authentication) {
                        return $carry + ((float) $authentication->oicp_fee);
                    });
                    $totalPremium = $authentications->reduce(function (?float $carry, object $authentication) {
                        return $carry + ((float) $authentication->basic_premium);
                    });
                @endphp

                @forelse ($authentications as $authentication)
                    <tr class="group cursor-pointer">
                        <td class="px-2 py-1 border">{{ $loop->index + 1 }}.</td>
                        <td class="px-2 py-1 border capitalize">{{ $authentication->branch }}</td>
                        <td class="px-2 py-1 border">{{ $authentication->coc_number }}</td>
                        <td class="px-2 py-1 border text-right" style="text-align: right;">
                            {{ $authentication->pira_fee }}
                        </td>
                        <td class="px-2 py-1 border text-right" style="text-align: right;">
                            {{ $authentication->basic_premium }}
                        </td>
                        <td class="px-2 py-1 border text-right" style="text-align: right;">
                            {{ $authentication->transaction_fee }}
                        </td>
                        <td class="px-2 py-1 border text-right" style="text-align: right;">
                            {{ $authentication->oicp_fee }}
                        </td>
                        <td class="px-2 py-1 border text-right" style="text-align: right;">
                            {{ $authentication->amount_due }}
                        </td>
                        </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-2 py-1 border text-center">No data found.</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr class="border-t">
                    <td colspan="3" class="px-2 py-1 border text-end text-lg">
                        Total Summary
                    </td>
                    <td class="px-2 py-1 border text-end font-bolder text-lg">
                        {{ number_format($totalPiraFee, 2) }}
                    </td>
                    <td class="px-2 py-1 border text-end font-bolder text-lg">
                        {{ number_format($totalPremium, 2) }}
                    </td>
                    <td class="px-2 py-1 border text-end font-bolder text-lg">
                        {{ number_format($totalTransFee, 2) }}
                    </td>
                    <td class="px-2 py-1 border text-end font-bolder text-lg">
                        {{ number_format($totalOicpFee, 2) }}
                    </td>
                    <td class="px-2 py-1 border text-end font-bolder text-lg">
                        {{ number_format($totalAmountDue, 2) }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
