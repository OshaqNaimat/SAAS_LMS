<x-layout>
    <div class="flex h-screen bg-gray-50 overflow-hidden relative">

        {{-- <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div> --}}

        <x-student-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Assalam-o-Alaikum, {{ $student->name }}</h1>
                    <p class="text-sm text-gray-600">
                        @if ($student->classRoom)
                            {{ $student->classRoom->name }} - Section {{ $student->classRoom->section }}
                        @else
                            No class assigned
                        @endif
                    </p>
                </div>
            </div>

            <!-- ─── KPI CARDS ─── -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

                <!-- Attendance Card -->
                <div
                    class="bg-white border border-gray-200 rounded-2xl p-6 flex flex-col justify-between h-56 shadow-sm">
                    <div>
                        <div class="flex justify-between items-start">
                            <div>
                                <span
                                    class="text-[11px] font-bold text-gray-500 uppercase tracking-wider block">Attendance
                                    Rate</span>
                                <h2 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $attendanceRate }}%</h2>
                            </div>
                            <span
                                class="text-xs font-bold {{ $attendanceRate >= 90 ? 'text-emerald-600 bg-emerald-50 border-emerald-200' : ($attendanceRate >= 75 ? 'text-amber-600 bg-amber-50 border-amber-200' : 'text-red-600 bg-red-50 border-red-200') }} border px-2 py-1 rounded-lg">
                                {{ $attendanceRate >= 90 ? 'Good Standing' : ($attendanceRate >= 75 ? 'Needs Improvement' : 'At Risk') }}
                            </span>
                        </div>
                        <div class="mt-8">
                            <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden border border-gray-300">
                                <div class="bg-emerald-500 h-3 rounded-full" style="width: {{ $attendanceRate }}%">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-gray-200 flex items-center justify-between text-xs text-gray-600">
                        <span class="flex items-center gap-1.5"><span
                                class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> {{ $presentCount }}
                            Present</span>
                        <span class="flex items-center gap-1.5"><span
                                class="w-2.5 h-2.5 rounded-full bg-red-500"></span> {{ $absentCount }} Absent</span>
                        <span class="flex items-center gap-1.5"><span
                                class="w-2.5 h-2.5 rounded-full bg-amber-500"></span> {{ $leaveCount }} Leave</span>
                    </div>
                </div>

                <!-- Fees Card -->
                <div
                    class="bg-white border border-gray-200 rounded-2xl p-6 flex flex-col justify-between h-56 shadow-sm">
                    <div>
                        <span class="text-[11px] font-bold text-gray-500 uppercase tracking-wider block">Fees
                            Overview</span>
                        <div class="flex items-end gap-4 mt-1">
                            <div>
                                <h2 class="text-2xl font-extrabold text-emerald-600">PKR
                                    {{ number_format($totalPaid) }}</h2>
                                <span class="text-[10px] text-gray-500">Paid</span>
                            </div>
                            <div>
                                <h2
                                    class="text-2xl font-extrabold {{ $totalDue > 0 ? 'text-red-600' : 'text-gray-500' }}">
                                    PKR {{ number_format($totalDue) }}</h2>
                                <span class="text-[10px] text-gray-500">Outstanding</span>
                            </div>
                        </div>

                        @if ($feeHistory->count() > 0)
                            <div class="flex items-end justify-between gap-1.5 h-16 mt-4 px-1">
                                @php $maxAmount = $feeHistory->max('amount') ?: 1; @endphp
                                @foreach ($feeHistory->take(6) as $fee)
                                    <div class="flex-1 bg-gray-200 rounded-t h-full flex items-end"
                                        title="{{ $fee['label'] }}: PKR {{ number_format($fee['amount']) }}">
                                        <div class="{{ $fee['status'] === 'cleared' ? 'bg-emerald-500' : ($fee['status'] === 'overdue' ? 'bg-red-500' : 'bg-amber-500') }} w-full rounded-t"
                                            style="height: {{ round(($fee['amount'] / $maxAmount) * 100) }}%"></div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-xs text-gray-500 mt-4">No fee records found yet.</p>
                        @endif
                    </div>
                    <div
                        class="pt-4 border-t border-gray-200 flex items-center justify-between text-[11px] text-gray-500">
                        <span>{{ $feeHistory->count() }} transaction(s) on record</span>
                        @if ($totalDue > 0)
                            <span class="text-red-600 font-bold">Payment Due</span>
                        @else
                            <span class="text-emerald-600 font-bold">All Cleared</span>
                        @endif
                    </div>
                </div>

            </div>

            <!-- ─── WEEKLY TIMETABLE ─── -->
            <div class="space-y-6">

                <div class="space-y-3">
                    <h3 class="text-xs font-bold text-gray-500 tracking-wide uppercase">Weekly Timetable</h3>

                    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden w-full shadow-sm">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse whitespace-nowrap">
                                <thead>
                                    <tr
                                        class="text-xs font-semibold text-gray-500 uppercase tracking-wider bg-gray-50/80 border-b border-gray-200">
                                        <th class="p-4 w-32">Day</th>
                                        <th class="p-4">Lectures</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm text-gray-700 divide-y divide-gray-200">
                                    @php
                                        $dayNames = [
                                            '',
                                            'Monday',
                                            'Tuesday',
                                            'Wednesday',
                                            'Thursday',
                                            'Friday',
                                            'Saturday',
                                        ];
                                    @endphp
                                    @forelse(range(1, 6) as $dayNum)
                                        @php $dayPeriods = $periods->get($dayNum, collect()); @endphp
                                        <tr class="hover:bg-gray-50 align-top">
                                            <td class="p-4 font-semibold text-gray-800">{{ $dayNames[$dayNum] }}</td>
                                            <td class="p-4">
                                                @if ($dayPeriods->isEmpty())
                                                    <span class="text-xs text-gray-500">
                                                        {{ $dayNum === 6 ? 'No classes on Saturday' : 'No lectures scheduled' }}
                                                    </span>
                                                @else
                                                    <div class="flex flex-wrap gap-2">
                                                        @foreach ($dayPeriods as $period)
                                                            <div
                                                                class="bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 min-w-[140px]">
                                                                <div
                                                                    class="flex items-center justify-between gap-2 mb-1">
                                                                    <span
                                                                        class="text-xs font-bold text-gray-800">{{ $period->subject }}</span>
                                                                    <span
                                                                        class="text-[10px] text-blue-600 font-mono">P{{ $period->period_number }}</span>
                                                                </div>
                                                                <p class="text-[10px] text-gray-500">
                                                                    {{ \Carbon\Carbon::parse($period->start_time)->format('H:i') }}
                                                                    -
                                                                    {{ \Carbon\Carbon::parse($period->end_time)->format('H:i') }}
                                                                </p>
                                                                <p class="text-[10px] text-gray-500">
                                                                    {{ $period->teacher->name ?? 'TBA' }} •
                                                                    {{ $period->room ?? 'No room' }}
                                                                </p>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script>
        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            if (sidebar) sidebar.classList.remove('open');
            if (overlay) overlay.classList.remove('show');
        }
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) closeSidebar();
        });
    </script>
</x-layout>
