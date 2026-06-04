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

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-400 font-medium">Assigned Courses</span>
                        <h4 class="text-2xl font-bold text-white tracking-tight">4 Batches</h4>
                        <span class="text-[11px] text-emerald-400 flex items-center gap-1"><i class="bi bi-book"></i>
                            MERN + Digital Logic</span>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 text-xl">
                        <i class="bi bi-journal-bookmark-fill"></i>
                    </div>
                </div>
                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-400 font-medium">Today's Lectures</span>
                        <h4 class="text-2xl font-bold text-white tracking-tight">2 Sessions</h4>
                        <span class="text-[11px] text-amber-400 flex items-center gap-1"><i class="bi bi-clock"></i>
                            Next at 11:30 AM</span>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 text-xl">
                        <i class="bi bi-calendar2-week"></i>
                    </div>
                </div>
                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-400 font-medium">Avg Class Attendance</span>
                        <h4 class="text-2xl font-bold text-white tracking-tight">91.4%</h4>
                        <span class="text-[11px] text-emerald-400 flex items-center gap-1"><i
                                class="bi bi-graph-up"></i> +2.3% this month</span>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400 text-xl">
                        <i class="bi bi-person-check"></i>
                    </div>
                </div>
                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-400 font-medium">Pending Appraisals</span>
                        <h4 class="text-2xl font-bold text-amber-400 tracking-tight">18 Labs</h4>
                        <span class="text-[11px] text-gray-400">Mid-term submissions</span>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 text-xl">
                        <i class="bi bi-file-earmark-ruled"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

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
                    <table class="w-full text-left border-collapse whitespace-nowrap min-w-[850px]">
                        <thead>
                            <tr
                                class="text-xs font-semibold text-gray-400 uppercase tracking-wider bg-slate-900/40 border-b border-slate-800">
                                <th class="p-4">Student Context Identity</th>
                                <th class="p-4">Assigned Active Course</th>
                                <th class="p-4">Attendance Log</th>
                                <th class="p-4">Lab Appraisals Progress</th>
                                <th class="p-4">Current Grade Estimate</th>
                                <th class="p-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-300 divide-y divide-slate-800/60">
                            <tr class="hover:bg-slate-900/40 transition">
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-blue-500/10 text-blue-400 flex items-center justify-center font-bold text-xs">
                                            AS</div>
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-white">Amara Sterling</span>
                                            <span class="text-xs font-mono text-gray-400">ID: #AGI-2026-089</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-xs font-medium text-gray-400">Advanced Web Architecture</td>
                                <td class="p-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-16 bg-slate-800 h-1.5 rounded-full overflow-hidden">
                                            <div class="bg-emerald-500 h-full w-[96%]"></div>
                                        </div>
                                        <span class="text-xs font-bold text-emerald-400">96%</span>
                                    </div>
                                </td>
                                <td class="p-4 text-xs font-semibold text-white">5 / 5 Uploaded</td>
                                <td class="p-4">
                                    <span
                                        class="px-2 py-0.5 rounded text-xs font-bold bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">A+
                                        Stable</span>
                                </td>
                                <td class="p-4 text-right">
                                    <button
                                        class="px-2.5 py-1 bg-slate-900 border border-slate-800 rounded-lg hover:border-emerald-500/40 text-xs text-gray-400 hover:text-white transition">Manage</button>
                                </td>
                            </tr>

                            <tr class="hover:bg-slate-900/40 transition">
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-emerald-500/10 text-emerald-400 flex items-center justify-center font-bold text-xs">
                                            EB</div>
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-white">Ethan Brooks</span>
                                            <span class="text-xs font-mono text-gray-400">ID: #AGI-2026-104</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-xs font-medium text-gray-400">Digital Logic Circuits</td>
                                <td class="p-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-16 bg-slate-800 h-1.5 rounded-full overflow-hidden">
                                            <div class="bg-amber-500 h-full w-[82%]"></div>
                                        </div>
                                        <span class="text-xs font-bold text-amber-400">82%</span>
                                    </div>
                                </td>
                                <td class="p-4 text-xs font-semibold text-white">4 / 5 Uploaded</td>
                                <td class="p-4">
                                    <span
                                        class="px-2 py-0.5 rounded text-xs font-bold bg-blue-500/10 border border-blue-500/20 text-blue-400">B
                                        Grade</span>
                                </td>
                                <td class="p-4 text-right">
                                    <button
                                        class="px-2.5 py-1 bg-slate-900 border border-slate-800 rounded-lg hover:border-emerald-500/40 text-xs text-gray-400 hover:text-white transition">Manage</button>
                                </td>
                            </tr>

                            <tr class="hover:bg-slate-900/40 transition">
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-amber-500/10 text-amber-400 flex items-center justify-center font-bold text-xs">
                                            ZM</div>
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-white">Zayn Malik</span>
                                            <span class="text-xs font-mono text-gray-400">ID: #AGI-2026-211</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-xs font-medium text-gray-400">Advanced Web Architecture</td>
                                <td class="p-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-16 bg-slate-800 h-1.5 rounded-full overflow-hidden">
                                            <div class="bg-rose-500 h-full w-[64%]"></div>
                                        </div>
                                        <span class="text-xs font-bold text-rose-400">64%</span>
                                    </div>
                                </td>
                                <td class="p-4 text-xs font-semibold text-white">2 / 5 Uploaded</td>
                                <td class="p-4">
                                    <span
                                        class="px-2 py-0.5 rounded text-xs font-bold bg-rose-500/10 border border-rose-500/20 text-rose-400">Critical
                                        Alert</span>
                                </td>
                                <td class="p-4 text-right">
                                    <button
                                        class="px-2.5 py-1 bg-slate-900 border border-slate-800 rounded-lg hover:border-emerald-500/40 text-xs text-gray-400 hover:text-white transition">Manage</button>
                                </td>
                            </tr>
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
