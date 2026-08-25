<x-layout>
    <div class="flex h-screen relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>
        <x-admin-sidebar />
        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <!-- Header with hamburger on mobile -->
            <div class="flex items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-white">Faculty & Roster Hub</h1>
                    <p class="text-sm text-gray-400 mt-1">Manage your institution's educators, personnel, and registered
                        student data arrays.</p>
                </div>
                <button onclick="toggleSidebar()" class="hamburger-btn lg:hidden" aria-label="Open menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>

            <div class="space-y-8">

                <div class="card-bg rounded-2xl shadow-lg overflow-hidden">
                    <div class="header-bg p-4 flex flex-col sm:flex-row justify-between items-center gap-3">
                        <div class="flex items-center gap-3 shrink-0">
                            <div
                                class="w-8 h-8 rounded-lg bg-emerald-950 flex items-center justify-center text-emerald-400">
                                <i class="fa-solid fa-graduation-cap"></i>
                            </div>
                            <h3 class="font-bold text-base text-white">Active Faculty Members</h3>
                        </div>

                        <div class="relative flex items-center w-full sm:w-64">
                            <i class="bi bi-search absolute left-3 text-gray-500 text-xs leading-none"></i>
                            <input type="text" id="teacherSearchInput" placeholder="Search teachers..."
                                autocomplete="off"
                                class="w-full bg-[#090d16] border border-slate-800 rounded-xl pl-9 pr-3 py-2 text-xs text-white placeholder-gray-600 focus:outline-none focus:border-emerald-500 transition">
                        </div>

                        <span
                            class="text-xs px-3 py-1 rounded-full bg-slate-900 border border-slate-700 font-semibold text-gray-400 shrink-0"
                            id="teacherCountBadge">
                            {{ $teachers->count() }} Registered
                        </span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse whitespace-nowrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold text-gray-400 uppercase tracking-wider bg-slate-900/60 border-b border-slate-800">
                                    <th class="p-4">Name</th>
                                    <th class="p-4">Assigned Class</th>
                                    <th class="p-4">Email Address</th>
                                    <th class="p-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-300 divide-y divide-slate-800">
                                @forelse($teachers as $teacher)
                                    <tr id="teacher-{{ $teacher->id }}" class="teacher-row hover:bg-slate-900/40">
                                        <td class="p-4 font-semibold text-white">{{ $teacher->name }}</td>
                                        <td class="p-4 text-gray-400">
                                            @php $ledClass = $teacher->ledClasses->first(); @endphp
                                            {{ $ledClass ? $ledClass->name . ' - ' . $ledClass->section : $teacher->assigned_class ?? '—' }}
                                        </td>
                                        <td class="p-4">{{ $teacher->email }}</td>
                                        <td class="p-4 text-right">
                                            <div class="flex items-center justify-end gap-3">
                                                <button
                                                    onclick="openEditTeacher({{ $teacher->id }}, '{{ $teacher->name }}', '{{ $teacher->email }}', '{{ $ledClass ? $ledClass->name . ' - ' . $ledClass->section : $teacher->assigned_class ?? '' }}')"
                                                    class="text-yellow-400 hover:text-yellow-300 transition"
                                                    title="Edit">
                                                    <i class="fa-solid fa-pen"></i>
                                                </button>
                                                <form action="{{ route('admin.user.destroy', $teacher->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Remove {{ $teacher->name }}? This cannot be undone.');"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-400 hover:text-red-300 transition"
                                                        title="Delete">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="p-4 text-right">
                                            <div class="flex items-center justify-end gap-3">
                                                <form action="{{ route('admin.user.destroy', $teacher->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Remove {{ $teacher->name }}? This cannot be undone.');"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-400 hover:text-red-300 transition"
                                                        title="Delete">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="p-6 text-center text-gray-500 text-sm">No teachers
                                            added yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-bg rounded-2xl shadow-lg overflow-hidden">
                    <div class="header-bg p-4 flex flex-col sm:flex-row justify-between items-center gap-3">
                        <div class="flex items-center gap-3 shrink-0">
                            <div class="w-8 h-8 rounded-lg bg-pink-950 flex items-center justify-center text-pink-400">
                                <i class="fa-solid fa-user-graduate"></i>
                            </div>
                            <h3 class="font-bold text-base text-white">Enrolled Student Registry</h3>
                        </div>

                        <div class="relative flex items-center w-full sm:w-64">
                            <i class="bi bi-search absolute left-3 text-gray-500 text-xs leading-none"></i>
                            <input type="text" id="studentSearchInput" placeholder="Search students..."
                                autocomplete="off"
                                class="w-full bg-[#090d16] border border-slate-800 rounded-xl pl-9 pr-3 py-2 text-xs text-white placeholder-gray-600 focus:outline-none focus:border-pink-500 transition">
                        </div>

                        <span
                            class="text-xs px-3 py-1 rounded-full bg-slate-900 border border-slate-700 font-semibold text-gray-400 shrink-0"
                            id="studentCountBadge">
                            {{ $students->count() }} Registered
                        </span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse whitespace-nowrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold text-gray-400 uppercase tracking-wider bg-slate-900/60 border-b border-slate-800">
                                    <th class="p-4">Roll No.</th>
                                    <th class="p-4">Student Name</th>
                                    <th class="p-4">Father's Name</th>
                                    <th class="p-4">Class & Section</th>
                                    <th class="p-4">Admission Date</th>
                                    <th class="p-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-300 divide-y divide-slate-800">
                                @forelse($students as $student)
                                    <tr id="student-{{ $student->id }}" class="student-row hover:bg-slate-900/40">
                                        <td class="p-4 text-blue-400 font-mono font-medium">
                                            #{{ $student->roll_number }}
                                        </td>
                                        <td class="p-4 font-semibold text-white">{{ $student->name }}</td>
                                        <td class="p-4 text-gray-400">{{ $student->father_name }}</td>
                                        <td class="p-4">{{ $student->classRoom->name ?? '—' }} -
                                            {{ $student->classRoom->section ?? '' }}</td>
                                        <td class="p-4">{{ $student->created_at->format('M d, Y') }}</td>
                                        <td class="p-4 text-right">
                                            <div class="flex items-center justify-end gap-3">
                                                <button
                                                    onclick="window.location.href='{{ route('admin.student.profile', $student->id) }}'"
                                                    class="text-blue-400 hover:text-blue-300 transition"
                                                    title="View Profile">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                                <form action="{{ route('admin.user.destroy', $student->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Remove {{ $student->name }}? This cannot be undone.');"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-400 hover:text-red-300 transition"
                                                        title="Delete">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-6 text-center text-gray-500 text-sm">No students
                                            added yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Forms & Modals (unchanged) -->
    {{-- <form action="{{ route('admin.add-teacher') }}" method="POST" class="p-6 space-y-5">
        @csrf
        <input type="hidden" name="role" value="teacher">

        <div class="space-y-1.5">
            <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-400">Full Name</label>
            <input type="text" name="name" placeholder="Prof. Mashood" required
                class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/80 transition">
        </div>

        <div class="space-y-1.5">
            <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-400">Email Address</label>
            <input type="email" name="email" placeholder="teacher@apex.edu" required
                class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/80 transition">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1.5">
                <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-400">Password</label>
                <input type="password" name="password" placeholder="••••••••" required
                    class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/80 transition">
            </div>
            <div class="space-y-1.5">
                <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-400">Assigned
                    Class</label>
                <select name="assigned_class"
                    class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500/80 transition">
                    <option value="">Select Class...</option>
                    <option value="Class 1">Class 1</option>
                    <option value="Class 2">Class 2</option>
                    <option value="Class 3">Class 3</option>
                </select>
            </div>
        </div>

        <div class="pt-3 flex justify-end gap-3 border-t border-slate-800/40">
            <button type="button" onclick="toggleModal('inviteModal')"
                class="px-5 py-2.5 rounded-xl text-sm font-semibold border border-slate-800 bg-[#172232] text-gray-300 hover:bg-slate-800 hover:text-white transition">Cancel</button>
            <button type="submit"
                class="px-5 py-2.5 rounded-xl text-sm font-semibold bg-blue-600 hover:bg-blue-500 text-white transition flex items-center gap-2 shadow-lg shadow-blue-600/10">
                <i class="bi bi-send text-xs"></i> Register Teacher
            </button>
        </div>
    </form> --}}

    {{-- <form action="{{ route('admin.add-student') }}" method="POST" class="p-6 space-y-5">
        @csrf
        <input type="hidden" name="role" value="student">

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-gray-400">Student Name</label>
                <input type="text" name="name" placeholder="Enter student name" required
                    class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500 transition">
            </div>
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-gray-400">Father's Name</label>
                <input type="text" name="father_name" placeholder="Enter father's name" required
                    class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500 transition">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-gray-400">Student Roll No.</label>
                <input type="text" name="roll_number" placeholder="e.g. AGI-2026-110" required
                    class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500 transition">
            </div>
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-gray-400">Class</label>
                <input type="text" name="class" placeholder="e.g. Grade 12" required
                    class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500 transition">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-gray-400">Section</label>
                <input type="text" name="section" placeholder="e.g. Alpha" required
                    class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500 transition">
            </div>
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-gray-400">Password</label>
                <input type="password" name="password" placeholder="••••••••" required
                    class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500 transition">
            </div>
        </div>

        <div class="pt-3 flex justify-end gap-3 border-t border-slate-800/40">
            <button type="button" onclick="toggleModal('studentModal')"
                class="px-4 py-2 rounded-xl text-sm font-medium border border-slate-700 text-gray-400 hover:bg-slate-800 transition">Cancel</button>
            <button type="submit"
                class="px-5 py-2 rounded-xl text-sm font-semibold bg-blue-600 text-white hover:bg-blue-500 transition">Save
                Entry</button>
        </div>
    </form> --}}

    <div id="editTeacherModal"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-[#090d16] bg-opacity-80 backdrop-blur-sm p-4 hidden opacity-0 transition-opacity duration-200 ease-out"
        role="dialog" aria-modal="true">
        <div
            class="w-full max-w-[500px] bg-[#111c2a] rounded-2xl shadow-2xl border border-slate-800 overflow-hidden transform opacity-0 scale-95 translate-y-4 transition-all duration-200 ease-out">
            <div class="p-5 flex justify-between items-center border-b border-slate-800/60 bg-[#142032]">
                <h3 class="text-base font-bold flex items-center gap-2 text-white">
                    <i class="fa-solid fa-user-pen text-yellow-400"></i> Edit Teacher
                </h3>
                <button onclick="toggleModal('editTeacherModal')" class="text-gray-400 hover:text-white transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form id="editTeacherForm" method="POST" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                <div class="space-y-1.5">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-400">Full Name</label>
                    <input type="text" name="name" id="editTeacherName" required
                        class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/80 transition">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-400">Email
                        Address</label>
                    <input type="email" name="email" id="editTeacherEmail" required
                        class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/80 transition">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-400">Assigned
                        Class</label>
                    <select name="assigned_class" id="editTeacherClass"
                        class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500/80 transition">
                        <option value="">No class assigned yet</option>
                        @foreach (\App\Models\ClassRoom::where('organization_id', Auth::user()->organization_id)->get() as $class)
                            <option value="{{ $class->name }} - {{ $class->section }}">{{ $class->name }} -
                                {{ $class->section }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="pt-3 flex justify-end gap-3 border-t border-slate-800/40">
                    <button type="button" onclick="toggleModal('editTeacherModal')"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold border border-slate-800 bg-[#172232] text-gray-300 hover:bg-slate-800 hover:text-white transition">Cancel</button>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold bg-blue-600 hover:bg-blue-500 text-white transition flex items-center gap-2 shadow-lg shadow-blue-600/10">
                        <i class="bi bi-check-lg text-xs"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="studentModal"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-[#090d16] bg-opacity-80 backdrop-blur-sm p-4 hidden"
        role="dialog" aria-modal="true">
        <div
            class="w-full max-w-2xl bg-[#111c2a] rounded-2xl shadow-2xl border border-slate-800 overflow-hidden transform scale-100 transition-all duration-200">
            <div class="p-5 flex justify-between items-center border-b border-slate-800/60 bg-[#142032]">
                <h3 class="text-base font-bold flex items-center gap-2 text-white">
                    <i class="fa-solid fa-user-plus text-blue-400"></i> Add New Student Entry
                </h3>
                <button onclick="toggleModal('studentModal')" class="text-gray-400 hover:text-white transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form class="p-6 space-y-5" onsubmit="event.preventDefault(); toggleModal('studentModal');">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-400">Student Name</label>
                        <input type="text" placeholder="Enter student name"
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500 transition"
                            required>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-400">Father's Name</label>
                        <input type="text" placeholder="Enter father's name"
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500 transition"
                            required>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-400">Student Roll No.</label>
                        <input type="text" placeholder="e.g. AGI-2026-110"
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500 transition"
                            required>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-400">Class</label>
                        <input type="text" placeholder="e.g. Grade 12"
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500 transition"
                            required>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-400">Section</label>
                        <input type="text" placeholder="e.g. Alpha"
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500 transition"
                            required>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-400">Admission Date</label>
                        <input type="date"
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500 transition"
                            required>
                    </div>
                </div>
                <div class="pt-3 flex justify-end gap-3 border-t border-slate-800/40">
                    <button type="button" onclick="toggleModal('studentModal')"
                        class="px-4 py-2 rounded-xl text-sm font-medium border border-slate-700 text-gray-400 hover:bg-slate-800 transition">Cancel</button>
                    <button type="submit"
                        class="px-5 py-2 rounded-xl text-sm font-semibold bg-blue-600 text-white hover:bg-blue-500 transition">Save
                        Entry</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        /* ─── Sidebar Toggle ─── */
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

        /* ─── Modal Logic ─── */
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

        // window.addEventListener('click', function(event) {
        //     if (event.target.id === 'inviteModal' || event.target.id === 'studentModal') {
        //         toggleModal(event.target.id);
        //     }
        // });
        window.addEventListener('click', function(event) {
            if (event.target.id === 'inviteModal' || event.target.id === 'studentModal' || event.target.id ===
                'editTeacherModal') {
                toggleModal(event.target.id);
            }
        });

        /* ─── Action Menus ─── */
        function toggleActionMenu(id) {
            document.querySelectorAll('[id^="menu-"]').forEach(menu => {
                if (menu.id !== 'menu-' + id) menu.classList.add('hidden');
            });
            document.getElementById('menu-' + id).classList.toggle('hidden');
        }

        window.addEventListener('click', function(e) {
            if (!e.target.closest('[id^="menu-"]') && !e.target.closest('button[onclick^="toggleActionMenu"]')) {
                document.querySelectorAll('[id^="menu-"]').forEach(menu => menu.classList.add('hidden'));
            }
        });

        /* ─── Search & Highlight ─── */
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

        const teacherSearchInput = document.getElementById('teacherSearchInput');
        const teacherCountBadge = document.getElementById('teacherCountBadge');
        if (teacherSearchInput) {
            teacherSearchInput.addEventListener('input', function() {
                const query = this.value.trim().toLowerCase();
                const rows = document.querySelectorAll('.teacher-row');
                let visibleCount = 0;
                rows.forEach(row => {
                    const matches = row.textContent.toLowerCase().includes(query);
                    row.style.display = matches ? '' : 'none';
                    if (matches) visibleCount++;
                });
                teacherCountBadge.textContent = `${visibleCount} Shown`;
            });
        }

        const studentSearchInput = document.getElementById('studentSearchInput');
        const studentCountBadge = document.getElementById('studentCountBadge');
        if (studentSearchInput) {
            studentSearchInput.addEventListener('input', function() {
                const query = this.value.trim().toLowerCase();
                const rows = document.querySelectorAll('.student-row');
                let visibleCount = 0;
                rows.forEach(row => {
                    const matches = row.textContent.toLowerCase().includes(query);
                    row.style.display = matches ? '' : 'none';
                    if (matches) visibleCount++;
                });
                studentCountBadge.textContent = `${visibleCount} Shown`;
            });
        }

        function openEditTeacher(id, name, email, assignedClass) {
            document.getElementById('editTeacherForm').action = `/admin/teachers/${id}`;
            document.getElementById('editTeacherName').value = name;
            document.getElementById('editTeacherEmail').value = email;
            document.getElementById('editTeacherClass').value = assignedClass;
            toggleModal('editTeacherModal');
        }
    </script>
</x-layout>
