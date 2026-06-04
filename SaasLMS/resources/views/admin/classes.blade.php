<x-layout>
    <div class="flex h-screen relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <x-admin-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-white">Academic Classes & Analytics</h1>
                    <p class="text-sm text-gray-400 mt-1">Monitor section allocations, performance matrices, and manage
                        active curriculums.</p>
                </div>
                <div class="flex items-center gap-3 shrink-0 sm:self-center">
                    <button onclick="toggleModal('classModal')"
                        class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-sm font-semibold transition text-white shadow-md shadow-blue-600/10">
                        <i class="bi bi-plus-lg"></i> Create New Class
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-400 font-medium">Total Classes</span>
                        <h4 class="text-2xl font-bold text-white tracking-tight">24</h4>
                        <span class="text-[11px] text-emerald-400 flex items-center gap-1"><i
                                class="bi bi-arrow-up-short"></i> +2 this term</span>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400 text-xl">
                        <i class="bi bi-door-open"></i>
                    </div>
                </div>
                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-400 font-medium">Avg Attendance</span>
                        <h4 class="text-2xl font-bold text-white tracking-tight">94.2%</h4>
                        <span class="text-[11px] text-emerald-400 flex items-center gap-1"><i
                                class="bi bi-arrow-up-short"></i> +0.8% MoM</span>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 text-xl">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                </div>
                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-400 font-medium">Avg Grade Ratio</span>
                        <h4 class="text-2xl font-bold text-white tracking-tight">B+ (84%)</h4>
                        <span class="text-[11px] text-amber-400 flex items-center gap-1"><i class="bi bi-dash"></i>
                            Stable baseline</span>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 text-xl">
                        <i class="bi bi-journal-bookmark-fill"></i>
                    </div>
                </div>
                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-400 font-medium">Overcrowded Classes</span>
                        <h4 class="text-2xl font-bold text-white tracking-tight">1</h4>
                        <span class="text-[11px] text-rose-400 flex items-center gap-1"><i
                                class="bi bi-exclamation-triangle"></i> Sec Alpha limits</span>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-rose-500/10 border border-rose-500/20 flex items-center justify-center text-rose-400 text-xl">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div
                    class="lg:col-span-2 bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex flex-col justify-between">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-sm font-bold text-white">Term Performance Matrix</h3>
                            <p class="text-xs text-gray-400">Average test scores across grade batches</p>
                        </div>
                        <span
                            class="text-xs font-semibold text-blue-400 bg-blue-500/10 border border-blue-500/20 px-2.5 py-1 rounded-md">2026
                            Batch</span>
                    </div>
                    <div class="flex items-end justify-between h-48 pt-4 px-2 border-b border-slate-800">
                        <div class="w-1/6 flex flex-col items-center gap-2 group h-full justify-end">
                            <div class="w-full max-w-[32px] bg-blue-600/30 group-hover:bg-blue-600 rounded-t-lg transition-all"
                                style="height: 72%;"></div>
                            <span class="text-[11px] text-gray-400">C-8</span>
                        </div>
                        <div class="w-1/6 flex flex-col items-center gap-2 group h-full justify-end">
                            <div class="w-full max-w-[32px] bg-blue-600/30 group-hover:bg-blue-600 rounded-t-lg transition-all"
                                style="height: 84%;"></div>
                            <span class="text-[11px] text-gray-400">C-9</span>
                        </div>
                        <div class="w-1/6 flex flex-col items-center gap-2 group h-full justify-end">
                            <div class="w-full max-w-[32px] bg-blue-500 group-hover:bg-blue-400 rounded-t-lg transition-all"
                                style="height: 92%;"></div>
                            <span class="text-[11px] text-gray-300 font-semibold">C-10</span>
                        </div>
                        <div class="w-1/6 flex flex-col items-center gap-2 group h-full justify-end">
                            <div class="w-full max-w-[32px] bg-blue-600/30 group-hover:bg-blue-600 rounded-t-lg transition-all"
                                style="height: 78%;"></div>
                            <span class="text-[11px] text-gray-400">C-11</span>
                        </div>
                        <div class="w-1/6 flex flex-col items-center gap-2 group h-full justify-end">
                            <div class="w-full max-w-[32px] bg-blue-600/30 group-hover:bg-blue-600 rounded-t-lg transition-all"
                                style="height: 65%;"></div>
                            <span class="text-[11px] text-gray-400">C-12</span>
                        </div>
                    </div>
                </div>

                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex flex-col justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-white mb-1">Syllabus Progress</h3>
                        <p class="text-xs text-gray-400">Curriculum standard coverage rate</p>
                    </div>
                    <div class="py-4 flex flex-col items-center justify-center relative">
                        <div
                            class="w-28 h-28 rounded-full border-[10px] border-slate-800 border-t-blue-500 border-r-blue-500 flex items-center justify-center">
                            <span class="text-xl font-black text-white">75%</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2 text-center pt-2 border-t border-slate-800/60">
                        <div>
                            <span class="text-[10px] uppercase text-gray-400 block font-bold">Completed</span>
                            <span class="text-sm font-semibold text-blue-400">18 Classes</span>
                        </div>
                        <div class="border-l border-slate-800">
                            <span class="text-[10px] uppercase text-gray-400 block font-bold">In Progress</span>
                            <span class="text-sm font-semibold text-gray-300">6 Classes</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <div class="card-bg rounded-2xl shadow-lg overflow-hidden">
                    <div class="header-bg p-4 flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-950 flex items-center justify-center text-blue-400">
                                <i class="bi bi-collection"></i>
                            </div>
                            <h3 class="font-bold text-base text-white">Active Class Configurations</h3>
                        </div>
                        <span
                            class="text-xs px-3 py-1 rounded-full bg-slate-900 border border-slate-700 font-semibold text-gray-400">
                            24
                        </span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse whitespace-nowrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold text-gray-400 uppercase tracking-wider bg-slate-900/60 border-b border-slate-800">
                                    <th class="p-4">Class Identification</th>
                                    <th class="p-4">Assigned Mentor</th>
                                    <th class="p-4">Active Roster</th>
                                    <th class="p-4">Syllabus Track</th>
                                    <th class="p-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-300 divide-y divide-slate-800">
                                <tr class="hover:bg-slate-900/40">
                                    <td class="p-4 font-semibold text-white">
                                        <div class="flex flex-col">
                                            <span>Grade 11 - Alpha</span>
                                            <span class="text-xs font-normal text-gray-400">Room 304 • Science
                                                Stream</span>
                                        </div>
                                    </td>
                                    <td class="p-4 text-gray-300">Dr. Sarah Jenkins</td>
                                    <td class="p-4 font-mono text-xs text-blue-400 font-medium">32 Students / Max 35
                                    </td>
                                    <td class="p-4">
                                        <div class="w-32 bg-slate-800 h-2 rounded-full overflow-hidden">
                                            <div class="bg-blue-500 h-full w-[85%]"></div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-right">
                                        <button class="text-gray-500 hover:text-white transition px-2"><i
                                                class="bi bi-pencil-square"></i></button>
                                        <button class="text-gray-500 hover:text-rose-400 transition px-2"><i
                                                class="bi bi-trash3"></i></button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-900/40">
                                    <td class="p-4 font-semibold text-white">
                                        <div class="flex flex-col">
                                            <span>Grade 12 - Omega</span>
                                            <span class="text-xs font-normal text-gray-400">Room 102 • Advanced
                                                Mathematics</span>
                                        </div>
                                    </td>
                                    <td class="p-4 text-gray-300">Prof. Marcus Vance</td>
                                    <td class="p-4 font-mono text-xs text-blue-400 font-medium">28 Students / Max 30
                                    </td>
                                    <td class="p-4">
                                        <div class="w-32 bg-slate-800 h-2 rounded-full overflow-hidden">
                                            <div class="bg-blue-500 h-full w-[60%]"></div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-right">
                                        <button class="text-gray-500 hover:text-white transition px-2"><i
                                                class="bi bi-pencil-square"></i></button>
                                        <button class="text-gray-500 hover:text-rose-400 transition px-2"><i
                                                class="bi bi-trash3"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="classModal"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-[#090d16] bg-opacity-80 backdrop-blur-sm p-4 hidden opacity-0 transition-opacity duration-200 ease-out"
        role="dialog" aria-modal="true">
        <div
            class="w-full max-w-[550px] bg-[#111c2a] rounded-2xl shadow-2xl border border-slate-800 overflow-hidden transform opacity-0 scale-95 translate-y-4 transition-all duration-200 ease-out">
            <div class="p-5 flex justify-between items-center border-b border-slate-800/60 bg-[#142032]">
                <h3 class="text-base font-bold flex items-center gap-2.5 text-white">
                    <i class="bi bi-door-open text-blue-500 text-lg"></i> Create New Class Configuration
                </h3>
                <button onclick="toggleModal('classModal')" class="text-gray-400 hover:text-white transition"
                    aria-label="Close">
                    <i class="bi bi-x-lg text-sm"></i>
                </button>
            </div>
            <form class="p-6 space-y-5" onsubmit="event.preventDefault(); toggleModal('classModal');">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-400">Class Name / Grade</label>
                        <input type="text" placeholder="e.g. Grade 11"
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/80 transition"
                            required>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-400">Section Designation</label>
                        <input type="text" placeholder="e.g. Alpha"
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/80 transition"
                            required>
                    </div>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-gray-400">Assigned Lead Faculty Mentor</label>
                    <div class="relative">
                        <select
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500/80 transition appearance-none"
                            required>
                            <option disabled selected>Assign educator...</option>
                            <option>Dr. Sarah Jenkins</option>
                            <option>Prof. Marcus Vance</option>
                        </select>
                        <i
                            class="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-400">Room Location</label>
                        <input type="text" placeholder="e.g. Room 304"
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/80 transition">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-400">Max Roster Seats</label>
                        <input type="number" placeholder="30"
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/80 transition"
                            required>
                    </div>
                </div>
                <div class="pt-3 flex justify-end gap-3 border-t border-slate-800/40">
                    <button type="button" onclick="toggleModal('classModal')"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold border border-slate-800 bg-[#172232] text-gray-300 hover:bg-slate-800 hover:text-white transition">Cancel</button>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold bg-blue-600 hover:bg-blue-500 text-white transition shadow-lg shadow-blue-600/10">
                        Create Configuration
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            const container = modal.querySelector('.transform');

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    modal.classList.add('opacity-100');
                    if (container) {
                        container.classList.remove('opacity-0', 'scale-95', 'translate-y-4');
                        container.classList.add('opacity-100', 'scale-100', 'translate-y-0');
                    }
                }, 20);
            } else {
                modal.classList.remove('opacity-100');
                modal.classList.add('opacity-0');
                if (container) {
                    container.classList.remove('opacity-100', 'scale-100', 'translate-y-0');
                    container.classList.add('opacity-0', 'scale-95', 'translate-y-4');
                }
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 200);
            }
        }

        // Global backdrop layout onblur clicking dismissal listener
        window.addEventListener('click', function(event) {
            if (event.target.id === 'classModal') {
                toggleModal(event.target.id);
            }
        });

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
