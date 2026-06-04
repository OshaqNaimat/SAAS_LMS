<x-layout>
    <div class="flex h-screen bg-[#090d16] overflow-hidden relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <x-student-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-white">Class Timetable Matrix</h1>
                    <p class="text-sm text-gray-400">Complete master view of your weekly room schedules and lecture
                        timings</p>
                </div>
                <div class="shrink-0 flex gap-2">
                    <span
                        class="text-xs bg-[#111c2a] border border-slate-800 text-gray-300 px-4 py-2 rounded-xl font-medium">
                        Class: 10-A
                    </span>
                    <span
                        class="text-xs bg-blue-500/10 border border-blue-500/20 text-blue-400 px-4 py-2 rounded-xl font-medium">
                        Term: Spring 2026
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                <div class="lg:col-span-3 space-y-4">
                    <div class="bg-[#111c2a] border border-slate-800 rounded-2xl overflow-hidden shadow-2xl">
                        <div class="p-5 border-b border-slate-800/60 bg-slate-900/40 flex justify-between items-center">
                            <h3 class="text-xs font-bold text-gray-300 tracking-wide uppercase">Weekly Lecture Schedule
                            </h3>
                            <span
                                class="text-[10px] text-emerald-400 font-bold bg-emerald-500/10 px-2 py-0.5 rounded border border-emerald-500/20 animate-pulse">Live
                                Tracking Enabled</span>
                        </div>

                        <div class="w-full">
                            <table class="w-full text-left table-fixed border-collapse">
                                <thead>
                                    <tr
                                        class="border-b border-slate-800 text-[10px] font-bold text-gray-400 uppercase tracking-wider bg-slate-900/20">
                                        <th class="py-3 pl-3 w-[10%]">Day</th>
                                        <th class="py-3 px-1 text-center w-[10%]">1st <span
                                                class="block text-[8px] text-gray-500 font-normal mt-0.5">08:30-09:15</span>
                                        </th>
                                        <th class="py-3 px-1 text-center w-[10%]">2nd <span
                                                class="block text-[8px] text-gray-500 font-normal mt-0.5">09:15-10:00</span>
                                        </th>
                                        <th class="py-3 px-0.5 text-center bg-slate-900/40 text-amber-500/70 w-[4%]">
                                            Recess</th>
                                        <th class="py-3 px-1 text-center w-[10%]">3rd <span
                                                class="block text-[8px] text-gray-500 font-normal mt-0.5">10:30-11:15</span>
                                        </th>
                                        <th class="py-3 px-1 text-center w-[10%]">4th <span
                                                class="block text-[8px] text-gray-500 font-normal mt-0.5">11:15-12:00</span>
                                        </th>
                                        <th class="py-3 px-1 text-center w-[10%]">5th <span
                                                class="block text-[8px] text-gray-500 font-normal mt-0.5">12:00-12:45</span>
                                        </th>
                                        <th class="py-3 px-1 text-center w-[10%]">6th <span
                                                class="block text-[8px] text-gray-500 font-normal mt-0.5">12:45-01:30</span>
                                        </th>
                                        <th class="py-3 px-1 text-center w-[10%]">7th <span
                                                class="block text-[8px] text-gray-500 font-normal mt-0.5">01:30-02:15</span>
                                        </th>
                                        <th class="py-3 px-1 text-center w-[10%]">8th <span
                                                class="block text-[8px] text-gray-500 font-normal mt-0.5">02:15-03:00</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-800 text-[11px] font-medium text-gray-300">

                                    <tr class="hover:bg-slate-900/20 transition">
                                        <td class="py-3 pl-3 font-bold text-white bg-slate-900/10">Monday</td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate" title="Mathematics">Maths</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 12</span>
                                        </td>
                                        <td
                                            class="py-3 px-1 text-center bg-emerald-500/[0.03] border-x border-emerald-500/10">
                                            <span class="block font-bold text-emerald-400 truncate"
                                                title="Computer Science">Comp Sci</span>
                                            <span class="block text-[9px] text-emerald-500/70 mt-0.5">Lab 01</span>
                                        </td>
                                        <td
                                            class="py-3 px-0.5 text-center bg-slate-900/40 text-[9px] font-bold text-gray-600 tracking-widest uppercase writing-mode-vertical">
                                            Break</td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">Physics</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 04</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">Chemistry</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Sci Lab</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">English</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 05</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">History</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 02</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">Islamiat</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 01</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-blue-400 truncate">Library</span>
                                            <span class="block text-[9px] text-blue-500/60 mt-0.5">Main</span>
                                        </td>
                                    </tr>

                                    <tr class="hover:bg-slate-900/20 transition">
                                        <td class="py-3 pl-3 font-bold text-white bg-slate-900/10">Tuesday</td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">English</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 05</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">Maths</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 12</span>
                                        </td>
                                        <td
                                            class="py-3 px-0.5 text-center bg-slate-900/40 text-[9px] font-bold text-gray-600 tracking-widest uppercase">
                                            Break</td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">Comp Sci</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 05</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">History</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 02</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">Physics</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 04</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">Chemistry</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 09</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">Maths</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 12</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">Biology</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Bio Lab</span>
                                        </td>
                                    </tr>

                                    <tr class="hover:bg-slate-900/20 transition">
                                        <td class="py-3 pl-3 font-bold text-white bg-slate-900/10">Wednesday</td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">Physics</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 04</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">Chemistry</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 09</span>
                                        </td>
                                        <td
                                            class="py-3 px-0.5 text-center bg-slate-900/40 text-[9px] font-bold text-gray-600 tracking-widest uppercase">
                                            Break</td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">Maths</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 12</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-blue-400 truncate">Library</span>
                                            <span class="block text-[9px] text-blue-500/60 mt-0.5">Main</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">English</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 05</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">Comp Sci</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 05</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">History</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 02</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">Urdu</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 07</span>
                                        </td>
                                    </tr>

                                    <tr class="hover:bg-slate-900/20 transition">
                                        <td class="py-3 pl-3 font-bold text-white bg-slate-900/10">Thursday</td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">Comp Sci</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 05</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">English</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 05</span>
                                        </td>
                                        <td
                                            class="py-3 px-0.5 text-center bg-slate-900/40 text-[9px] font-bold text-gray-600 tracking-widest uppercase">
                                            Break</td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">Phys Lab</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Sci Wing</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">Maths</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 12</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">Urdu</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 07</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">Biology</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 03</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">Islamiat</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 01</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">Drawing</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Art Rm</span>
                                        </td>
                                    </tr>

                                    <tr class="hover:bg-slate-900/20 transition">
                                        <td class="py-3 pl-3 font-bold text-white bg-slate-900/10">Friday</td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">Chemistry</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 09</span>
                                        </td>
                                        <td class="py-3 px-1 text-center">
                                            <span class="block text-gray-200 truncate">Islamiat</span>
                                            <span class="block text-[9px] text-gray-500 mt-0.5">Rm 01</span>
                                        </td>
                                        <td
                                            class="py-3 px-0.5 text-center bg-slate-900/40 text-[9px] font-bold text-gray-600 tracking-widest uppercase">
                                            Break</td>
                                        <td colspan="5"
                                            class="py-3 px-1 text-center font-bold text-rose-400/80 bg-rose-500/[0.01]">
                                            No Class Scheduled (Weekend Start)
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">

                    <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5">
                        <h4 class="text-sm font-bold text-white mb-4">Weekly Balance</h4>
                        <div class="space-y-3.5">
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-400">Total Core Lectures:</span>
                                <span class="font-bold text-white">16 lecturess</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-400">Lab Practice Rooms:</span>
                                <span class="font-bold text-emerald-400">2 Sessions</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-400">Library Allocations:</span>
                                <span class="font-bold text-blue-400">1 Slot</span>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-gradient-to-br from-blue-600/5 to-slate-900/10 border border-slate-800 rounded-2xl p-5">
                        <span class="text-xs font-bold text-white flex items-center gap-2 mb-2">
                            <i class="bi bi-info-circle text-blue-400"></i> Timetable Controls
                        </span>
                        <p class="text-[11px] text-gray-400 leading-relaxed">
                            Need a custom offline printout copy for your textbook clipboards? Click your browser's print
                            options map (`Ctrl + P`) to generate a clean PDF layout automatically.
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
