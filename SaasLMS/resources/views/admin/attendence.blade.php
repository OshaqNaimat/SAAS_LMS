<x-layout>
    <div class="flex h-screen relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <x-admin-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-white">Attendance Tracking & Analytics</h1>
                    <p class="text-sm text-gray-400 mt-1">Daily presence logging and rolling retention graphs
                        across roles.</p>
                </div>
                <div class="flex items-center gap-3 shrink-0 sm:self-center">
                    <div
                        class="bg-slate-900 border border-slate-800 rounded-xl px-4 py-2 flex items-center gap-2 text-xs font-semibold text-gray-300">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Live Session: {{ now()->format('M d, Y') }}
                    </div>
                    <button id="saveChangesBtn" onclick="saveAllChanges()"
                        class="hidden items-center gap-2 px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-sm font-semibold transition text-white shadow-md shadow-blue-600/10">
                        <i class="bi bi-save"></i> Save Changes
                        <span id="pendingCount" class="bg-white/20 rounded-full px-2 py-0.5 text-xs">0</span>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-400 font-medium">Student Attendance Rate</span>
                        <h4 class="text-2xl font-bold text-white tracking-tight">{{ $studentRate }}%</h4>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400 text-xl">
                        <i class="bi bi-person-check"></i>
                    </div>
                </div>
                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-400 font-medium">Faculty Attendance Rate</span>
                        <h4 class="text-2xl font-bold text-white tracking-tight">{{ $facultyRate }}%</h4>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 text-xl">
                        <i class="bi bi-shield-check"></i>
                    </div>
                </div>
                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-400 font-medium">Total Student Absentees</span>
                        <h4 class="text-2xl font-bold text-rose-400 tracking-tight">{{ $studentAbsentToday }}</h4>
                        <span class="text-[11px] text-gray-400">Out of {{ $students->count() }} Enrolled</span>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-rose-500/10 border border-rose-500/20 flex items-center justify-center text-rose-400 text-xl">
                        <i class="bi bi-person-x"></i>
                    </div>
                </div>
                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-400 font-medium">Faculty On Leave</span>
                        <h4 class="text-2xl font-bold text-amber-400 tracking-tight">{{ $facultyOnLeave }}</h4>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 text-xl">
                        <i class="bi bi-envelope-open"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div
                    class="lg:col-span-2 bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex flex-col justify-between">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-sm font-bold text-white">Weekly Attendance Velocity</h3>
                            <p class="text-xs text-gray-400">Comparing Student vs Faculty daily ratios</p>
                        </div>
                        <div class="flex items-center gap-4 text-xs">
                            <span class="flex items-center gap-1.5 text-blue-400"><span
                                    class="w-2.5 h-2.5 rounded bg-blue-500 block"></span> Students</span>
                            <span class="flex items-center gap-1.5 text-emerald-400"><span
                                    class="w-2.5 h-2.5 rounded bg-emerald-500 block"></span> Faculty</span>
                        </div>
                    </div>

                    <div class="flex items-end justify-between h-44 pt-4 px-2 border-b border-slate-800/80 gap-4">
                        @foreach ($trend as $i => $day)
                            <div class="w-1/5 flex flex-col items-center gap-2 h-full justify-end">
                                <div class="w-full flex justify-center items-end gap-1 h-full">
                                    <div class="w-3 bg-blue-500 rounded-t-sm transition-all"
                                        style="height: {{ $day['student_pct'] }}%"></div>
                                    <div class="w-3 bg-emerald-500 rounded-t-sm transition-all"
                                        style="height: {{ $day['faculty_pct'] }}%"></div>
                                </div>
                                <span
                                    class="text-[10px] {{ $i === 4 ? 'text-gray-300 font-bold' : 'text-gray-400 font-medium' }}">
                                    {{ $i === 4 ? 'Today' : $day['label'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex flex-col justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-white mb-1">Incident Categorization</h3>
                        <p class="text-xs text-gray-400">Distribution of exceptions logged today</p>
                    </div>
                    @php
                        $leavePct = $incidentTotal > 0 ? round(($incidents['leave'] / $incidentTotal) * 100) : 0;
                        $absentPct = $incidentTotal > 0 ? round(($incidents['absent'] / $incidentTotal) * 100) : 0;
                        $latePct = $incidentTotal > 0 ? round(($incidents['late'] / $incidentTotal) * 100) : 0;
                    @endphp
                    <div class="space-y-3 py-2">
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-gray-400">Approved Leaves</span>
                                <span class="text-white font-medium">{{ $leavePct }}%</span>
                            </div>
                            <div class="w-full bg-slate-800 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-amber-500 h-full" style="width: {{ $leavePct }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-gray-400">Unexcused Absences</span>
                                <span class="text-white font-medium">{{ $absentPct }}%</span>
                            </div>
                            <div class="w-full bg-slate-800 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-rose-500 h-full" style="width: {{ $absentPct }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-gray-400">Late Arrivals</span>
                                <span class="text-white font-medium">{{ $latePct }}%</span>
                            </div>
                            <div class="w-full bg-slate-800 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-blue-500 h-full" style="width: {{ $latePct }}%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="text-[11px] text-gray-500 text-center">Calculated across aggregate institutional
                        rosters.</div>
                </div>
            </div>

            <div
                class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4 border-b border-slate-800 pb-2">
                <div class="flex gap-2 pb-px">
                    <button onclick="switchTab('students')" id="tabBtn-students"
                        class="px-4 py-2 text-sm font-semibold transition-all border-b-2 border-blue-500 text-white">
                        Student Attendance Roster
                    </button>
                    <button onclick="switchTab('faculty')" id="tabBtn-faculty"
                        class="px-4 py-2 text-sm font-semibold transition-all border-b-2 border-transparent text-gray-400 hover:text-white">
                        Faculty Attendance Roster
                    </button>
                </div>

                <div>
                    <button id="bulkFacultyBtn" onclick="bulkMarkAll('roster-faculty')"
                        class="hidden flex items-center gap-1.5 text-xs font-semibold bg-slate-900 border border-slate-800 hover:border-emerald-500/50 hover:text-emerald-400 text-gray-400 px-3 py-1.5 rounded-xl transition">
                        <i class="bi bi-check-all text-sm"></i> Mark All Faculty Present
                    </button>
                </div>
            </div>

            <div class="space-y-8">

                <div id="roster-students"
                    class="card-bg rounded-2xl shadow-lg overflow-hidden transition-all duration-150">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse whitespace-nowrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold text-gray-400 uppercase tracking-wider bg-slate-900/60 border-b border-slate-800">
                                    <th class="p-4">Student Information</th>
                                    <th class="p-4">Academic Roster</th>
                                    <th class="p-4">Rolling Rate</th>
                                    <th class="p-4">Teacher's Marking</th>
                                    <th class="p-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-300 divide-y divide-slate-800">
                                @forelse($students as $student)
                                    @php
                                        $record = $todayRecords->get($student->id);
                                        $status = $record->status ?? 'present';
                                        $rate = $student->attendanceRate();
                                    @endphp
                                    <tr class="hover:bg-slate-900/40">
                                        <td class="p-4">
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-white">{{ $student->name }}</span>
                                                <span class="text-xs font-mono text-blue-400">Roll No.
                                                    {{ $student->roll_number }}</span>
                                            </div>
                                        </td>
                                        <td class="p-4 text-gray-400">{{ $student->class }} - {{ $student->section }}
                                        </td>
                                        <td
                                            class="p-4 font-semibold {{ $rate === null ? 'text-gray-500' : ($rate >= 90 ? 'text-emerald-400' : 'text-rose-400') }}">
                                            {{ $rate !== null ? $rate . '%' : 'No data' }}
                                        </td>
                                        <td class="p-4">
                                            @php
                                                $badgeClass = match ($status) {
                                                    'present'
                                                        => 'bg-emerald-500/10 border-emerald-500/20 text-emerald-400',
                                                    'absent' => 'bg-rose-500/10 border-rose-500/20 text-rose-400',
                                                    default => 'bg-amber-500/10 border-amber-500/20 text-amber-400',
                                                };
                                            @endphp
                                            <span id="status-student-{{ $student->id }}"
                                                class="px-2.5 py-1 rounded-full text-xs font-semibold border {{ $badgeClass }}">
                                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                                            </span>
                                        </td>
                                        <td class="p-4 text-right">
                                            <button
                                                onclick="openOverrideModal({{ $student->id }}, '{{ $student->name }}', '{{ $status }}', 'status-student-{{ $student->id }}')"
                                                class="text-xs font-semibold bg-slate-900 border border-slate-800 hover:border-blue-500/50 hover:text-blue-400 text-gray-400 px-3 py-1.5 rounded-xl transition">
                                                <i class="bi bi-pencil-square mr-1"></i> Edit Exception
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-6 text-center text-gray-500 text-sm">No students
                                            found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="roster-faculty"
                    class="card-bg rounded-2xl shadow-lg overflow-hidden hidden transition-all duration-150">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse whitespace-nowrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold text-gray-400 uppercase tracking-wider bg-slate-900/60 border-b border-slate-800">
                                    <th class="p-4">Educator Name</th>
                                    <th class="p-4">Department Base</th>
                                    <th class="p-4">Rolling Rate</th>
                                    <th class="p-4">Daily Check-In Status (Admin Action)</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-300 divide-y divide-slate-800">
                                @forelse($teachers as $teacher)
                                    @php
                                        $record = $todayRecords->get($teacher->id);
                                        $status = $record->status ?? 'present';
                                        $rate = $teacher->attendanceRate();
                                    @endphp
                                    <tr class="hover:bg-slate-900/40">
                                        <td class="p-4">
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-white">{{ $teacher->name }}</span>
                                                <span class="text-xs text-gray-400">{{ $teacher->email }}</span>
                                            </div>
                                        </td>
                                        <td class="p-4 text-gray-400">{{ $teacher->assigned_class ?? '—' }}</td>
                                        <td
                                            class="p-4 font-semibold {{ $rate === null ? 'text-gray-500' : ($rate >= 90 ? 'text-emerald-400' : 'text-rose-400') }}">
                                            {{ $rate !== null ? $rate . '%' : 'No data' }}
                                        </td>
                                        <td class="p-4">
                                            <div class="flex gap-1 status-group" data-user-id="{{ $teacher->id }}">
                                                <button onclick="setStatus(this, 'present')"
                                                    class="status-btn px-2.5 py-1 rounded-lg text-xs font-semibold {{ $status === 'present' ? 'bg-emerald-950 text-emerald-400 border border-emerald-800' : 'bg-slate-900 text-gray-500 border border-slate-800' }} transition">Present</button>
                                                <button onclick="setStatus(this, 'approved_leave')"
                                                    class="status-btn px-2.5 py-1 rounded-lg text-xs font-semibold {{ $status === 'approved_leave' ? 'bg-amber-950 text-amber-400 border border-amber-800' : 'bg-slate-900 text-gray-500 border border-slate-800' }} transition">On
                                                    Leave</button>
                                                <button onclick="setStatus(this, 'absent')"
                                                    class="status-btn px-2.5 py-1 rounded-lg text-xs font-semibold {{ $status === 'absent' ? 'bg-rose-950 text-rose-400 border border-rose-800' : 'bg-slate-900 text-gray-500 border border-slate-800' }} transition">Absent</button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="p-6 text-center text-gray-500 text-sm">No teachers
                                            found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="card-bg rounded-2xl shadow-lg overflow-hidden mt-8">
                            <div class="header-bg p-4 flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-lg bg-purple-950 flex items-center justify-center text-purple-400">
                                    <i class="bi bi-clock-history"></i>
                                </div>
                                <h3 class="font-bold text-base text-white">Attendance History</h3>
                            </div>
                            <div class="p-5 space-y-6">
                                @forelse($history as $day)
                                    <div
                                        class="flex flex-col sm:flex-row sm:items-start gap-4 pb-5 border-b border-slate-800/60 last:border-0 last:pb-0">
                                        <div class="w-32 shrink-0 font-bold text-white text-sm">{{ $day['date'] }}
                                        </div>
                                        <div class="flex-1 flex flex-wrap gap-2">
                                            @foreach ($day['entries'] as $entry)
                                                @if ($entry['present'])
                                                    <span
                                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-emerald-950/40 text-emerald-400 border border-emerald-800/40">
                                                        <i class="bi bi-check-lg"></i> {{ $entry['name'] }}
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-rose-950/40 text-rose-400 border border-rose-800/40">
                                                        <i class="bi bi-x-lg"></i> {{ $entry['name'] }}
                                                    </span>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="shrink-0 text-xl font-black text-amber-400">{{ $day['pct'] }}%
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-center text-gray-500 text-sm py-6">No attendance history yet.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <div id="overrideModal"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-[#090d16] bg-opacity-80 backdrop-blur-sm p-4 hidden opacity-0 transition-opacity duration-200 ease-out"
        role="dialog" aria-modal="true">
        <div
            class="w-full max-w-[480px] bg-[#111c2a] rounded-2xl shadow-2xl border border-slate-800 overflow-hidden transform opacity-0 scale-95 translate-y-4 transition-all duration-200 ease-out">
            <div class="p-5 flex justify-between items-center border-b border-slate-800/60 bg-[#142032]">
                <h3 class="text-base font-bold flex items-center gap-2.5 text-white">
                    <i class="bi bi-shield-exclamation text-amber-500 text-lg"></i> Admin Status Override
                </h3>
                <button onclick="toggleModal('overrideModal')" class="text-gray-400 hover:text-white transition">
                    <i class="bi bi-x-lg text-sm"></i>
                </button>
            </div>
            <form class="p-6 space-y-5" onsubmit="saveOverrideException(event)">
                <input type="hidden" id="targetBadgeId">
                <input type="hidden" id="targetUserId">


                <div class="bg-slate-950/40 border border-slate-800 rounded-xl p-4 space-y-2">
                    <div class="flex justify-between text-xs"><span class="text-gray-400">Student:</span> <span
                            id="modalStudentName" class="text-white font-semibold">--</span></div>
                    <div class="flex justify-between text-xs"><span class="text-gray-400">Teacher's Status:</span>
                        <span id="modalCurrentStatus" class="text-gray-400">--</span>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-gray-400">Apply New Overridden Status</label>
                    <div class="relative">
                        <select id="modalNewStatusSelect"
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500/80 transition appearance-none"
                            required>
                            <option value="Present">Present</option>
                            <option value="Absent">Absent</option>
                            <option value="Late">Late Entry</option>
                            <option value="Approved Leave">Approved Leave (Parent Request)</option>
                        </select>
                        <i
                            class="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-gray-400">Reason / Reference Note</label>
                    <textarea placeholder="e.g. Parent visited center to deliver medical certificate application..." rows="3"
                        class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/80 transition resize-none"
                        required></textarea>
                </div>

                <div class="pt-3 flex justify-end gap-3 border-t border-slate-800/40">
                    <button type="button" onclick="toggleModal('overrideModal')"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold border border-slate-800 bg-[#172232] text-gray-300 hover:bg-slate-800 hover:text-white transition">Cancel</button>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold bg-blue-600 hover:bg-blue-500 text-white transition shadow-lg shadow-blue-600/10">
                        Save Exception
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let pendingChanges = {};

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
                setTimeout(() => modal.classList.add('hidden'), 200);
            }
        }

        window.addEventListener('click', function(event) {
            if (event.target.id === 'overrideModal') toggleModal(event.target.id);
        });

        function switchTab(tabKey) {
            const studentTable = document.getElementById('roster-students');
            const facultyTable = document.getElementById('roster-faculty');
            const studentBtn = document.getElementById('tabBtn-students');
            const facultyBtn = document.getElementById('tabBtn-faculty');
            const bulkFaculty = document.getElementById('bulkFacultyBtn');

            if (tabKey === 'students') {
                studentTable.classList.remove('hidden');
                facultyTable.classList.add('hidden');
                bulkFaculty.classList.add('hidden');
                studentBtn.className =
                    "px-4 py-2 text-sm font-semibold transition-all border-b-2 border-blue-500 text-white";
                facultyBtn.className =
                    "px-4 py-2 text-sm font-semibold transition-all border-b-2 border-transparent text-gray-400 hover:text-white";
            } else {
                studentTable.classList.add('hidden');
                facultyTable.classList.remove('hidden');
                bulkFaculty.classList.remove('hidden');
                studentBtn.className =
                    "px-4 py-2 text-sm font-semibold transition-all border-b-2 border-transparent text-gray-400 hover:text-white";
                facultyBtn.className =
                    "px-4 py-2 text-sm font-semibold transition-all border-b-2 border-blue-500 text-white";
            }
        }

        function csrfToken() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }

        function stageChange(userId, status, note = null) {
            pendingChanges[userId] = {
                user_id: userId,
                status,
                note
            };
            updateSaveButton();
        }

        function updateSaveButton() {
            const btn = document.getElementById('saveChangesBtn');
            const count = Object.keys(pendingChanges).length;
            document.getElementById('pendingCount').textContent = count;
            if (count > 0) {
                btn.classList.remove('hidden');
                btn.classList.add('flex');
            } else {
                btn.classList.add('hidden');
                btn.classList.remove('flex');
            }
        }

        function saveAllChanges() {
            const changes = Object.values(pendingChanges);
            if (changes.length === 0) return;

            fetch("{{ route('admin.attendance.save-batch') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken(),
                    },
                    body: JSON.stringify({
                        changes
                    }),
                })
                .then(res => res.json())
                .then(() => {
                    pendingChanges = {};
                    location.reload();
                })
                .catch(err => console.error(err));
        }

        function openOverrideModal(userId, studentName, currentStatus, badgeId) {
            document.getElementById('modalStudentName').innerText = studentName;
            document.getElementById('modalCurrentStatus').innerText = currentStatus;
            document.getElementById('targetBadgeId').value = badgeId;
            document.getElementById('targetUserId').value = userId;
            document.getElementById('modalNewStatusSelect').value = currentStatus;
            toggleModal('overrideModal');
        }

        function saveOverrideException(event) {
            event.preventDefault();
            const userId = document.getElementById('targetUserId').value;
            const badgeId = document.getElementById('targetBadgeId').value;
            const newStatus = document.getElementById('modalNewStatusSelect').value;
            const note = event.target.querySelector('textarea').value;
            const statusKey = newStatus.toLowerCase().replace(' ', '_');

            const targetBadge = document.getElementById(badgeId);
            if (targetBadge) {
                targetBadge.innerText = newStatus;
                if (newStatus === 'Present') {
                    targetBadge.className =
                        "px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 border border-emerald-500/20 text-emerald-400";
                } else if (newStatus === 'Absent') {
                    targetBadge.className =
                        "px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-500/10 border border-rose-500/20 text-rose-400";
                } else {
                    targetBadge.className =
                        "px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-500/10 border border-amber-500/20 text-amber-400";
                }
            }

            stageChange(userId, statusKey, note);
            toggleModal('overrideModal');
        }

        function setStatus(button, type) {
            const group = button.closest('.status-group');
            const userId = group.dataset.userId;
            const buttons = group.querySelectorAll('.status-btn');

            buttons.forEach(btn => {
                btn.className =
                    "status-btn px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-900 text-gray-500 border border-slate-800 transition";
            });

            if (type === 'present') {
                button.className =
                    "status-btn px-2.5 py-1 rounded-lg text-xs font-semibold bg-emerald-950 text-emerald-400 border border-emerald-800 transition";
            } else if (type === 'approved_leave') {
                button.className =
                    "status-btn px-2.5 py-1 rounded-lg text-xs font-semibold bg-amber-950 text-amber-400 border border-amber-800 transition";
            } else if (type === 'absent') {
                button.className =
                    "status-btn px-2.5 py-1 rounded-lg text-xs font-semibold bg-rose-950 text-rose-400 border border-rose-800 transition";
            }

            stageChange(userId, type);
        }

        function bulkMarkAll(tableId) {
            const table = document.getElementById(tableId);
            const groups = table.querySelectorAll('.status-group');
            groups.forEach(group => {
                const presentBtn = group.querySelector('button:nth-child(1)');
                if (presentBtn) setStatus(presentBtn, 'present');
            });
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
