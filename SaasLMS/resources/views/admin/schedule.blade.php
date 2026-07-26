<x-layout>
    <div class="flex h-screen relative">
        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>
        <x-admin-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-white">Teacher Schedule Management</h1>
                    <p class="text-sm text-gray-400 mt-1">Assign periods, subjects, and rooms to teachers across the
                        week.</p>
                </div>
                <button onclick="openAddSchedule()"
                    class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-sm font-semibold transition text-white shadow-md shadow-blue-600/10">
                    <i class="bi bi-plus-lg"></i> Assign Period
                </button>
            </div>

            <div class="card-bg rounded-2xl shadow-lg overflow-hidden">
                <div class="header-bg p-4 flex justify-between items-center">
                    <h3 class="font-bold text-base text-white">All Assigned Periods</h3>
                    <span
                        class="text-xs px-3 py-1 rounded-full bg-slate-900 border border-slate-700 font-semibold text-gray-400">
                        {{ $schedules->count() }}
                    </span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold text-gray-400 uppercase tracking-wider bg-slate-900/60 border-b border-slate-800">
                                <th class="p-4">Day</th>
                                <th class="p-4">Period</th>
                                <th class="p-4">Time</th>
                                <th class="p-4">Teacher</th>
                                <th class="p-4">Class</th>
                                <th class="p-4">Subject</th>
                                <th class="p-4">Room</th>
                                <th class="p-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-300 divide-y divide-slate-800">
                            @forelse($schedules as $s)
                                <tr class="hover:bg-slate-900/40">
                                    <td class="p-4 font-semibold text-white">{{ $s->dayName() }}</td>
                                    <td class="p-4 text-gray-400">{{ $s->period_number }}</td>
                                    <td class="p-4 text-xs font-mono text-blue-400">
                                        {{ \Carbon\Carbon::parse($s->start_time)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($s->end_time)->format('H:i') }}
                                    </td>
                                    <td class="p-4">{{ $s->teacher->name ?? 'Unknown' }}</td>
                                    <td class="p-4">{{ $s->classRoom->name ?? '' }} -
                                        {{ $s->classRoom->section ?? '' }}</td>
                                    <td class="p-4 text-gray-400">{{ $s->subject }}</td>
                                    <td class="p-4 text-gray-400">{{ $s->room ?? '—' }}</td>
                                    <td class="p-4 text-right">
                                        <button
                                            onclick="openEditSchedule({{ $s->id }}, {{ $s->teacher_id }}, {{ $s->class_room_id }}, '{{ $s->subject }}', {{ $s->day_of_week }}, {{ $s->period_number }}, '{{ \Carbon\Carbon::parse($s->start_time)->format('H:i') }}', '{{ \Carbon\Carbon::parse($s->end_time)->format('H:i') }}', '{{ $s->room }}')"
                                            class="text-yellow-400 hover:text-yellow-300 transition px-2">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <form action="{{ route('admin.schedule.destroy', $s->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Remove this period?');">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="text-gray-500 hover:text-rose-400 transition px-2">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="p-6 text-center text-gray-500 text-sm">No periods assigned
                                        yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8 space-y-6">
                <h3 class="text-xs font-bold text-gray-400 tracking-wide uppercase">Class Timetables (Student View)</h3>

                @forelse($classes as $class)
                    @php $classSchedules = $schedulesByClass->get($class->id, collect()); @endphp
                    <div class="card-bg rounded-2xl shadow-lg overflow-hidden">
                        <div class="header-bg p-4 flex justify-between items-center">
                            <h3 class="font-bold text-base text-white">{{ $class->name }} - {{ $class->section }}
                            </h3>
                            <span
                                class="text-xs px-3 py-1 rounded-full bg-slate-900 border border-slate-700 font-semibold text-gray-400">
                                {{ $classSchedules->count() }} Periods
                            </span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse whitespace-nowrap">
                                <thead>
                                    <tr
                                        class="text-xs font-semibold text-gray-400 uppercase tracking-wider bg-slate-900/60 border-b border-slate-800">
                                        <th class="p-4">Day</th>
                                        <th class="p-4">Period</th>
                                        <th class="p-4">Time</th>
                                        <th class="p-4">Subject</th>
                                        <th class="p-4">Teacher</th>
                                        <th class="p-4">Room</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm text-gray-300 divide-y divide-slate-800">
                                    @forelse($classSchedules as $s)
                                        <tr class="hover:bg-slate-900/40">
                                            <td class="p-4 font-semibold text-white">{{ $s->dayName() }}</td>
                                            <td class="p-4 text-gray-400">{{ $s->period_number }}</td>
                                            <td class="p-4 text-xs font-mono text-blue-400">
                                                {{ \Carbon\Carbon::parse($s->start_time)->format('H:i') }} -
                                                {{ \Carbon\Carbon::parse($s->end_time)->format('H:i') }}
                                            </td>
                                            <td class="p-4">{{ $s->subject }}</td>
                                            <td class="p-4 text-gray-400">{{ $s->teacher->name ?? 'Unknown' }}</td>
                                            <td class="p-4 text-gray-400">{{ $s->room ?? '—' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="p-6 text-center text-gray-500 text-sm">No periods
                                                scheduled for this class yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 text-sm py-6">No classes exist yet.</p>
                @endforelse
            </div>
        </main>
    </div>

    <!-- Assign/Edit Period Modal -->
    <div id="scheduleModal"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-[#090d16] bg-opacity-80 backdrop-blur-sm p-4 hidden opacity-0 transition-opacity duration-200 ease-out"
        role="dialog" aria-modal="true">
        <div
            class="w-full max-w-[550px] bg-[#111c2a] rounded-2xl shadow-2xl border border-slate-800 overflow-hidden transform opacity-0 scale-95 translate-y-4 transition-all duration-200 ease-out">
            <div class="p-5 flex justify-between items-center border-b border-slate-800/60 bg-[#142032]">
                <h3 id="scheduleModalTitle" class="text-base font-bold flex items-center gap-2.5 text-white">
                    <i class="bi bi-calendar-plus text-blue-500 text-lg"></i> Assign New Period
                </h3>
                <button onclick="toggleModal('scheduleModal')" class="text-gray-400 hover:text-white transition">
                    <i class="bi bi-x-lg text-sm"></i>
                </button>
            </div>
            <form id="scheduleForm" action="{{ route('admin.schedule.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="_method" id="scheduleMethod" value="POST">
                <div id="errorToast" class="error-toast">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <span id="errorToastMsg"></span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-400">Teacher</label>
                        <select name="teacher_id" id="scheduleTeacher" required
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500/80 transition">
                            <option value="">Select Teacher...</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-400">Class</label>
                        <select name="class_room_id" id="scheduleClass" required
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500/80 transition">
                            <option value="">Select Class...</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }} - {{ $class->section }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-gray-400">Subject</label>
                    <input type="text" name="subject" id="scheduleSubject" placeholder="e.g. Mathematics"
                        required
                        class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/80 transition">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-400">Day of Week</label>
                        <select name="day_of_week" id="scheduleDay" required
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500/80 transition">
                            <option value="1">Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-400">Period Number</label>
                        <input type="number" name="period_number" id="schedulePeriod" min="1"
                            placeholder="1" required
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/80 transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-400">Start Time</label>
                        <input type="time" name="start_time" id="scheduleStart" required
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500/80 transition">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-400">End Time</label>
                        <input type="time" name="end_time" id="scheduleEnd" required
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500/80 transition">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-gray-400">Room (optional)</label>
                    <input type="text" name="room" id="scheduleRoom" placeholder="e.g. Room 12"
                        class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/80 transition">
                </div>

                <div class="pt-3 flex justify-end gap-3 border-t border-slate-800/40">
                    <button type="button" onclick="toggleModal('scheduleModal')"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold border border-slate-800 bg-[#172232] text-gray-300 hover:bg-slate-800 hover:text-white transition">Cancel</button>
                    <button type="submit" id="scheduleSubmitBtn"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold bg-blue-600 hover:bg-blue-500 text-white transition shadow-lg shadow-blue-600/10">
                        Assign Period
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
                setTimeout(() => modal.classList.add('hidden'), 200);
            }
        }

        function resetScheduleForm() {
            document.getElementById('scheduleForm').action = "{{ route('admin.schedule.store') }}";
            document.getElementById('scheduleMethod').value = "POST";
            document.getElementById('scheduleModalTitle').innerHTML =
                '<i class="bi bi-calendar-plus text-blue-500 text-lg"></i> Assign New Period';
            document.getElementById('scheduleSubmitBtn').textContent = 'Assign Period';
            document.getElementById('scheduleForm').reset();
        }

        function openAddSchedule() {
            resetScheduleForm();
            toggleModal('scheduleModal');
        }

        function openEditSchedule(id, teacherId, classId, subject, day, period, startTime, endTime, room) {
            resetScheduleForm();
            document.getElementById('scheduleForm').action = `/admin/schedule/${id}`;
            document.getElementById('scheduleMethod').value = "PUT";
            document.getElementById('scheduleModalTitle').innerHTML =
                '<i class="bi bi-pencil-square text-yellow-400 text-lg"></i> Edit Period';
            document.getElementById('scheduleSubmitBtn').textContent = 'Update Period';
            document.getElementById('scheduleTeacher').value = teacherId;
            document.getElementById('scheduleClass').value = classId;
            document.getElementById('scheduleSubject').value = subject;
            document.getElementById('scheduleDay').value = day;
            document.getElementById('schedulePeriod').value = period;
            document.getElementById('scheduleStart').value = startTime;
            document.getElementById('scheduleEnd').value = endTime;
            document.getElementById('scheduleRoom').value = room === 'null' ? '' : room;
            toggleModal('scheduleModal');
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

        function showErrorToast(message) {
            const toast = document.getElementById('errorToast');
            const msg = document.getElementById('errorToastMsg');
            msg.textContent = message;
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 3500);
        }

        @if (session('error'))
            window.addEventListener('DOMContentLoaded', () => {
                showErrorToast(@json(session('error')));
            });
        @endif
    </script>
</x-layout>
