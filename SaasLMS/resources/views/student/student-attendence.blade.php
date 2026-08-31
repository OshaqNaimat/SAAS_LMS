<x-layout>
    <div class="flex h-screen bg-gray-50 overflow-hidden relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <x-student-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Attendance Analytics</h1>
                    <p class="text-sm text-gray-500">Real-time tracking metrics and course compliance log</p>
                </div>
                <div class="shrink-0">
                    <span
                        class="text-xs bg-gray-100 border border-gray-200 text-gray-600 px-4 py-2 rounded-xl block font-mono shadow-sm">
                        Academic Term: Spring 2026
                    </span>
                </div>
            </div>

            <!-- ─── KPI CARDS ─── -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div
                    class="bg-white border border-gray-200 rounded-2xl p-5 flex items-center justify-between shadow-sm">
                    <div>
                        <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Average Attendance</p>
                        <h3
                            class="text-2xl font-extrabold {{ $avgAttendance >= 75 ? 'text-emerald-600' : 'text-red-600' }} mt-1">
                            {{ $avgAttendance }}%</h3>
                        <p class="text-[10px] text-gray-500 mt-1">Status:
                            {{ $avgAttendance >= 75 ? 'Safe' : 'At Risk' }} (Req: 75%)</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-xl flex items-center justify-center">
                        <i class="bi bi-pie-chart-fill text-lg"></i>
                    </div>
                </div>

                <div
                    class="bg-white border border-gray-200 rounded-2xl p-5 flex items-center justify-between shadow-sm">
                    <div>
                        <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Total Present</p>
                        <h3 class="text-2xl font-extrabold text-gray-900 mt-1">{{ $totalPresent }} <span
                                class="text-xs text-gray-500 font-normal">days</span></h3>
                        <p class="text-[10px] text-gray-500 mt-1">System marked logs</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-blue-50 border border-blue-200 text-blue-600 rounded-xl flex items-center justify-center">
                        <i class="bi bi-check-circle-fill text-lg"></i>
                    </div>
                </div>

                <div
                    class="bg-white border border-gray-200 rounded-2xl p-5 flex items-center justify-between shadow-sm">
                    <div>
                        <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Total Absent</p>
                        <h3 class="text-2xl font-extrabold text-red-600 mt-1">{{ $totalAbsent }} <span
                                class="text-xs text-gray-500 font-normal">days</span></h3>
                        <p class="text-[10px] text-red-500/70 mt-1">Unexcused leaves included</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-red-50 border border-red-200 text-red-600 rounded-xl flex items-center justify-center">
                        <i class="bi bi-x-circle-fill text-lg"></i>
                    </div>
                </div>

                <div
                    class="bg-white border border-gray-200 rounded-2xl p-5 flex items-center justify-between shadow-sm">
                    <div>
                        <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Total Delivered</p>
                        <h3 class="text-2xl font-extrabold text-gray-900 mt-1">{{ $totalDelivered }} <span
                                class="text-xs text-gray-500 font-normal">days</span></h3>
                        <p class="text-[10px] text-gray-500 mt-1">Last 30 days</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-gray-100 border border-gray-200 text-gray-500 rounded-xl flex items-center justify-center">
                        <i class="bi bi-calendar3 text-lg"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- ─── LEFT COLUMN: SUBJECTS ─── -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="p-4 bg-gray-100 border border-gray-200 rounded-xl flex items-center justify-between">
                        <span class="text-xs font-bold text-gray-500">Enrolled Subjects (This Term)</span>
                    </div>

                    @forelse($subjects as $subject)
                        <div
                            class="bg-white border border-gray-200 rounded-2xl p-5 space-y-4 hover:border-gray-300 transition shadow-sm">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-sm font-bold text-gray-800">{{ $subject->subject }}</h4>
                                    <p class="text-[11px] text-gray-500 mt-0.5">Instructor:
                                        {{ $subject->teacher->name ?? 'TBA' }}</p>
                                </div>
                                <span
                                    class="text-xs font-bold px-2.5 py-1 rounded-lg {{ $avgAttendance >= 75 ? 'bg-emerald-50 border-emerald-200 text-emerald-700' : 'bg-red-50 border-red-200 text-red-700' }} border">
                                    {{ $avgAttendance }}% Overall
                                </span>
                            </div>
                            <div class="space-y-1.5">
                                <div class="w-full bg-gray-200 h-2 rounded-full overflow-hidden flex">
                                    <div class="{{ $avgAttendance >= 75 ? 'bg-emerald-500' : 'bg-red-500' }} h-full"
                                        style="width: {{ $avgAttendance }}%"></div>
                                </div>
                                <p class="text-[10px] text-gray-500">Based on your overall attendance record

                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white border border-gray-200 rounded-2xl p-8 text-center shadow-sm">
                            <p class="text-sm text-gray-400">No subjects scheduled for your class yet.</p>
                        </div>
                    @endforelse
                </div>

                <!-- ─── RIGHT COLUMN ─── -->
                <div class="space-y-6">
                    <!-- Recent System Logs -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                        <h3 class="text-sm font-bold text-gray-800 mb-4">Recent System Logs</h3>
                        <div class="relative pl-4 border-l border-gray-200 space-y-5">
                            @forelse($recentLogs as $log)
                                <div class="relative">
                                    <span
                                        class="absolute -left-[21px] top-1 w-2.5 h-2.5 rounded-full {{ $log->status === 'present' ? 'bg-emerald-500' : 'bg-red-500' }} ring-4 ring-white"></span>
                                    <div class="text-[11px]">
                                        <span
                                            class="text-gray-500 block font-mono">{{ \Carbon\Carbon::parse($log->date)->isToday() ? 'Today' : \Carbon\Carbon::parse($log->date)->format('d M') }}</span>
                                        <span
                                            class="{{ $log->status === 'present' ? 'text-emerald-600' : 'text-red-600' }} font-medium">Marked
                                            {{ ucfirst(str_replace('_', ' ', $log->status)) }}</span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-xs text-gray-500">No attendance logs yet.</p>
                            @endforelse
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
