<x-layout>
    <div class="flex h-screen bg-[#090d16] overflow-hidden relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <x-student-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-white">Assalam-o-Alaikum, {{ $student->name }}</h1>
                    <p class="text-sm text-gray-400">
                        @if ($student->classRoom)
                            Class {{ $student->classRoom->name }} - Section {{ $student->classRoom->section }}
                        @else
                            No class assigned
                        @endif
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-6 flex flex-col justify-between h-56">
                    <div>
                        <div class="flex justify-between items-start">
                            <div>
                                <span
                                    class="text-[11px] font-bold text-gray-500 uppercase tracking-wider block">Attendance
                                    Rate</span>
                                <h2 class="text-3xl font-extrabold text-white mt-1">{{ $attendanceRate }}%</h2>
                            </div>
                            <span
                                class="text-xs font-bold {{ $attendanceRate >= 90 ? 'text-emerald-400 bg-emerald-500/10 border-emerald-500/20' : ($attendanceRate >= 75 ? 'text-amber-400 bg-amber-500/10 border-amber-500/20' : 'text-rose-400 bg-rose-500/10 border-rose-500/20') }} border px-2 py-1 rounded-lg">
                                {{ $attendanceRate >= 90 ? 'Good Standing' : ($attendanceRate >= 75 ? 'Needs Improvement' : 'At Risk') }}
                            </span>
                        </div>
                        <div class="mt-8">
                            <div class="w-full bg-slate-900 rounded-full h-3 overflow-hidden border border-slate-800">
                                <div class="bg-emerald-500 h-3 rounded-full" style="width: {{ $attendanceRate }}%">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="pt-4 border-t border-slate-800/60 flex items-center justify-between text-xs text-gray-400">
                        <span class="flex items-center gap-1.5"><span
                                class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> {{ $presentCount }}
                            Present</span>
                        <span class="flex items-center gap-1.5"><span
                                class="w-2.5 h-2.5 rounded-full bg-rose-500"></span> {{ $absentCount }} Absent</span>
                        <span class="flex items-center gap-1.5"><span
                                class="w-2.5 h-2.5 rounded-full bg-amber-500"></span> {{ $leaveCount }} Leave</span>
                    </div>
                </div>

                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-6 flex flex-col justify-between h-56">
                    <div>
                        <span class="text-[11px] font-bold text-gray-500 uppercase tracking-wider block">Fees
                            Overview</span>
                        <div class="flex items-end gap-4 mt-1">
                            <div>
                                <h2 class="text-2xl font-extrabold text-emerald-400">PKR
                                    {{ number_format($totalPaid) }}</h2>
                                <span class="text-[10px] text-gray-500">Paid</span>
                            </div>
                            <div>
                                <h2
                                    class="text-2xl font-extrabold {{ $totalDue > 0 ? 'text-rose-400' : 'text-gray-500' }}">
                                    PKR {{ number_format($totalDue) }}</h2>
                                <span class="text-[10px] text-gray-500">Outstanding</span>
                            </div>
                        </div>

                        @if ($feeHistory->count() > 0)
                            <div class="flex items-end justify-between gap-1.5 h-16 mt-4 px-1">
                                @php $maxAmount = $feeHistory->max('amount') ?: 1; @endphp
                                @foreach ($feeHistory->take(6) as $fee)
                                    <div class="flex-1 bg-slate-900 rounded-t h-full flex items-end"
                                        title="{{ $fee['label'] }}: PKR {{ number_format($fee['amount']) }}">
                                        <div class="{{ $fee['status'] === 'cleared' ? 'bg-emerald-500' : ($fee['status'] === 'overdue' ? 'bg-rose-500' : 'bg-amber-500') }} w-full rounded-t"
                                            style="height: {{ round(($fee['amount'] / $maxAmount) * 100) }}%"></div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-xs text-gray-500 mt-4">No fee records found yet.</p>
                        @endif
                    </div>
                    <div
                        class="pt-4 border-t border-slate-800/60 flex items-center justify-between text-[11px] text-gray-400">
                        <span>{{ $feeHistory->count() }} transaction(s) on record</span>
                        @if ($totalDue > 0)
                            <span class="text-rose-400 font-bold">Payment Due</span>
                        @else
                            <span class="text-emerald-400 font-bold">All Cleared</span>
                        @endif
                    </div>
                </div>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-6">

                    <div class="space-y-3">
                        <h3 class="text-xs font-bold text-gray-400 tracking-wide uppercase">Weekly Timetable</h3>

                        <div class="bg-[#111c2a] border border-slate-800 rounded-2xl overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse whitespace-nowrap">
                                    <thead>
                                        <tr
                                            class="text-xs font-semibold text-gray-400 uppercase tracking-wider bg-slate-900/60 border-b border-slate-800">
                                            <th class="p-4">Day</th>
                                            <th class="p-4">Period</th>
                                            <th class="p-4">Time</th>
                                            <th class="p-4">Subject</th>
                                            <th class="p-4">Teacher</th>
                                            <th class="p-4">Room</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm text-gray-300 divide-y divide-slate-800">
                                        @forelse($periods as $period)
                                            <tr class="hover:bg-slate-900/40">
                                                <td class="p-4 font-semibold text-white">{{ $period->dayName() }}</td>
                                                <td class="p-4 text-gray-400">{{ $period->period_number }}</td>
                                                <td class="p-4 text-xs font-mono text-blue-400">
                                                    {{ \Carbon\Carbon::parse($period->start_time)->format('H:i') }} -
                                                    {{ \Carbon\Carbon::parse($period->end_time)->format('H:i') }}
                                                </td>
                                                <td class="p-4 font-semibold text-white">{{ $period->subject }}</td>
                                                <td class="p-4 text-gray-400">{{ $period->teacher->name ?? 'TBA' }}
                                                </td>
                                                <td class="p-4 text-gray-400">{{ $period->room ?? 'No room set' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="p-6 text-center text-gray-500 text-sm">No
                                                    periods scheduled yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="space-y-3 pt-2">
                        <h3 class="text-xs font-bold text-gray-400 tracking-wide uppercase">Class Announcements</h3>

                        <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 space-y-3">
                            <div class="flex items-center justify-between">
                                <span
                                    class="text-[10px] font-bold uppercase tracking-wider text-amber-400 bg-amber-500/10 px-2 py-0.5 rounded">Homework
                                    Diary</span>
                                <span class="text-xs text-gray-500">Today, 02:15 PM</span>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-white">HTML Layout Structure Lab Practical</h4>
                                <p class="text-xs text-gray-400 mt-1 leading-relaxed">
                                    Complete your responsive layout grids using CSS variables. All students must bring
                                    their practical logs completed for code checking tomorrow morning.
                                </p>
                            </div>
                            <div class="text-[11px] text-gray-500 pt-1">
                                <span>Teacher: Prof. Mashood</span>
                            </div>
                        </div>
                    </div> --}}

                </div>

                {{-- <div class="space-y-6">

                    <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5">
                        <h3 class="text-sm font-bold text-white mb-4">My Homework Tasks</h3>

                        <div class="space-y-3">
                            <label
                                class="flex items-start gap-3 p-3 bg-slate-900/50 rounded-xl border border-slate-800 cursor-pointer group">
                                <input type="checkbox"
                                    class="mt-0.5 rounded border-slate-700 bg-slate-800 text-blue-600 focus:ring-0">
                                <div>
                                    <span
                                        class="text-xs font-semibold text-gray-300 block group-hover:text-white transition">Complete
                                        Computer Lab Grid Assignment</span>
                                    <span class="text-[10px] text-gray-500">Due: Tomorrow</span>
                                </div>
                            </label>

                            <label
                                class="flex items-start gap-3 p-3 bg-slate-900/50 rounded-xl border border-slate-800 cursor-pointer group">
                                <input type="checkbox"
                                    class="mt-0.5 rounded border-slate-700 bg-slate-800 text-blue-600 focus:ring-0">
                                <div>
                                    <span
                                        class="text-xs font-semibold text-gray-300 block group-hover:text-white transition">Maths
                                        Exercise 3.2 (Questions 1-5)</span>
                                    <span class="text-[10px] text-gray-500">Due: Monday</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5">
                        <h3 class="text-sm font-bold text-white mb-4">School Calendar</h3>
                        <div class="space-y-3">
                            <div
                                class="flex items-center gap-3 p-2 bg-slate-900/30 rounded-xl border border-slate-800/40">
                                <div
                                    class="w-9 h-9 rounded-lg bg-blue-500/10 border border-blue-500/20 flex flex-col items-center justify-center shrink-0">
                                    <span class="text-[8px] font-bold text-blue-400 uppercase">Jun</span>
                                    <span class="text-xs font-bold text-white">10</span>
                                </div>
                                <span class="text-xs font-medium text-gray-300">Upcoming Parent-Teacher Meeting</span>
                            </div>
                        </div>
                    </div>

                </div> --}}
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
