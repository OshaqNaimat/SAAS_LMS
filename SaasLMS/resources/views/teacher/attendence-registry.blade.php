<x-layout>
    <div class="flex h-screen bg-[#090d16] overflow-hidden relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <x-teacher-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-white">Attendance Registry</h1>
                    <p class="text-sm text-gray-400">Mark and manage daily classroom attendance</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <select
                        class="bg-[#111c2a] border border-slate-800 text-xs text-white rounded-xl px-3 py-2 focus:outline-none focus:border-emerald-500">
                        <option value="10-a">Class 10-A</option>
                        <option value="9-b">Class 9-B</option>
                        <option value="11-c">Class 11-C</option>
                        <option value="12-eng">Class 12-Eng</option>
                    </select>
                    <div
                        class="bg-[#111c2a] border border-slate-800 rounded-xl px-4 py-1.5 flex flex-col justify-center">
                        <span class="text-[9px] text-gray-500 uppercase font-bold">Date</span>
                        <span class="text-xs font-bold text-white">04 June 2026</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-4">
                    <div
                        class="flex items-center justify-between p-2 bg-slate-900/40 rounded-xl border border-slate-800/60 mb-2">
                        <span class="text-xs font-bold text-gray-400 pl-2">Student Name & Roll ID</span>
                        <span class="text-xs font-bold text-gray-400 pr-24 hidden sm:block">Status Actions</span>
                    </div>

                    <form action="/save-attendance" method="POST" class="space-y-3">
                        @csrf

                        <div
                            class="bg-[#111c2a] border border-slate-800 rounded-2xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:border-slate-700 transition">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center font-bold text-xs text-gray-400">
                                    01</div>
                                <div>
                                    <h3 class="text-sm font-bold text-white">Amara Sterling</h3>
                                    <p class="text-[11px] font-mono text-gray-500">Roll No: #10A-01</p>
                                </div>
                            </div>

                            <input type="hidden" name="attendance[1]" id="status-1" value="present">

                            <div class="flex items-center gap-2">
                                <button type="button" onclick="setStatus(1, 'present', this)"
                                    class="btn-p-1 px-3 py-1.5 rounded-lg text-xs font-bold transition bg-emerald-500 text-white shadow-md shadow-emerald-500/20 border border-emerald-400/20">Present</button>
                                <button type="button" onclick="setStatus(1, 'absent', this)"
                                    class="btn-a-1 px-3 py-1.5 rounded-lg text-xs font-semibold transition bg-slate-900 text-gray-400 hover:text-white border border-slate-800">Absent</button>
                                <button type="button" onclick="setStatus(1, 'leave', this)"
                                    class="btn-l-1 px-3 py-1.5 rounded-lg text-xs font-semibold transition bg-slate-900 text-gray-400 hover:text-white border border-slate-800">Leave</button>
                            </div>
                        </div>

                        <div
                            class="bg-[#111c2a] border border-slate-800 rounded-2xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:border-slate-700 transition">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center font-bold text-xs text-gray-400">
                                    02</div>
                                <div>
                                    <h3 class="text-sm font-bold text-white">Ethan Brooks</h3>
                                    <p class="text-[11px] font-mono text-gray-500">Roll No: #10A-02</p>
                                </div>
                            </div>

                            <input type="hidden" name="attendance[2]" id="status-2" value="absent">

                            <div class="flex items-center gap-2">
                                <button type="button" onclick="setStatus(2, 'present', this)"
                                    class="btn-p-2 px-3 py-1.5 rounded-lg text-xs font-semibold transition bg-slate-900 text-gray-400 hover:text-white border border-slate-800">Present</button>
                                <button type="button" onclick="setStatus(2, 'absent', this)"
                                    class="btn-a-2 px-3 py-1.5 rounded-lg text-xs font-bold transition bg-rose-500 text-white shadow-md shadow-rose-500/20 border border-rose-400/20">Absent</button>
                                <button type="button" onclick="setStatus(2, 'leave', this)"
                                    class="btn-l-2 px-3 py-1.5 rounded-lg text-xs font-semibold transition bg-slate-900 text-gray-400 hover:text-white border border-slate-800">Leave</button>
                            </div>
                        </div>

                        <div
                            class="bg-[#111c2a] border border-slate-800 rounded-2xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:border-slate-700 transition">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center font-bold text-xs text-gray-400">
                                    03</div>
                                <div>
                                    <h3 class="text-sm font-bold text-white">Zayn Malik</h3>
                                    <p class="text-[11px] font-mono text-gray-500">Roll No: #10A-03</p>
                                </div>
                            </div>

                            <input type="hidden" name="attendance[3]" id="status-3" value="leave">

                            <div class="flex items-center gap-2">
                                <button type="button" onclick="setStatus(3, 'present', this)"
                                    class="btn-p-3 px-3 py-1.5 rounded-lg text-xs font-semibold transition bg-slate-900 text-gray-400 hover:text-white border border-slate-800">Present</button>
                                <button type="button" onclick="setStatus(3, 'absent', this)"
                                    class="btn-a-3 px-3 py-1.5 rounded-lg text-xs font-semibold transition bg-slate-900 text-gray-400 hover:text-white border border-slate-800">Absent</button>
                                <button type="button" onclick="setStatus(3, 'leave', this)"
                                    class="btn-l-3 px-3 py-1.5 rounded-lg text-xs font-bold transition bg-amber-500 text-white shadow-md shadow-amber-500/20 border border-amber-400/20">Leave</button>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit"
                                class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-xs font-semibold transition text-white shadow-lg shadow-blue-600/10">
                                <i class="bi bi-check-circle-fill mr-1.5"></i> Save Today's Attendance
                            </button>
                        </div>
                    </form>
                </div>

                <div class="space-y-6">
                    <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5">
                        <h3 class="text-sm font-bold text-white mb-4">Class 10-A Breakdown</h3>
                        <div class="grid grid-cols-3 gap-2">
                            <div class="bg-emerald-500/5 border border-emerald-500/20 rounded-xl p-3 text-center">
                                <span class="text-[10px] text-emerald-400 font-bold block uppercase">Present</span>
                                <span class="text-lg font-bold text-white mt-1 block">38</span>
                            </div>
                            <div class="bg-rose-500/5 border border-rose-500/20 rounded-xl p-3 text-center">
                                <span class="text-[10px] text-rose-400 font-bold block uppercase">Absent</span>
                                <span class="text-lg font-bold text-white mt-1 block">02</span>
                            </div>
                            <div class="bg-amber-500/5 border border-amber-500/20 rounded-xl p-3 text-center">
                                <span class="text-[10px] text-amber-400 font-bold block uppercase">Leave</span>
                                <span class="text-lg font-bold text-white mt-1 block">01</span>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-slate-800/60 flex justify-between text-xs text-gray-400">
                            <span>Total Enrolled Strength:</span>
                            <span class="font-bold text-white">41 Students</span>
                        </div>
                    </div>

                    <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5">
                        <h3 class="text-sm font-bold text-white mb-3">Leave Slips / Notes</h3>
                        <p class="text-xs text-gray-400 mb-4">Approved submissions recorded for this section.</p>
                        <div class="p-3 bg-slate-900/50 border border-slate-800 rounded-xl space-y-1">
                            <div class="flex justify-between items-center text-[10px]">
                                <span class="font-bold text-amber-400">Zayn Malik (#10A-03)</span>
                                <span class="text-gray-500">Medical Slip</span>
                            </div>
                            <p class="text-xs text-gray-300">Down with a high seasonal fever. Requested 2 days off.</p>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script>
        function setStatus(studentId, selectedStatus, clickedElement) {
            // Update hidden input box value securely for Laravel processing
            document.getElementById(`status-${studentId}`).value = selectedStatus;

            // Target the specific button pack wrapper parent elements
            const container = clickedElement.parentElement;
            const buttons = container.querySelectorAll('button');

            // Reset all 3 sibling buttons back to default styling states
            buttons.forEach(btn => {
                btn.className =
                    "px-3 py-1.5 rounded-lg text-xs font-semibold transition bg-slate-900 text-gray-400 hover:text-white border border-slate-800";
            });

            // Apply selected bright highlighting states directly
            if (selectedStatus === 'present') {
                clickedElement.className =
                    "px-3 py-1.5 rounded-lg text-xs font-bold transition bg-emerald-500 text-white shadow-md shadow-emerald-500/20 border border-emerald-400/20";
            } else if (selectedStatus === 'absent') {
                clickedElement.className =
                    "px-3 py-1.5 rounded-lg text-xs font-bold transition bg-rose-500 text-white shadow-md shadow-rose-500/20 border border-rose-400/20";
            } else if (selectedStatus === 'leave') {
                clickedElement.className =
                    "px-3 py-1.5 rounded-lg text-xs font-bold transition bg-amber-500 text-white shadow-md shadow-amber-500/20 border border-amber-400/20";
            }
        }

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
