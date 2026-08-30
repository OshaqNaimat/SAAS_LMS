<x-layout>
    <div class="flex h-screen bg-gray-50 overflow-hidden relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <x-teacher-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Class Noticeboard</h1>
                    <p class="text-sm text-gray-500">View and broadcast informational updates to your assigned classrooms
                    </p>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <select
                        class="bg-white border border-gray-300 text-xs text-gray-800 rounded-xl px-3 py-2 focus:outline-none focus:border-emerald-500 shadow-sm">
                        <option value="all">All Classes</option>
                        <option value="10-a">Class 10-A</option>
                        <option value="9-b">Class 9-B</option>
                        <option value="11-c">Class 11-C</option>
                        <option value="12-eng">Class 12-Eng</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- ─── LEFT COLUMN: NOTICES ─── -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-xs font-bold text-gray-500 tracking-wide uppercase">Active Announcements</h3>
                        <span class="text-xs text-gray-400">Showing 3 Alerts</span>
                    </div>

                    <!-- Notice 1 -->
                    <div
                        class="bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 transition shadow-sm space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span
                                    class="text-xs font-bold text-gray-700 bg-blue-50 border border-blue-200 text-blue-600 px-2.5 py-1 rounded-lg">Class
                                    10-A</span>
                                <span
                                    class="text-[10px] font-bold uppercase tracking-wider text-amber-600 bg-amber-50 px-2 py-0.5 rounded border border-amber-200">Homework</span>
                            </div>
                            <span class="text-xs text-gray-500">Today, 02:15 PM</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-800">HTML Layout Structure Lab Practical</h4>
                            <p class="text-xs text-gray-600 mt-1 leading-relaxed">
                                Complete your responsive layout grids using CSS variables. All students must bring their
                                practical logs completed for code checking tomorrow morning.
                            </p>
                        </div>
                        <div
                            class="pt-2 border-t border-gray-200 flex items-center justify-between text-[11px] text-gray-500">
                            <span>Posted by: You</span>
                            <button class="text-red-500 hover:text-red-700 hover:underline transition">Delete
                                Notice</button>
                        </div>
                    </div>

                    <!-- Notice 2 -->
                    <div
                        class="bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 transition shadow-sm space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span
                                    class="text-xs font-bold text-gray-700 bg-blue-50 border border-blue-200 text-blue-600 px-2.5 py-1 rounded-lg">Class
                                    9-B</span>
                                <span
                                    class="text-[10px] font-bold uppercase tracking-wider text-red-600 bg-red-50 px-2 py-0.5 rounded border border-red-200">Exam
                                    Alert</span>
                            </div>
                            <span class="text-xs text-gray-500">Yesterday, 11:30 AM</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-800">Mathematics Monthly Revision Test</h4>
                            <p class="text-xs text-gray-600 mt-1 leading-relaxed">
                                A 20-minute surprise revision test covering Calculus Extrema & Functions graphical
                                methods will be held during the first period on Monday. Prepare accordingly!
                            </p>
                        </div>
                        <div
                            class="pt-2 border-t border-gray-200 flex items-center justify-between text-[11px] text-gray-500">
                            <span>Posted by: You</span>
                            <button class="text-red-500 hover:text-red-700 hover:underline transition">Delete
                                Notice</button>
                        </div>
                    </div>

                    <!-- Notice 3 -->
                    <div
                        class="bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 transition shadow-sm space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span
                                    class="text-xs font-bold text-gray-700 bg-blue-50 border border-blue-200 text-blue-600 px-2.5 py-1 rounded-lg">Class
                                    12-Eng</span>
                                <span
                                    class="text-[10px] font-bold uppercase tracking-wider text-purple-600 bg-purple-50 px-2 py-0.5 rounded border border-purple-200">General</span>
                            </div>
                            <span class="text-xs text-gray-500">01 June 2026</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-800">Logic Gate Simulation Software Setup</h4>
                            <p class="text-xs text-gray-600 mt-1 leading-relaxed">
                                Please download the standard logic gates simulator file on your personal systems before
                                coming to the lab on Thursday. The download link is available via the library portal.
                            </p>
                        </div>
                        <div
                            class="pt-2 border-t border-gray-200 flex items-center justify-between text-[11px] text-gray-500">
                            <span>Posted by: You</span>
                            <button class="text-red-500 hover:text-red-700 hover:underline transition">Delete
                                Notice</button>
                        </div>
                    </div>

                </div>

                <!-- ─── RIGHT COLUMN ─── -->
                <div class="space-y-6">

                    <!-- Admin Desk Notices -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                        <h3 class="text-sm font-bold text-gray-800 mb-1 flex items-center gap-2">
                            <i class="bi bi-building-fill-exclamation text-emerald-500"></i> Admin Desk Notices
                        </h3>
                        <p class="text-xs text-gray-500 mb-4">Official updates sent from the Principal or Vice Principal
                            room.</p>

                        <div class="space-y-3">
                            <div class="p-3 bg-gray-50 border border-gray-200 rounded-xl space-y-1">
                                <div class="flex justify-between items-center text-[10px]">
                                    <span class="font-bold text-emerald-600">Vice Principal</span>
                                    <span class="text-gray-500">Today</span>
                                </div>
                                <h5 class="text-xs font-bold text-gray-800">Diary Check Cycle</h5>
                                <p class="text-[11px] text-gray-600">All coordinators will visit rooms tomorrow to check
                                    student diaries and signature validation.</p>
                            </div>

                            <div class="p-3 bg-gray-50 border border-gray-200 rounded-xl space-y-1">
                                <div class="flex justify-between items-center text-[10px]">
                                    <span class="font-bold text-blue-600">Accounts Office</span>
                                    <span class="text-gray-500">29 May</span>
                                </div>
                                <h5 class="text-xs font-bold text-gray-800">Challan Submission Last Date</h5>
                                <p class="text-[11px] text-gray-600">Kindly remind student class reps to submit fee
                                    counter tokens before June 5th.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Auto Removal Tip -->
                    <div class="bg-gradient-to-br from-emerald-50 to-blue-50 border border-emerald-200 rounded-2xl p-5">
                        <span class="text-xs font-bold text-gray-700 block mb-1">📢 Automatic Removal</span>
                        <p class="text-[11px] text-gray-600 leading-relaxed">
                            To keep class portals clean, notices you post here automatically archive after 14 calendar
                            days.
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
