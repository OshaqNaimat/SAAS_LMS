<x-layout>
    <div class="flex h-screen bg-[#090d16] overflow-hidden relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <x-teacher-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-white">Assigned Classes</h1>
                    <p class="text-sm text-gray-400">Overview of your academic rooms, total student counts, and sections
                    </p>
                </div>
                <div class="flex items-center gap-3 shrink-0">
                    <span
                        class="text-xs bg-blue-500/10 border border-blue-500/20 text-blue-400 font-semibold px-4 py-2 rounded-xl">
                        Total Enrolled: 154 Students
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-4">
                    <h3 class="text-xs font-bold text-gray-400 tracking-wide uppercase mb-2">Active Academic Rooms</h3>

                    <div
                        class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:border-slate-700 transition">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-400 flex items-center justify-center text-xl shrink-0">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h4 class="text-base font-bold text-white">Class 10 - Section A</h4>
                                    <span
                                        class="text-[10px] px-2 py-0.5 rounded font-bold bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">Main
                                        Room</span>
                                </div>
                                <p class="text-xs text-gray-400 mt-0.5">Subject: Computer Science • Room No. 05</p>
                                <p class="text-[11px] text-gray-500 mt-1"><i class="bi bi-person-badge"></i> Class
                                    Strength: 41 Enrolled</p>
                            </div>
                        </div>
                        <div class="flex sm:flex-col items-center sm:items-end gap-2 shrink-0 w-full sm:w-auto">
                            <a href="/teacher-attendance?class=10-a"
                                class="w-full sm:w-auto text-center px-3 py-1.5 bg-slate-900 border border-slate-800 hover:border-emerald-500/40 text-xs font-semibold rounded-lg text-gray-300 hover:text-white transition">
                                View Attendance
                            </a>
                        </div>
                    </div>

                    <div
                        class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:border-slate-700 transition">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl shrink-0">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h4 class="text-base font-bold text-white">Class 9 - Section B</h4>
                                </div>
                                <p class="text-xs text-gray-400 mt-0.5">Subject: Mathematics • Room No. 12</p>
                                <p class="text-[11px] text-gray-500 mt-1"><i class="bi bi-person-badge"></i> Class
                                    Strength: 38 Enrolled</p>
                            </div>
                        </div>
                        <div class="flex sm:flex-col items-center sm:items-end gap-2 shrink-0 w-full sm:w-auto">
                            <a href="/teacher-attendance?class=9-b"
                                class="w-full sm:w-auto text-center px-3 py-1.5 bg-slate-900 border border-slate-800 hover:border-emerald-500/40 text-xs font-semibold rounded-lg text-gray-300 hover:text-white transition">
                                View Attendance
                            </a>
                        </div>
                    </div>

                    <div
                        class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:border-slate-700 transition">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-400 flex items-center justify-center text-xl shrink-0">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h4 class="text-base font-bold text-white">Class 11 - Section C</h4>
                                </div>
                                <p class="text-xs text-gray-400 mt-0.5">Subject: Chemistry • Room No. 09</p>
                                <p class="text-[11px] text-gray-500 mt-1"><i class="bi bi-person-badge"></i> Class
                                    Strength: 35 Enrolled</p>
                            </div>
                        </div>
                        <div class="flex sm:flex-col items-center sm:items-end gap-2 shrink-0 w-full sm:w-auto">
                            <a href="/teacher-attendance?class=11-c"
                                class="w-full sm:w-auto text-center px-3 py-1.5 bg-slate-900 border border-slate-800 hover:border-emerald-500/40 text-xs font-semibold rounded-lg text-gray-300 hover:text-white transition">
                                View Attendance
                            </a>
                        </div>
                    </div>

                    <div
                        class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:border-slate-700 transition">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-purple-500/10 border border-purple-500/20 text-purple-400 flex items-center justify-center text-xl shrink-0">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h4 class="text-base font-bold text-white">Class 12 - Pre-Engineering</h4>
                                </div>
                                <p class="text-xs text-gray-400 mt-0.5">Subject: Physics • Room No. 04</p>
                                <p class="text-[11px] text-gray-500 mt-1"><i class="bi bi-person-badge"></i> Class
                                    Strength: 40 Enrolled</p>
                            </div>
                        </div>
                        <div class="flex sm:flex-col items-center sm:items-end gap-2 shrink-0 w-full sm:w-auto">
                            <a href="/teacher-attendance?class=12-eng"
                                class="w-full sm:w-auto text-center px-3 py-1.5 bg-slate-900 border border-slate-800 hover:border-emerald-500/40 text-xs font-semibold rounded-lg text-gray-300 hover:text-white transition">
                                View Attendance
                            </a>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5">
                        <h3 class="text-sm font-bold text-white mb-1 flex items-center gap-2">
                            <i class="bi bi-megaphone-fill text-amber-400"></i> Post Class Notice
                        </h3>
                        <p class="text-xs text-gray-400 mb-4">Send a notice or homework alert straight to a specific
                            class dashboard.</p>

                        <form action="/post-class-notice" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-[11px] font-bold text-gray-400 uppercase mb-1.5">Target
                                    Class</label>
                                <select
                                    class="w-full bg-[#090d16] border border-slate-800 text-xs text-white rounded-xl p-2.5 focus:outline-none focus:border-emerald-500">
                                    <option value="10-a">Class 10-A (Computer Science)</option>
                                    <option value="9-b">Class 9-B (Mathematics)</option>
                                    <option value="11-c">Class 11-C (Chemistry)</option>
                                    <option value="12-eng">Class 12-Eng (Physics)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-gray-400 uppercase mb-1.5">Notice
                                    Message</label>
                                <textarea rows="4" placeholder="Write homework diary instructions or general classroom announcements..."
                                    class="w-full bg-[#090d16] border border-slate-800 text-xs text-white rounded-xl p-2.5 focus:outline-none focus:border-emerald-500 resize-none placeholder-gray-600"></textarea>
                            </div>

                            <button type="submit"
                                class="w-full py-2 bg-blue-600 hover:bg-blue-500 text-xs font-semibold text-white rounded-xl transition shadow-lg shadow-blue-600/10">
                                Broadcast Message
                            </button>
                        </form>
                    </div>

                    <div class="bg-slate-900/40 border border-dashed border-slate-800 rounded-2xl p-4">
                        <span class="text-xs font-bold text-white flex items-center gap-1.5"><i
                                class="bi bi-info-circle text-blue-400"></i> Tip for Teachers</span>
                        <p class="text-[11px] text-gray-400 mt-1 leading-relaxed">Need to make adjustments to your room
                            schedules or swap sections? Please contact the coordination desk.</p>
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
