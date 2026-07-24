<x-layout>
    <div class="flex h-screen bg-[#090d16] overflow-hidden relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <x-teacher-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-white">Faculty Workspace</h1>
                    <p class="text-sm text-gray-400 mt-1">Manage active courses, review curriculum progress metrics, and
                        process class registries.</p>
                </div>
                <div class="flex items-center gap-3 shrink-0">
                    <button
                        class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-xs font-semibold transition text-white shadow-lg shadow-emerald-600/10">
                        <i class="bi bi-calendar-plus"></i> Mark Attendance
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-400 font-medium">Assigned Classes</span>
                        <h4 class="text-2xl font-bold text-white tracking-tight">{{ $classes->count() }}</h4>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 text-xl">
                        <i class="bi bi-journal-bookmark-fill"></i>
                    </div>
                </div>
                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-400 font-medium">Avg Class Attendance</span>
                        <h4 class="text-2xl font-bold text-white tracking-tight">{{ $avgAttendance }}%</h4>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400 text-xl">
                        <i class="bi bi-person-check"></i>
                    </div>
                </div>
            </div>

            {{-- <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

                <div class="lg:col-span-2 bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex flex-col">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h3 class="text-sm font-bold text-white">Today's Lecture Agenda</h3>
                            <p class="text-xs text-gray-400">Chronological list of allocated classroom blocks</p>
                        </div>
                        <span
                            class="text-[10px] uppercase font-bold text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2.5 py-1 rounded-md">Live
                            Track</span>
                    </div>

                    <div class="space-y-3 flex-1 overflow-y-auto max-h-[260px] pr-1">
                        <div
                            class="flex items-center justify-between p-3.5 bg-[#090d16] border border-slate-800 rounded-xl hover:border-emerald-500/30 transition">
                            <div class="flex items-start gap-3">
                                <div
                                    class="px-2.5 py-1 bg-emerald-500/10 border border-emerald-500/20 rounded-lg text-emerald-400 font-mono text-xs font-bold text-center">
                                    09:00<br><span class="text-[9px] font-normal text-gray-400">AM</span>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-white">Advanced Web Architecture (MERN)</h4>
                                    <p class="text-[11px] text-gray-400 mt-0.5">Section A • Room 402 (Lab Block)</p>
                                </div>
                            </div>
                            <span
                                class="px-2 py-0.5 rounded-md text-[10px] font-semibold bg-slate-800 border border-slate-700 text-gray-400">Concluded</span>
                        </div>

                        <div
                            class="flex items-center justify-between p-3.5 bg-[#090d16] border border-slate-800 rounded-xl hover:border-emerald-500/30 transition">
                            <div class="flex items-start gap-3">
                                <div
                                    class="px-2.5 py-1 bg-blue-500/10 border border-blue-500/20 rounded-lg text-blue-400 font-mono text-xs font-bold text-center">
                                    11:30<br><span class="text-[9px] font-normal text-gray-400">AM</span>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-white">Digital Logic Circuits & Electronics</h4>
                                    <p class="text-[11px] text-gray-400 mt-0.5">Section B • Room 108 (Lecture Hall)</p>
                                </div>
                            </div>
                            <span
                                class="px-2 py-0.5 rounded-md text-[10px] font-semibold bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 animate-pulse">Up
                                Next</span>
                        </div>

                        <div
                            class="flex items-center justify-between p-3.5 bg-[#090d16] border border-slate-800 rounded-xl hover:border-emerald-500/30 transition">
                            <div class="flex items-start gap-3">
                                <div
                                    class="px-2.5 py-1 bg-slate-800 border border-slate-700 rounded-lg text-gray-400 font-mono text-xs font-bold text-center">
                                    02:00<br><span class="text-[9px] font-normal text-gray-400">PM</span>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-white">Mobile Development via React Native</h4>
                                    <p class="text-[11px] text-gray-400 mt-0.5">Section A • Room 402 (Lab Block)</p>
                                </div>
                            </div>
                            <span
                                class="px-2 py-0.5 rounded-md text-[10px] font-semibold bg-slate-900 border border-slate-800 text-gray-500">Scheduled</span>
                        </div>
                    </div>
                </div>

                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex flex-col justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-white mb-1">Department Circulars</h3>
                        <p class="text-xs text-gray-400">Internal updates pushed by Dean / Registrar offices</p>
                    </div>
                    <div class="space-y-3.5 my-3">
                        <div class="p-3 bg-[#090d16] border-l-2 border-amber-500 rounded-r-xl space-y-1">
                            <div class="flex justify-between items-center text-[10px]">
                                <span class="font-bold text-amber-400 uppercase tracking-wider">Exam Board</span>
                                <span class="text-gray-500">2h ago</span>
                            </div>
                            <p class="text-xs font-medium text-gray-300 line-clamp-2">Mid-term grading registries must
                                be locked by next Friday evening.</p>
                        </div>
                        <div class="p-3 bg-[#090d16] border-l-2 border-blue-500 rounded-r-xl space-y-1">
                            <div class="flex justify-between items-center text-[10px]">
                                <span class="font-bold text-blue-400 uppercase tracking-wider">IT Operations</span>
                                <span class="text-gray-500">Yesterday</span>
                            </div>
                            <p class="text-xs font-medium text-gray-300 line-clamp-2">Lab 402 circuit boards and logic
                                gate gates have been re-calibrated.</p>
                        </div>
                    </div>
                    <button
                        class="w-full text-center py-2 bg-slate-900 hover:bg-slate-900/60 border border-slate-800 text-[11px] text-gray-400 rounded-xl transition font-medium">
                        View All Circulars
                    </button>
                </div>
            </div>
             --}}
            <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 mb-8">
                <h3 class="text-sm font-bold text-white mb-4">Your Classes</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    @forelse($classes as $class)
                        <div class="p-3.5 bg-[#090d16] border border-slate-800 rounded-xl">
                            <h4 class="text-xs font-bold text-white">{{ $class->name }} - {{ $class->section }}</h4>
                            <p class="text-[11px] text-gray-400 mt-0.5">{{ $class->pivot->subject ?? 'General' }} •
                                {{ $class->room ?? 'No room set' }}</p>
                        </div>
                    @empty
                        <p class="text-xs text-gray-500 col-span-3">No classes assigned yet. Contact admin.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-[#111c2a] border border-slate-800 rounded-2xl shadow-lg overflow-hidden w-full mb-8">
                <div
                    class="p-4 bg-slate-900/60 border-b border-slate-800 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="font-bold text-base text-white">Active Student Registry</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Real-time performance metrics and tracking indexes</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="text" placeholder="Search Student name / Roll ID..."
                            class="bg-[#090d16] border border-slate-800 rounded-xl px-3 py-1.5 text-xs text-white focus:outline-none focus:border-emerald-500 transition w-52 placeholder-gray-600">
                    </div>
                </div>

                <div class="w-full overflow-x-auto block">
                    <table class="w-full text-left border-collapse whitespace-nowrap min-w-[650px]">
                        <thead>
                            <tr
                                class="text-xs font-semibold text-gray-400 uppercase tracking-wider bg-slate-900/40 border-b border-slate-800">
                                <th class="p-4">Student</th>
                                <th class="p-4">Class</th>
                                <th class="p-4">Attendance Rate</th>
                                <th class="p-4">Today's Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-300 divide-y divide-slate-800/60">
                            @forelse($students as $student)
                                @php
                                    $rate = $student->attendanceRate();
                                    $status = $todayRecords->get($student->id)->status ?? 'present';
                                    $initials = collect(explode(' ', $student->name))
                                        ->map(fn($w) => strtoupper($w[0]))
                                        ->take(2)
                                        ->implode('');
                                @endphp
                                <tr class="hover:bg-slate-900/40 transition">
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 rounded-full bg-blue-500/10 text-blue-400 flex items-center justify-center font-bold text-xs">
                                                {{ $initials }}</div>
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-white">{{ $student->name }}</span>
                                                <span class="text-xs font-mono text-gray-400">Roll:
                                                    {{ $student->roll_number }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-xs font-medium text-gray-400">{{ $student->class }} -
                                        {{ $student->section }}</td>
                                    <td class="p-4">
                                        @if ($rate !== null)
                                            <div class="flex items-center gap-2">
                                                <div class="w-16 bg-slate-800 h-1.5 rounded-full overflow-hidden">
                                                    <div class="{{ $rate >= 90 ? 'bg-emerald-500' : ($rate >= 75 ? 'bg-amber-500' : 'bg-rose-500') }} h-full"
                                                        style="width: {{ $rate }}%"></div>
                                                </div>
                                                <span
                                                    class="text-xs font-bold {{ $rate >= 90 ? 'text-emerald-400' : ($rate >= 75 ? 'text-amber-400' : 'text-rose-400') }}">{{ $rate }}%</span>
                                            </div>
                                        @else
                                            <span class="text-xs text-gray-500">No data</span>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        <span
                                            class="px-2 py-0.5 rounded text-xs font-bold {{ $status === 'present' ? 'bg-emerald-500/10 border border-emerald-500/20 text-emerald-400' : 'bg-rose-500/10 border border-rose-500/20 text-rose-400' }}">
                                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-6 text-center text-gray-500 text-sm">No students found
                                        in your classes.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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
