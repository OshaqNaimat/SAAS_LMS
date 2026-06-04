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
                        <h3 class="text-2xl font-extrabold text-emerald-400 mt-1">86.4%</h3>
                        <p class="text-[10px] text-gray-500 mt-1">Status: Safe (Req: 75%)</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl flex items-center justify-center">
                        <i class="bi bi-pie-chart-fill text-lg"></i>
                    </div>
                </div>

                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total Present</p>
                        <h3 class="text-2xl font-extrabold text-white mt-1">76 <span
                                class="text-xs text-gray-500 font-normal">lectures</span></h3>
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
                        <h3 class="text-2xl font-extrabold text-rose-400 mt-1">12 <span
                                class="text-xs text-gray-500 font-normal">lectures</span></h3>
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
                        <h3 class="text-2xl font-extrabold text-white mt-1">88 <span
                                class="text-xs text-gray-500 font-normal">lectures</span></h3>
                        <p class="text-[10px] text-gray-500 mt-1">Overall session counts</p>
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
                        <span class="text-xs font-bold text-gray-400">Subject Distribution Summary</span>
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                            <span class="text-[11px] text-gray-400 mr-3">Present</span>
                            <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                            <span class="text-[11px] text-gray-400">Absent</span>
                        </div>
                    </div>

                    <div
                        class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 space-y-4 hover:border-slate-700 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-bold text-white">Mathematics (Calculus)</h4>
                                <p class="text-[11px] text-gray-500 mt-0.5">Instructor: Prof. Mashood</p>
                            </div>
                            <span
                                class="text-xs font-bold px-2.5 py-1 rounded-lg bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">92.3%
                                Attendance</span>
                        </div>
                        <div class="space-y-1.5">
                            <div class="w-full bg-slate-900 h-2 rounded-full overflow-hidden flex">
                                <div class="bg-emerald-500 h-full" style="width: 92.3%"></div>
                            </div>
                            <div class="flex justify-between text-[10px] text-gray-500">
                                <span>Present Sessions: 24</span>
                                <span>Absent: 2 / Total: 26</span>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 space-y-4 hover:border-slate-700 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-bold text-white">Computer Science</h4>
                                <p class="text-[11px] text-gray-500 mt-0.5">Instructor: Prof. Mashood</p>
                            </div>
                            <span
                                class="text-xs font-bold px-2.5 py-1 rounded-lg bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">88.0%
                                Attendance</span>
                        </div>
                        <div class="space-y-1.5">
                            <div class="w-full bg-slate-900 h-2 rounded-full overflow-hidden flex">
                                <div class="bg-emerald-500 h-full" style="width: 88%"></div>
                            </div>
                            <div class="flex justify-between text-[10px] text-gray-500">
                                <span>Present Sessions: 22</span>
                                <span>Absent: 3 / Total: 25</span>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 space-y-4 hover:border-slate-700 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-bold text-white">Physics (Mechanics)</h4>
                                <p class="text-[11px] text-gray-500 mt-0.5">Instructor: Dr. Harrison</p>
                            </div>
                            <span
                                class="text-xs font-bold px-2.5 py-1 rounded-lg bg-amber-500/10 border border-amber-500/20 text-amber-400">75.0%
                                Attendance</span>
                        </div>
                        <div class="space-y-1.5">
                            <div class="w-full bg-slate-900 h-2 rounded-full overflow-hidden flex">
                                <div class="bg-amber-500 h-full" style="width: 75%"></div>
                            </div>
                            <div class="flex justify-between text-[10px] text-gray-500">
                                <span>Present Sessions: 15</span>
                                <span>Absent: 5 / Total: 20</span>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 space-y-4 hover:border-slate-700 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-bold text-white">Chemistry (Organic)</h4>
                                <p class="text-[11px] text-gray-500 mt-0.5">Instructor: Prof. Sarah</p>
                            </div>
                            <span
                                class="text-xs font-bold px-2.5 py-1 rounded-lg bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">88.2%
                                Attendance</span>
                        </div>
                        <div class="space-y-1.5">
                            <div class="w-full bg-slate-900 h-2 rounded-full overflow-hidden flex">
                                <div class="bg-emerald-500 h-full" style="width: 88.2%"></div>
                            </div>
                            <div class="flex justify-between text-[10px] text-gray-500">
                                <span>Present Sessions: 15</span>
                                <span>Absent: 2 / Total: 17</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5">
                        <h3 class="text-sm font-bold text-white mb-4">Recent System Logs</h3>

                        <div class="relative pl-4 border-l border-slate-800 space-y-5">

                            <div class="relative">
                                <span
                                    class="absolute -left-[21px] top-1 w-2.5 h-2.5 rounded-full bg-emerald-500 ring-4 ring-[#111c2a]"></span>
                                <div class="text-[11px]">
                                    <span class="text-gray-500 block font-mono">Today, 09:15 AM</span>
                                    <span class="font-bold text-white block mt-0.5">Computer Science</span>
                                    <span class="text-emerald-400 font-medium">Marked Present</span>
                                </div>
                            </div>

                            <div class="relative">
                                <span
                                    class="absolute -left-[21px] top-1 w-2.5 h-2.5 rounded-full bg-emerald-500 ring-4 ring-[#111c2a]"></span>
                                <div class="text-[11px]">
                                    <span class="text-gray-500 block font-mono">Today, 08:30 AM</span>
                                    <span class="font-bold text-white block mt-0.5">Mathematics</span>
                                    <span class="text-emerald-400 font-medium">Marked Present</span>
                                </div>
                            </div>

                            <div class="relative">
                                <span
                                    class="absolute -left-[21px] top-1 w-2.5 h-2.5 rounded-full bg-rose-500 ring-4 ring-[#111c2a]"></span>
                                <div class="text-[11px]">
                                    <span class="text-gray-500 block font-mono">Yesterday, 11:15 AM</span>
                                    <span class="font-bold text-white block mt-0.5">Physics (Mechanics)</span>
                                    <span class="text-rose-400 font-medium">Marked Absent</span>
                                </div>
                            </div>

                            <div class="relative">
                                <span
                                    class="absolute -left-[21px] top-1 w-2.5 h-2.5 rounded-full bg-emerald-500 ring-4 ring-[#111c2a]"></span>
                                <div class="text-[11px]">
                                    <span class="text-gray-500 block font-mono">Yesterday, 10:30 AM</span>
                                    <span class="font-bold text-white block mt-0.5">Chemistry (Organic)</span>
                                    <span class="text-emerald-400 font-medium">Marked Present</span>
                                </div>
                            </div>
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
