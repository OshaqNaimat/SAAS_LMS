<x-layout>



    <div class="flex h-screen ">

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
                        Invite Member
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
                        <span
                            class="text-xs px-3 py-1 rounded-full bg-slate-900 border border-slate-700 font-semibold text-gray-400">50
                            Registered</span>
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
                                <tr class="hover:bg-slate-900/40">
                                    <td class="p-4 font-semibold text-white">Dr. Sarah Jenkins</td>
                                    <td class="p-4 text-gray-400">Computer Science</td>
                                    <td class="p-4">s.jenkins@apex.edu</td>
                                    <td class="p-4">
                                        <span
                                            class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-950 text-emerald-400 border border-emerald-800">Active</span>
                                    </td>
                                    <td class="p-4 text-right">
                                        <button class="text-gray-500 hover:text-white"><i
                                                class="fa-solid fa-ellipsis-vertical"></i></button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-900/40">
                                    <td class="p-4 font-semibold text-white">Prof. Marcus Vance</td>
                                    <td class="p-4 text-gray-400">Mathematics</td>
                                    <td class="p-4">m.vance@apex.edu</td>
                                    <td class="p-4">
                                        <span
                                            class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-950 text-emerald-400 border border-emerald-800">Active</span>
                                    </td>
                                    <td class="p-4 text-right">
                                        <button class="text-gray-500 hover:text-white"><i
                                                class="fa-solid fa-ellipsis-vertical"></i></button>
                                    </td>
                                </tr>
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
                        <span
                            class="text-xs px-3 py-1 rounded-full bg-slate-900 border border-slate-700 font-semibold text-gray-400">500
                            Registered</span>
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
                                <tr class="hover:bg-slate-900/40">
                                    <td class="p-4 text-blue-400 font-mono font-medium">#AGI-2026-089</td>
                                    <td class="p-4 font-semibold text-white">Amara Sterling</td>
                                    <td class="p-4 text-gray-400">David Sterling</td>
                                    <td class="p-4">Grade 11 - Alpha</td>
                                    <td class="p-4">Aug 14, 2025</td>
                                    <td class="p-4 text-right">
                                        <button class="text-gray-500 hover:text-white"><i
                                                class="fa-solid fa-ellipsis-vertical"></i></button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-900/40">
                                    <td class="p-4 text-blue-400 font-mono font-medium">#AGI-2026-104</td>
                                    <td class="p-4 font-semibold text-white">Ethan Brooks</td>
                                    <td class="p-4 text-gray-400">Robert Brooks</td>
                                    <td class="p-4">Grade 12 - Omega</td>
                                    <td class="p-4">Sep 01, 2025</td>
                                    <td class="p-4 text-right">
                                        <button class="text-gray-500 hover:text-white"><i
                                                class="fa-solid fa-ellipsis-vertical"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </main>

        <div id="inviteModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75 backdrop-blur-sm p-4 hidden"
            role="dialog" aria-modal="true">
            <div
                class="card-bg w-full max-w-md rounded-2xl shadow-2xl overflow-hidden scale-95 transition-all duration-200">

                <div class="header-bg p-4 flex justify-between items-center">
                    <h3 class="text-base font-bold flex items-center gap-2 text-white">
                        <i class="bi bi-person-plus text-blue-500"></i> Invite Team Member
                    </h3>
                    <button onclick="toggleModal('inviteModal')" class="text-gray-400 hover:text-white"
                        aria-label="Close">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <form class="p-5 space-y-4" onsubmit="event.preventDefault(); toggleModal('inviteModal');">
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 mb-1">Email Address</label>
                        <input type="email" placeholder="colleague@example.com"
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2 text-sm text-white focus:outline-none focus:border-blue-500"
                            required>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 mb-1">Role</label>
                            <select
                                class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2 text-sm text-white focus:outline-none focus:border-blue-500">
                                <option disabled selected>Select Role...</option>
                                <option>Teacher</option>
                                <option>Admin</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 mb-1">Project</label>
                            <select
                                class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2 text-sm text-white focus:outline-none focus:border-blue-500">
                                <option disabled selected>Select project...</option>
                                <option>Class 1</option>
                                <option>Class 2</option>
                                <option>Class 3</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-400 mb-1">Message (optional)</label>
                        <input type="text" placeholder="Add a personal message..."
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2 text-sm text-white focus:outline-none focus:border-blue-500">
                    </div>

                    <div class="pt-2 flex justify-end gap-3">
                        <button type="button" onclick="toggleModal('inviteModal')"
                            class="px-4 py-2 rounded-xl text-sm font-medium border border-slate-700 text-gray-400 hover:bg-slate-800 transition">Cancel</button>
                        <button type="submit"
                            class="px-5 py-2 rounded-xl text-sm font-semibold bg-blue-600 text-white hover:bg-blue-500 transition flex items-center gap-2">
                            <i class="bi bi-send text-xs"></i> Send Invite
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div id="studentModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75 backdrop-blur-sm p-4 hidden">
            <div
                class="card-bg w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden scale-95 transition-all duration-200">
                <div class="header-bg p-4 flex justify-between items-center">
                    <h3 class="text-base font-bold flex items-center gap-2 text-white"><i
                            class="fa-solid fa-user-plus text-blue-400"></i> Add New Student Entry</h3>
                    <button onclick="toggleModal('studentModal')" class="text-gray-400 hover:text-white"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
                <form class="p-5 space-y-4" onsubmit="event.preventDefault(); toggleModal('studentModal');">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 mb-1">Student Name</label>
                            <input type="text" placeholder="Enter student name"
                                class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2 text-sm text-white focus:outline-none focus:border-blue-500"
                                required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 mb-1">Father's Name</label>
                            <input type="text" placeholder="Enter father's name"
                                class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2 text-sm text-white focus:outline-none focus:border-blue-500"
                                required>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 mb-1">Student Roll No.</label>
                            <input type="text" placeholder="e.g. AGI-2026-110"
                                class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2 text-sm text-white focus:outline-none focus:border-blue-500"
                                required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 mb-1">Class</label>
                            <input type="text" placeholder="e.g. Grade 12"
                                class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2 text-sm text-white focus:outline-none focus:border-blue-500"
                                required>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 mb-1">Section</label>
                            <input type="text" placeholder="e.g. Alpha"
                                class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2 text-sm text-white focus:outline-none focus:border-blue-500"
                                required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 mb-1">Admission Date</label>
                            <input type="date"
                                class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2 text-sm text-white focus:outline-none focus:border-blue-500"
                                required>
                        </div>
                    </div>
                    <div class="pt-2 flex justify-end gap-3">
                        <button type="button" onclick="toggleModal('studentModal')"
                            class="px-4 py-2 rounded-xl text-sm font-medium border border-slate-700 text-gray-400 hover:bg-slate-800">Cancel</button>
                        <button type="submit"
                            class="px-5 py-2 rounded-xl text-sm font-semibold bg-blue-600 text-white hover:bg-blue-500">Save
                            Entry</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function toggleModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal.classList.contains('hidden')) {
                    modal.classList.remove('hidden');
                } else {
                    modal.classList.add('hidden');
                }
            }
        </script>
    </div>

</x-layout>
