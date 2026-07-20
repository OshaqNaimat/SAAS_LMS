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
                <form action="{{ route('admin.reports.generate') }}" method="POST"
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @csrf
                    <div class="space-y-1.5">
                        <label class="block text-[11px] font-semibold text-gray-400">Report Scope / Type</label>
                        <select name="type" required
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-blue-500/80 transition">
                            <option value="attendance">Attendance Compliance Audit</option>
                            <option value="roster">Roster Capacity & Enrollment</option>
                            <option value="lessons">Faculty Lesson Progress Tracking</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[11px] font-semibold text-gray-400">Target Academic Cohort</label>
                        <select name="class_id"
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-blue-500/80 transition">
                            <option value="">All Batches Combined</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }} - {{ $class->section }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[11px] font-semibold text-gray-400">Temporal Window</label>
                        <select name="window" required
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-blue-500/80 transition">
                            <option value="current_term">Current Term (This Month)</option>
                            <option value="previous_month">Previous Month</option>
                            <option value="full_year">Full Academic Year</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit"
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
                            <span class="text-xl font-black text-white">{{ $rosterPct }}%</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2 text-center pt-2 border-t border-slate-800/60">
                        <div>
                            <span class="text-[10px] uppercase text-gray-400 block font-bold">Seats Occupied</span>
                            <span class="text-sm font-semibold text-blue-400">{{ $totalEnrolled }} Active</span>
                        </div>
                        <div class="border-l border-slate-800">
                            <span class="text-[10px] uppercase text-gray-400 block font-bold">Available Buffers</span>
                            <span class="text-sm font-semibold text-gray-300">{{ max(0, $totalSeats - $totalEnrolled) }}
                                Vacant</span>
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
                            {{ $reports->count() }} Available For Export
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
                                @forelse($reports as $report)
                                    <tr class="hover:bg-slate-900/40">
                                        <td class="p-4 font-semibold text-white">
                                            <div class="flex items-center gap-2.5">
                                                <i
                                                    class="bi bi-file-earmark-spreadsheet-fill text-emerald-500 text-lg"></i>
                                                <div class="flex flex-col">
                                                    <span>{{ $report->filename }}</span>
                                                    <span class="text-xs font-normal text-gray-400">System generated
                                                        CSV export</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4 text-gray-400">{{ $report->department }}</td>
                                        <td class="p-4 font-mono text-xs text-gray-400">
                                            {{ $report->created_at->format('M d, Y H:i') }}</td>
                                        <td class="p-4 text-xs font-mono">{{ $report->humanSize() }}</td>
                                        <td class="p-4 text-right">
                                            <a href="{{ route('admin.reports.download', $report->id) }}"
                                                class="text-xs font-semibold bg-blue-600 hover:bg-blue-500 text-white px-3 py-1.5 rounded-xl transition shadow-sm inline-block">
                                                <i class="bi bi-download mr-1"></i> Download File
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-6 text-center text-gray-500 text-sm">No reports
                                            generated yet.</td>
                                    </tr>
                                @endforelse
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
