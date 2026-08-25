@forelse($payments as $payment)
    <tr class="hover:bg-gray-50">
        <td class="p-4 font-mono text-xs text-blue-600 font-semibold">{{ $payment->voucher_id }}</td>
        <td class="p-4">
            <div class="flex flex-col">
                <span class="font-semibold text-gray-800">{{ $payment->student_name }}</span>
                <span class="text-xs font-mono text-gray-500">Roll: #{{ $payment->roll_number }}</span>
            </div>
        </td>
        <td class="p-4 text-gray-600 font-medium">{{ $payment->category }}</td>
        <td class="p-4 text-xs">
            <i
                class="bi {{ str_contains($payment->channel, 'Cash') ? 'bi-cash text-emerald-600' : 'bi-bank text-blue-600' }} mr-1.5"></i>
            {{ $payment->channel }}
        </td>
        <td class="p-4 font-bold text-gray-800">PKR {{ number_format($payment->amount) }}</td>
        <td class="p-4">
            @php
                $statusClass = match ($payment->status) {
                    'cleared' => 'bg-emerald-100 border-emerald-200 text-emerald-700',
                    'pending' => 'bg-amber-100 border-amber-200 text-amber-700',
                    'overdue' => 'bg-red-100 border-red-200 text-red-700',
                };
            @endphp
            <span id="payment-status-{{ $payment->id }}"
                class="px-2.5 py-1 rounded-full text-xs font-semibold border {{ $statusClass }}">
                {{ ucfirst($payment->status) }}
            </span>
        </td>
        <td class="p-4 text-right">
            <button onclick="openEditPayment({{ $payment->id }}, '{{ $payment->status }}')"
                class="text-yellow-600 hover:text-yellow-700 transition" title="Edit Status">
                <i class="bi bi-pencil-square"></i>
            </button>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="p-6 text-center text-gray-400 text-sm">No payment records found.</td>
    </tr>
@endforelse
