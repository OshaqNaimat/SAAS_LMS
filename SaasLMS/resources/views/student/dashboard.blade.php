<x-layout>
    <div class="flex h-screen bg-[#090d16] overflow-hidden relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <x-student-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                @php
                    // Fetch the currently authenticated student's details
$studentName = Auth::user()->name ?? 'Student';

// Split the name by spaces to extract initials
$words = explode(' ', $studentName);
$studentClass = Auth::user()->class ?? 'N/A';
$studentSection = Auth::user()->section ?? 'N/A';

                @endphp
                <div>
                    <h1 class="text-2xl font-bold text-white">Assalam-o-Alaikum, {{ $studentName }}</h1>
                    <p class="text-sm text-gray-400">
                        Class {{ ucfirst($studentClass) }} - Section {{ strtoupper($studentSection) }} •
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
                                <h2 class="text-3xl font-extrabold text-white mt-1">92.4%</h2>
                            </div>
                            <span
                                class="text-xs font-bold text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2 py-1 rounded-lg">Good
                                Standing</span>
                        </div>

                        <div class="mt-8">
                            <div class="w-full bg-slate-900 rounded-full h-3 overflow-hidden border border-slate-800">
                                <div class="bg-emerald-500 h-3 rounded-full" style="width: 92.4%"></div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="pt-4 border-t border-slate-800/60 flex items-center justify-between text-xs text-gray-400">
                        <span class="flex items-center gap-1.5"><span
                                class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> 38 Present</span>
                        <span class="flex items-center gap-1.5"><span
                                class="w-2.5 h-2.5 rounded-full bg-rose-500"></span> 2 Absent</span>
                        <span class="flex items-center gap-1.5"><span
                                class="w-2.5 h-2.5 rounded-full bg-amber-500"></span> 1 Leave</span>
                    </div>
                </div>

                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-6 flex flex-col justify-between h-56">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <span class="text-[11px] font-bold text-gray-500 uppercase tracking-wider block">Monthly
                                Test Performance</span>
                            <h2 class="text-3xl font-extrabold text-white mt-1">Grade A</h2>
                        </div>

                        <div
                            class="flex items-end justify-between gap-2.5 h-24 w-32 shrink-0 px-2 bg-slate-900/40 border border-slate-800/50 rounded-xl p-2">
                            <div class="w-4 bg-slate-900 rounded-t h-full flex items-end" title="Maths: 85%">
                                <div class="bg-blue-500 w-full rounded-t" style="height: 85%"></div>
                            </div>
                            <div class="w-4 bg-slate-900 rounded-t h-full flex items-end" title="Comp Sci: 95%">
                                <div class="bg-blue-500 w-full rounded-t" style="height: 95%"></div>
                            </div>
                            <div class="w-4 bg-slate-900 rounded-t h-full flex items-end" title="Physics: 75%">
                                <div class="bg-blue-500 w-full rounded-t" style="height: 75%"></div>
                            </div>
                            <div class="w-4 bg-slate-900 rounded-t h-full flex items-end" title="Chemistry: 88%">
                                <div class="bg-blue-500 w-full rounded-t" style="height: 88%"></div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="pt-4 border-t border-slate-800/60 flex items-center justify-between text-[11px] text-gray-400">
                        <span>Subject benchmarks verified</span>
                        <span class="text-blue-400 font-bold">86.5% Avg</span>
                    </div>
                </div>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-6">

                    <div class="space-y-3">
                        <h3 class="text-xs font-bold text-gray-400 tracking-wide uppercase">Today's Periods</h3>

                        <div
                            class="bg-[#111c2a] border border-slate-800 rounded-2xl p-4 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-xl bg-slate-900 border border-slate-800 flex flex-col items-center justify-center">
                                    <span class="text-[10px] text-gray-500 font-bold">1st</span>
                                    <span class="text-xs text-white font-bold">08:30</span>
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-white">Mathematics</h3>
                                    <p class="text-xs text-gray-500">Prof. Mashood • Room 12</p>
                                </div>
                            </div>
                            <span
                                class="text-[10px] font-bold text-gray-500 bg-slate-900 px-3 py-1 rounded-full border border-slate-800">Ended</span>
                        </div>

                        <div
                            class="bg-[#111c2a] border border-emerald-500/40 bg-emerald-500/[0.02] rounded-2xl p-4 flex items-center justify-between shadow-xl">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex flex-col items-center justify-center">
                                    <span class="text-[10px] text-emerald-400 font-bold uppercase">2nd</span>
                                    <span class="text-xs text-emerald-400 font-bold">09:15</span>
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-white">Computer Science</h3>
                                    <p class="text-xs text-emerald-400/70">Prof. Mashood • Computer Lab</p>
                                </div>
                            </div>
                            <span
                                class="text-[10px] font-bold text-emerald-400 bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/20 animate-pulse">On-going</span>
                        </div>
                    </div>

                    <div class="space-y-3 pt-2">
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
                    </div>

                </div>

                <div class="space-y-6">

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
