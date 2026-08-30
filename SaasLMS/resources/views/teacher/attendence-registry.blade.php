<x-layout>
    <div class="flex h-screen bg-gray-50 overflow-hidden relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <x-teacher-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Attendance Registry</h1>
                    <p class="text-sm text-gray-500">Mark and manage daily classroom attendance</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <select onchange="window.location.href='{{ route('teacher.attendance') }}?class_id=' + this.value"
                        class="bg-white border border-gray-300 text-xs text-gray-800 rounded-xl px-3 py-2 focus:outline-none focus:border-emerald-500 shadow-sm">
                        @forelse($classes as $class)
                            <option value="{{ $class->id }}" {{ $selectedClassId == $class->id ? 'selected' : '' }}>
                                {{ $class->name }} - {{ $class->section }}
                            </option>
                        @empty
                            <option value="">No classes assigned</option>
                        @endforelse
                    </select>
                    <div
                        class="bg-white border border-gray-200 rounded-xl px-4 py-1.5 flex flex-col justify-center shadow-sm">
                        <span class="text-[9px] text-gray-500 uppercase font-bold">Date</span>
                        <span class="text-xs font-bold text-gray-800">{{ now()->format('d F Y') }}</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-4">
                    <!-- ─── TABLE HEADER ─── -->
                    <div
                        class="flex items-center justify-between p-2 bg-gray-100 rounded-xl border border-gray-200 mb-2">
                        <span class="text-xs font-bold text-gray-500 pl-2">Student Name & Roll ID</span>
                        <span class="text-xs font-bold text-gray-500 pr-24 hidden sm:block">Status Actions</span>
                    </div>

                    <!-- ─── STUDENT LIST ─── -->
                    <form action="{{ route('teacher.attendance.save') }}" method="POST" class="space-y-3">
                        @csrf
                        <input type="hidden" name="class_id" value="{{ $selectedClassId }}">

                        @forelse($students as $student)
                            @php
                                $currentStatus = $todayRecords->get($student->id)->status ?? 'present';
                            @endphp
                            <div
                                class="bg-white border border-gray-200 rounded-2xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:border-gray-300 transition shadow-sm">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-9 h-9 rounded-xl bg-gray-100 border border-gray-200 flex items-center justify-center font-bold text-xs text-gray-500">
                                        {{ $loop->iteration }}
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-bold text-gray-800">{{ $student->name }}</h3>
                                        <p class="text-[11px] font-mono text-gray-500">Roll No:
                                            {{ $student->roll_number }}</p>
                                    </div>
                                </div>

                                <input type="hidden" name="attendance[{{ $student->id }}]"
                                    id="status-{{ $student->id }}" value="{{ $currentStatus }}">

                                <div class="flex items-center gap-2">
                                    <button type="button" onclick="setStatus({{ $student->id }}, 'present', this)"
                                        class="px-3 py-1.5 rounded-lg text-xs font-{{ $currentStatus === 'present' ? 'bold' : 'semibold' }} transition {{ $currentStatus === 'present' ? 'bg-emerald-500 text-white shadow-md shadow-emerald-500/20 border border-emerald-400/20' : 'bg-gray-100 text-gray-600 hover:text-gray-800 border border-gray-200' }}">Present</button>
                                    <button type="button" onclick="setStatus({{ $student->id }}, 'absent', this)"
                                        class="px-3 py-1.5 rounded-lg text-xs font-{{ $currentStatus === 'absent' ? 'bold' : 'semibold' }} transition {{ $currentStatus === 'absent' ? 'bg-red-500 text-white shadow-md shadow-red-500/20 border border-red-400/20' : 'bg-gray-100 text-gray-600 hover:text-gray-800 border border-gray-200' }}">Absent</button>
                                    <button type="button"
                                        onclick="setStatus({{ $student->id }}, 'approved_leave', this)"
                                        class="px-3 py-1.5 rounded-lg text-xs font-{{ $currentStatus === 'approved_leave' ? 'bold' : 'semibold' }} transition {{ $currentStatus === 'approved_leave' ? 'bg-amber-500 text-white shadow-md shadow-amber-500/20 border border-amber-400/20' : 'bg-gray-100 text-gray-600 hover:text-gray-800 border border-gray-200' }}">Leave</button>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-400 text-sm py-8">No students found in this class.</p>
                        @endforelse

                        @if ($students->count() > 0)
                            <div class="pt-4">
                                <button type="submit"
                                    class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-xs font-semibold transition text-white shadow-lg shadow-blue-600/10">
                                    <i class="bi bi-check-circle-fill mr-1.5"></i> Save Today's Attendance
                                </button>
                            </div>
                        @endif
                    </form>
                </div>

                <!-- ─── RIGHT SIDEBAR: BREAKDOWN ─── -->
                <div class="space-y-6">
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                        <h3 class="text-sm font-bold text-gray-800 mb-4">
                            {{ $selectedClass ? $selectedClass->name . '-' . $selectedClass->section : 'Class' }}
                            Breakdown
                        </h3>
                        <div class="grid grid-cols-3 gap-2">
                            <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-3 text-center">
                                <span class="text-[10px] text-emerald-600 font-bold block uppercase">Present</span>
                                <span class="text-lg font-bold text-gray-800 mt-1 block">{{ $presentCount }}</span>
                            </div>
                            <div class="bg-red-50 border border-red-200 rounded-xl p-3 text-center">
                                <span class="text-[10px] text-red-600 font-bold block uppercase">Absent</span>
                                <span class="text-lg font-bold text-gray-800 mt-1 block">{{ $absentCount }}</span>
                            </div>
                            <div class="bg-amber-50 border border-amber-200 rounded-xl p-3 text-center">
                                <span class="text-[10px] text-amber-600 font-bold block uppercase">Leave</span>
                                <span class="text-lg font-bold text-gray-800 mt-1 block">{{ $leaveCount }}</span>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200 flex justify-between text-xs text-gray-500">
                            <span>Total Enrolled Strength:</span>
                            <span class="font-bold text-gray-800">{{ $students->count() }} Students</span>
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
                    "px-3 py-1.5 rounded-lg text-xs font-semibold transition bg-gray-100 text-gray-600 hover:text-gray-800 border border-gray-200";
            });

            // Apply selected bright highlighting states directly
            if (selectedStatus === 'present') {
                clickedElement.className =
                    "px-3 py-1.5 rounded-lg text-xs font-bold transition bg-emerald-500 text-white shadow-md shadow-emerald-500/20 border border-emerald-400/20";
            } else if (selectedStatus === 'absent') {
                clickedElement.className =
                    "px-3 py-1.5 rounded-lg text-xs font-bold transition bg-red-500 text-white shadow-md shadow-red-500/20 border border-red-400/20";
            } else if (selectedStatus === 'approved_leave') {
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
