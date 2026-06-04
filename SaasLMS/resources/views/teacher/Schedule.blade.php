<x-layout>
    <div class="flex h-screen bg-[#090d16] overflow-hidden relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <x-teacher-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-white">Daily Timetable</h1>
                    <p class="text-sm text-gray-400">Tuesday, 04 June 2026</p>
                </div>
                <div class="flex gap-2">
                    <div class="bg-[#111c2a] border border-slate-800 rounded-xl px-4 py-2">
                        <span class="text-[10px] text-gray-500 uppercase block font-bold">Total Lectures</span>
                        <span class="text-sm font-bold text-white">05 Today</span>
                    </div>
                    <div class="bg-[#111c2a] border border-slate-800 rounded-xl px-4 py-2">
                        <span class="text-[10px] text-gray-500 uppercase block font-bold">Work Load</span>
                        <span class="text-sm font-bold text-emerald-400">04 Hours</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-4">

                    <div class="flex gap-2 mb-6 overflow-x-auto pb-2">
                        <button
                            class="px-4 py-2 text-xs font-semibold rounded-xl bg-emerald-600 text-white shrink-0">Mon</button>
                        <button
                            class="px-4 py-2 text-xs font-semibold rounded-xl bg-blue-600 text-white shrink-0 border border-blue-500/50 shadow-lg shadow-blue-600/20">Tue</button>
                        <button
                            class="px-4 py-2 text-xs font-semibold rounded-xl bg-[#111c2a] text-gray-400 border border-slate-800 shrink-0">Wed</button>
                        <button
                            class="px-4 py-2 text-xs font-semibold rounded-xl bg-[#111c2a] text-gray-400 border border-slate-800 shrink-0">Thu</button>
                        <button
                            class="px-4 py-2 text-xs font-semibold rounded-xl bg-[#111c2a] text-gray-400 border border-slate-800 shrink-0">Fri</button>
                    </div>

                    <div class="space-y-3">
                        <div
                            class="bg-[#111c2a] border border-slate-800 rounded-2xl p-4 flex items-center justify-between group hover:border-slate-700 transition">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-xl bg-slate-900 border border-slate-800 flex flex-col items-center justify-center">
                                    <span class="text-[10px] text-gray-500 font-bold">1st</span>
                                    <span class="text-xs text-white font-bold">08:30</span>
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-white">Mathematics</h3>
                                    <p class="text-xs text-gray-500">Class 9-B • Room 12</p>
                                </div>
                            </div>
                            <span
                                class="text-[10px] font-bold text-gray-500 bg-slate-900 px-3 py-1 rounded-full border border-slate-800">Done</span>
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
                                    <p class="text-xs text-emerald-400/70">Class 10-A • Computer Lab</p>
                                </div>
                            </div>
                            <span
                                class="text-[10px] font-bold text-emerald-400 bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/20 animate-pulse">On-going</span>
                        </div>

                        <div class="p-3 bg-slate-900/30 border border-dashed border-slate-800 rounded-2xl text-center">
                            <span class="text-xs text-gray-500 font-medium">☕ 20 Min Recess / Break</span>
                        </div>

                        <div
                            class="bg-[#111c2a] border border-slate-800 rounded-2xl p-4 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-xl bg-slate-900 border border-slate-800 flex flex-col items-center justify-center">
                                    <span class="text-[10px] text-gray-500 font-bold">3rd</span>
                                    <span class="text-xs text-white font-bold">10:20</span>
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-white">Physics</h3>
                                    <p class="text-xs text-gray-500">Class 12-Eng • Room 04</p>
                                </div>
                            </div>
                            <span
                                class="text-[10px] font-bold text-blue-400 bg-blue-500/10 px-3 py-1 rounded-full border border-blue-500/20">Up
                                Next</span>
                        </div>

                        <div
                            class="bg-[#111c2a] border border-slate-800 rounded-2xl p-4 flex items-center justify-between opacity-70">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-xl bg-slate-900 border border-slate-800 flex flex-col items-center justify-center">
                                    <span class="text-[10px] text-gray-500 font-bold">4th</span>
                                    <span class="text-xs text-white font-bold">11:05</span>
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-white">Chemistry</h3>
                                    <p class="text-xs text-gray-500">Class 11-C • Room 09</p>
                                </div>
                            </div>
                            <span
                                class="text-[10px] font-bold text-gray-500 bg-slate-900 px-3 py-1 rounded-full">Later</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">

                    <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-bold text-white">Daily Tasks</h3>
                            <button class="text-[10px] text-blue-400 font-bold hover:underline">Add New</button>
                        </div>
                        <div class="space-y-3">
                            <label
                                class="flex items-center gap-3 p-3 bg-slate-900/50 rounded-xl border border-slate-800 cursor-pointer group">
                                <input type="checkbox"
                                    class="rounded border-slate-700 bg-slate-800 text-blue-600 focus:ring-0">
                                <span class="text-xs text-gray-400 group-hover:text-white transition">Mark Attendance
                                    (10-A)</span>
                            </label>
                            <label
                                class="flex items-center gap-3 p-3 bg-slate-900/50 rounded-xl border border-slate-800 cursor-pointer group">
                                <input type="checkbox" checked
                                    class="rounded border-slate-700 bg-slate-800 text-blue-600 focus:ring-0">
                                <span class="text-xs text-gray-500 line-through">Submit Weekly Report</span>
                            </label>
                            <label
                                class="flex items-center gap-3 p-3 bg-slate-900/50 rounded-xl border border-slate-800 cursor-pointer group">
                                <input type="checkbox"
                                    class="rounded border-slate-700 bg-slate-800 text-blue-600 focus:ring-0">
                                <span class="text-xs text-gray-400 group-hover:text-white transition">Check Maths
                                    Homework</span>
                            </label>
                        </div>
                    </div>

                    <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5">
                        <h3 class="text-sm font-bold text-white mb-4">Upcoming Events</h3>
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-10 h-10 rounded-lg bg-amber-500/10 border border-amber-500/20 flex flex-col items-center justify-center shrink-0">
                                    <span class="text-[9px] font-bold text-amber-500 uppercase">Jun</span>
                                    <span class="text-xs font-bold text-white">10</span>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-white">Parent-Teacher Meeting</h4>
                                    <p class="text-[10px] text-gray-500 mt-0.5">8:00 AM — 12:00 PM</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-10 h-10 rounded-lg bg-blue-500/10 border border-blue-500/20 flex flex-col items-center justify-center shrink-0">
                                    <span class="text-[9px] font-bold text-blue-500 uppercase">Jun</span>
                                    <span class="text-xs font-bold text-white">15</span>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-white">Summer Vacation Starts</h4>
                                    <p class="text-[10px] text-gray-500 mt-0.5">Full Day Event</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div
                        class="bg-gradient-to-br from-blue-600/20 to-emerald-600/20 border border-blue-500/20 rounded-2xl p-5">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="bi bi-gift text-amber-400"></i>
                            <h3 class="text-sm font-bold text-white">Student Birthdays</h3>
                        </div>
                        <p class="text-xs text-gray-400 mb-0.5">Zayn Malik (Class 10-A)</p>
                        <p class="text-[10px] text-blue-400 font-semibold">Today! 🎂</p>
                    </div> --}}

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
