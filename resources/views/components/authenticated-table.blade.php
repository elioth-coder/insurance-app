@props(['authentication','settings','vehicle_type'])

<style>
#authentication-table {
    font-size
}
</style>
<table id="authentication-table" class="table align-top border mx-auto w-full text-xs">
    <tbody>
        <tr>
            <td colspan="4" class="p-2 font-bold border-b bg-gray-300 py-1">TRANSACTION DETAILS</td>
        </tr>
        <tr class="border-b">
            <td class="p-2 border-r font-bold">Date & Time</td>
            <td class="p-2 border-r">{{ date('Y-m-d h:i A', strtotime($authentication->created_at)) }}</td>
            <td class="p-2 border-r font-bold">Policy No.</td>
            <td class="p-2 border-r">{{ $authentication->policy_number }}</td>
        </tr>
        <tr class="border-b">
            <td class="p-2 border-r font-bold">OR No.</td>
            <td class="p-2">{{ $authentication->or_number }}</td>
            <td class="p-2 border-r font-bold">COC No.</td>
            <td class="p-2">{{ $authentication->coc_number }}</td>
        </tr>
        <tr class="border-b">
            <td class="p-2 border-r font-bold">Name & Address</td>
            <td class="p-2 border-r" colspan="3">{{ $authentication->assured_name }} - {{ $authentication->assured_address }}</td>
        </tr>
        <tr>
            <td colspan="4" class="p-2 font-bold border-b bg-gray-300 py-1">VEHICLE DETAILS</td>
        </tr>
        <tr class="border-b">
            <td class="p-2 border-r font-bold">Plate No.</td>
            <td class="p-2 border-r">{{ $authentication->plate_number ?? '--' }}</td>
            <td class="p-2 border-r font-bold">MV File No.</td>
            <td class="p-2">{{ $authentication->mv_file_number ?? '--' }}</td>
        </tr>
        <tr class="border-b">
            <td class="p-2 border-r font-bold">Chassis No.</td>
            <td class="p-2 border-r">{{ $authentication->serial_number }}</td>
            <td class="p-2 border-r font-bold">Engine No.</td>
            <td class="p-2">{{ $authentication->engine_number ?? '--' }}</td>
        </tr>
        <tr class="border-b">
            <td class="p-2 border-r font-bold">Year & Model</td>
            <td class="p-2 border-r">{{ $authentication->year }} {{ $authentication->model }}</td>
            <td class="p-2 border-r font-bold">Make & Color</td>
            <td class="p-2">{{ $authentication->make }} {{ $authentication->color }}</td>
        </tr>
        <tr>
            <td colspan="4" class="p-2 font-bold border-b bg-gray-300 py-1">INSURANCE FEE DETAILS</td>
        </tr>
        <tr class="border-b">
            <td class="p-2 border-r font-bold">Classification</td>
            <td colspan="3" class="p-2 border-r uppercase">
                {{ $vehicle_type->code }} - {{ $vehicle_type->type }} &mdash;
                P{{ number_format((($authentication->coverage == 1) ? $vehicle_type->one_year : $vehicle_type->three_years),2) }}
            </td>
        </tr>
        <tr class="border-b">
            <td class="p-2 border-r"><b>Coverage</b></td>
            <td class="p-2 border-r">
                {{ ($authentication->coverage == 1) ? 'One (1) year' : 'Three (3) years'}}
            </td>
            <td class="p-2 border-r"><b>Inception Date</b></td>
            <td class="p-2">
                {{ date('M d, Y', strtotime($authentication->inception_date)) }} 12:00 NN
            </td>
        </tr>
        <tr class="border-b">
            <td class="p-2 border-r"><b>PIRA Fee</b></td>
            <td class="p-2 text-end">{{ number_format($authentication->pira_fee, 2) }}</td>
            <td class="p-2 border-r"><b>Expiry Date</b></td>
            <td class="p-2">
                {{ date('M d, Y', strtotime($authentication->expiry_date)) }} 12:00 NN
            </td>
            {{-- <td class="p-2 border-r font-bold">Liability Limit</td>
            <td class="p-2 text-end">{{ number_format($settings['LIABILITY_LIMIT'], 2) }}</td> --}}
        </tr>
        <tr class="border-b">
            <td class="p-2 border-r font-bold">Docstamp Tax</td>
            <td class="p-2 text-end">{{ number_format($authentication->doc_stamp_tax, 2) }}</td>
            <td class="p-2 border-r font-bold">Premiums</td>
            <td class="p-2 text-end">{{ number_format($authentication->basic_premium, 2) }}</td>
        </tr>
        <tr class="border-b">
            <td class="p-2 border-r font-bold">E-VAT</td>
            <td class="p-2 text-end">{{ number_format($authentication->e_vat, 2) }}</td>
            <td class="p-2 border-r font-bold">Trans. Fee</td>
            <td class="p-2 text-end">{{ number_format($authentication->transaction_fee, 2) }}</td>
        </tr>
        <tr class="border-b">
            <td class="p-2 border-r font-bold">Local Tax</td>
            <td class="p-2 text-end">{{ number_format($authentication->local_gov_tax, 2) }}</td>
            <td class="p-2 border-x font-bold">OICP Fee</td>
            <td class="p-2 text-end ">{{ number_format($authentication->oicp_fee, 2) }}</td>
        </tr>
        <tr class="border-b align-top">
            <td class="p-2 border-r font-bold">Net Amount</td>
            <td class="p-2 text-end">{{ number_format($authentication->net_amount, 2) }}</td>
            <td class="p-2 border-x font-bold">Amount Due</td>
            <td class="p-2 text-end text-2xl font-bold">P {{ number_format($authentication->amount_due, 2) }}</td>
        </tr>
    </tbody>
</table>
