@forelse($payments as $payment)
    <tr class="hover:bg-slate-900/40">
        <td class="p-4 font-mono text-xs text-blue-400 font-semibold">{{ $payment->voucher_id }}</td>
        <td class="p-4">
            <div class="flex flex-col">
                <span class="font-semibold text-white">{{ $payment->student_name }}</span>
                <span class="text-xs font-mono text-gray-400">Roll: #{{ $payment->roll_number }}</span>
            </div>
        </td>
        <td class="p-4 text-gray-400 font-medium">{{ $payment->category }}</td>
        <td class="p-4 text-xs">
            <i
                class="bi {{ str_contains($payment->channel, 'Cash') ? 'bi-cash text-emerald-400' : 'bi-bank text-blue-400' }} mr-1.5"></i>
            {{ $payment->channel }}
        </td>
        <td class="p-4 font-bold text-white">PKR {{ number_format($payment->amount) }}</td>
        <td class="p-4">
            @php
                $statusClass = match ($payment->status) {
                    'cleared' => 'bg-emerald-500/10 border-emerald-500/20 text-emerald-400',
                    'pending' => 'bg-amber-500/10 border-amber-500/20 text-amber-400',
                    'overdue' => 'bg-rose-500/10 border-rose-500/20 text-rose-400',
                };
            @endphp
            <span id="payment-status-{{ $payment->id }}"
                class="px-2.5 py-1 rounded-full text-xs font-semibold border {{ $statusClass }}">
                {{ ucfirst($payment->status) }}
            </span>
        </td>
        <td class="p-4 text-right">
            <button onclick="openEditPayment({{ $payment->id }}, '{{ $payment->status }}')"
                class="text-yellow-400 hover:text-yellow-300 transition" title="Edit Status">
                <i class="bi bi-pencil-square"></i>
            </button>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="p-6 text-center text-gray-500 text-sm">No payment records found.</td>
    </tr>
@endforelse
