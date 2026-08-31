<x-layout>
    <div class="flex h-screen bg-gray-50 overflow-hidden relative">

        {{-- <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div> --}}

        <x-teacher-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Faculty Workspace</h1>
                    <p class="text-sm text-gray-500 mt-1">Manage active courses, review curriculum progress metrics, and
                        process class registries.</p>
                </div>
                <div class="flex items-center gap-3 shrink-0">
                    <a href="{{ route('teacher.attendance') }}"
                        class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-xs font-semibold transition text-white shadow-lg shadow-emerald-600/10">
                        <i class="bi bi-calendar-plus"></i> Mark Attendance
                    </a>
                </div>
            </div>

            <!-- ─── KPI CARDS ─── -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
                <div
                    class="bg-white border border-gray-200 rounded-2xl p-5 flex items-center justify-between shadow-sm">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-500 font-medium">Assigned Classes</span>
                        <h4 class="text-2xl font-bold text-gray-900 tracking-tight">{{ $classes->count() }}</h4>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-emerald-100 border border-emerald-200 flex items-center justify-center text-emerald-600 text-xl">
                        <i class="bi bi-journal-bookmark-fill"></i>
                    </div>
                </div>
                <div
                    class="bg-white border border-gray-200 rounded-2xl p-5 flex items-center justify-between shadow-sm">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-500 font-medium">Avg Class Attendance</span>
                        <h4 class="text-2xl font-bold text-gray-900 tracking-tight">{{ $avgAttendance }}%</h4>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-blue-100 border border-blue-200 flex items-center justify-center text-blue-600 text-xl">
                        <i class="bi bi-person-check"></i>
                    </div>
                </div>
            </div>

            <!-- ─── YOUR CLASSES ─── -->
            <div class="bg-white border border-gray-200 rounded-2xl p-5 mb-8 shadow-sm">
                <h3 class="text-sm font-bold text-gray-800 mb-4">Your Classes</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    @forelse($classes as $class)
                        <div
                            class="p-3.5 bg-gray-50 border border-gray-200 rounded-xl hover:border-blue-300 transition">
                            <h4 class="text-xs font-bold text-gray-800">{{ $class->name }} - {{ $class->section }}</h4>
                            <p class="text-[11px] text-gray-500 mt-0.5">{{ $class->room ?? 'No room set' }}</p>
                        </div>
                    @empty
                        <p class="text-xs text-gray-400 col-span-3">No classes assigned yet. Contact admin.</p>
                    @endforelse
                </div>
            </div>

            <!-- ─── STUDENT REGISTRY TABLE ─── -->
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden w-full mb-8">
                <div
                    class="p-4 bg-gray-50 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="font-bold text-base text-gray-800">Active Student Registry</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Real-time performance metrics and tracking indexes</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="text" placeholder="Search Student name / Roll ID..."
                            class="bg-white border border-gray-300 rounded-xl px-3 py-1.5 text-xs text-gray-800 focus:outline-none focus:border-emerald-500 transition w-52 placeholder-gray-400">
                    </div>
                </div>

                <div class="w-full overflow-x-auto block">
                    <table class="w-full text-left border-collapse whitespace-nowrap min-w-[650px]">
                        <thead>
                            <tr
                                class="text-xs font-semibold text-gray-500 uppercase tracking-wider bg-gray-50/80 border-b border-gray-200">
                                <th class="p-4">Student</th>
                                <th class="p-4">Class</th>
                                <th class="p-4">Attendance Rate</th>
                                <th class="p-4">Today's Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-600 divide-y divide-gray-100">
                            @forelse($students as $student)
                                @php
                                    $rate = method_exists($student, 'attendanceRate')
                                        ? $student->attendanceRate()
                                        : null;
                                    $todayRecord = isset($todayRecords) ? $todayRecords->get($student->id) : null;
                                    $status = $todayRecord->status ?? 'Not Marked';

                                    $initials = collect(explode(' ', $student->name ?? 'Student'))
                                        ->map(fn($w) => strtoupper($w[0] ?? ''))
                                        ->take(2)
                                        ->implode('');
                                @endphp
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs">
                                                {{ $initials }}
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-gray-800">{{ $student->name }}</span>
                                                <span class="text-xs font-mono text-gray-500">Roll:
                                                    {{ $student->roll_number ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-xs font-medium text-gray-500">
                                        {{ $student->classRoom->name ?? 'Unassigned' }}
                                        @if (!empty($student->classRoom->section))
                                            - {{ $student->classRoom->section }}
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        @if ($rate !== null)
                                            <div class="flex items-center gap-2">
                                                <div class="w-16 bg-gray-200 h-1.5 rounded-full overflow-hidden">
                                                    <div class="{{ $rate >= 90 ? 'bg-emerald-500' : ($rate >= 75 ? 'bg-amber-500' : 'bg-red-500') }} h-full"
                                                        style="width: {{ $rate }}%"></div>
                                                </div>
                                                <span
                                                    class="text-xs font-bold {{ $rate >= 90 ? 'text-emerald-600' : ($rate >= 75 ? 'text-amber-600' : 'text-red-600') }}">
                                                    {{ $rate }}%
                                                </span>
                                            </div>
                                        @else
                                            <span class="text-xs text-gray-400">No data</span>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        @php
                                            $badgeClasses = match (strtolower($status)) {
                                                'present' => 'bg-emerald-100 border-emerald-200 text-emerald-700',
                                                'absent' => 'bg-red-100 border-red-200 text-red-700',
                                                'late' => 'bg-amber-100 border-amber-200 text-amber-700',
                                                default => 'bg-gray-100 border-gray-200 text-gray-600',
                                            };
                                        @endphp
                                        <span class="px-2 py-0.5 rounded text-xs font-bold border {{ $badgeClasses }}">
                                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-6 text-center text-gray-400 text-sm">
                                        No students found in your assigned classes.
                                    </td>
                                </tr>
                            @endforelse
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
