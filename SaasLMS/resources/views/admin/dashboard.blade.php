<x-layout>


    <x-admin-sidebar />
    <div class="bg-[#030712] text-[#f3f4f6] font-sans antialiased min-h-screen">

        <div class="flex min-h-screen">

            <div id="sidebar-target" class="hidden md:block">
                <script>
                    fetch('sidebar-lms.html')
                        .then(response => response.text())
                        .then(data => document.getElementById('sidebar-target').innerHTML = data)
                        .catch(() => {});
                </script>
            </div>

            <main class="flex-1 min-w-0 flex flex-col">

                <header
                    class="h-20 border-b border-[#1f2937] px-6 lg:px-8 flex items-center justify-between gap-4 bg-[#030712]/80 backdrop-blur sticky top-0 z-30">
                    <div>
                        <h1 class="text-xl font-bold text-white tracking-tight">Institution Dashboard</h1>
                        <p class="text-xs text-gray-400 hidden sm:block mt-0.5">Manage your teachers, students, and
                            courses efficiently.</p>
                    </div>

                    <div class="flex items-center gap-3 flex-1 justify-end max-w-2xl">
                        <div class="relative w-full max-w-xs hidden sm:block">
                            <i
                                class="bi bi-search absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-500 text-sm"></i>
                            <input type="text" placeholder="Search users, courses..."
                                class="w-full bg-[#111827] text-sm text-gray-200 pl-10 pr-4 py-2 rounded-xl border border-[#1f2937] focus:outline-none focus:border-[#2563eb] transition-all">
                        </div>

                        <button
                            class="relative p-2 text-gray-400 hover:text-white bg-[#111827] rounded-xl border border-[#1f2937] transition-colors">
                            <i class="bi bi-bell text-lg"></i>
                            <span
                                class="absolute top-1.5 right-1.5 w-4 h-4 bg-red-600 text-[10px] font-bold text-white rounded-full flex items-center justify-center">3</span>
                        </button>

                        <div class="flex items-center gap-2">
                            <button onclick="openFormModal('teacher')"
                                class="flex items-center gap-1.5 bg-[#1f2937] hover:bg-[#374151] text-gray-200 px-3.5 py-2 rounded-xl text-xs font-semibold tracking-wide border border-[#374151] transition-all">
                                <i class="bi bi-person-plus"></i>
                                <span>Add Teacher</span>
                            </button>
                            <button onclick="openFormModal('student')"
                                class="flex items-center gap-1.5 bg-[#06b6d4] hover:bg-[#0891b2] text-black px-3.5 py-2 rounded-xl text-xs font-bold tracking-wide transition-all shadow-lg shadow-cyan-500/10">
                                <i class="bi bi-plus-lg"></i>
                                <span>Add Student</span>
                            </button>
                        </div>
                    </div>
                </header>

                <div class="p-6 lg:p-8 space-y-6 max-w-[1600px] w-full mx-auto">

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="bg-[#0b0f17] p-5 rounded-2xl border border-[#1f2937] flex flex-col justify-between">
                            <div class="flex items-start justify-between">
                                <div
                                    class="w-10 h-10 bg-cyan-500/10 text-cyan-400 rounded-xl flex items-center justify-center text-xl">
                                    <i class="bi bi-person-video3"></i>
                                </div>
                                <span
                                    class="text-xs font-semibold text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-lg flex items-center gap-0.5"><i
                                        class="bi bi-arrow-up-short"></i>2</span>
                            </div>
                            <div class="mt-4">
                                <h3 class="text-2xl font-bold text-white font-mono">24</h3>
                                <p class="text-xs text-gray-400 mt-1">Total Teachers</p>
                            </div>
                        </div>
                        <div class="bg-[#0b0f17] p-5 rounded-2xl border border-[#1f2937] flex flex-col justify-between">
                            <div class="flex items-start justify-between">
                                <div
                                    class="w-10 h-10 bg-purple-500/10 text-purple-400 rounded-xl flex items-center justify-center text-xl">
                                    <i class="bi bi-people"></i>
                                </div>
                                <span
                                    class="text-xs font-semibold text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-lg flex items-center gap-0.5"><i
                                        class="bi bi-arrow-up-short"></i>45</span>
                            </div>
                            <div class="mt-4">
                                <h3 class="text-2xl font-bold text-white font-mono">486</h3>
                                <p class="text-xs text-gray-400 mt-1">Total Students</p>
                            </div>
                        </div>
                        <div class="bg-[#0b0f17] p-5 rounded-2xl border border-[#1f2937] flex flex-col justify-between">
                            <div class="flex items-start justify-between">
                                <div
                                    class="w-10 h-10 bg-emerald-500/10 text-emerald-400 rounded-xl flex items-center justify-center text-xl">
                                    <i class="bi bi-book"></i>
                                </div>
                                <span
                                    class="text-xs font-semibold text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-lg flex items-center gap-0.5"><i
                                        class="bi bi-arrow-up-short"></i>5</span>
                            </div>
                            <div class="mt-4">
                                <h3 class="text-2xl font-bold text-white font-mono">32</h3>
                                <p class="text-xs text-gray-400 mt-1">Active Courses</p>
                            </div>
                        </div>
                        <div class="bg-[#0b0f17] p-5 rounded-2xl border border-[#1f2937] flex flex-col justify-between">
                            <div class="flex items-start justify-between">
                                <div
                                    class="w-10 h-10 bg-amber-500/10 text-amber-500 rounded-xl flex items-center justify-center text-xl">
                                    <i class="bi bi-graph-up-arrow"></i>
                                </div>
                                <span
                                    class="text-xs font-semibold text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-lg flex items-center gap-0.5"><i
                                        class="bi bi-arrow-up-short"></i>3%</span>
                            </div>
                            <div class="mt-4">
                                <h3 class="text-2xl font-bold text-white font-mono">87%</h3>
                                <p class="text-xs text-gray-400 mt-1">Completion Rate</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                        <div class="lg:col-span-2 bg-[#0b0f17] rounded-2xl border border-[#1f2937] p-5 space-y-4">
                            <div class="flex items-center justify-between">
                                <h2 class="text-sm font-bold text-white tracking-wide">Teachers</h2>
                                <a href="#" class="text-xs text-blue-500 hover:underline">Manage All</a>
                            </div>

                            <div class="space-y-3">
                                <div
                                    class="flex items-center justify-between p-3.5 bg-[#111622]/40 border border-[#1f2937]/40 rounded-xl hover:border-[#374151] transition-all">
                                    <div class="flex items-center gap-3.5">
                                        <div
                                            class="w-9 h-9 rounded-xl bg-cyan-600/20 text-cyan-400 font-bold text-xs flex items-center justify-center">
                                            DMC</div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <h4 class="text-xs font-semibold text-white">Dr. Michael Chen</h4>
                                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                            </div>
                                            <p class="text-[11px] text-gray-500 mt-0.5">Mathematics</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-5 text-right">
                                        <div>
                                            <p class="text-xs text-gray-300 font-medium">86 students</p>
                                            <p class="text-[10px] text-amber-500 font-medium mt-0.5"><i
                                                    class="bi bi-star-fill mr-1"></i>4.9</p>
                                        </div>
                                        <button class="text-gray-500 hover:text-white"><i
                                                class="bi bi-three-dots-vertical"></i></button>
                                    </div>
                                </div>

                                <div
                                    class="flex items-center justify-between p-3.5 bg-[#111622]/40 border border-[#1f2937]/40 rounded-xl hover:border-[#374151] transition-all">
                                    <div class="flex items-center gap-3.5">
                                        <div
                                            class="w-9 h-9 rounded-xl bg-cyan-600/20 text-cyan-400 font-bold text-xs flex items-center justify-center">
                                            PEW</div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <h4 class="text-xs font-semibold text-white">Prof. Emily Watson</h4>
                                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                            </div>
                                            <p class="text-[11px] text-gray-500 mt-0.5">Physics</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-5 text-right">
                                        <div>
                                            <p class="text-xs text-gray-300 font-medium">72 students</p>
                                            <p class="text-[10px] text-amber-500 font-medium mt-0.5"><i
                                                    class="bi bi-star-fill mr-1"></i>4.8</p>
                                        </div>
                                        <button class="text-gray-500 hover:text-white"><i
                                                class="bi bi-three-dots-vertical"></i></button>
                                    </div>
                                </div>

                                <div
                                    class="flex items-center justify-between p-3.5 bg-[#111622]/40 border border-[#1f2937]/40 rounded-xl hover:border-[#374151] transition-all">
                                    <div class="flex items-center gap-3.5">
                                        <div
                                            class="w-9 h-9 rounded-xl bg-cyan-600/20 text-cyan-400 font-bold text-xs flex items-center justify-center">
                                            DJM</div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <h4 class="text-xs font-semibold text-white">Dr. James Miller</h4>
                                                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                                            </div>
                                            <p class="text-[11px] text-gray-500 mt-0.5">Chemistry</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-5 text-right">
                                        <div>
                                            <p class="text-xs text-gray-300 font-medium">64 students</p>
                                            <p class="text-[10px] text-amber-500 font-medium mt-0.5"><i
                                                    class="bi bi-star-fill mr-1"></i>4.7</p>
                                        </div>
                                        <button class="text-gray-500 hover:text-white"><i
                                                class="bi bi-three-dots-vertical"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="bg-[#0b0f17] p-5 rounded-2xl border border-[#1f2937] space-y-4">
                                <h2 class="text-sm font-bold text-white tracking-wide">Quick Actions</h2>
                                <div class="grid grid-cols-2 gap-3">
                                    <button onclick="openFormModal('teacher')"
                                        class="p-4 bg-[#111622]/60 hover:bg-[#111622] rounded-xl border border-[#1f2937] flex flex-col items-center justify-center gap-2 transition-all group">
                                        <div
                                            class="w-8 h-8 bg-cyan-500/10 text-cyan-400 rounded-xl flex items-center justify-center text-base group-hover:scale-110 transition-transform">
                                            <i class="bi bi-person-fill-add"></i>
                                        </div>
                                        <span class="text-[11px] font-medium text-gray-300">Add Teacher</span>
                                    </button>
                                    <button onclick="openFormModal('student')"
                                        class="p-4 bg-[#111622]/60 hover:bg-[#111622] rounded-xl border border-[#1f2937] flex flex-col items-center justify-center gap-2 transition-all group">
                                        <div
                                            class="w-8 h-8 bg-purple-500/10 text-purple-400 rounded-xl flex items-center justify-center text-base group-hover:scale-110 transition-transform">
                                            <i class="bi bi-people-fill"></i>
                                        </div>
                                        <span class="text-[11px] font-medium text-gray-300">Add Student</span>
                                    </button>
                                    <button
                                        class="p-4 bg-[#111622]/60 hover:bg-[#111622] rounded-xl border border-[#1f2937] flex flex-col items-center justify-center gap-2 transition-all group">
                                        <div
                                            class="w-8 h-8 bg-emerald-500/10 text-emerald-400 rounded-xl flex items-center justify-center text-base group-hover:scale-110 transition-transform">
                                            <i class="bi bi-journal-plus"></i>
                                        </div>
                                        <span class="text-[11px] font-medium text-gray-300">New Course</span>
                                    </button>
                                    <button
                                        class="p-4 bg-[#111622]/60 hover:bg-[#111622] rounded-xl border border-[#1f2937] flex flex-col items-center justify-center gap-2 transition-all group">
                                        <div
                                            class="w-8 h-8 bg-amber-500/10 text-amber-500 rounded-xl flex items-center justify-center text-base group-hover:scale-110 transition-transform">
                                            <i class="bi bi-calendar-plus"></i>
                                        </div>
                                        <span class="text-[11px] font-medium text-gray-300">Schedule</span>
                                    </button>
                                </div>
                            </div>

                            <div class="bg-[#0b0f17] p-5 rounded-2xl border border-[#1f2937] space-y-4">
                                <h2 class="text-sm font-bold text-white tracking-wide">Popular Courses</h2>
                                <div class="space-y-3.5">
                                    <div>
                                        <div class="flex justify-between text-xs mb-1.5"><span
                                                class="text-gray-300 font-medium">Advanced Mathematics</span><span
                                                class="text-gray-500 font-mono text-[11px]">156 enrolled</span></div>
                                        <div class="w-full bg-[#1e293b] h-1.5 rounded-full overflow-hidden">
                                            <div class="bg-cyan-500 h-1.5 rounded-full" style="width: 85%"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between text-xs mb-1.5"><span
                                                class="text-gray-300 font-medium">Introduction to Physics</span><span
                                                class="text-gray-500 font-mono text-[11px]">142 enrolled</span></div>
                                        <div class="w-full bg-[#1e293b] h-1.5 rounded-full overflow-hidden">
                                            <div class="bg-cyan-400 h-1.5 rounded-full" style="width: 73%"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between text-xs mb-1.5"><span
                                                class="text-gray-300 font-medium">Web Development</span><span
                                                class="text-gray-500 font-mono text-[11px]">128 enrolled</span></div>
                                        <div class="w-full bg-[#1e293b] h-1.5 rounded-full overflow-hidden">
                                            <div class="bg-cyan-500 h-1.5 rounded-full" style="width: 60%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#0b0f17] p-5 rounded-2xl border border-[#1f2937] space-y-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm font-bold text-white tracking-wide">Recently Enrolled Students</h2>
                            <a href="#" class="text-xs text-blue-500 hover:underline">View All Students</a>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div
                                class="p-4 bg-[#111622]/40 border border-[#1f2937]/60 rounded-xl flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-indigo-600/20 text-indigo-400 flex items-center justify-center text-xs font-bold font-mono">
                                    AT</div>
                                <div class="min-w-0">
                                    <h4 class="text-xs font-semibold text-white truncate">Alex Turner</h4>
                                    <p class="text-[10px] text-gray-500 truncate mt-0.5">Web Development</p>
                                    <p class="text-[9px] text-gray-600 font-mono mt-1">Enrolled: Today</p>
                                </div>
                            </div>
                            <div
                                class="p-4 bg-[#111622]/40 border border-[#1f2937]/60 rounded-xl flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-purple-600/20 text-purple-400 flex items-center justify-center text-xs font-bold font-mono">
                                    JL</div>
                                <div class="min-w-0">
                                    <h4 class="text-xs font-semibold text-white truncate">Jessica Lee</h4>
                                    <p class="text-[10px] text-gray-500 truncate mt-0.5">Data Science</p>
                                    <p class="text-[9px] text-gray-600 font-mono mt-1">Enrolled: Yesterday</p>
                                </div>
                            </div>
                            <div
                                class="p-4 bg-[#111622]/40 border border-[#1f2937]/60 rounded-xl flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-600/20 text-blue-400 flex items-center justify-center text-xs font-bold font-mono">
                                    MJ</div>
                                <div class="min-w-0">
                                    <h4 class="text-xs font-semibold text-white truncate">Marcus Johnson</h4>
                                    <p class="text-[10px] text-gray-500 truncate mt-0.5">Mathematics</p>
                                    <p class="text-[9px] text-gray-600 font-mono mt-1">Enrolled: 2 days ago</p>
                                </div>
                            </div>
                            <div
                                class="p-4 bg-[#111622]/40 border border-[#1f2937]/60 rounded-xl flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-fuchsia-600/20 text-fuchsia-400 flex items-center justify-center text-xs font-bold font-mono">
                                    EW</div>
                                <div class="min-w-0">
                                    <h4 class="text-xs font-semibold text-white truncate">Emma Wilson</h4>
                                    <p class="text-[10px] text-gray-500 truncate mt-0.5">Physics</p>
                                    <p class="text-[9px] text-gray-600 font-mono mt-1">Enrolled: 3 days ago</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>

        <div id="formModal"
            class="fixed inset-0 z-50 invisible opacity-0 transition-all duration-300 flex items-center justify-center p-4 sm:p-6">
            <div onclick="closeFormModal()" class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>

            <div class="bg-[#0b0f17] border border-[#1f2937] w-full max-w-md rounded-2xl shadow-2xl relative z-10 transform scale-95 transition-all duration-300 overflow-hidden"
                id="modalFrame">
                <div class="p-5 border-b border-[#1f2937] flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div id="modalIconBox" class="w-9 h-9 rounded-xl flex items-center justify-center text-base">
                            <i id="modalHeaderIcon" class="bi bi-person-fill-add"></i>
                        </div>
                        <div>
                            <h3 id="modalTitle" class="text-sm font-bold text-white">Add New Profile</h3>
                            <p id="modalSubtitle" class="text-[11px] text-gray-400 mt-0.5">Insert verification records
                                details</p>
                        </div>
                    </div>
                    <button onclick="closeFormModal()" class="text-gray-500 hover:text-white p-1 rounded-lg"><i
                            class="bi bi-x-lg text-sm"></i></button>
                </div>

                <form class="p-5 space-y-4" onsubmit="event.preventDefault(); closeFormModal();">
                    <div>
                        <label id="nameLabel" class="block text-xs font-semibold text-gray-400 mb-1.5">Full
                            Name</label>
                        <input type="text" placeholder="e.g. Alex Turner" required
                            class="w-full bg-[#111827] text-xs text-white px-4 py-2.5 rounded-xl border border-[#1f2937] focus:outline-none focus:border-cyan-500 transition-colors placeholder:text-gray-600">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-400 mb-1.5">Gmail Address</label>
                        <input type="email" placeholder="username@gmail.com" required
                            class="w-full bg-[#111827] text-xs text-white px-4 py-2.5 rounded-xl border border-[#1f2937] focus:outline-none focus:border-cyan-500 transition-colors placeholder:text-gray-600">
                    </div>

                    <div id="dynamicSelectContainer">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-400 mb-1.5">Initial Access Password</label>
                        <input type="password" placeholder="••••••••" required
                            class="w-full bg-[#111827] text-xs text-white px-4 py-2.5 rounded-xl border border-[#1f2937] focus:outline-none focus:border-cyan-500 transition-colors placeholder:text-gray-600">
                    </div>

                    <div class="flex gap-2.5 justify-end pt-2">
                        <button type="button" onclick="closeFormModal()"
                            class="px-4 py-2.5 rounded-xl text-xs font-semibold bg-[#111827] hover:bg-[#1f2937] border border-[#1f2937] text-gray-300 transition-colors">Cancel</button>
                        <button type="submit" id="submitModalBtn"
                            class="px-4 py-2.5 rounded-xl text-xs font-bold text-black transition-colors shadow-lg">Save
                            Profile</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            const formModal = document.getElementById('formModal');
            const modalFrame = document.getElementById('modalFrame');
            const modalTitle = document.getElementById('modalTitle');
            const modalSubtitle = document.getElementById('modalSubtitle');
            const modalIconBox = document.getElementById('modalIconBox');
            const modalHeaderIcon = document.getElementById('modalHeaderIcon');
            const nameLabel = document.getElementById('nameLabel');
            const dynamicSelectContainer = document.getElementById('dynamicSelectContainer');
            const submitModalBtn = document.getElementById('submitModalBtn');

            function openFormModal(mode) {
                // Reconfigure Modal Form Structure on the fly matching context profile constraints
                if (mode === 'teacher') {
                    modalTitle.innerText = "Add Teacher";
                    modalSubtitle.innerText = "Register new instructor department profile accounts";
                    nameLabel.innerText = "Teacher Name";

                    modalIconBox.className =
                        "w-9 h-9 rounded-xl bg-cyan-500/10 text-cyan-400 flex items-center justify-center text-base";
                    modalHeaderIcon.className = "bi bi-person-workspace";
                    submitModalBtn.className =
                        "px-4 py-2.5 rounded-xl text-xs font-bold bg-[#06b6d4] hover:bg-[#0891b2] text-black transition-colors shadow-lg shadow-cyan-500/10";

                    dynamicSelectContainer.innerHTML = `
                    <label class="block text-xs font-semibold text-gray-400 mb-1.5">Assigned Faculty Department</label>
                    <select class="w-full bg-[#111827] text-xs text-gray-300 px-4 py-2.5 rounded-xl border border-[#1f2937] focus:outline-none focus:border-cyan-500 transition-colors">
                        <option>Mathematics Department</option>
                        <option>Physics Faculty</option>
                        <option>Chemistry Division</option>
                        <option>Computer Sciences Branch</option>
                    </select>
                `;
                } else if (mode === 'student') {
                    modalTitle.innerText = "Add Student";
                    modalSubtitle.innerText = "Enroll new student record matrix profiles";
                    nameLabel.innerText = "Student Name";

                    modalIconBox.className =
                        "w-9 h-9 rounded-xl bg-purple-500/10 text-purple-400 flex items-center justify-center text-base";
                    modalHeaderIcon.className = "bi bi-mortarboard";
                    submitModalBtn.className =
                        "px-4 py-2.5 rounded-xl text-xs font-bold bg-purple-600 hover:bg-purple-700 text-white transition-colors shadow-lg shadow-purple-600/10";

                    dynamicSelectContainer.innerHTML = `
                    <label class="block text-xs font-semibold text-gray-400 mb-1.5">Primary Course Selection Enrollment</label>
                    <select class="w-full bg-[#111827] text-xs text-gray-300 px-4 py-2.5 rounded-xl border border-[#1f2937] focus:outline-none focus:border-purple-500 transition-colors">
                        <option>Advanced Mathematics</option>
                        <option>Introduction to Physics</option>
                        <option>Full-Stack Web Development</option>
                        <option>Data Sciences Roadmap</option>
                    </select>
                `;
                }

                // Execute Animation Classes Display Transition
                formModal.classList.remove('invisible', 'opacity-0');
                modalFrame.classList.remove('scale-95');
                modalFrame.classList.add('scale-100');
            }

            function closeFormModal() {
                formModal.classList.add('opacity-0');
                modalFrame.classList.remove('scale-100');
                modalFrame.classList.add('scale-95');
                setTimeout(() => {
                    formModal.classList.add('invisible');
                }, 300);
            }
        </script>
    </div>


</x-layout>
