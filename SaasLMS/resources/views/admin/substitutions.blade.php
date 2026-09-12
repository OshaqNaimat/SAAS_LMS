<x-layout>
    <div class="flex h-screen relative">
        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>
        <x-admin-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8 bg-gray-50">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Substitution Statistics</h1>
                    <p class="text-sm text-gray-500 mt-1">Track how often each teacher covers for others, and how often
                        their own classes get covered.</p>
                </div>
                <button onclick="toggleSidebar()" class="hamburger-btn lg:hidden" aria-label="Open menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>

            <!-- ─── PER-TEACHER SUMMARY ─── -->
            <div class="bg-white rounded-2xl shadow-sm  border border-gray-200 mb-8">
                <div class="p-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="font-bold text-base text-gray-800">Teacher Summary</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold text-gray-500 uppercase tracking-wider bg-gray-50/80 border-b border-gray-200">
                                <th class="p-4">Teacher</th>
                                <th class="p-4">Times Covered for Others</th>
                                <th class="p-4">Times Own Class Covered</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-600 divide-y divide-gray-100">
                            @forelse($stats as $row)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-4">
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-gray-800">{{ $row['teacher']->name }}</span>
                                            <span class="text-xs text-gray-500">{{ $row['teacher']->email }}</span>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <span
                                            class="px-2.5 py-1 rounded-full text-xs font-semibold border bg-blue-100 border-blue-200 text-blue-700">
                                            {{ $row['times_covering'] }}
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <span
                                            class="px-2.5 py-1 rounded-full text-xs font-semibold border bg-amber-100 border-amber-200 text-amber-700">
                                            {{ $row['times_covered'] }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="p-6 text-center text-gray-400 text-sm">No teachers found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ─── FULL LOG ─── -->
            <div class="bg-white rounded-2xl shadow-sm  border border-gray-200">
                <div class="p-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="font-bold text-base text-gray-800">Substitution Log</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold text-gray-500 uppercase tracking-wider bg-gray-50/80 border-b border-gray-200">
                                <th class="p-4">Date</th>
                                <th class="p-4">Class</th>
                                <th class="p-4">Subject</th>
                                <th class="p-4">Original Teacher</th>
                                <th class="p-4">Substitute</th>
                                <th class="p-4">Reason</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-600 divide-y divide-gray-100">
                            @forelse($log as $entry)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-4 font-mono text-xs text-gray-600">
                                        {{ \Carbon\Carbon::parse($entry->date)->format('d M Y') }}</td>
                                    <td class="p-4">{{ $entry->schedule->classRoom->name ?? '—' }} -
                                        {{ $entry->schedule->classRoom->section ?? '' }}</td>
                                    <td class="p-4 text-gray-500">{{ $entry->schedule->subject ?? '—' }}</td>
                                    <td class="p-4 text-gray-500">{{ $entry->schedule->teacher->name ?? 'Unknown' }}
                                    </td>
                                    <td class="p-4 font-semibold text-blue-600">
                                        {{ $entry->substituteTeacher->name ?? 'Unknown' }}</td>
                                    <td class="p-4 text-xs text-gray-400">{{ $entry->reason ?? '—' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-6 text-center text-gray-400 text-sm">No substitutions
                                        recorded yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            if (sidebar.classList.contains('open')) {
                closeSidebar();
            } else {
                sidebar.classList.add('open');
                overlay.classList.add('show');
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
