@props(['authentications'])

<div>
    <h3 class="text-center text-2xl my-2">Authentication Taxes</h3>
    <h4 class="text-center text-md my-1">{{ date('M d, Y @ h:m a') }}</h4>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table id="authentications-table" class="bg-white w-full text-nowrap text-sm text-left rtl:text-right">
            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-2 py-1 border">#</th>
                    <th class="px-2 py-1 border">Branch</th>
                    <th class="px-2 py-1 border">COC No.</th>
                    <th class="px-2 py-1 border text-right" style="text-align: right;">NET</th>
                    <th class="px-2 py-1 border text-right" style="text-align: right;">DST</th>
                    <th class="px-2 py-1 border text-right" style="text-align: right;">EVAT</th>
                    <th class="px-2 py-1 border text-right" style="text-align: right;">LGT</th>
                    <th class="px-2 py-1 border text-right" style="text-align: right;">PIRA FEE</th>
                    <th class="px-2 py-1 border text-right" style="text-align: right;">PREMIUMS</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalNet = $authentications->reduce(function (?float $carry, object $authentication) {
                        return $carry + ((float) $authentication->net_amount);
                    });
                    $totalDST = $authentications->reduce(function (?float $carry, object $authentication) {
                        return $carry + ((float) $authentication->doc_stamp_tax);
                    });
                    $totalEVAT = $authentications->reduce(function (?float $carry, object $authentication) {
                        return $carry + ((float) $authentication->e_vat);
                    });
                    $totalLGT = $authentications->reduce(function (?float $carry, object $authentication) {
                        return $carry + ((float) $authentication->local_gov_tax);
                    });
                    $totalPiraFee = $authentications->reduce(function (?float $carry, object $authentication) {
                        return $carry + ((float) $authentication->pira_fee);
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
                            {{ $authentication->net_amount }}
                        </td>
                        <td class="px-2 py-1 border text-right" style="text-align: right;">
                            {{ $authentication->doc_stamp_tax }}
                        </td>
                        <td class="px-2 py-1 border text-right" style="text-align: right;">
                            {{ $authentication->e_vat }}
                        </td>
                        <td class="px-2 py-1 border text-right" style="text-align: right;">
                            {{ $authentication->local_gov_tax }}
                        </td>
                        <td class="px-2 py-1 border text-right" style="text-align: right;">
                            {{ $authentication->pira_fee }}
                        </td>
                        <td class="px-2 py-1 border text-right" style="text-align: right;">
                            {{ $authentication->basic_premium }}
                        </td>
                        </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-2 py-1 border text-center">No data found.</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr class="border-t">
                    <td colspan="3" class="px-2 py-1 border text-end text-lg">
                        Total Summary
                    </td>
                    <td class="px-2 py-1 border text-end font-bolder text-lg">
                        {{ number_format($totalNet, 2) }}
                    </td>
                    <td class="px-2 py-1 border text-end font-bolder text-lg">
                        {{ number_format($totalDST, 2) }}
                    </td>
                    <td class="px-2 py-1 border text-end font-bolder text-lg">
                        {{ number_format($totalEVAT, 2) }}
                    </td>
                    <td class="px-2 py-1 border text-end font-bolder text-lg">
                        {{ number_format($totalLGT, 2) }}
                    </td>
                    <td class="px-2 py-1 border text-end font-bolder text-lg">
                        {{ number_format($totalPiraFee, 2) }}
                    </td>
                    <td class="px-2 py-1 border text-end font-bolder text-lg">
                        {{ number_format($totalPremium, 2) }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
