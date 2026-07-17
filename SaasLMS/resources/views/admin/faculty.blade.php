<x-layout>
    <div class="flex h-screen relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <x-admin-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-white">Faculty & Roster Hub</h1>
                    <p class="text-sm text-gray-400 mt-1">Manage your institution's educators, personnel, and registered
                        student data arrays.</p>
                </div>
                <div class="flex items-center gap-3 shrink-0 sm:self-center">
                    <button onclick="toggleModal('inviteModal')"
                        class="flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-700 bg-slate-800 hover:bg-slate-700 text-sm font-semibold transition text-gray-200">
                        Add a Member
                    </button>
                    <button onclick="toggleModal('studentModal')"
                        class="flex items-center gap-2 px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-sm font-semibold transition text-white shadow-md">
                        Add New Student
                    </button>
                </div>
            </div>

            <div class="space-y-8">

                <div class="card-bg rounded-2xl shadow-lg overflow-hidden">
                    <div class="header-bg p-4 flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-lg bg-emerald-950 flex items-center justify-center text-emerald-400">
                                <i class="fa-solid fa-graduation-cap"></i>
                            </div>
                            <h3 class="font-bold text-base text-white">Active Faculty Members</h3>
                        </div>
                        {{-- <span
                            class="text-xs px-3  py-1 rounded-full bg-slate-900 border border-slate-700 font-semibold text-gray-400">
                            {{ $teachers->count() }} Registered
                        </span> --}}
                        <div class="kpi-value">{{ $totalTeachers }}</div>

                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse whitespace-nowrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold text-gray-400 uppercase tracking-wider bg-slate-900/60 border-b border-slate-800">
                                    <th class="p-4">Name</th>
                                    <th class="p-4">Department</th>
                                    <th class="p-4">Email Address</th>
                                    <th class="p-4">Status</th>
                                    <th class="p-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-300 divide-y divide-slate-800">
                                @forelse($teachers as $teacher)
                                    <tr class="hover:bg-slate-900/40">
                                        <td class="p-4 font-semibold text-white">{{ $teacher->name }}</td>
                                        <td class="p-4 text-gray-400">{{ $teacher->assigned_class ?? '—' }}</td>
                                        <td class="p-4">{{ $teacher->email }}</td>
                                        <td class="p-4">
                                            <span
                                                class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-950 text-emerald-400 border border-emerald-800">Active</span>
                                        </td>
                                        <td class="p-4 text-right">
                                            <button class="text-gray-500 hover:text-white">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-6 text-center text-gray-500 text-sm">No teachers
                                            added yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-bg rounded-2xl shadow-lg overflow-hidden">
                    <div class="header-bg p-4 flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-pink-950 flex items-center justify-center text-pink-400">
                                <i class="fa-solid fa-user-graduate"></i>
                            </div>
                            <h3 class="font-bold text-base text-white">Enrolled Student Registry</h3>
                        </div>
                        {{-- <span
                            class="text-xs px-3 py-1 rounded-full bg-slate-900 border border-slate-700 font-semibold text-gray-400">
                            {{ $students->count() }} Registered
                        </span> --}}
                        <div class="kpi-value">{{ $totalStudents }}</div>

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
                                    <tr class="hover:bg-slate-900/40">
                                        <td class="p-4 text-blue-400 font-mono font-medium">#{{ $student->roll_number }}
                                        </td>
                                        <td class="p-4 font-semibold text-white">{{ $student->name }}</td>
                                        <td class="p-4 text-gray-400">{{ $student->father_name }}</td>
                                        <td class="p-4">{{ $student->class }} - {{ $student->section }}</td>
                                        <td class="p-4">{{ $student->created_at->format('M d, Y') }}</td>
                                        <td class="p-4 text-right">
                                            <button class="text-gray-500 hover:text-white">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
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

    <form action="{{ route('admin.add-teacher') }}" method="POST" class="p-6 space-y-5">
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
                <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-400">Assigned Class</label>
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
    </form>

    <form action="{{ route('admin.add-student') }}" method="POST" class="p-6 space-y-5">
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
    </form>

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
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            const container = modal.querySelector('.transform'); // Finds the inner modal box

            if (modal.classList.contains('hidden')) {
                // 1. Unhide container element first
                modal.classList.remove('hidden');

                // 2. Tiny timeout allows the browser to register the display change before animating
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    modal.classList.add('opacity-100');

                    if (container) {
                        container.classList.remove('opacity-0', 'scale-95', 'translate-y-4');
                        container.classList.add('opacity-100', 'scale-100', 'translate-y-0');
                    }
                }, 20);
            } else {
                // 1. Fade out and scale down
                modal.classList.remove('opacity-100');
                modal.classList.add('opacity-0');

                if (container) {
                    container.classList.remove('opacity-100', 'scale-100', 'translate-y-0');
                    container.classList.add('opacity-0', 'scale-95', 'translate-y-4');
                }

                // 2. Wait for the CSS animation duration (200ms) before adding 'hidden' back
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 200);
            }
        }

        // Global window listener to close modal if backdrop background wrapper is clicked
        window.addEventListener('click', function(event) {
            // Check if the clicked target is one of our modal container wrappers
            if (event.target.id === 'inviteModal' || event.target.id === 'studentModal') {
                toggleModal(event.target.id);
            }
        });

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
