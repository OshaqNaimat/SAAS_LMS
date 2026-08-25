<x-layout>
    <div class="flex h-screen relative">
        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>
        {{-- <x-admin-sidebar /> --}}

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8 bg-slate-50">

            <div class="flex items-center gap-3 mb-8">
                <a href="{{ route('admin.faculty') }}" class="text-gray-500 hover:text-gray-900 transition">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">{{ $student->name }}</h1>
                    <p class="text-sm text-gray-500 mt-1">Roll No. {{ $student->roll_number }} •
                        {{ $student->classRoom->name ?? '—' }} - {{ $student->classRoom->section ?? '' }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
                <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                    <span class="text-xs text-gray-500 font-medium">Attendance Rate</span>
                    <h4 class="text-2xl font-bold text-gray-900 mt-1">
                        {{ $attendanceRate !== null ? $attendanceRate . '%' : 'No data' }}</h4>
                </div>
                <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                    <span class="text-xs text-gray-500 font-medium">Total Paid</span>
                    <h4 class="text-2xl font-bold text-emerald-600 mt-1">PKR {{ number_format($totalPaid) }}</h4>
                </div>
                <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                    <span class="text-xs text-gray-500 font-medium">Outstanding Dues</span>
                    <h4 class="text-2xl font-bold {{ $totalDue > 0 ? 'text-rose-600' : 'text-gray-400' }} mt-1">PKR
                        {{ number_format($totalDue) }}</h4>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                    <div class="bg-gray-50 border-b border-gray-200 p-4">
                        <h3 class="font-bold text-base text-gray-900">Recent Attendance</h3>
                    </div>
                    <div class="overflow-x-auto max-h-96 overflow-y-auto">
                        <table class="w-full text-left border-collapse whitespace-nowrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold text-gray-500 uppercase tracking-wider bg-gray-50 border-b border-gray-200">
                                    <th class="p-4">Date</th>
                                    <th class="p-4">Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                                @forelse($attendanceRecords as $record)
                                    <tr>
                                        <td class="p-4">{{ \Carbon\Carbon::parse($record->date)->format('M d, Y') }}
                                        </td>
                                        <td class="p-4">
                                            <span
                                                class="px-2 py-0.5 rounded text-xs font-bold {{ $record->status === 'present' ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                                {{ ucfirst(str_replace('_', ' ', $record->status)) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="p-6 text-center text-gray-400 text-sm">No attendance
                                            records yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                    <div class="bg-gray-50 border-b border-gray-200 p-4">
                        <h3 class="font-bold text-base text-gray-900">Payment History</h3>
                    </div>
                    <div class="overflow-x-auto max-h-96 overflow-y-auto">
                        <table class="w-full text-left border-collapse whitespace-nowrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold text-gray-500 uppercase tracking-wider bg-gray-50 border-b border-gray-200">
                                    <th class="p-4">Voucher</th>
                                    <th class="p-4">Category</th>
                                    <th class="p-4">Amount</th>
                                    <th class="p-4">Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                                @forelse($payments as $payment)
                                    <tr>
                                        <td class="p-4 font-mono text-xs text-blue-600">{{ $payment->voucher_id }}</td>
                                        <td class="p-4">{{ $payment->category }}</td>
                                        <td class="p-4 font-bold text-gray-900">PKR
                                            {{ number_format($payment->amount) }}</td>
                                        <td class="p-4">
                                            @php
                                                $statusClass = match ($payment->status) {
                                                    'cleared' => 'bg-emerald-50 text-emerald-700',
                                                    'pending' => 'bg-amber-50 text-amber-700',
                                                    'overdue' => 'bg-rose-50 text-rose-700',
                                                };
                                            @endphp
                                            <span
                                                class="px-2 py-0.5 rounded text-xs font-bold {{ $statusClass }}">{{ ucfirst($payment->status) }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="p-6 text-center text-gray-400 text-sm">No payment
                                            records yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>
</x-layout>
