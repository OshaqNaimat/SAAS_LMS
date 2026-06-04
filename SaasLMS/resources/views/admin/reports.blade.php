<x-layout>
    <div class="flex h-screen relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <x-admin-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-white">System Reports & Exports</h1>
                    <p class="text-sm text-gray-400 mt-1">Compile comprehensive summaries, download academic logs, and
                        review metric cross-sections.</p>
                </div>
                <div class="flex items-center gap-3 shrink-0 sm:self-center">
                    <button onclick="window.print()"
                        class="flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-900 border border-slate-800 hover:border-slate-700 text-xs font-semibold transition text-gray-300">
                        <i class="bi bi-printer"></i> Print Screen
                    </button>
                </div>
            </div>

            <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 mb-8">
                <h3 class="text-xs font-bold uppercase tracking-wider text-blue-400 mb-4">Report Configuration Engine
                </h3>
                <form class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4" onsubmit="event.preventDefault();">
                    <div class="space-y-1.5">
                        <label class="block text-[11px] font-semibold text-gray-400">Report Scope / Type</label>
                        <div class="relative">
                            <select
                                class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-blue-500/80 transition appearance-none">
                                <option>Attendance Compliance Audit</option>
                                <option>Academic Grade Distributions</option>
                                <option>Faculty Lesson Progress Tracking</option>
                                <option>Roster Capacity & Enrollment</option>
                            </select>
                            <i
                                class="bi bi-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-[10px] pointer-events-none"></i>
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[11px] font-semibold text-gray-400">Target Academic Cohort</label>
                        <div class="relative">
                            <select
                                class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-blue-500/80 transition appearance-none">
                                <option>All Batches Combined</option>
                                <option>Grade 11 - Science</option>
                                <option>Grade 12 - Mathematics</option>
                            </select>
                            <i
                                class="bi bi-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-[10px] pointer-events-none"></i>
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[11px] font-semibold text-gray-400">Temporal Window</label>
                        <div class="relative">
                            <select
                                class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-blue-500/80 transition appearance-none">
                                <option>Current Term (2026 Baseline)</option>
                                <option>Previous Month</option>
                                <option>Full Academic Year</option>
                            </select>
                            <i
                                class="bi bi-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-[10px] pointer-events-none"></i>
                        </div>
                    </div>
                    <div class="flex items-end">
                        <button type="button"
                            class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold text-xs py-2 rounded-xl transition shadow-lg shadow-blue-600/10 h-[34px]">
                            Compile & Process Data
                        </button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div
                    class="lg:col-span-2 bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex flex-col justify-between">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-sm font-bold text-white">Institutional Grade Curves</h3>
                            <p class="text-xs text-gray-400">Aggregated grade frequencies across terms</p>
                        </div>
                        <span
                            class="text-[10px] uppercase font-bold text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2.5 py-1 rounded-md">Passing
                            Alpha Thresholds</span>
                    </div>

                    <div class="flex items-end justify-between h-44 pt-4 px-4 border-b border-slate-800/80 gap-6">
                        <div class="w-1/5 flex flex-col items-center gap-2 h-full justify-end group">
                            <div class="w-full max-w-[40px] bg-blue-600/30 group-hover:bg-blue-600 rounded-t-md transition-all"
                                style="height: 15%;"></div>
                            <span class="text-[11px] text-gray-400">F / D</span>
                        </div>
                        <div class="w-1/5 flex flex-col items-center gap-2 h-full justify-end group">
                            <div class="w-full max-w-[40px] bg-blue-600/30 group-hover:bg-blue-600 rounded-t-md transition-all"
                                style="height: 45%;"></div>
                            <span class="text-[11px] text-gray-400">C</span>
                        </div>
                        <div class="w-1/5 flex flex-col items-center gap-2 h-full justify-end group">
                            <div class="w-full max-w-[40px] bg-blue-500 group-hover:bg-blue-400 rounded-t-md transition-all"
                                style="height: 88%;"></div>
                            <span class="text-[11px] text-gray-300 font-bold">B / B+</span>
                        </div>
                        <div class="w-1/5 flex flex-col items-center gap-2 h-full justify-end group">
                            <div class="w-full max-w-[40px] bg-blue-600/30 group-hover:bg-blue-600 rounded-t-md transition-all"
                                style="height: 62%;"></div>
                            <span class="text-[11px] text-gray-400">A</span>
                        </div>
                        <div class="w-1/5 flex flex-col items-center gap-2 h-full justify-end group">
                            <div class="w-full max-w-[40px] bg-emerald-500/40 group-hover:bg-emerald-500 rounded-t-md transition-all"
                                style="height: 28%;"></div>
                            <span class="text-[11px] text-emerald-400 font-semibold">A+ Honors</span>
                        </div>
                    </div>
                </div>

                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex flex-col justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-white mb-1">Roster Allocation</h3>
                        <p class="text-xs text-gray-400">Total physical capacity vs active enrollments</p>
                    </div>
                    <div class="py-4 flex flex-col items-center justify-center relative">
                        <div
                            class="w-28 h-28 rounded-full border-[10px] border-slate-800 border-t-blue-500 border-r-blue-500 border-b-blue-500 flex items-center justify-center">
                            <span class="text-xl font-black text-white">82%</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2 text-center pt-2 border-t border-slate-800/60">
                        <div>
                            <span class="text-[10px] uppercase text-gray-400 block font-bold">Seats Occupied</span>
                            <span class="text-sm font-semibold text-blue-400">410 Active</span>
                        </div>
                        <div class="border-l border-slate-800">
                            <span class="text-[10px] uppercase text-gray-400 block font-bold">Available Buffers</span>
                            <span class="text-sm font-semibold text-gray-300">90 Vacant</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <div class="card-bg rounded-2xl shadow-lg overflow-hidden">
                    <div class="header-bg p-4 flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-950 flex items-center justify-center text-blue-400">
                                <i class="bi bi-journal-arrow-down"></i>
                            </div>
                            <h3 class="font-bold text-base text-white">Generated Report Manifest</h3>
                        </div>
                        <span
                            class="text-xs px-3 py-1 rounded-full bg-slate-900 border border-slate-700 font-semibold text-gray-400">
                            Available For Export
                        </span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse whitespace-nowrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold text-gray-400 uppercase tracking-wider bg-slate-900/60 border-b border-slate-800">
                                    <th class="p-4">Report Signature Name</th>
                                    <th class="p-4">Contextual Department</th>
                                    <th class="p-4">Generated Timestamp</th>
                                    <th class="p-4">File Size</th>
                                    <th class="p-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-300 divide-y divide-slate-800">
                                <tr class="hover:bg-slate-900/40">
                                    <td class="p-4 font-semibold text-white">
                                        <div class="flex items-center gap-2.5">
                                            <i class="bi bi-file-earmark-pdf-fill text-rose-500 text-lg"></i>
                                            <div class="flex flex-col">
                                                <span>Attendance_Compliance_Q2.pdf</span>
                                                <span class="text-xs font-normal text-gray-400">System generated
                                                    verification layout</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-gray-400">Administration Control</td>
                                    <td class="p-4 font-mono text-xs text-gray-400">Jun 04, 2026 08:35</td>
                                    <td class="p-4 text-xs font-mono">2.4 MB</td>
                                    <td class="p-4 text-right">
                                        <button
                                            class="text-xs font-semibold bg-blue-600 hover:bg-blue-500 text-white px-3 py-1.5 rounded-xl transition shadow-sm">
                                            <i class="bi bi-download mr-1"></i> Download File
                                        </button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-900/40">
                                    <td class="p-4 font-semibold text-white">
                                        <div class="flex items-center gap-2.5">
                                            <i class="bi bi-file-earmark-excel-fill text-emerald-500 text-lg"></i>
                                            <div class="flex flex-col">
                                                <span>Grade_Distribution_Matrix_Final.xlsx</span>
                                                <span class="text-xs font-normal text-gray-400">Full grade schema
                                                    spreadsheet dump</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-gray-400">Examination Cell</td>
                                    <td class="p-4 font-mono text-xs text-gray-400">Jun 02, 2026 14:10</td>
                                    <td class="p-4 text-xs font-mono">842 KB</td>
                                    <td class="p-4 text-right">
                                        <button
                                            class="text-xs font-semibold bg-blue-600 hover:bg-blue-500 text-white px-3 py-1.5 rounded-xl transition shadow-sm">
                                            <i class="bi bi-download mr-1"></i> Download File
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
