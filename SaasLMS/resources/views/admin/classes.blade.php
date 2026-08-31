<x-layout>
    <div class="flex h-screen relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <x-admin-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8 bg-gray-50">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Academic Classes & Analytics</h1>
                    <p class="text-sm text-gray-500 mt-1">Monitor section allocations, performance matrices, and manage
                        active curriculums.</p>
                </div>
                <div class="flex items-center gap-3 shrink-0 sm:self-center">

                    <button onclick="openAddClass()"
                        class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-sm font-semibold transition text-white shadow-md shadow-blue-600/10">
                        <i class="bi bi-plus-lg"></i> Create New Class
                    </button>
                    <button onclick="toggleSidebar()" class="hamburger-btn lg:hidden" aria-label="Open menu">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
            </div>

            <!-- ─── KPI CARDS (Light) ─── -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">
                <div
                    class="bg-white border border-gray-200 rounded-2xl p-5 flex items-center justify-between shadow-sm">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-500 font-medium">Total Classes</span>
                        <h4 class="text-2xl font-bold text-gray-900 tracking-tight">{{ $totalClasses }}</h4>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-blue-100 border border-blue-200 flex items-center justify-center text-blue-600 text-xl">
                        <i class="bi bi-door-open"></i>
                    </div>
                </div>

                <div
                    class="bg-white border border-gray-200 rounded-2xl p-5 flex items-center justify-between shadow-sm">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-500 font-medium">Avg Attendance</span>
                        <h4 class="text-2xl font-bold text-gray-900 tracking-tight">{{ $avgAttendance }}%</h4>
                        <span
                            class="text-[11px] {{ $avgAttendance >= 75 ? 'text-emerald-600' : 'text-red-500' }} flex items-center gap-1">
                            <i class="bi {{ $avgAttendance >= 75 ? 'bi-arrow-up-short' : 'bi-arrow-down-short' }}"></i>
                            Last 30 days
                        </span>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-emerald-100 border border-emerald-200 flex items-center justify-center text-emerald-600 text-xl">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                </div>

                <div
                    class="bg-white border border-gray-200 rounded-2xl p-5 flex items-center justify-between shadow-sm">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-500 font-medium">Overcrowded Classes</span>
                        <h4 class="text-2xl font-bold text-gray-900 tracking-tight">{{ $overcrowded }}</h4>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-red-100 border border-red-200 flex items-center justify-center text-red-500 text-xl">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>

            <!-- ─── CLASSES TABLE ─── -->
            <div class="space-y-8">
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-200">
                    <div
                        class="p-4 flex flex-col sm:flex-row justify-between items-center gap-3 border-b border-gray-200 bg-gray-50">
                        <div class="flex items-center gap-3 shrink-0">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600">
                                <i class="bi bi-collection"></i>
                            </div>
                            <h3 class="font-bold text-base text-gray-800">Active Class Configurations</h3>
                        </div>

                        <div class="relative flex items-center w-full sm:w-64">
                            <i class="bi bi-search absolute left-3 text-gray-400 text-xs leading-none"></i>
                            <input type="text" id="classSearchInput" placeholder="Search classes..."
                                autocomplete="off"
                                class="w-full bg-white border border-gray-300 rounded-xl pl-9 pr-3 py-2 text-xs text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 transition">
                        </div>

                        <span
                            class="text-xs px-3 py-1 rounded-full bg-gray-100 border border-gray-200 font-semibold text-gray-600 shrink-0"
                            id="classCountBadge">
                            {{ $classes->count() }}
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse whitespace-nowrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold text-gray-500 uppercase tracking-wider bg-gray-50/80 border-b border-gray-200">
                                    <th class="p-4">Class Identification</th>
                                    <th class="p-4">Assigned Mentor</th>
                                    <th class="p-4">Active Students</th>
                                    <th class="p-4">Seating Capacity</th>
                                    <th class="p-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-600 divide-y divide-gray-100">
                                @forelse($classes as $class)
                                    @php $count = $class->studentCount(); @endphp
                                    <tr id="class-{{ $class->id }}" class="class-row hover:bg-gray-50">
                                        <td class="p-4 font-semibold text-gray-800">
                                            <div class="flex flex-col">
                                                <span>{{ $class->name }} - {{ $class->section }}</span>
                                                <span class="text-xs font-normal text-gray-500">
                                                    {{ $class->room ?? 'No room set' }} @if ($class->stream)
                                                        • {{ $class->stream }}
                                                    @endif
                                                </span>
                                            </div>
                                        </td>
                                        <td class="p-4 text-gray-600">{{ $class->teacher->name ?? 'Unassigned' }}</td>
                                        <td
                                            class="p-4 font-mono text-xs {{ $count >= $class->max_seats ? 'text-red-500' : 'text-blue-600' }} font-medium">
                                            {{ $count }} Students / Max {{ $class->max_seats }}
                                        </td>
                                        <td class="p-4">
                                            @php $pct = $class->max_seats > 0 ? min(100, round($count / $class->max_seats * 100)) : 0; @endphp
                                            <div class="w-32 bg-gray-200 h-2 rounded-full overflow-hidden">
                                                <div class="{{ $pct >= 100 ? 'bg-red-500' : 'bg-blue-500' }} h-full"
                                                    style="width: {{ $pct }}%"></div>
                                            </div>
                                        </td>
                                        <td class="p-4 text-right">
                                            <button
                                                onclick="openPromoteClass({{ $class->id }}, '{{ $class->name }} - {{ $class->section }}', {{ $class->studentCount() }})"
                                                class="text-purple-400 hover:text-purple-300 transition px-2"
                                                title="Promote Class">
                                                <i class="bi bi-arrow-up-circle"></i>
                                            </button>
                                            <button
                                                onclick="openEditClass({{ $class->id }}, '{{ $class->name }}', '{{ $class->section }}', '{{ $class->stream }}', '{{ $class->room }}', {{ $class->max_seats }}, {{ $class->teacher_id ?? 'null' }})"
                                                class="text-yellow-600 hover:text-yellow-700 transition px-2"><i
                                                    class="bi bi-pencil-square"></i></button>
                                            <form action="{{ route('admin.classes.destroy', $class->id) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Delete {{ $class->name }} - {{ $class->section }}? This cannot be undone.');">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="text-gray-400 hover:text-red-500 transition px-2"><i
                                                        class="bi bi-trash3"></i></button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-6 text-center text-gray-400 text-sm">No classes
                                            created yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div id="promoteClassModal"
                            class="fixed inset-0 z-[100] flex items-center justify-center bg-[#090d16] bg-opacity-80 backdrop-blur-sm p-4 hidden opacity-0 transition-opacity duration-200 ease-out"
                            role="dialog" aria-modal="true">
                            <div
                                class="w-full max-w-[450px] bg-[#111c2a] rounded-2xl shadow-2xl border border-slate-800 overflow-hidden transform opacity-0 scale-95 translate-y-4 transition-all duration-200 ease-out">
                                <div
                                    class="p-5 flex justify-between items-center border-b border-slate-800/60 bg-[#142032]">
                                    <h3 class="text-base font-bold flex items-center gap-2 text-white">
                                        <i class="bi bi-arrow-up-circle text-purple-400"></i>
                                        Promote Class
                                    </h3>
                                    <button onclick="toggleModal('promoteClassModal')"
                                        class="text-gray-400 hover:text-white transition">
                                        <i class="bi bi-x-lg text-sm"></i>
                                    </button>
                                </div>
                                <form id="promoteClassForm" method="POST" class="p-6 space-y-4"
                                    onsubmit="return confirm('Are you absolutely sure? This will move all students immediately.');">
                                    @csrf
                                    <p class="text-sm text-gray-300">
                                        Promote all <span id="promoteStudentCount"
                                            class="font-bold text-white"></span> student(s) from
                                        <span id="promoteFromClass" class="font-bold text-white"></span> to:
                                    </p>
                                    <div class="space-y-1.5">
                                        <label class="block text-xs font-semibold text-gray-400">Destination
                                            Class</label>
                                        <select name="target_class_id" id="promoteTargetClass" required
                                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-purple-500/80 transition">
                                            <option value="">Select destination class...
                                            </option>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}">
                                                    {{ $class->name }} - {{ $class->section }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div
                                        class="bg-amber-500/10 border border-amber-500/20 text-amber-400 text-xs rounded-xl p-3">
                                        <i class="bi bi-exclamation-triangle-fill mr-1"></i> This
                                        will move every student out of their current class
                                        permanently. This action cannot be undone.
                                    </div>
                                    <div class="pt-3 flex justify-end gap-3 border-t border-slate-800/40">
                                        <button type="button" onclick="toggleModal('promoteClassModal')"
                                            class="px-5 py-2.5 rounded-xl text-sm font-semibold border border-slate-800 bg-[#172232] text-gray-300 hover:bg-slate-800 hover:text-white transition">Cancel</button>
                                        <button type="submit"
                                            class="px-5 py-2.5 rounded-xl text-sm font-semibold bg-purple-600 hover:bg-purple-500 text-white transition shadow-lg shadow-purple-600/10">
                                            Confirm Promotion
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- ─── CLASS MODAL (Light) ─── -->
    <div id="classModal"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm p-4 hidden opacity-0 transition-opacity duration-200 ease-out"
        role="dialog" aria-modal="true">
        <div
            class="w-full max-w-[550px] bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden transform opacity-0 scale-95 translate-y-4 transition-all duration-200 ease-out">
            <div class="p-5 flex justify-between items-center border-b border-gray-200 bg-gray-50">
                <h3 id="classModalTitle" class="text-base font-bold flex items-center gap-2.5 text-gray-800">
                    <i class="bi bi-door-open text-blue-600 text-lg"></i> Create New Class Configuration
                </h3>
                <button onclick="toggleModal('classModal')" class="text-gray-400 hover:text-gray-600 transition">
                    <i class="bi bi-x-lg text-sm"></i>
                </button>
            </div>
            <form id="classForm" action="{{ route('admin.classes.store') }}" method="POST" class="p-6 space-y-5">
                @csrf
                <input type="hidden" name="_method" id="classMethod" value="POST">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-500">Class Name / Grade</label>
                        <input type="text" name="name" id="className" placeholder="e.g. Grade 11" required
                            class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 transition">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-500">Section Designation</label>
                        <input type="text" name="section" id="classSection" placeholder="e.g. Alpha" required
                            class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 transition">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-gray-500">Assigned Lead Faculty Mentor</label>
                    <select name="teacher_id" id="classTeacher"
                        class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:border-blue-500 transition">
                        <option value="">Unassigned</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-500">Stream (optional)</label>
                        <input type="text" name="stream" id="classStream" placeholder="e.g. Science Stream"
                            class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 transition">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-500">Room Location</label>
                        <input type="text" name="room" id="classRoom" placeholder="e.g. Room 304"
                            class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 transition">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-gray-500">Max Roster Seats</label>
                    <input type="number" name="max_seats" id="classMaxSeats" placeholder="30" required
                        min="1"
                        class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 transition">
                </div>

                <div class="pt-3 flex justify-end gap-3 border-t border-gray-200">
                    <button type="button" onclick="toggleModal('classModal')"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold border border-gray-300 bg-gray-100 text-gray-600 hover:bg-gray-200 transition">Cancel</button>
                    <button type="submit" id="classSubmitBtn"
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

        window.addEventListener('click', function(event) {
            if (event.target.id === 'classModal') {
                toggleModal(event.target.id);
            }
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) closeSidebar();
        });

        function resetClassForm() {
            document.getElementById('classForm').action = "{{ route('admin.classes.store') }}";
            document.getElementById('classMethod').value = "POST";
            document.getElementById('classModalTitle').innerHTML =
                '<i class="bi bi-door-open text-blue-600 text-lg"></i> Create New Class Configuration';
            document.getElementById('classSubmitBtn').textContent = 'Create Configuration';
            document.getElementById('classForm').reset();
        }

        function openAddClass() {
            resetClassForm();
            toggleModal('classModal');
        }

        function openEditClass(id, name, section, stream, room, maxSeats, teacherId) {
            resetClassForm();
            document.getElementById('classForm').action = `/admin-classes-control/${id}`;
            document.getElementById('classMethod').value = "PUT";
            document.getElementById('classModalTitle').innerHTML =
                '<i class="bi bi-pencil-square text-yellow-600 text-lg"></i> Edit Class Configuration';
            document.getElementById('classSubmitBtn').textContent = 'Update Configuration';
            document.getElementById('className').value = name;
            document.getElementById('classSection').value = section;
            document.getElementById('classStream').value = stream ?? '';
            document.getElementById('classRoom').value = room ?? '';
            document.getElementById('classMaxSeats').value = maxSeats;
            document.getElementById('classTeacher').value = teacherId ?? '';
            toggleModal('classModal');
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (window.location.hash) {
                const target = document.querySelector(window.location.hash);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    target.classList.add('row-highlight');
                    setTimeout(() => target.classList.remove('row-highlight'), 2500);
                }
            }
        });

        const classSearchInput = document.getElementById('classSearchInput');
        const classCountBadge = document.getElementById('classCountBadge');

        if (classSearchInput) {
            classSearchInput.addEventListener('input', function() {
                const query = this.value.trim().toLowerCase();
                const rows = document.querySelectorAll('.class-row');
                let visibleCount = 0;
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    const matches = text.includes(query);
                    row.style.display = matches ? '' : 'none';
                    if (matches) visibleCount++;
                });
                classCountBadge.textContent = visibleCount;
            });
        }

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

        function openPromoteClass(classId, className, studentCount) {
            document.getElementById('promoteClassForm').action = `/admin/classes/${classId}/promote`;
            document.getElementById('promoteFromClass').textContent = className;
            document.getElementById('promoteStudentCount').textContent = studentCount;
            document.getElementById('promoteTargetClass').value = '';
            toggleModal('promoteClassModal');
        }
    </script>
</x-layout>
