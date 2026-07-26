<x-layout>
    <div class="flex h-screen bg-[#090d16] overflow-hidden relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <x-student-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-white">Attendance Analytics</h1>
                    <p class="text-sm text-gray-400">Real-time tracking metrics and course compliance log</p>
                </div>
                <div class="shrink-0">
                    <span
                        class="text-xs bg-slate-900 border border-slate-800 text-gray-400 px-4 py-2 rounded-xl block font-mono">
                        Academic Term: Spring 2026
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Average Attendance</p>
                        <h3
                            class="text-2xl font-extrabold {{ $avgAttendance >= 75 ? 'text-emerald-400' : 'text-rose-400' }} mt-1">
                            {{ $avgAttendance }}%</h3>
                        <p class="text-[10px] text-gray-500 mt-1">Status:
                            {{ $avgAttendance >= 75 ? 'Safe' : 'At Risk' }} (Req: 75%)</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl flex items-center justify-center">
                        <i class="bi bi-pie-chart-fill text-lg"></i>
                    </div>
                </div>

                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total Present</p>
                        <h3 class="text-2xl font-extrabold text-white mt-1">{{ $totalPresent }} <span
                                class="text-xs text-gray-500 font-normal">days</span></h3>
                        <p class="text-[10px] text-gray-500 mt-1">System marked logs</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-blue-500/10 border border-blue-500/20 text-blue-400 rounded-xl flex items-center justify-center">
                        <i class="bi bi-check-circle-fill text-lg"></i>
                    </div>
                </div>

                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total Absent</p>
                        <h3 class="text-2xl font-extrabold text-rose-400 mt-1">{{ $totalAbsent }} <span
                                class="text-xs text-gray-500 font-normal">days</span></h3>
                        <p class="text-[10px] text-rose-500/60 mt-1">Unexcused leaves included</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-rose-500/10 border border-rose-500/20 text-rose-400 rounded-xl flex items-center justify-center">
                        <i class="bi bi-x-circle-fill text-lg"></i>
                    </div>
                </div>

                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total Delivered</p>
                        <h3 class="text-2xl font-extrabold text-white mt-1">{{ $totalDelivered }} <span
                                class="text-xs text-gray-500 font-normal">days</span></h3>
                        <p class="text-[10px] text-gray-500 mt-1">Last 30 days</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-slate-900 border border-slate-800 text-gray-400 rounded-xl flex items-center justify-center">
                        <i class="bi bi-calendar3 text-lg"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-4">
                    <div
                        class="p-4 bg-slate-900/40 border border-slate-800/60 rounded-xl flex items-center justify-between">
                        <span class="text-xs font-bold text-gray-400">Enrolled Subjects (This Term)</span>
                    </div>

                    @forelse($subjects as $subject)
                        <div
                            class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 space-y-4 hover:border-slate-700 transition">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-sm font-bold text-white">{{ $subject->subject }}</h4>
                                    <p class="text-[11px] text-gray-500 mt-0.5">Instructor:
                                        {{ $subject->teacher->name ?? 'TBA' }}</p>
                                </div>
                                <span
                                    class="text-xs font-bold px-2.5 py-1 rounded-lg {{ $avgAttendance >= 75 ? 'bg-emerald-500/10 border-emerald-500/20 text-emerald-400' : 'bg-rose-500/10 border-rose-500/20 text-rose-400' }} border">
                                    {{ $avgAttendance }}% Overall
                                </span>
                            </div>
                            <div class="space-y-1.5">
                                <div class="w-full bg-slate-900 h-2 rounded-full overflow-hidden flex">
                                    <div class="{{ $avgAttendance >= 75 ? 'bg-emerald-500' : 'bg-rose-500' }} h-full"
                                        style="width: {{ $avgAttendance }}%"></div>
                                </div>
                                <p class="text-[10px] text-gray-500">Based on your overall attendance record
                                    (per-subject tracking not yet available)
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-8 text-center">
                            <p class="text-sm text-gray-500">No subjects scheduled for your class yet.</p>
                        </div>
                    @endforelse
                </div>

                <div class="space-y-6">
                    <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5">
                        <h3 class="text-sm font-bold text-white mb-4">Recent System Logs</h3>
                        <div class="relative pl-4 border-l border-slate-800 space-y-5">
                            @forelse($recentLogs as $log)
                                <div class="relative">
                                    <span
                                        class="absolute -left-[21px] top-1 w-2.5 h-2.5 rounded-full {{ $log->status === 'present' ? 'bg-emerald-500' : 'bg-rose-500' }} ring-4 ring-[#111c2a]"></span>
                                    <div class="text-[11px]">
                                        <span
                                            class="text-gray-500 block font-mono">{{ \Carbon\Carbon::parse($log->date)->isToday() ? 'Today' : \Carbon\Carbon::parse($log->date)->format('d M') }}</span>
                                        <span
                                            class="{{ $log->status === 'present' ? 'text-emerald-400' : 'text-rose-400' }} font-medium">Marked
                                            {{ ucfirst(str_replace('_', ' ', $log->status)) }}</span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-xs text-gray-500">No attendance logs yet.</p>
                            @endforelse
                        </div>
                    </div>

                    <div
                        class="bg-gradient-to-br from-blue-600/5 to-slate-900/10 border border-slate-800 rounded-2xl p-5">
                        <span class="text-xs font-bold text-white flex items-center gap-2 mb-2">
                            <i class="bi bi-shield-lock-fill text-blue-400"></i> Automation Notice
                        </span>
                        <p class="text-[11px] text-gray-400 leading-relaxed">
                            Attendance percentages are compiled instantly by system proxies upon instructor submittal.
                            If you spot a proxy logging mismatch mistake, please file an application sheet to the admin
                            registrar workspace within 3 days.
                        </p>
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
